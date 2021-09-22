@extends('layouts.main_customer')

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
                    <br><br>
                    <div class="d-flex align-items-center justify-content-center">

                        <table style="max-width: 800px" class="table table-hover table-bordered table-stripped"
                            id="example2">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Slot Parkir</th>
                                    <th>Jam Masuk</th>
                                    <th>Durasi</th>
                                </tr>
                                @foreach ($transaction as $tra)
                                    <tr>
                                        <td>{{ $tra->customer->name }}</td>
                                        <td>{{ $tra->slot->name }}</td>
                                        <td>{{ $tra->time_in }}</td>
                                        <td>{{ $tra->duration }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ url('/create_ticket') }}" class="btn btn-danger btn-lg mr-3">Kembali</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
