<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $member->member_name . " " . date("d-m-Y") }}</title>
	
</head>
<style>
	
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
			
    		<div class="row" style="padding-top: 10px;">
				<div class="col-xs-4" style=" text-align:left;">
				<img src="{{ asset('/assets/img/logo.png') }}" alt="" class="img-fluid" width="150">
				<h4>Managed by: <span style="font-weight:bold;">{{ 'test' }}</span></h4>
				</div>
				<div class="col-xs-5">
				<h2 style="font-weight:bold; line-height:0px">MEMBER'S</h2>
				<h2 style="line-height:0px;">PAYMENT SCHEDULE</h2>
				</div>
				<div class="col-xs-3" style=" text-align:right;">
				<h2 style="font-weight:bold; line-height:0px;">MONTH</h2>
				<h2 style="line-height:0px;">{{ \Carbon\Carbon::now()->format('M Y') }}</h2>
				</div>
				
			</div>
			<div class="register_table one">
			<table style="margin:10px 0px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:45%;"><span>NAME: </span>{{ $member->member_name }}</td>
					<td class="main_table text-left" style="width:27.5%;"><span>MIF NO: </span>{{ $member->file_number }}</td>
					<td class="main_table text-right" style="width:27.5%;"><span>MEMBERSHIP NO: </span>{{ $member->membership_number }}</td>
				</tr>
				</tbody>
			</table>
			<table style="margin:10px 0px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:30%;"><span>CNIC NO: </span> {{ $member->cnic_passport }}</td>
					<td class="main_table text-right" style="width:35%;"><span>PHONE NO(PRIMARY): </span> {{ $member->phone_number }}</td>
					<td class="main_table text-right" style="width:35%;"><span>PHONE NO(ALTERNATE): </span> {{ $member->alternate_ph_number }}</td>
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


			<table style="margin-top:30px;">
				<tbody>
				<tr>
					<td class="main_table" style="width:33%;">
					<h6 style="font-weight:600; line-height:0px; font-size:12px; text-align:left;">PAY ONLINE:</h6>
					<img src="{{ asset('/assets/img/visa-mastercard.png') }}" alt="" class="img-fluid" width="110">
					<p style="font-size:10px; color: #0000EE;" class="print_link">https://gwadargymkhana.com.pk/pay-online/</p>
				</td>
					<td class="main_table" style="width:33%; text-align:right;">
					<h6 style="font-weight:600; line-height:8px; font-size:12px !important; text-align:right;">TOTAL LATE PAYMENT CHARGES:</h6>

        <h5 style="line-height: 22px; font-size: 18px; text-align: right;">PKR {{ number_format($late_payment_charges) }}/-</h5>

<td class="main_table" style="width:33%; text-align:right;">    
	@if($member->payment_status === "level3" || $member->payment_status === "level4"):
	    <h6 style="font-weight:600; line-height:12px; font-size:12px !important; text-align:right;">PAY OUTSTANDING DUES IMMEDIATELY</h6>
	@else
		<h6 style="font-weight:600; line-height:12px; font-size:12px !important; text-align:right;">PAY DUES BEFORE {{ $formattedDate }}</h6>
	@endif
	<h5 style="font-weight:bold; line-height:22px; font-size:30px; text-align:right;">PKR. {{ number_format($to_be_paid_row->payable) }}/-</h5>
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
                    <td colspan="10" class="text-right balance">
                        {{ number_format($member->form_fee + $member->processing_fee + $member->first_payment + $member->total_installment) }}
                    </td>
                </tr>
            @foreach($recovery_rows as $row)
			<tr class="data page" scope="row">
		
                <td style="width:10%;">{{ \Carbon\Carbon::parse($row->month)->format("F, Y") }}</td>
			    <td style="width:10%;" class="text-right">{{ number_format($row->due_b_f) ? number_format($row->due_b_f) : ""}}</td>
				<td style="width:10%;">{{ \Carbon\Carbon::parse($row->due_date)->format("d M y") }}</td>
				<td style="width:11%;">{{ $row->payment_description }}</td>
				<td style="width:9%;" class="text-right">{{ number_format($row->current_month_payable) }}</td>
				<td style="width:12%;" class="text-right">{{ number_format($row->late_payment_charges) ? number_format($row->late_payment_charges) : ""}}</td>
				<td style="width:10%;" class="text-right">{{ number_format($row->payable    ) }}</td>
				<td style="width:10%;" class="text-right">{{ number_format($row->paid) ? number_format($row->paid) : "" }}</td>
				<td style="width:10%;" class="text-right">{{ number_format($row->due_amount) ? number_format($row->due_amount) : ""}}</td>
				<td style="width:13%;" class="text-right">{{ number_format($row->total_sum_value) }}</td>
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