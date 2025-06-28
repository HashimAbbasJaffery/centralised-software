<?php

namespace App\Http\Controllers;

use App\Models\{Member, Child, Spouse, RecoverySheet, CardType};
use App\Models\Club;
use App\Models\Duration;
use App\Models\Introletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage, Log};
use Carbon\Carbon;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class ImportingController extends Controller
{
    public function getFileData($filePath) 
    {
        if (!Storage::disk("public")->exists($filePath)) {
            return [];
        }

        $localPath = Storage::disk("public")->path($filePath);
        $csvData = [];

        if (($handle = fopen($localPath, 'r')) !== false) {
            $headers = fgetcsv($handle);
            $headers = array_map('trim', $headers);

            while (($row = fgetcsv($handle)) !== false) {
                $csvData[] = array_combine($headers, $row);
            }

            fclose($handle);
        }

        return $csvData;
    }

    public function getLevels($level) 
    {
        return str_replace(" ", "", strtolower($level ?? 'regular'));
    }

    public function isValidDateFormat($date, $format = 'Y-m-d') 
    {
        if (empty($date)) return false;
        
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function parseDate($dateString) 
    {
        if (empty($dateString)) {
            return null;
        }

        try {
            if ($this->isValidDateFormat($dateString, 'Y-m-d')) {
                return $dateString;
            }
            return Carbon::createFromFormat('m/d/Y', $dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::warning("Failed to parse date: {$dateString}");
            return null;
        }
    }

    public function cleanNumber($value) 
    {
        if (is_numeric($value)) return (int)$value;
        return (int)str_replace([',', ' '], '', $value ?? '0');
    }

    public function import() 
    {
        // DB::transaction(function () {
            // Clear existing data
            RecoverySheet::query()->forceDelete();
            Child::query()->forceDelete();
            Spouse::query()->forceDelete();
            Member::query()->forceDelete();

            // Load CSV data
            $membersData = $this->getFileData("members_2.csv");
            $registerMembers = $this->getFileData("register_member.csv");
            $recoverySheets = $this->getFileData("recovery.csv");
            $membershipCards = $this->getFileData("membership_cards.csv");
            $introletters = $this->getFileData("customer.csv");
            $complains = $this->getFileData("complains.csv");

            foreach ($membersData as $member) {
                try {
                    // Find related records
                    $registerMember = collect($registerMembers)
                        ->firstWhere('membership_number', $member['membership_no']);
                    
                    $card = collect($membershipCards)
                        ->firstWhere('members_no', $member['membership_no']);

                    $letter = collect($introletters)
                                ->firstWhere("membership_no", $member["membership_no"]);

                    $complains = collect($complains)
                                ->firstWhere("membership_number", $member["membership_no"]);

                    // Process main member data
                    $newMember = $this->createMember($member, $registerMember, $card);

                    // Migrate children
                    $this->migrateChildren($member, $newMember->id, $card);

                    // Migrate spouses
                    $this->migrateSpouses($member, $newMember->id, $card);

                    $this->migrateLetter($newMember->id, $letter);

                    // Migrate recovery sheets
                    if ($registerMember) {
                        $this->migrateRecoverySheets(
                            $registerMember['id'],
                            $recoverySheets,
                            $newMember->id
                        );
                    }

                } catch (\Exception $e) {
                    dd($e);
                    Log::error("Migration failed for member {$member['membership_no']}: " . $e->getMessage());
                    continue;
                }
            }
        // });

        return response()->json(['message' => 'Migration completed successfully']);
    }

    protected function createMember($member, $registerMember, $card)
    {
        if((isset($member["cnic_passport"]) && isset($card["cnic"])) && $member["cnic_passport"] != $card["cnic"]) {
            $card = null;
        }
        $cardType = CardType::where('card_name', trim($member['membership_type'] ?? ''))->first();
        return Member::create([
            'member_name' => trim($member['members_name'] ?? ''),
            'date_of_birth' => $this->parseDate($member['date_of_birth'] ?? null),
            'gender' => strtolower(trim($member['gender'] ?? '')),
            'marital_status' => trim($member['martial_status'] ?? ''),
            'cnic_passport' => trim($member['cnic_passport'] ?? ''),
            'phone_number' => trim($member['phone_number'] ?? ''),
            'phone_number_code' => trim($member['country_code'] ?? ''),
            'recovery_phone_number' => $registerMember['phone_1'] ?? '',
            'alternate_ph_number' => $registerMember['phone_2'] ?? '',
            'alternate_ph_number_code' => '3323743375', // Default as in your original
            'email_address' => trim($member['email_address'] ?? ''),
            'residential_address' => trim($member['residential_address'] ?? ''),
            'city_country' => trim($member['city_country'] ?? ''),
            'membership_type' => $cardType ? $cardType->id : 1,
            'membership_number' => trim($member['membership_no'] ?? ''),
            'membership_status' => 'regular',
            'file_number' => trim($member['file_no'] ?? ''),
            'date_of_applying' => $this->parseDate($member['date_of_applying'] ?? null),
            'form_fee' => $this->cleanNumber($registerMember['form_fee'] ?? 0),
            'processing_fee' => $this->cleanNumber($registerMember['processing_fee'] ?? 0),
            'first_payment' => $this->cleanNumber($registerMember['first_payment'] ?? 0),
            'total_installment' => $this->cleanNumber($registerMember['installment'] ?? 0),
            'installment_month' => $registerMember['plan_month'] ?? 0,
            'payment_status' => $this->getLevels($registerMember['status'] ?? null),
            'blood_group' => $card['blood_group'] ?? 'AB+',
            'emergency_contact' => $card['emergency_no'] ?? '',
            'emergency_contact_code' => '92',
            'profile_picture' => $this->getProfilePicturePath($card),
            'card_type' => $card['members_type'] ?? 'Cleared',
            'date_of_issue' => $this->parseDate($card['date_of_issue'] ?? null) ?? now(),
            'validity' => $this->parseDate($card['validity'] ?? null) ?? now()->addYears(4),
            'has_receipt_created' => 0,
            'locker_category' => 'a',
            'locker_number' => '12',
            'user_token' => Str::uuid(),
            'created_at' => now(),
            'updated_at' => now(),
            'country' => $this->extractCountry($member['city_country'] ?? ''),
            'city' => $this->extractCity($member['city_country'] ?? '')
        ]);
    }
    protected function numberToOrdinal($number) {
    $map = [
        1 => 'first',
        2 => 'second',
        3 => 'third',
        4 => 'fourth',
        5 => 'fifth',
        6 => 'sixth',
        7 => 'seventh',
        8 => 'eight',
        9 => 'nineth',
        10 => 'tenth'
    ];

    return $map[$number] ?? $number;
}

    protected function migrateLetter($newMemberId, $letter) {
        if(!$newMemberId) return;
        if(!$letter) return;

        $duration = explode(" ", $letter["duration"])[0];

        $club = Club::firstWhere("club_name", $letter["clubs"]);
        $duration = Duration::firstWhere("months", $duration);

        if(!strlen($letter["clubs"])) {
            return;
        }
        if(!$club) {
            return;
        }

        
        Introletter::create([
            "member_id" => $newMemberId,
            "spouse" => $letter["spouse"] != "yes" && $letter["spouse"] != "no" ? "no" : $letter["spouse"],
            "children" => $letter["children"] != "yes" && $letter["children"] != "no" ? "no" : $letter["children"],
            "club_id" => $club->id,
            "duration_id" => $duration->id,
            "status" => 1,
        ]);
    }
    protected function migrateChildren($member, $memberId, $card)
    {
        $children = [];
        for ($i = 1; $i <= 10; $i++) {
            $nameField = "{$this->numberToOrdinal($i)}_child_name";
            $dobField = "{$this->numberToOrdinal($i)}_child_dob";
            if (!empty($member[$nameField]) && !empty($member[$dobField])) {
                if($member[$nameField] === "NULL") continue;
                $children[] = [
                    'child_name' => $member[$nameField],
                    'cnic' => '', // Not in source data
                    'date_of_birth' => $this->parseDate($member[$dobField] ?? "1974-4-19") ?? "1974-4-19",
                    'date_of_issue' => $this->parseDate($card['date_of_issue'] ?? "1974-4-19") ?? "1974-4-19",
                    'validity' => $this->parseDate($card['validity'] ?? "1974-4-19") ?? "1974-4-19",
                    'blood_group' => $card['blood_group'] ?? 'AB+',
                    'profile_pic' => '', // Not in source data
                    'member_id' => $memberId,
                    'membership_id' => 1, // Can be updated later if needed
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        if (!empty($children)) {
            Child::insert($children);
        }

    }

    protected function migrateSpouses($member, $memberId, $card)
    {

        $membership_type = $member["membership_type"];
        $spouses = [];     
        
        for ($i = 1; $i <= 4; $i++) {
            $field = $i === 1 ? 'spouse_name' : "{$this->numberToOrdinal($i)}_spouse_name";
            
            if (!empty($member[$field])) {
                if($member[$field] === "NULL") continue;
                $spouses[] = [
                    'spouse_name' => $member[$field],
                    'cnic' => '', // Not in source data
                    'date_of_birth' => "1974-4-19", // Not in source data
                    'date_of_issue' => $this->parseDate($card['date_of_issue'] ?? "1974-4-19") ?? "1974-4-19",
                    'validity' => $this->parseDate($card['validity'] ?? "1974-4-19") ?? "1974-4-19",
                    'blood_group' => $card['blood_group'] ?? 'AB+',
                    'picture' => $this->getSpousePicturePath($card), // Not in source data
                    'member_id' => $memberId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        if (!empty($spouses)) {
            Spouse::insert($spouses);
        }
    }

    protected function migrateRecoverySheets($registerMemberId, $allSheets, $memberId)
    {
        $sheets = collect($allSheets)
            ->where('register_member_id', $registerMemberId);

        $recoveryData = [];
        
        foreach ($sheets as $sheet) {
            $recoveryData[] = [
                'member_id' => $memberId,
                'month' => $this->parseDate($sheet['month'] ?? null),
                'due_date' => $this->parseDate($sheet['due_date'] ?? null),
                'payment_description' => $sheet['payment_description'] ?? '',
                'current_month_payable' => $this->cleanNumber($sheet['current_month_payable'] ?? 0),
                'late_payment_charges' => $this->cleanNumber($sheet['late_payment_charges'] ?? 0),
                'payable' => $this->cleanNumber($sheet['payable'] ?? 0),
                'paid' => $this->cleanNumber($sheet['paid']) ?? null,
                'due_amount' => $this->cleanNumber($sheet['due_amount'] ?? 0),
                'due_b_f' => $this->cleanNumber($sheet['due_b_f'] ?? 0),
                'main_balance' => $this->cleanNumber($sheet['main_balance'] ?? 0),
                'total_sum_value' => $this->cleanNumber($sheet['total_sum_value'] ?? 0),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        if (!empty($recoveryData)) {
            RecoverySheet::insert($recoveryData);
        }
    }

    protected function getProfilePicturePath($card)
    {
        if (!$card || empty($card['profile_picture'])) {
            return 'profile_pictures/default-user.png';
        }
        return str_replace('uploads', 'profile_pictures', $card['profile_picture']);
    }
    protected function getSpousePicturePath($card)
    {
        if (!$card || empty($card['profile_picture'])) {
            return 'profile_pictures/default-user.png';
        }
        return str_replace('uploads', 'uploads/spouses_picture', $card['profile_picture']);
    }

    protected function extractCountry($cityCountry)
    {
        // Implement your logic to extract country from city_country
        return trim($cityCountry);
    }

    protected function extractCity($cityCountry)
    {
        // Implement your logic to extract city from city_country
        return trim($cityCountry);
    }
}