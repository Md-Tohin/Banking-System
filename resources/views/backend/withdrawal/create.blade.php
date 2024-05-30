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
@section('withdrawal-add')
    active
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Withdrawal Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Withdrawal Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Withdrawal </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- withdrawal form start -->
                        <form action="{{ route('withdrawal.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="today_withdrawal_amount" id="today_withdrawal_amount"
                                value="{{ $today_withdrawal_amount }}" />
                            <input type="hidden" name="balance_amount" id="balance_amount" value="{{ $balance_amount }}" />

                            <div class="card-body row">
                                <!-- withdrawal amount show limit message -->
                                <div id="error-alert-message"
                                    @if ($today_withdrawal_amount > 3000) class="col-md-12" @else class="col-md-12 d-none" @endif>
                                </div>
                                <!-- withdrawal amount and balance amount show message -->
                                <div id="deposit-error-message" class="col-md-12 d-none"></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wd_number">Withdrawal Number <span class="text-danger">*</span></label>
                                        <input type="text" name="wd_number" value="{{ old('wd_number') }}"
                                            class="form-control @error('wd_number') is-invalid @enderror" id="wd_number"
                                            placeholder="Enter withdrawal number">
                                        @error('wd_number')
                                            <span class="invalid-feedback" id="wd_number_error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Withdrawal Amount <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" id="withdrawal_amount"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            placeholder="Enter withdrawal amount">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vat">Vat (%)</label>
                                        <input type="text" class="form-control @error('vat') is-invalid @enderror"
                                            id="vat" name="vat" value="{{ old('vat') }}"
                                            placeholder="Enter withdrawal number" readonly>
                                        @error('vat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vat">(Vat + Extra Fee) Amount</label>
                                        <input type="text" class="form-control @error('vat_amount') is-invalid @enderror"
                                            id="vat_amount" name="vat_amount" value="{{ $vat_amount }}"
                                            placeholder="Enter withdrawal number" readonly>
                                        @error('vat_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="grand_total">Grand Total</label>
                                        <input type="text"
                                            class="form-control @error('grand_total') is-invalid @enderror" id="grand_total"
                                            name="grand_total" value="{{ old('grand_total') }}"
                                            placeholder="Enter grand total amount" readonly>
                                        @error('grand_total')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" rows="3" placeholder="Enter Description..."></textarea>
                                    </div>
                                </div>
                                <div class="mx-auto text-center">
                                    <button type="submit" id="withdrawal-button"
                                        @if ($today_withdrawal_amount > 3000) disabled @endif
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let vat = 0;
            let vat_extra_amount = parseFloat($("#vat_amount").val());
            let grand_total_amount = parseFloat($("#grand_total").val());
            let today_withdrawal_amount = parseFloat($("#today_withdrawal_amount").val());
            let balance_amount = parseFloat($("#balance_amount").val());

            $(document).on('keyup', '#withdrawal_amount', function() {
                const amount = $(this).val();
                //  check input type 
                if (typeof amount !== 'number' && isNaN(amount)) {
                    $('#withdrawal_amount').val('')
                    toastr.error("Please enter a numeric value");
                    return;
                }
                //  check minimum value
                if (amount < 1) {
                    toastr.error("Amount minimum value is 1");
                    return;
                }

                //  check daily withdrawal amount limit
                if ((today_withdrawal_amount + parseFloat(amount)) > 3000) {
                    $("#error-alert-message").removeClass('d-none');
                    $("#withdrawal-button").attr('disabled', 'disabled');
                    $("#error-alert-message").html(`
                        <div class="alert alert-danger" role="alert">
                            A daily withdrawal limit of $3000 per account! <b>Your Already Withdrawal: ${today_withdrawal_amount}</b>
                        </div>
                    `);
                } else {
                    $("#error-alert-message").addClass('d-none');
                }

                //  check balance amount
                calculateGrandTotal();
                if (grand_total_amount > balance_amount) {
                    $("#deposit-error-message").removeClass('d-none');
                    $("#withdrawal-button").attr('disabled', 'disabled');
                    $("#deposit-error-message").html(`
                        <div class="alert alert-danger" role="alert">
                            You can not withdraw more than your balance amount! <b>Your Balance: ${balance_amount}</b>
                        </div>
                    `);
                } else {
                    $("#deposit-error-message").addClass('d-none');
                }

                //  disable or enable submit button
                if ((today_withdrawal_amount + parseFloat(amount)) > 3000 || grand_total_amount > balance_amount) {
                    $("#withdrawal-button").attr('disabled', 'disabled');
                } else {
                    $("#withdrawal-button").removeAttr('disabled');
                }

                calculateVat();
                calculateVatAmount();
                calculateGrandTotal();
            });

            //  vat calculation
            function calculateVat() {
                let wd_amount = $('#withdrawal_amount').val();
                if (wd_amount < 500) {
                    vat = 0;
                } else if (wd_amount >= 500 && wd_amount <= 1000) {
                    vat = 1;
                } else {
                    vat = 2;
                }
                $('#vat').val(vat);
            }

            //  vat or extra fee amount calculation
            function calculateVatAmount() {
                let wd_amount = $('#withdrawal_amount').val();
                let vat = $('#vat').val();
                let vatAmount = parseFloat(wd_amount) * parseFloat(vat) / 100;
                $('#vat_amount').val(vatAmount + vat_extra_amount);
            }

            //  grand total amount calculation
            function calculateGrandTotal() {
                let wd_amount = $('#withdrawal_amount').val();
                let vat_amount = $('#vat_amount').val();
                grand_total_amount = parseFloat(wd_amount) + parseFloat(vat_amount);
                $('#grand_total').val(grand_total_amount);
            }

            $('#vat').val(vat);

            

        });
    </script>
@endsection
