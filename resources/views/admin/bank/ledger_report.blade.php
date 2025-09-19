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
		<img src="https://app.akhayerintl.com/admin/img/banner.jpg" width="100%" height="100px;" style="border-bottom:1px solid;">
		<h4 class="text-center" style="text-decoration: underline;"> {{ $title }} </h4>

        <table class="table" style="vertical-align: top">
            <tbody>            
                <tr>
                    <td width="20%"> 
                        <p> Bank Name </p>
                        <p> Account Name </p>
                        <p> Account No </p>
                        <p> Duration </p>
                    </td>
                    <td> 
                        <p> <?php echo " : " . $bank->bank_name; ?> </p>
                        <p> <?php echo " : " . $bank->account_name; ?> </p>
                        <p> <?php echo " : " . $bank->account_no; ?> </p>
                        <p> <?php echo " : " . $from_date . " To " . $to_date; ?> </p>
                    </td>
                </tr>            
            </tbody>
        </table>

        <table class="table table-bordered report" border="2px">
            <thead>
                <tr>
                    <th width="25px">#</th>
                    <th width="95px"> Trans. Date  </th>
                    <th> Particulars </th>
                    <th width="90px"> Collection Amount (Tk.) </th>
                    <th width="90px"> Paying Amount (Tk.) </th>                
                    <th width="110px"> Balance (Tk.) </th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $i = 0;
                    $balance = 0.00;

                    if (count($results) == 0) {
                        echo "<tr>";
                            echo "<td valign='top' colspan='5' class='text-right'> Current Balance = </td>";
                            $balance = $bank->account_balance;
                            echo "<td valign='top' class='text-right'>" . bd_money_format($balance) . "</td>";
                        echo "</tr>";
                    }

                    foreach ($results as $row) {
                        $i++;
                        if ($i == 1 && $row->transaction_type == 'Initial Balance') {
                            echo "<tr>";
                            echo "<td valign='top' colspan='5' class='text-right'> Initial Balance = </td>";
                            $balance = $row->amount;
                            echo "<td valign='top' class='text-right'>" . bd_money_format($balance) . "</td>";
                            echo "</tr>";
                        } else {
                            if ($i == 1) {
                                // Get previous blance
                                $balance = app(\App\Http\Controllers\Admin\Bank\IndexController::class)->previous_blance($bank->id, $from_date);
                                echo "<tr>";
                                echo "<td valign='top' colspan='5' class='text-right'> Previous Balance = </td>";
                                echo "<td valign='top' class='text-right'>" . bd_money_format($balance) . "</td>";
                                echo "</tr>";
                            }
                            if ($row->transaction_type == 'Payment' || $row->transaction_type == 'Expense') {
                                
                                $balance = $balance - $row->amount;
                                $credit = bd_money_format($row->amount);
                                $debit = '';
                                                
                            } else {
                            
                                $balance = $balance + $row->amount;
                                $credit = '';
                                $debit = bd_money_format($row->amount);
                                                    
                            }

                            if ($row->transaction_type == 'Payment') {
                                $particulars = app(\App\Http\Controllers\Admin\Payment\IndexController::class)->particulars($row->reference_no);
                            } else if ($row->transaction_type == 'Expense') {
                                $particulars = app(\App\Http\Controllers\Admin\Expense\IndexController::class)->particulars($row->reference_no);
                            }

                            echo "<tr>";
                                echo "<td valign='top'>" . sprintf("%02d", $i) . "</td>";
                                echo "<td valign='top'>" . $row->transaction_date . "</td>";
                                echo "<td valign='top' class='particulars'><p style='font-weight:bold'>" . $row->transaction_type . "</p>" . $particulars . "</td>";
                                echo "<td valign='top' class='text-right'>" . $debit . "</td>";
                                echo "<td valign='top' class='text-right'>" . $credit . "</td>";
                                echo "<td valign='top' class='text-right'>" . bd_money_format($balance) . "</td>";
                            echo "</tr>";
                        }
                    }
                    if (count($results) > 0) {
                        echo "<tr>";
                            echo "<td valign='top' colspan='5' class='text-right'> Grand Total = </td>";
                            echo "<td valign='top' class='text-right'>" . bd_money_format($balance) . "</td>";
                        echo "</tr>";
                    }
                    echo "<tr>";
                        $obj = new Currency();
                        if ($bank->bank_name == 'CASH') {
                            echo "<td valign='top' colspan='6' class='text-center'>" . $obj->get_bd_amount_in_text($balance) . "</td>";
                        } else {
                            echo "<td valign='top' colspan='6' class='text-center'>" . $obj->ladger_in_text($balance) . "</td>";
                        }
                    echo "</tr>";
                ?>
            </tbody>        
        </table>
        <footer>
            <div style="margin-top: 8px !important">Copyright © <?php echo date("Y");?> . All rights reserved.</div>
        </footer>
    </body>
</html>