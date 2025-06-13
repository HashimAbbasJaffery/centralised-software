<!DOCTYPE html>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <style>
            @page {
                size: A4 portrait;
            }
            * {
                font-family: 'Roboto';
                padding: 0px;
                margin: 0px;
            }
        </style>
    </head>
    <body style="padding-left: 71pt; padding-top: 20pt; padding-right: 72pt;">
        <header style="margin-bottom: 0pt; padding-bottom: 0pt;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-transform: uppercase; line-height: 11pt; padding-bottom: 8pt;">
                        <h1 style="font-weight: 500; font-size: 12pt; margin-bottom: 0px; padding-bottom: 0px;">applicant’s</h1>
                        <p style="font-weight: normal; font-size: 12pt; margin-bottom: 0px; padding-bottom: 0px;">information record</p>
                    </td>
                    <td style="text-align: right; padding-bottom: 16pt;">
                        <img src="https://gwadargymkhana.com.pk/cef/admin/img/logo.png" style="height: 47.12pt; width: 133.2pt;" />
                    </td>
                </tr>
            </table>
        </header>
        <div style="width: 339.84pt;">
            <table style="width: 339.84pt; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="height: 35.28pt; border: 0.2px solid black; font-size: 12pt; padding-left: 5pt; vertical-align: middle;">
                        <span style="font-weight: 500;">Fullname: </span>{{ $member->member_name }}
                    </td>
                </tr>
                <tr>
                    <td style="height: 20.88pt; width: 60.38%; border: 0.2px solid black; font-size: 10pt; padding-left: 5pt; padding-bottom: 0.5pt;">
                        <span style="font-weight: 500;">CNIC/Passport:</span> {{ $member->cnic_passport }}
                    </td>
                    <td style="height: 20.88pt; width: 39.62%; border: 0.2px solid black; font-size: 10pt; padding-left: 5pt; padding-bottom: 0.5pt;">
                        <span style="font-weight: 500;">Date of Birth:</span> {{ \Carbon\Carbon::parse($member->date_of_birth)->format("d/m/Y") }}
                    </td>
                </tr>
            </table>
            <table style="width: 339.84pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Gender:</span> <span style="text-transform: uppercase;">{{ $member->gender }}</span>
                    </td>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Blood Group:</span> <span style="text-transform: uppercase;">{{ $member->blood_group }}
                    </td>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Marital Status:</span> <span style="text-transform: capitalize;">{{ $member->marital_status }}</span>
                    </td>
                </tr>
            </table>

            <table style="width: 450.72pt; border-collapse: collapse; margin-top: 30pt;">
                <tr>
                    <td style="width: 33.33%; font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Phone Number: </span>{{ $member->phone_number }}</td>
                    <td style="width: 33.33%; font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Alternative Number: </span>{{ $member->alternate_ph_number }}</td>
                    <td style="width: 33.33%; font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Emergency Number: </span>{{ $member->emergency_contact }}</td>
                </tr>
            </table>
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Residential address: </span>{{ $member->residential_address }}</td>
                </tr>
                <tr>
                    <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;">opposite Kashmir Road</td>
                </tr>
            </table>
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 32.9%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Country: </span>{{ $member->country }}</td>
                    <td style="width: 23.64%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">City: </span>{{ $member->city }}</td>
                    <td style="width: 43.45%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">E-mail: </span>{{ $member->email_address }}</td>
                </tr>
            </table>

            <table style="width: 450.72pt; border-collapse: collapse; margin-top: 30pt;">
                <tr>
                    <td style="height: 35.28pt; padding-top: 5pt; width: 43.92%; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Membership type: </span><span style="text-transform: capitalize">{{ $member->membership->card_name }}</span></td>
                    <td style="height: 35.28pt; padding-top: 5pt; width: 31.46%; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Membership No: </span>{{ $member->membership_number }}</td>
                    <td style="width: 24.62%;">&nbsp;</td>
                </tr>
            </table>
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 25.12666666666667%; padding-top: 5pt; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 8pt;"><span style="font-weight: 500;">File Number: </span>{{ $member->file_number }}</td>
                    <td style="width: 25.12666666666667%; padding-top: 5pt; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 8pt;"><span style="font-weight: 500;">Locker Category: </span><span style="text-transform: uppercase;">{{ $member->locker_category }}</span></td>
                    <td style="width: 25.12666666666667%; padding-top: 5pt; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 8pt;"><span style="font-weight: 500;">Locker Number: </span>{{ $member->locker_number }}</td>
                    <td style="width: 24.62%;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Date of Applying: </span>{{ \Carbon\Carbon::parse($member->date_of_applying)->format("d/m/Y") }}</td>
                    <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Date of Issue: </span>{{ \Carbon\Carbon::parse($member->date_of_issue)->format("d/m/Y") }}</td>
                    <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Validity: </span>{{ \Carbon\Carbon::parse($member->validity)->format("d/m/Y") }}</td>
                    <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Card Type: </span>{{ $member->card_type }}</td>
                </tr>
            </table>

            
            <table style="width: 450.72pt; border-collapse: collapse; margin-top: 30pt;">
                <tr>
                    <td style="width: 39.29712460063898%; font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Type of profession: </span>{{ $member->profession->type_of_profession }}</td>
                    <td style="width: 60.70287539936102%; font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Company Name: </span>{{ $member->profession->company_name }}</td>
                </tr>
                <tr>
                    <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Designation: </span>{{ $member->profession->designation }}</td>
                    <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Work phone number: </span>{{ $member->profession->office_phone_number ?? "N/A" }}</td>
                </tr>
            </table>
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Company address: </span>{{ $member->profession->office_address ?? "N/A" }}</td>
                </tr>
                <tr>
                    <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;">opposite Kashmir Road</td>
                </tr>
            </table>
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 32.9%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Country: </span>{{ $member->profession->country ?? "N/A" }}</td>
                    <td style="width: 23.64%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">City: </span>{{ $member->profession->city ?? "N/A" }}</td>
                    <td style="width: 43.45%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">E-mail: </span>{{ $memenr->profession->work_email ?? "N/A" }}</td>
                </tr>
            </table>

            @foreach ($member->spouses as $spouse)
                <table style="width: 339.84pt; margin-top: 30pt; border-collapse: collapse;">
                    <tr style="width: 100%;">
                        <td colspan="2" style="font-size: 10pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                            <span style="font-weight: 500;">First spouse full name: </span>{{ $spouse->spouse_name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                            <span style="font-weight: 500;">CNIC/Passport: </span>42201-1805406-5
                        </td>
                        <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                            <span style="font-weight: 500;">Date of Birth: </span>20/02/1990
                        </td>
                    </tr>
                </table>

                <table style="width: 339.84pt; border-collapse: collapse;">
                    <tr>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Date of Issue:</span> 20/02/1990
                        </td>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Validity:</span> 20/02/1990
                        </td>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Blood Group:</span> B+
                        </td>
                    </tr>
                </table>

            @endforeach

            @foreach($member->children as $child)
                <table style="width: 339.84pt; margin-top: 30pt; border-collapse: collapse;">
                    <tr style="width: 100%;">
                        <td colspan="2" style="font-size: 10pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                            <span style="font-weight: 500;">First child full name: </span>{{ $child->child_name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                            <span style="font-weight: 500;">CNIC/Passport: </span>42201-1805406-5
                        </td>
                        <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                            <span style="font-weight: 500;">Date of Birth: </span>20/02/1990
                        </td>
                    </tr>
                </table>
                <table style="width: 339.84pt; border-collapse: collapse;">
                    <tr>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Date of Issue:</span> 20/02/1990
                        </td>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Validity:</span> 20/02/1990
                        </td>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Blood Group:</span> B+
                        </td>
                    </tr>
                </table>
            @endforeach

        </div>
    </body>
    <script></script>
</html>