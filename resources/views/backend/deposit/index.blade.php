@extends('backend.layout')
@section('title')
    Banking System | Deposit
@endsection
@section('deposit')
    active
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Deposit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Deposit</li>
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
                            <h3 class="card-title">Deposit History</h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-sm btn-success text-light text-md"
                                            data-toggle="modal" data-target="#add_deposit_modal"><i
                                                class="fa-solid fa-circle-plus mr-2"></i> Add Deposit </button>
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
                                        <th>Deposit Number</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d M, Y', strtotime($item->date)) }}</td>
                                            <td>{{ $item->deposit_number }}</td>
                                            <td>{{ $item->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Date</th>
                                        <th>Deposit Number</th>
                                        <th>Amount</th>
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

    <!-- add deposit Modal -->
    <div class="modal fade" id="add_deposit_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Deposit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="add_deposit_form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Deposit Number <span class="text-danger">*</span></label>
                            <input type="text" name="deposit_number" class="form-control"
                                placeholder="Enter deposit number">
                            <small class="text-danger" id="deposit-add-deposit_number"></small>
                        </div>

                        <div class="form-group">
                            <label>Deposit Amount <span class="text-danger">*</span></label>
                            <input type="text" name="amount" class="form-control" placeholder="Enter deposit amount">
                            <small class="text-danger" id="deposit-add-amount"></small>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter Description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="add_deposit_button" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add deposit Modal -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //  add deposit 
            $('#add_deposit_form').on('submit', function(e) {
                e.preventDefault();
                $('#add_deposit_button').text('Submitting...');
                const fd = new FormData(this);
                $.ajax({
                    url: "{{ route('deposit.store') }}",
                    method: "POST",
                    data: fd,
                    catch: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            $('#add_deposit_form')[0].reset();
                            $('#add_deposit_button').text('Submit');
                            $('#add_deposit_modal').modal('hide');
                            $('.deposit_table').load(location.href + ' .deposit_table');
                            toastr.success('Deposit successfully done!');
                        }
                        if (res.status == 500) {
                            $('#add_deposit_button').text('Submit');
                            $.each(res.errors, function(i, error) {
                                $("#deposit-add-" + i).attr('style', 'color:red');
                                $("#deposit-add-" + i).html(error);
                                setTimeout(function() {
                                    $('#deposit-add-' + i).css({
                                        'display': 'none'
                                    });
                                }, [3000]);
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        $('#add_deposit_button').text('Submit');
                        toastr.error('Something went wrong!');
                    }
                });
            });
        });
    </script>
@endsection
