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
			<span class="text">Shift: {{ $print_data->check_shift }}</span>
		</div>
		<div class="w-50 text-right">
			<span class="text">Date: {{ $print_data->shift_date }} </span>
		</div>
	</div>
	<table style="width:100%;margin: -1;" border="1" cellpadding="4" cellspacing="0" >
        <tr>
            <td>Shift UPI Collection</td>
            <td><b>{{ $print_data->total_shift_upi }}</b></td>
        </tr>
        <tr>
            <td>Shift Cash Collection</td>
            <td><b>{{ $print_data->total_shift_cash }}</b></td>
        </tr>
        <tr>
            <td>Shift Total Collection</td>
            <td><b>{{ $print_data->total_collection }}</b></td>
        </tr>
        <tr>
            <td>Last Hour UPI Collection</td>
            <td><b>{{ $print_data->last_hour_upi_total }}</b></td>
        </tr>
        <tr>
            <td>Last Hour Cash Collection</td>
            <td><b>{{ $print_data->last_hour_cash_total }}</b></td>
        </tr>
        <tr>
            <td>Last Hour Total Collection</td>
            <td><b>{{ $print_data->last_hour_total }}</b></td>
        </tr>
	</table>
	<div style="margin-top: 20px;text-align: right;">
		<span style="text-align:right;font-weight: bold;">E.&.O.E</span>
	</div>
</div>