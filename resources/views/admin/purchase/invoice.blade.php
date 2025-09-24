<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $title }}</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<style>
            @page {
                header: page-header;
                footer: page-footer;
            }

            body{font-size: 12px; font-family: SolaimanLipi, Nikosh, Arial, Helvetica, sans-serif;}
			.table thead { border:1px solid #000 !important; }
            .table thead tr { border:1px solid #000 !important; }
            .table th { text-align: center; border:1px solid #000 !important; }
            .table tbody { border:1px solid #000 !important; }
            .table tbody tr { border:1px solid #000 !important; }
            .table tbody td { border:1px solid #000 !important; }
            .table thead th, tbody td { padding: 3px; font-size: 12px; line-height: 15px !important;}

            footer {
                position: fixed; 
                bottom: -10px; 
                left: 0px; 
                right: 0px;
                height: 40px; 
                font-size: 15px !important;
                color: white; !important;

                /** Extra personal styles **/
                background-color: #1dbb90;
                text-align: center;
                line-height: 30px;
            }
		</style>
	</head>
	<body>

		<htmlpageheader name="page-header">
			
      	</htmlpageheader>
      
      	<htmlpagefooter name="page-footer">
       		{{ $time }} <br>{{ $by }}
      	</htmlpagefooter>

		<img src="https://new.akhayerintl.com/admin/img/banner.jpg" width="100%" height="100px;" style="border-bottom:1px solid;">
		<h4 class="text-center" style="text-decoration: underline;"> {{ $title }} </h4>

		<table class="table" style="vertical-align: top">
			<tbody>   
				<?php
				if ($invoice->payment_mode == 'Cash') {
					echo "<tr>";
					echo "<td width='25%'> Transaction Date </td>";
					echo "<td> : " . date('d-m-Y', strtotime($invoice->transaction_date)) . "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td> Money Receipt No </td>";
					echo "<td> : " . $invoice->money_receipt_no . "</td>";
					echo "</tr>";
				} else if ($invoice->payment_mode == 'Cheque') {
					echo "<tr>";
					echo "<td width='25%'> Transaction Date </td>";
					echo "<td> : " . date('d-m-Y', strtotime($invoice->transaction_date)) . "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td> Money Receipt No </td>";
					echo "<td> : " . $invoice->money_receipt_no . "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td> Issued Cheque No </td>";
					echo "<td> : " . $invoice->cheque_no . "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td> Cheque Issued Date </td>";
					echo "<td> : " . date('d-m-Y', strtotime($invoice->cheque_date)) . "</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th> Particulars</th>
					<th> Paying Amount (Tk.) </th>
					<th> Collection Amount (Tk.) </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td> M/S. A Khayer &amp; International <br/> <?php echo $note; ?> </td>
					<td class="text-right"> 
						<?php 
							echo bd_money_format($invoice->amount);
				 		?> 
				 	</td>
					<td class="text-right"> - </td>
				</tr>
				<tr>
					<td> <?php echo $invoice->supplier->office_name . "<br/>" . $note2; ?> </td>
					<td class="text-right"> - </td>
					<td class="text-right"> 
						<?php 
							echo bd_money_format($invoice->amount);
						?> 
					</td>
				</tr>	
			</tbody>
		</table>

		<?php
			$obj = new Currency();
			echo "<br/><br/><p> Payment Tk. " . bd_money_format($invoice->amount) . "; " . $obj->get_bd_amount_in_text($invoice->amount) . ".</p><br/><br/>";

			echo "<p> Remarks: " . $invoice->remarks . "<p>";

			if ($invoice->status == 'Cancel') {
				echo "<p> <span class='text-danger'>Cancel Note : </span>" . $invoice->cancel_remarks . "</p>";
			}
		?>

		<table class="table table-bordered text-center" style="margin-top: 100px;">
			<tr>
				<td height="50px" width="33%"></td>
				<td width="33%"></td>
				<td width="33%"></td>
			</tr>
			<tr>
				<td> Supplier Signature </td>
				<td> Checked By (With Note) </td>
				<td> Transaction Confirmed By </td>
			</tr>
		</table>
    </body>
</html>