@extends('admin.layout.default')
@section('title')
    Manage Delivery List
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Delivery List's</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('entry.add') }}" class="btn btn-success">Add New</a>
                    </div>
                </div>
                <div class="box-body color-black">
                    <table id="members_list_table" class="table table-bordered table-striped example">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>REF/Agent</th>
                                <th>BD Office</th>
                                <th>Country</th>
                                <th>Client Details</th>
                                <th>GCC Medical Report</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($allData))
                                @foreach ($allData as $key => $data)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $data->agent->name }}</td>
                                        <td>{{ $data->rl_no }}</td>
                                        <td>{{ $data->country }}</td>
                                        <td>
                                            <b>Name:</b> {{ $data->user->name }}<br>
                                            <b>Mobile No:</b> {{ $data->user->phone }}<br>
                                            <b>DOB:</b> {{ $data->user->dob ? $data->user->dob : 'N/A' }}<br>
                                            <b>Passport No:</b> {{ $data->user->passport_no }}<br>
                                            <b>Expired Date:</b> {{ $data->user->passport_expired_date }}
                                        </td>
                                        <td>{{ $data->gcc_medical_report }}</td>
                                        <td>{{ $data->delivered_date }}</td>
                                        <td>
                                            @if ($data->is_returned == 'YES')
                                                <span class="badge btn-danger">RETURNED</span><br><br>
                                            @else
                                                @if ($data->status == 'PENDING')
                                                    <span class="badge btn-default">PENDING</span><br><br>
                                                @elseif($data->status == 'EMBASSY')
                                                    <span class="badge btn-info">EMBASSY</span><br><br>
                                                @elseif($data->status == 'MANPOWER')
                                                    <span class="badge btn-warning">MANPOWER</span><br><br>
                                                @elseif($data->status == 'COLLECT')
                                                    <span class="badge btn-primary">Ready to Delivery</span><br><br>
                                                @elseif($data->status == 'DELIVERED')
                                                    <span class="badge btn-success">DELIVERED</span><br><br>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('delivery.details', hashid_encode($data->id)) }}"
                                                style="color: green;" title="Details">View <i class="fa fa-eye fa-lg"
                                                    style="color: green;"></i></a> |

                                            <a href="#" style="color: black;" id="log_modal" data-toggle="modal"
                                                data-id="{{ $data->id }}" data-target="#staticBackdrop2"
                                                title="Log">Log <i class="fa fa-info fa-lg"
                                                    style="color: black;"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Log Modal HTML -->
    <div id="staticBackdrop2" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Log</h4>
                </div>
                <div class="modal-body">
                    <div id="show_log">

                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on("click", "#log_modal", function() {
            var entry_id = $(this).data("id");
            $.ajax({
                url: "{{ route('delivery.log') }}",
                type: "get",
                dataType: "json",
                data: {
                    "entry_id": entry_id
                },
                beforeSend: function() {
                    $("#overlay").fadeIn(300);
                },
                success: function(data) {
                    $("#show_log").html(data.html);
                    $("#overlay").fadeOut(300);
                },
                error: function(e) {
                    $.Notification.autoHideNotify('error', 'top right',
                        "Something Wrong. Please try again");
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>

@endsection
