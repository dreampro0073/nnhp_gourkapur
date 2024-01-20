<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		.main{
			width: 300px;
			border: 1px solid red;
		}
		h4{
			text-align: center;
			font-size: 14px;
		}
		.table-div{
			display: table;
			width: 100%;
		}
		.table-div > div{
			display: table-cell;
			vertical-align: middle;
			/*border: 1px solid #000;*/
			padding: 2px;
		}
		.w-50{
			width: 50%;
		}
		.w-16{
			width: 16.66%;
		}
		td,span{
			font-size: 12px;
		}
	</style>
</head>
<body>
	<div class="main" id="printableArea">
		<h4>
			M/s New Nabaratna Hospitality Pvt. Ltd.
		</h4>
		<div class="table-div">
			<div class="w-50">
				<span class="text">Bill No: 212112</span>
			</div>
			<div class="w-50">
				<span class="text">Date: <?php echo date("d-m-Y"); ?></span>
			</div>
		</div>
		<p class="text">Name : Dipanshu Chuahan</p>
		<div class="table-div">
			<div class="w-50">
				<span class="text">PNR/ID No.: 898989</span>
			</div>
			<div class="w-50">
				<span class="text">Mob: 7351334717</span>
			</div>
		</div>
		<div class="table-div" style="margin-bottom: 20px;">
			<div class="w-50">
				<span class="text">In Time: 7:30 PM</span>
			</div>
			<div class="w-50">
				<span class="text">Out Time: 7:30 PM</span>
			</div>
		</div>
		<table style="width:100%;margin: -1;" border="1" cellspacing="0" >
			<tr>
				<td class="w-50">For First hours or part there of</td>
				<td class="w-16">Adult 30/- Perpersal</td>
				<td class="w-16">Pax</td>
				<td class="w-16">Value</td>
			</tr>
			<tr>
				<td class="w-50">Per Exterded hours or part there of</td>
				<td class="w-16">Adult 20/- Perpersal</td>
				<td class="w-16"></td>
				<td class="w-16"></td>
			</tr>
			<tr>
				<td class="w-50">1st hours of part there of</td>
				<td class="w-16">Age 5 to 12, 20/ Perchilores</td>
				<td class="w-16"></td>
				<td class="w-16"></td>
			</tr>
			<tr>
				<td class="w-50">Per Exterded hours or part there of</td>
				<td class="w-16">ge 5 to 12, 10/ Perchilores</td>
				<td class="w-16"></td>
				<td class="w-16"></td>
			</tr>
			<tr>
				<td class="w-50">Age Below5 Years</td>
				<td class="w-16">Free</td>
				<td class="w-16"></td>
				<td class="w-16"></td>
			</tr>
		</table>
	</div>

	<a href="{{url('print-post')}}">Print</a>
	<input type="button" onclick="printDiv('printableArea')" value="print a div!" />

	<script type="text/javascript">
		function printDiv(divName) {
		     var printContents = document.getElementById(divName).innerHTML;
		     var originalContents = document.body.innerHTML;

		     document.body.innerHTML = printContents;

		     window.print();

		     document.body.innerHTML = originalContents;
		}
	</script>
</body>
</html>