<?php

namespace App\Jobs;

use Google_Client;
use App\Models\Member;
use App\Models\Setting;

use Google_Service_Drive;
use Google_Service_Sheets;
use Google_Service_Drive_DriveFile;
use Google_Service_Sheets_BatchClearValuesRequest;
use Illuminate\Support\Facades\Log;
use Google_Service_Drive_Permission;
use Google_Service_Sheets_ValueRange;
use Google_Service_Sheets_Spreadsheet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google\Service\Sheets\BatchClearValuesRequest;
use Google_Service_Sheets_BatchUpdateValuesRequest;
use Google_Service_Sheets_BatchUpdateSpreadsheetRequest;

class SaveInGoogleDrive implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $setting = Setting::first();
            $client = new Google_Client();
            $client->setApplicationName("Google Sheets Export");

            // Add Google Drive API scope to allow sharing
            $client->setScopes([
                Google_Service_Sheets::SPREADSHEETS,
                Google_Service_Drive::DRIVE,
            ]);

            $client->setAuthConfig(
                storage_path(config('services.google.service_account'))
            );
            $client->setAccessType("offline");

            $service = new Google_Service_Sheets($client);

            // 1. Create spreadsheet
            $spreadsheet = new Google_Service_Sheets_Spreadsheet([
                'properties' => ['title' => 'Laravel Members Export - ' . now()->toDateTimeString()]
            ]);
            
            $spreadsheetId = null;
            if(!$setting) {
                $new_spreadsheet = $service->spreadsheets->create($spreadsheet);
                $spreadsheetId = $new_spreadsheet->spreadsheetId;
            } else {
                $spreadsheetId = $setting->google_sheet_id;
            }

            // 2. Insert data
            $vals = Member::with(['spouses', 'children'])->get();
            $value = [];
            $spouseValue = [];
            $childValue = [];

            foreach($vals as $val) {

                // ======================
                // 1. Members
                // ======================
                $value[] = [ 
                    $val->id,
                    $val->member_name,
                    $val->date_of_birth,
                    $val->gender,
                    $val->marital_status,
                    $val->cnic_passport,
                    $val->phone_number_code,
                    str_replace("+", "", $val->phone_number),
                    $val->alternate_ph_number_code,
                    str_replace("+", "", $val->alternate_ph_number),
                    $val->email_address,
                    $val->residential_address,
                    $val->city_country,
                    $val->membership->card_name,
                    $val->membership_number,
                    $val->membership_status,
                    $val->file_number,
                    $val->date_of_applying,
                    $val->form_fee,
                    $val->processing_fee,
                    $val->first_payment,
                    $val->total_installment,
                    $val->installment_month,
                    $val->payment_status,
                    $val->profession?->company_name ?? '-',
                    $val->profession?->designation ?? '-',
                    $val->profession?->type_of_profession ?? '-',
                    $val->profession?->office_phone_number ?? '-',
                    $val->profession?->country ?? '-',
                    $val->profession?->city ?? '-',
                    $val->profession?->work_email ?? '-',
                    $val->profession?->office_address ?? '-',
                    $val->blood_group,
                    $val->emergency_contact,
                    $val->card_type,
                    $val->date_of_issue,
                    $val->validity,
                    $val->locker_category,
                    $val->locker_number
                ];

                // ======================
                // 2. Spouses
                // ======================
                foreach ($val->spouses as $spouse) {
                    $spouseValue[] = [
                        $val->id,
                        $val->member_name,
                        $val->membership_number,
                        $spouse->spouse_name,
                        $spouse->cnic,
                        $spouse->date_of_birth,
                        $spouse->date_of_issue,
                        $spouse->validity,
                        $spouse->blood_group,
                        $spouse->emergency_phone_number,
                    ];
                }


                // ======================
                // 3. Childs
                // ======================
                foreach ($val->children as $child) {
                    $childValue[] = [
                        $val->id,
                        $val->member_name,
                        $val->membership_number,
                        $child->child_name,
                        $child->cnic,
                        $child->date_of_birth,
                        $child->date_of_issue,
                        $child->validity,
                        $child->membership->card_name,
                        $child->blood_group,
                        $child->emergency_phone_number,
                    ];
                }
            }

            $values = [
                [
                    "id", 
                    "Member Name", 
                    "Date of Birth",
                    "Gender",
                    "Marital Status",
                    "CNIC/Passport",
                    "Country Code",
                    "Phone Number",
                    "Country Code",
                    "Alternate Phone Number",
                    "Email Address",
                    "Residential Address",
                    "City Country",
                    "Membership Type",
                    "Membership Number",
                    "Membership Status",
                    "File Number",
                    "Date of Applying",
                    "Form Fee",
                    "Processing Fee",
                    "First Payment",
                    "Total Installment",
                    "Installment Month",
                    "Payment Status",
                    "Company Name",
                    "Company Designation",
                    "Type of Profession",
                    "Office Phone Number",
                    "Country",
                    "City",
                    "Work Email",
                    "Office Address",
                    "Blood Group",
                    "Emergency Contact",
                    "Card Type",
                    "Date of Issue",
                    "Validity",
                    "Locker Category",
                    "Locker Number"
                ],
                ...$value
            ];

            $spouseValues = [
                [
                    "Member ID",
                    "Member Name",
                    "Membership Number",
                    "Spouse Name",
                    "CNIC/Passport",
                    "Date Of Birth",
                    "Date Of Issue",
                    "Validity",
                    "Blood Group",
                    "Emergency Contact",
                ],
                ...$spouseValue
            ];

            $childValues = [
                [
                    "Member ID",
                    "Member Name",
                    "Membership Number",
                    "Child Name",
                    "CNIC/Passport",
                    "Date of Birth",
                    "Date of Issue",
                    "Validity",
                    "Membership Type",
                    "Blood Group",
                    "Emergency Contact"
                ],
                ...$childValue
            ];

            $sheets = $service->spreadsheets_values;

            $sheetService = $service->spreadsheets;
            $old_spreadsheet = $sheetService->get($spreadsheetId);
            $existingSheets = collect($old_spreadsheet->getSheets())->pluck('properties.title')->toArray();

            $neededSheets = ['members', 'spouses', 'childs'];

            foreach ($neededSheets as $sheetName) {
                if (!in_array($sheetName, $existingSheets)) {
                    $addSheetRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
                        'requests' => [
                            [
                                'addSheet' => [
                                    'properties' => ['title' => $sheetName]
                                ]
                            ]
                        ]
                    ]);
                    $sheetService->batchUpdate($spreadsheetId, $addSheetRequest);
                }
            }
            $clearRequest = new Google_Service_Sheets_BatchClearValuesRequest([
                'ranges' => [
                    'members!A:Z',
                    'spouses!A:Z',
                    'childs!A:Z',
                ]
            ]);

            $sheets->batchClear($spreadsheetId, $clearRequest);

            // 3 Prepare all three data ranges
            $batchData = new Google_Service_Sheets_BatchUpdateValuesRequest([
                'valueInputOption' => 'RAW',
                'data' => [
                    new Google_Service_Sheets_ValueRange([
                        'range' => 'members!A1',
                        'values' => $values
                    ]),
                    new Google_Service_Sheets_ValueRange([
                        'range' => 'spouses!A1',
                        'values' => $spouseValues
                    ]),
                    new Google_Service_Sheets_ValueRange([
                        'range' => 'childs!A1',
                        'values' => $childValues
                    ]),
                ]
            ]);

            // Single batch update for all sheets
            $sheets->batchUpdate($spreadsheetId, $batchData);

            // 3. Share sheet with your Gmail
            $driveService = new Google_Service_Drive($client);
            $permission = new Google_Service_Drive_Permission([
                'type' => 'user',
                'role' => 'writer', // use 'reader' if you only want to view
                'emailAddress' => 'backup290125@gmail.com' 
            ]);
            $driveService->permissions->create($spreadsheetId, $permission);

            // 4. Show the sheet URL
            $url = "https://docs.google.com/spreadsheets/d/$spreadsheetId";

            if(!$setting) {
                Setting::create([
                    "google_drive_link" => $url,
                    "google_sheet_id" => $spreadsheetId
                ]);
            }

        } catch (\Google_Service_Exception $e) {
            \Log::error('Google_Service_Exception: ' . $e->getMessage());
            \Log::error('HTTP Code: ' . $e->getCode());
            \Log::error('Errors Array: ' . json_encode($e->getErrors()));
            \Log::error('Full Exception: ' . $e);
            throw $e;

        } catch (\Exception $e) {
            \Log::error('General Exception: ' . $e->getMessage());
            throw $e;
        }

    }

}
