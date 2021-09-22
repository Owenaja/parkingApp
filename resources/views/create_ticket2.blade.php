@extends('layouts.main')

@section('title')
    <title>New Ticket</title>
@endsection

@section('page')
    New Ticket
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/dist/img/barcode.png') }}" alt="Barcode" style="width:80%">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                {{-- <div class="card-header">
                    Exit Ticket
                </div> --}}
                <div class="card-body">
                    <form action="">
                        <div class="mb-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Print</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Back</button>
                            </div>
                        </div>
                        {{-- <div class="mb-3 text-right">
                            <button type="submit" class=" btn btn-danger padding-top">Input Manually</button>
                        </div> --}}
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
