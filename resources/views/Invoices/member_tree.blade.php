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
            .no-break {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        </style>
    </head>
    <body style="padding-left: 71pt; padding-top: 20pt; padding-right: 72pt;">
        <header style="margin-bottom: 0pt; padding-bottom: 0pt;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-transform: uppercase; line-height: 11pt; padding-bottom: 8pt;">
                        <h1 style="font-weight: 500; font-size: 12pt; margin-bottom: 0px; padding-bottom: 0px;">applicant's</h1>
                        <p style="font-weight: normal; font-size: 12pt; margin-bottom: 0px; padding-bottom: 0px;">information record</p>
                    </td>
                    <td style="text-align: right; padding-bottom: 16pt;">
                        <img src="https://gwadargymkhana.com.pk/cef/admin/img/logo.png" style="height: 47.12pt; width: 133.2pt;" />
                    </td>
                </tr>
            </table>
        </header>
        <div style="width: 339.84pt;">
            <table style="width: 100%; border-collapse: collapse;">
    <tr>
        {{-- Left Side: Tables --}}
        <td style="width: 339.84pt; vertical-align: top;">
            <div class="no-break">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td colspan="2" style="height: 35.28pt; border: 0.2px solid black; font-size: 12pt; padding-left: 5pt; vertical-align: middle;">
                            <span style="font-weight: 500;">Full name: </span>{{ $member->member_name }}
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

                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Gender:</span> <span style="text-transform: uppercase;">{{ $member->gender }}</span>
                        </td>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Blood Group:</span> <span style="text-transform: uppercase;">{{ $member->blood_group }}</span>
                        </td>
                        <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                            <span style="font-weight: 500;">Marital Status:</span> <span style="text-transform: capitalize;">{{ $member->marital_status }}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </td>

        {{-- Right Side: Image --}}
        <td style="width: 110.88pt; text-align: center; vertical-align: top;" border="0">
            @php
                $path = $member->profile_picture;
                $base64 = null;
                if (Storage::disk('public')->exists($path)) {
                    // $data = Storage::disk('public')->get($path);
                    // $type = pathinfo($path, PATHINFO_EXTENSION);
                    // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }
            @endphp
            <img src="{{ $base64 }}" style="border-radius: 50px; height: 100px; width: 100px;" />
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
            @php 


            $addressOnly = $member->residential_address;
            $prefix = "Residential address: ";

            $fontPathRegular = storage_path('fonts/Roboto-Regular.ttf');
            $fontPathMedium = storage_path('fonts/Roboto-Medium.ttf'); // font-weight: 500
            $fontSize = 8; // pt
            $cellWidthPt = 450.72;

            // Measure the bold prefix with bold font
            $prefixBox = imagettfbbox($fontSize, 0, $fontPathMedium, $prefix);
            $prefixWidthPt = abs($prefixBox[2] - $prefixBox[0]);

            // Convert remaining width to pt
            $remainingPt = ($cellWidthPt - $prefixWidthPt) + 150;

            // Now split remaining text
            list($line1, $line2) = \App\Helpers\Helpers::splitTextByWidth($addressOnly, $fontPathRegular, $fontSize, $remainingPt);

            @endphp
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Residential address: </span>{{ $line1 }}</td>
                </tr>
                @if($line2)
                    <tr>
                        <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;">{{ $line2 }}</td>
                    </tr>
                @endif
            </table>
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 32.9%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Country: </span>{{ $member->country }}</td>
                    <td style="width: 23.64%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">City: </span>{{ $member->city }}</td>
                    <td style="width: 43.45%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">E-mail: </span>{{ $member->email_address }}</td>
                </tr>
            </table>
            <div>

            <div style="position: relative">
                <table style="width: 450.72pt; border-collapse: collapse; margin-top: 30pt; position: relative;">
                    <tr>
                        <td style="height: 35.28pt; padding-top: 5pt; width: 43.92%; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Membership type: </span><span style="text-transform: capitalize">Permanent SE</span></td>
                        <td style="height: 35.28pt; padding-top: 5pt; width: 31.46%; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Membership No: </span>{{ $member->membership_number }}</td>
                        <td style="width: 24.62%; border: 0.2px solid black; border-bottom: none; text-align: center; vertical-align: middle; height: 35.28pt;">
                            <div>
                                <div style="display: inline-block; vertical-align: middle; line-height: 1.3;">
                                    <p style="font-size: 8pt; margin: 0; padding-top: 40px;">Payment status:</p>
                                </div>
                            </div>
                        </td>

                    </tr>
                </table>
                <table style="width: 450.72pt; border-collapse: collapse;">
                    <tr>
                        <td style="width: 25.12666666666667%; padding-top: 5pt; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 8pt;"><span style="font-weight: 500;">File Number: </span>{{ $member->file_number }}</td>
                        <td style="width: 25.12666666666667%; padding-top: 5pt; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 8pt;"><span style="font-weight: 500;">Locker Category: </span><span style="text-transform: uppercase;">{{ $member->locker_category }}</span></td>
                        <td style="width: 25.12666666666667%; padding-top: 5pt; font-size: 11pt; border: 0.2px solid black; padding-left: 5pt; padding-bottom: 8pt;"><span style="font-weight: 500;">Locker Number: </span>{{ $member->locker_number }}</td>
                        <td style="width: 24.62%; border: 0.2px solid black; border-top: none; vertical-align: top; position: relative;">
                            @if($member->payment_status === "level1")
                                <p style="font-size: 12pt; margin: 0; text-align: center; padding: 0; margin: 0;">Payment Request</p>
                            @elseif($member->payment_status === "level2")
                                <p style="font-size: 12pt; margin: 0; text-align: center; padding: 0; margin: 0;">Payment Reminder</p>
                            @elseif($member->payment_status === "level3")
                                <p style="font-size: 12pt; margin: 0; text-align: center; padding: 0; margin: 0;">Final Notice</p>
                            @elseif($member->payment_status === "level4")
                                <p style="font-size: 12pt; margin: 0; text-align: center; padding: 0; margin: 0;">Cancelled</p>
                            @elseif($member->payment_status === "level5")
                                <p style="font-size: 12pt; margin: 0; text-align: center; padding: 0; margin: 0;">Re-Regularized</p>
                            @else
                                <p style="font-size: 12pt; margin: 0; text-align: center; padding: 0; margin: 0;">Cleared</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Date of Applying: </span>{{ \Carbon\Carbon::parse($member->date_of_applying)->format("d/m/Y") }}</td>
                        <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Date of Issue: </span>{{ \Carbon\Carbon::parse($member->date_of_issue)->format("d/m/Y") }}</td>
                        <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Validity: </span>{{ \Carbon\Carbon::parse($member->validity)->format("d/m/Y") }}</td>
                        @if($member->card_type)
                            <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Card Type: </span>Not for Families</td>
                        @else
                            <td style="font-size: 8pt; border: 0.5px solid black; padding-left: 5pt; padding-top: 5pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Card Type: </span>{{ $member->card_type }}</td>
                        @endif
                    </tr>
                </table>
            </div>

            @php
                $addressOnly = $member->profession->office_address;
                $prefix = "Company address: ";

                $fontPathRegular = storage_path('fonts/Roboto-Regular.ttf');
                $fontPathMedium = storage_path('fonts/Roboto-Medium.ttf'); // font-weight: 500
                $fontSize = 8; // pt
                $cellWidthPt = 450.72;

                // Measure the bold prefix with bold font
                $prefixBox = imagettfbbox($fontSize, 0, $fontPathMedium, $prefix);
                $prefixWidthPt = abs($prefixBox[2] - $prefixBox[0]);

                // Convert remaining width to pt
                $remainingPt = ($cellWidthPt - $prefixWidthPt) + 150;

                // Now split remaining text
                list($line1, $line2) = \App\Helpers\Helpers::splitTextByWidth($addressOnly, $fontPathRegular, $fontSize, $remainingPt);

            @endphp
            
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
            <table style="width: 450.72pt; border-collapse: collapse; font-feature-settings: 'tnum';">
                <tr>
                    <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Company address: </span>{{ !$line1 ? "N/A" : $line1 }}</td>
                </tr>
                @if($line2)
                    <tr>
                        <td style="width: 100%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt;">{{ $line2 }}</td>
                    </tr>
                @endif
            </table>
            <table style="width: 450.72pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 32.9%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">Country: </span>{{ $member->profession->country ?? "N/A" }}</td>
                    <td style="width: 23.64%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">City: </span>{{ $member->profession->city ?? "N/A" }}</td>
                    <td style="width: 43.45%; font-size: 8pt; border: 0.2px solid black; border-top: none; padding-left: 5pt; padding-top: 4pt; padding-bottom: 5pt;"><span style="font-weight: 500;">E-mail: </span>{{ $member->profession->work_email ?? "N/A" }}</td>
                </tr>
            </table>
            @foreach ($member->spouses as $spouse)
            <div class="no-break">
              <table style="width: 100%; border-collapse: collapse; margin-top: 30pt;">
    <tr>
        {{-- Left Side: Spouse Tables --}}
        <td style="width: 339.84pt; vertical-align: top;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="font-size: 10pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                        <span style="font-weight: 500;">{{ Illuminate\Support\Str::ordinalWord($loop->index + 1) }} spouse full name: </span>{{ $spouse->spouse_name }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                        <span style="font-weight: 500;">CNIC/Passport: </span>{{ $spouse->cnic }}
                    </td>
                    <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                        <span style="font-weight: 500;">Date of Birth: </span>{{ \Carbon\Carbon::parse($spouse->date_of_birth)->format("d/m/Y") }}
                    </td>
                </tr>
            </table>

            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Date of Issue:</span> {{ \Carbon\Carbon::parse($member->date_of_issue)->format("d/m/Y") }}
                    </td>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Validity:</span> {{ \Carbon\Carbon::parse($member->validity)->format("d/m/Y") }}
                    </td>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Blood Group:</span> {{ $member->blood_group }}
                    </td>
                </tr>
            </table>
        </td>

        {{-- Right Side: Optional Image or Empty --}}
        <td style="width: 110.88pt; text-align: center; vertical-align: top;" border="0">
            @php

                $path = $spouse->picture;
                $base64 = null;

                if (Storage::disk('public')->exists($path)) {
                    $data = Storage::disk('public')->get($path);
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }
            @endphp
            <img src="{{ $base64 }}" style="border-radius: 50px; height: 100px; width: 100px;" />
        </td>
    </tr>
                </table>
            </div>
            @endforeach

            @foreach($member->children as $child)
            <div class="no-break">
                <table style="width: 100%; border-collapse: collapse; margin-top: 30pt;">
    <tr>
        {{-- Left Side: Child Details --}}
        <td style="width: 339.84pt; vertical-align: top;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="font-size: 10pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                        <span style="font-weight: 500;">{{ Illuminate\Support\Str::ordinalWord($loop->index + 1) }} child full name: </span>{{ $child->child_name }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                        <span style="font-weight: 500;">CNIC/Passport: </span>{{ $child->cnic }}
                    </td>
                    <td style="font-size: 8pt; border: 0.2px solid black; padding-left: 5pt; vertical-align: middle; padding-top: 4pt; padding-bottom: 5pt;">
                        <span style="font-weight: 500;">Date of Birth: </span>{{ \Carbon\Carbon::parse($member->date_of_birth)->format("d/m/Y") }}
                    </td>
                </tr>
            </table>

            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Date of Issue:</span> {{ \Carbon\Carbon::parse($member->date_of_issue)->format("d/m/Y") }}
                    </td>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Validity:</span> {{ \Carbon\Carbon::parse($member->validity)->format("d/m/Y") }}
                    </td>
                    <td style="width: 33.33%; border: 0.2px solid black; font-size: 8pt; padding-left: 5pt; padding-top: 3pt; padding-bottom: 5pt; border-top: none;">
                        <span style="font-weight: 500;">Blood Group:</span> {{ $member->blood_group }}
                    </td>
                </tr>
            </table>
        </td>

            
        {{-- Right Side: Optional Image or Empty --}}
        <td style="width: 110.88pt; text-align: center; vertical-align: top;" border="0">
            @php
                $path = $child->profile_pic;
                $base64 = null;

                if (Storage::disk('public')->exists($path)) {
                    $data = Storage::disk('public')->get($path);
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }
            @endphp
            <img src="{{ $base64 }}" style="border-radius: 50px; height: 100px; width: 100px;" />
        </td>
    </tr>
                </table>
            </div>
            @endforeach

        </div>
    </body>
</html>