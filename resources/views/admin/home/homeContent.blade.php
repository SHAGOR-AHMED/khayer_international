@extends('admin.layout.default')
@section('title')
    Admin Dashboard
@endsection
@section('content')

<style type="text/css">
    .connectedSortable {
      min-height: 100px;
    }
    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: .75rem 1.25rem;
        position: relative;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }
    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-footer {
        padding: .75rem 1.25rem;
        background-color: rgba(0,0,0,.03);
        border-top: 0 solid rgba(0,0,0,.125);
    }
  </style>

  <div class="content-wrapper">
    <section class="content-header"></section>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #dc3545!important; color:#fff">
            <div class="inner">
                <h3>333</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('user.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #17a2b8!important; color:#fff">
                <div class="inner">
                    <h3>222</h3>
                    <p>Total Entry</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #dc3545!important; color:#fff">
            <div class="inner">
                <h3>333</h3>
                <p>Total Delivery</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('user.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #17a2b8!important; color:#fff">
                <div class="inner">
                    <h3>222</h3>
                    <p>Total Reject</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

      <!-- Main row -->
      <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
              <!-- TABLE: LATEST ORDERS -->
              <div class="card">
                  <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Contacts</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix text-center">
                    <a href="#" class="btn btn-sm btn-secondary float-right">View All</a>
                  </div>
                  <!-- /.card-footer -->
            </div>
          </section>
          <!-- /.Left col -->
          
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
              <!-- PRODUCT LIST -->
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Recent Contacts</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Vacancies</th>
                            <th>Deadline</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix text-center">
                    <a href="" class="btn btn-sm btn-secondary float-right">View All</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
          </section>
          <!-- right col -->
      </div><!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

  </div><!-- /.content-wrapper -->

@endsection