<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $member->member_name . " " . date("d-m-Y") }}</title>
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<style>
	* {
		font-family: "Roboto";
	}
	body {
		padding-left: 20pt;
		padding-right: 20pt;
	}
/* .footer, .footer-space {
  height: 100px;
} */
 /* @media print {
       table{page-break-after: auto;}
   } */
	.balance{
		padding-left:3px;
		font-size:10px;
		padding:2px 5px;	
	}
	h2{
		font-size:20px !important;
	}
	h4{
		font-size:11px !important;
	}
	h4 span{
		font-weight:bold;
	}
	h6{
		font-size: 10px !important;
		text-align:center;
	}
	.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}
.head td{
	height:70px;
	border: 2px solid #000;
	text-align:center;
	font-size:11px;
	line-height:15px;
	font-weight:600;
	padding:2px 5px;
}

.data td{
padding-left:3px;
font-size:10px;
padding:2px 5px;	
}
.main_table{
	font-size: 11px !important;
	line-height: 8px;
}
.main_table span{
	font-weight: bold !important;
}
.register_table{
	border:1px dashed #000;
	  border-radius:8px !important;
	  margin-top:20px;
		padding: 8px;
}
/* .one{
	margin-top:40px;
} */

table, tfoot td{
    bottom: 0;
    border: none;
}
@page {
  size: A4;
  margin: 0 auto;
  margin-top: 1cm;
  margin-bottom: 1cm;
}
/* @page :first{
	margin: 1cm auto;
} */

/* @page2{
	size: A4;
  margin: 0 auto;
  margin-bottom: 1cm;
  margin-top: 1cm;
} */
   @media print{
	thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   body {margin: 0;}
   .container{
    margin: 0px 30px !important; 
   }
.print_link{
	color: #0000EE !important;
}
   
}

.page-footer, .page-footer-space {
    height: 50px;
	padding:30px;
  
  }
  
  .page-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    /* border-top: 1px solid black; for demo */
    /* background: yellow; for demo */
  }
</style>
<body>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


  <div class="page-footer">
	<table>
	<tr>
  <td colspan="4" style="font-weight:bold !important; font-size: 10px !important; text-left">If you have  any questions, please reach out us at:</td>
				<td colspan="2" style="font-size: 10px !important;"><span style="font-weight:bold !important;">UAN :</span> +9221 111 947 111</td>
				<td colspan="6" style="font-size: 10px !important; text-align:right;"><span style="font-weight:bold !important;">EMAIL :</span> member.services@gwadargymkhana.com.pk</td>
				</tr>
				<tr style="line-height:20px;">
				<td style="font-size: 10px !important; text-align:center;" colspan="3"><span style="font-weight:bold !important;">WEBSITE:</span> www.gwadargymkhana.com.pk</td>
				<td style="font-size: 10px !important; text-align:center;" colspan="7"><span style="font-weight:bold !important;">ADDRESS:</span> Suite 207, The Plaza, Khayaban-e-Iqbal Block 9 Clifton, Karachi, Pakistan.</td>
				</tr>
				</table>
  </div>
<div class="container" style="margin-left:20px; margin: auto;">
<div class="row">

<div class="col-xs-12">
			<div style="width: 100%; padding-top: 10px;">

				<!-- Left Column -->
				<div style="width: 33.33%; float: left; text-align: left; line-height: 1pt;">
					<img src="http://127.0.0.1:8000/assets/img/logo.png" alt="" width="150">
					<h4>Managed by: <span style="font-weight: bold;">shahmirahs</span></h4>
				</div>

				<!-- Middle Column -->
				<div style="width: 33.33%; float: left; line-height: 10pt; margin-top: 10pt;">
					<h2 style="font-weight: bold; margin: 0; padding-bottom: 0px; margin-bottom: 0px;">MEMBER'S</h2>
					<h2 style="margin: 0;">PAYMENT SCHEDULE</h2>
				</div>

				<!-- Right Column -->
				<div style="width: 33.33%; float: left; text-align: right; line-height: 10pt; margin-top: 10pt;">
					<h2 style="font-weight: bold; margin: 0; padding-bottom: 0px; margin-bottom: 0px;">MONTH</h2>
					<h2 style="margin: 0;">Jun 2025</h2>
				</div>

				<!-- Clear floats -->
				<div style="clear: both;"></div>
			</div>
			
			<div class="register_table one">
			<table style="margin:10px 0px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:45%;"><span>NAME: </span>{{ $member->member_name }}</td>
					<td class="main_table text-left" style="width:27.5%;"><span>MIF NO: </span>{{ $member->file_number }}</td>
					<td class="main_table" style="width:27.5%; text-align: right;"><span>MEMBERSHIP NO: </span>{{ $member->membership_number }}</td>
				</tr>
				</tbody>
			</table>
			<table style="margin:10px 0px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:30%;"><span>CNIC NO: </span> {{ $member->cnic_passport }}</td>
					<td class="main_table text-right" style="width:35%; text-align: center;"><span>PHONE NO(PRIMARY): </span> {{ $member->phone_number }}</td>
					<td class="main_table text-right" style="width:35%; text-align: right;"><span>PHONE NO(ALTERNATE): </span> {{ $member->alternate_ph_number }}</td>
				</tr>
				</tbody>
			</table>
			<table style="margin:10px 0px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:100%;"><span>ADDRESS:</span> {{ $member->residential_address }}</td>
				</tr>
				</tbody>
			</table>
			</div>

			<div class="register_table">
			<table style="margin:10px 0px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:33%;"><span>MEMBERSHIP TYPE:</span> {{ $member->membership->card_name }}</td>
					<td class="main_table" style="width:33%; text-align:right;"><span>FORM FEE:</span> {{ number_format($member->form_fee) }}</td>
					<td class="main_table" style="width:33%; text-align:right;"><span>PROCESSING FEE:</span> {{ number_format($member->processing_fee) }}</td>
				</tr>
				</tbody>
			</table>
			<table style="margin:10px 0px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:33%;"><span>FIRST PAYMENT:</span> {{ number_format($member->first_payment) }}</td>
					<td class="main_table" style="width:33%; text-align:right;"><span>TOTAL INSTALLMENTS:</span> {{ number_format($member->total_installment) }}</td>
					<td class="main_table" style="width:33%; text-align:right;"><span>INSTALLMENT MONTH'S:</span> {{ $member->installment_month }}</td>
				</tr>
				</tbody>
			</table>
			</div>	


			<table>
				<tbody>
				<tr>
    <td class="main_table" style="width:33%; vertical-align: top; margin-top: 20pt;">
        <h6 style="font-weight:600; margin: 0; font-size:12px; text-align:left; margin-bottom: 5pt; margin-top: 25pt;">PAY ONLINE:</h6>
        <img src="http://127.0.0.1:8000/assets/img/visa-mastercard.png" alt="" class="img-fluid" width="110">
        <p style="font-size:10px; color: #0000EE; margin: 0;" class="print_link">https://gwadargymkhana.com.pk/pay-online/</p>
    </td>

	<td class="main_table" style="width:33%; vertical-align: top; text-align:right; padding: 0; margin: 0; ">
		<div style="display: inline-block; vertical-align: top; text-align: right;">
			<h6 style="font-weight:600; margin: 0; padding: 0; font-size:12px; line-height: 14px; margin-top: 20pt;">TOTAL LATE PAYMENT CHARGES:</h6>
			<h5 style="margin: 0; padding: 0; line-height: 30px; font-size: 18px;">PKR {{ number_format($late_payment_charges) }}/-</h5>
		</div>
	</td>

    <td class="main_table" style="width:33%; vertical-align: top; text-align:right;">
        @if($member->payment_status === "level3" || $member->payment_status === "level4")
            <h6 style="font-weight:600; font-size:12px; margin: 0; margin-bottom: 5pt; margin-top: 25pt; text-align: right;">PAY OUTSTANDING DUES IMMEDIATELY</h6>
        @else
            <h6 style="font-weight:600; font-size:12px; margin: 0; margin-bottom: 5pt;  margin-top: 25pt;">PAY DUES BEFORE {{ $formattedDate }}</h6>
        @endif
        <h5 style="margin: 0; font-weight:bold; font-size:30px; line-height: 25px;">PKR. {{ number_format($to_be_paid_row?->payable ?? "0") }}/-</h5>
    </td>
</tr>

</tbody>
</table>

<div class="row" style="margin-top:20px;">    
    <div class="col-md-12">
        <table>
            <thead>
                <tr class="head" scope="row">
                    <td style="width:10%;">Month</td>
                    <td style="width:10%;">Due amount</td>
                    <td style="width:10%;">Due date</td>
                    <td style="width:10%;">Payment description</td>
                    <td style="width:10%;">Current month payable</td>
                    <td style="width:10%;">Late<br> payment charges</td>
                    <td style="width:10%;">Payable</td>
                    <td style="width:10%;">Paid</td>
                    <td style="width:10%;">Due B/F</td>
                    <td style="width:10%;">Balance</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="10" class="text-right balance" style="text-align: right;">
                        {{ number_format($member->form_fee + $member->processing_fee + $member->first_payment + $member->total_installment) }}
                    </td>
                </tr>
            @foreach($recovery_rows as $row)
			<tr class="data page" scope="row">
		
                <td style="width:10%;">{{ \Carbon\Carbon::parse($row->month)->format("M, Y") }}</td>
			    <td style="width:10%;" class="text-right" style="text-align: right;">
					@if(!is_null($row->late_payment_charges))
						{{ number_format($row->due_b_f) }}
					@endif
				</td>
				<td style="width:10%;">{{ \Carbon\Carbon::parse($row->due_date)->format("d M y") }}</td>
				<td style="width:11%;">{{ $row->payment_description }}</td>
				<td style="width:9%;" class="text-right" style="text-align: right;">
					{{ is_null($row->current_month_payable) ? "" : number_format($row->current_month_payable) }}
				</td>
				<td style="width:12%;" class="text-right" style="text-align: right;">{{ is_null($row->late_payment_charges) ? "" : number_format($row->late_payment_charges) }}</td>
				<td style="width:10%;" style="text-align: right" class="text-right">
					@if(!is_null($row->late_payment_charges))
						{{ is_null($row->payable) ? "" : number_format($row->payable) }}
					@endif
				</td>
				<td style="width:10%;" class="text-right">{{ is_null($row->paid) ? "" : number_format($row->paid) }}</td>
				<td style="width:10%;" style="text-align: right;" class="text-right">
					@if(!is_null($row->late_payment_charges))
						{{ number_format($row->due_amount) }}
					@endif
				</td>
				<td style="width:13%; text-align: right;;" class="text-right">
					@if(!is_null($row->late_payment_charges))
						{{ !is_null($row?->payable ?? null) && $row->payable > 0 ? number_format($row->total_sum_value) : "" }}
					@endif
				</td>
			</tr>
            @endforeach
			</tbody>
			<tfoot class="text-center" >
			<tr>
			<td>  <div class="page-footer-space"></div></td>

			</tr>	
			
			
		</tfoot>
	</table>
    </div>
	</div>
	
</div>


</body>	
<script>
	// window.print();
</script>
</html>