<div class="main" id="printableArea">
	<h4>
		M/s New Nabaratna Hospitality Pvt. Ltd.
	</h4>
	<p class="m-space">
		AC Executive Lounge, Guwahati Railway Station, PF No. 1
	</p>
	<h5>
		GSTIN: 18AAICN4763E1ZA
	</h5>
	<div class="table-div">
		<div class="w-50">
			<span class="text">Bill No: {{ $print_data->unique_id }}</span>
		</div>
		<div class="w-50 text-right">
			<span class="text">Date: <?php echo date("d-m-Y"); ?></span>
		</div>
	</div>
	<span class="name">Name : {{$print_data->name}}</span>
	<div class="table-div">
		<div class="w-50">
			<span class="text">PNR/ID No.: {{$print_data->pnr_uid}}</span>
		</div>
		<div class="w-50">
			<span class="text text-right">Mobile: {{$print_data->mobile_no}}</span>
		</div>
	</div>
	<div class="table-div" style="margin-bottom: 20px;">
		<div class="w-50">
			<span class="text">In Time: <b>{{$print_data->check_in}}</b></span>
		</div>
		<div class="w-50">
			<span class="text">Out Time: <b>{{$print_data->check_out}}</b></span>
		</div>
	</div>
	<table style="width:100%;margin: -1;" border="1" cellpadding="4" cellspacing="0" >
		<tr>
			<td class="w-46">Description</td>
			<td class="w-20">Fee Type</td>
			<td class="w-16">Quantity</td>
			<td class="w-16">Amount</td>
		</tr>
		<tr>
			<td class="w-46">For 1st hours or part there of</td>
			<td class="w-20">Adult 30/- Perpersal</td>
			<td class="w-16" rowspan="2">{{$print_data->no_of_adults}}</td>
			<td class="w-16">{{$print_data->adult_first_hour_amount}}</td>
		</tr>
		<tr>
			<td class="w-46">Per Exterded hours or part there of</td>
			<td class="w-20">Adult 20/- Perpersal</td>
			<td class="w-16">{{$print_data->adult_other_hour_amount}}</td>
		</tr>
		<tr>
			<td class="w-46">1st hours of part there of</td>
			<td class="w-20">Age 5 to 12, 20/ Perchilores</td>
			<td class="w-16" rowspan="2">{{$print_data->no_of_children}}</td>
			<td class="w-16">{{$print_data->children_first_hour_amount}}</td>
		</tr>
		<tr>
			<td class="w-46">Per Exterded hours or part there of</td>
			<td class="w-20">Age 5 to 12, 10/ Perchilores</td>
			<td class="w-16">{{$print_data->children_other_hour_amount}}</td>
		</tr>
		<tr>
			<td class="w-46">Age Below 5 Years</td>
			<td class="w-20">Free</td>
			<td class="w-16">{{$print_data->no_of_baby_staff}}</td>
			<td class="w-16">--</td>
		</tr>
		<tr>
			<td class="w-46" colspan="2"><b>Total</b></td>
			<td class="w-20">{{$print_data->total_member}}</td>
			<td class="w-16">{{$print_data->paid_amount}}</td>
		</tr>
	</table>
	<div style="margin-top: 20px;text-align: right;">
		<span style="text-align:right;font-weight: bold;">E.&.O.E</span>
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