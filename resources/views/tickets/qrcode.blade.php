@extends('layouts.main')

@section('title')
    <title>QR Code</title>
@endsection

@section('page')
    QR Code
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center">
                    {!! $qrcode !!}
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{ url('tickets') }}" class="btn btn-danger btn-lg mr-3">Kembali</a>
                    <a href="#" class="btn btn-warning btn-lg mr-3">Cetak</a>
                </div>
            </div>
       </div>
              
    </div>
</div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
@endsection
