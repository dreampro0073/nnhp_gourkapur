<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		@page { margin: 0; }
		body { margin: 0; }
		.main{
			width: 300px;
		}
		h4{
			
			font-size: 14px;
		}
		h4,h5,p{
			text-align: center;
			margin: 0;
		}
		.m-space{
			margin: 4px 0;
		}
		.table-div{
			display: table;
			width: 100%;
		}
		.table-div > div{
			display: table-cell;
			vertical-align: middle;
			padding: 2px;
		}
		.w-50{
			width: 50%;
		}
		.w-16{
			width: 16.66%;
		}
		td,span,p{
			font-size: 12px;
		}
		.text-right{
			text-align: right;
		}
		.name{
			text-align: left;
		}
	</style>
</head>
<body>
	<div class="main" id="printableArea">
		<h4>
			M/s New Nabaratna Hospitality Pvt. Ltd.
		</h4>
		<p style="padding:0 15px;text-align: center;">
			Gorakhpur Railway Station<br>PF No. 9
		</p>
		<h5>
			GSTIN: 18AAICN4763E1ZA
		</h5>
		<h5>
			@if($print_data->type == 1)
				PODS
			@endif

			@if($print_data->type ==2)
				Single Suit Cabins
			@endif

			@if($print_data->type == 3)
				Double Beds
			@endif
		</h5>
		<div class="table-div">
			<div class="w-50">
				<span class="text">Bill No: <b>{{ $print_data->unique_id }}</b></span>
			</div>
			<div class="w-50">
				<span class="text">PNR/ID No.: <b>{{$print_data->pnr_uid}}</b></span>
			</div>
			
		</div>
		
		<div class="table-div">
			<div class="w-50">
				<span class="text">Name: <b>{{ $print_data->name }}</b></span>
			</div>
			<div class="w-50">
				<span class="text">Mobile:<b>{{$print_data->mobile_no}}</b></span>
			</div>

		</div>
		<div class="table-div">
			<div class="w-50">
				<span class="text">No: <b>{{ $print_data->e_ids }}</b></span>
			</div>
			<div class="w-50">
				<span class="text">Hours: <b>{{ $print_data->hours_occ }}</b></span>
			</div>

			
		</div>
		
		<div class="table-div">
			<div class="w-50">
				<span class="text">Paid Amount: <b>{{ $print_data->total_amount-$print_data->discount_amount }}Rs.</b></span>
			</div>
			<div class="w-50">
				<span class="text">Discount Amount: <b>{{ $print_data->discount_amount }}Rs.</b></span>
			</div>
		</div>
		<div>
			<span class="text">In Time: <b>{{date("h:i A",strtotime($print_data->check_in))}}, <?php echo date("d M Y"); ?></b></span>
		</div>
		<div>
			<span class="text">Out Time: <b>{{date("h:i A, d M Y",strtotime($print_data->checkout_date))}}</b></span>
		</div>
		<div style="margin-top:10px;text-align: right;">
			
			<span style="text-align:right;font-weight: bold;">** Non Refundable **</span>
		</div>
		<div style="margin-top:10px;text-align:center;">

			<p>
				<b>*Note : Passengers must protect their own Mobile and luggage.</b>
			</p>
			<p style="margin-top:10px;font-size: 16px;">
				<strong>Thanks Visit Again</strong>
			</p>
		</div>
		
	</div>
	<script type="text/javascript">
		window.onload = function(e){ 
		    var printContents = document.getElementById("printableArea").innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents; 
		}
	</script>
</body>
</html>


