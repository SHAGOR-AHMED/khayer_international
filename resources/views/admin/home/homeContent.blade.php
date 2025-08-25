@extends('admin.layout.default')
@section('title')
    {{ $title }}
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
                <h3 class="count" data-target="{{ $total_user }}">0</h3>
                <p>Total User</p>
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
                    <h3 class="count" data-target="{{ $total_agent }}">0</h3>
                    <p>Total Agent</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('agent.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #3540dcff!important; color:#fff">
            <div class="inner">
                <h3 class="count" data-target="{{ $total_client }}">0</h3>
                <p>Total Client</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('client.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #60b817ff!important; color:#fff">
                <div class="inner">
                    <h3 class="count" data-target="{{ $total_entry }}">0</h3>
                    <p>Total Entry</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('entry.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

      <!-- Main row -->
      <div class="row">
         
      </div><!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

  </div><!-- /.content-wrapper -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll('.count');
            const speed = 9000; // lower is faster

            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.getAttribute('data-target');
                    const data = +counter.innerText;
                    
                    const increment = Math.ceil(value / speed);

                    if (data < value) {
                        counter.innerText = data + increment;
                        setTimeout(animate, 30);
                    } else {
                        counter.innerText = value;
                    }
                };

                animate();
            });
        });
    </script>

@endsection