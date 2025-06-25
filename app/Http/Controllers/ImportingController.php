<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\Member;
use App\Models\RecoverySheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportingController extends Controller
{

public function getFileData($filePath) {
    
    if (!Storage::disk("public")->exists($filePath)) {
        return 'CSV file not found.';
    }

    $localPath = Storage::disk("public")->path($filePath);
    $csvData = [];

    if (($handle = fopen($localPath, 'r')) !== false) {
        $headers = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = array_combine($headers, $row);
        }

        fclose($handle);
    }

    return $csvData;
}
public function getLevels($level) {
    return str_replace(" ", "", strtolower($level));
}
public function import() {
    // Deleting All Members
    Member::withTrashed()->forceDelete();


    $csvData = $this->getFileData("members_2.csv");
    $recoveryData = $this->getFileData("register_member.csv");
    $recoverySheetData = $this->getFileData("recovery.csv");
    $membershipcardData = $this->getFileData("membership_cards.csv");
   
    foreach ($csvData as $index => $member) {
        $data = [...array_filter($recoveryData, fn($data) => $data["membership_number"] === $member["membership_no"])];
        
        
        $associatedRecoverySheets = null;
        $membershipCardData = null;
        if($data) {
            $membershipCardData = [...array_filter($membershipcardData, fn($cardData) => $data[0]["membership_number"] === $cardData["members_no"])];
            $associatedRecoverySheets = [...array_filter($recoverySheetData, fn($recoveryData) => $recoveryData["register_member_id"] === $data[0]["id"])];
        }

        try {
            $dob = \Carbon\Carbon::createFromFormat('m/d/Y', trim($member['date_of_birth']))->format('Y-m-d');
            $doa = \Carbon\Carbon::createFromFormat('m/d/Y', trim($member['date_of_applying']))->format('Y-m-d');
        } catch (\Exception $e) {
            continue;
        }

        $membershipType = CardType::where("card_name", trim($member["membership_type"]))->first();
        $member = Member::createQuietly([
            "id" => $member["id"],
            "member_name" => trim($member["members_name"]),
            "date_of_birth" => $dob,
            "gender" => strtolower(trim($member["gender"])),
            "marital_status" => trim($member["martial_status"]),
            "cnic_passport" => trim($member["cnic_passport"]),
            "phone_number" => trim($member["phone_number"]),
            "phone_number_code" => trim($member["country_code"]),
            "alternate_ph_number" => "1",
            "alternate_ph_number_code" => "3323743375",
            "email_address" => trim($member["email_address"]),
            "residential_address" => trim($member["residential_address"]),
            "city_country" => trim($member["city_country"]),
            "membership_type" => $membershipType?->id ?? 1,
            "membership_number" => trim($member["membership_no"]),
            "membership_status" => "regular",
            "file_number" => trim($member["file_no"]),
            "date_of_applying" => $doa,
            "form_fee" => (int)str_replace(",", "", $data[0]["form_fee"] ?? 0),
            "processing_fee" => (int)str_replace(",", "", $data[0]["processing_fee"] ?? 0),
            "first_payment" => (int)str_replace(",", "", $data[0]["first_payment"] ?? 0),
            "total_installment" => (int)str_replace(",", "", $data[0]["installment"] ?? 0),
            "installment_month" => $data[0]["plan_month"] ?? 0,
            "payment_status" => $this->getLevels($data[0]["status"] ?? 'regular'),
            "blood_group" => $membershipCardData[0]["blood_group"] ?? "AB+",
            "emergency_contact" => "1",
            "emergency_contact_code" => "92",
            "profile_picture" => "profile_pictures/default-user.png",
            "card_type" => $membershipCardData[0]["members_type"] ?? "Cleared",
            "date_of_issue" => $membershipCardData[0]["date_of_issue"] ?? now(),
            "validity" => $membershipCardData[0]["validity"] ?? now()->addYears(4),
            "has_receipt_created" => 0,
            "locker_category" => "a",
            "locker_number" => "12",    
            "user_token" => Str::uuid()
        ]);

        if($associatedRecoverySheets) {
            foreach($associatedRecoverySheets as $recoverySheet) {
                try {
                    $month = \Carbon\Carbon::createFromFormat('m/d/Y', trim($recoverySheet['month']))->format('Y-m-d');
                    $due_date = \Carbon\Carbon::createFromFormat('m/d/Y', trim($recoverySheet['due_date']))->format('Y-m-d');
                } catch (\Exception $e) {
                    \Log::warning("Skipping row #$index due to invalid date: " . $e->getMessage());
                    Log::error($e->getMessage());
                    continue;
                }
                $recovery = RecoverySheet::createQuietly([
                    "member_id" => $member->id,
                    "month" => $month,
                    "due_date" => $due_date,
                    "payment_description" => $recoverySheet["payment_description"],
                    "current_month_payable" => (int)str_replace(",", "", $recoverySheet["current_month_payable"] ?? 0),
                    "late_payment_charges" => (int)str_replace(",", "", $recoverySheet["late_payment_charges"] ?? 0),
                    "payable" => (int)str_replace(",", "", $recoverySheet["payable"] ?? 0),
                    "paid" => (int)str_replace(",", "", $recoverySheet["paid"] ?? 0),
                    "due_amount" => (int)str_replace(",", "", $recoverySheet["due_amount"] ?? 0),
                    "due_b_f" => (int)str_replace(",", "", $recoverySheet["due_b_f"] ?? 0),
                    "main_balance" => (int)str_replace(",", "", $recoverySheet["main_balance"] ?? 0),
                    "total_sum_value" => (int)str_replace(",", "", $recoverySheet["total_sum_value"] ?? 0)
                ]);
            }
        }
    }

    dd("Imported");
}

}
