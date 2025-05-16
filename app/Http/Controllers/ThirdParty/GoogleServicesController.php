<?php

namespace App\Http\Controllers\ThirdParty;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_Spreadsheet;
use Google_Service_Sheets_ValueRange;
use Google_Service_Drive;
use Google_Service_Drive_Permission;
use Illuminate\Support\Facades\Schema;

class GoogleServicesController extends Controller
{
    public function save() {
        $client = new Google_Client();
$client->setApplicationName("Google Sheets Export");

// 👇 Add Google Drive API scope to allow sharing
$client->setScopes([
    Google_Service_Sheets::SPREADSHEETS,
    Google_Service_Drive::DRIVE,
]);

$client->setAuthConfig(env('GOOGLE_SERVICE_ACCOUNT_PATH'));
$client->setAccessType("offline");

$sheets = new Google_Service_Sheets($client);

// 1. Create spreadsheet
$spreadsheet = new Google_Service_Sheets_Spreadsheet([
    'properties' => ['title' => 'Laravel Members Export - ' . now()->toDateTimeString()]
]);
$spreadsheet = $sheets->spreadsheets->create($spreadsheet);
$spreadsheetId = $spreadsheet->spreadsheetId;
// 2. Insert data
$value = [];
$vals = Member::all();

foreach($vals as $val) {
    $value[] = [ 
        $val->id,
        $val->member_name,
        $val->date_of_birth,
        $val->gender,
        $val->marital_status,
        $val->cnic_passport,
        $val->phone_number,
        $val->alternate_ph_number,
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
        $val->blood_group,
        $val->emergency_contact,
        $val->card_type,
        $val->date_of_issue,
        $val->validity
    ];
}



$values = [
    [
    "id", 
    "Member Name", 
    "Date of Birth",
    "Gender",
    "Marital Status",
    "CNIC/Passport",
    "Phone Number",
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
    "Blood Group",
    "Emergency Contact",
    "Card Type",
    "Date of Issue",
    "Validity"
],
    ...$value
];

$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

$sheets->spreadsheets_values->update(
    $spreadsheetId,
    'Sheet1!A1',
    $body,
    ['valueInputOption' => 'RAW']
);

// 3. Share sheet with your Gmail
$driveService = new Google_Service_Drive($client);
$permission = new Google_Service_Drive_Permission([
    'type' => 'user',
    'role' => 'writer', // use 'reader' if you only want to view
    'emailAddress' => 'habbas21219@gmail.com' // 👈 replace with your Gmail
]);
$driveService->permissions->create($spreadsheetId, $permission);

// 4. Show the sheet URL
$url = "https://docs.google.com/spreadsheets/d/$spreadsheetId";
dd($url);

    }
}
