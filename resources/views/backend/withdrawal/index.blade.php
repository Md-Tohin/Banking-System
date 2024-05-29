@extends('backend.layout')
@section('title')
    Banking System | Withdrawal
@endsection
@section('withdrawal')
    menu-open
@endsection
@section('withdrawal-menu')
    active
@endsection
@section('withdrawal-list')
    active
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Withdrawal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Withdrawal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Withdrawal History</h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a href="{{ route('withdrawal.add') }}"
                                            class="btn btn-sm btn-success text-light text-md"><i
                                                class="fa-solid fa-circle-plus mr-2"></i> Add Withdrawal </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped deposit_table">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Date</th>
                                        <th>Withdrawal Number</th>
                                        <th>Amount</th>
                                        <th>Vat (%)</th>
                                        <th>Vat Amount</th>
                                        <th>Grand Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d M, Y', strtotime($item->date)) }}</td>
                                            <td>{{ $item->wd_number }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->vat }} %</td>
                                            <td>{{ $item->vat_amount }}</td>
                                            <td>{{ $item->grand_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Date</th>
                                        <th>Withdrawal Number</th>
                                        <th>Amount</th>
                                        <th>Vat (%)</th>
                                        <th>Vat Amount</th>
                                        <th>Grand Total</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
