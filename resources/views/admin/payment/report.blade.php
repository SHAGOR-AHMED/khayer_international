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
            body{font-size: 12px; font-family: SolaimanLipi, Nikosh, Arial, Helvetica, sans-serif;}
			.table th { text-align: center; }
			.table thead th, tbody td { padding: 3px; font-size: 12px; line-height: 15px !important;}
			.bold {font-weight: bold;}
                           td.particulars { line-height: 13px !important;}
		</style>
	</head>
	<body>
		<!-- <img src="{{ asset('admin/img/banner.jpg') }}" width="100%" height="100px;" style="border-bottom:1px solid; margin-top:-25px"> -->
		<h4 class="text-center" style="text-decoration: underline;"> {{ $title }} </h4>

        <table class="table table-bordered report">
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

    </body>
</html>