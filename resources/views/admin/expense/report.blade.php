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
		<img src="https://asset.cpbangladesh.com/documents/cp_five_star_banner_20221201055508JiRXtyM6hn.jpg" width="100%" height="100px;" style="border-bottom:1px solid;">
		<h4 class="text-center" style="text-decoration: underline;"> {{ $title }} </h4>

        <table class="table table-bordered report" border="2px">
            <thead>
                <tr>
                    <th width="25px">#</th>
                    <th>Trans. Date</th>
                    <th>Agent Name</th>
                    <th>Payment From</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($allData))
                    @foreach ($allData as $key => $data)
                        <tr>
                            <td>{{ sprintf("%02d", ++$key); }}</td>
                            <td>{{ $data->transaction_date }}</td>
                            <td>{{ $data->agent->name }}</td>
                            <td>
                                {{ $data->payment_mode }}
                                @if($data->payment_mode == 'Cheque')
                                <p>{{ $data->bank->bank_name }} <{{ $data->cheque_no }}> <{{ $data->cheque_date }}></p>
                                @endif
                            </td>
                            <td>{{ bd_money_format($data->amount) }}</td>
                            <td>{{ $data->remarks }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <footer>
            <div style="margin-top: 8px !important">Copyright © <?php echo date("Y");?> . All rights reserved.</div>
        </footer>
    </body>
</html>