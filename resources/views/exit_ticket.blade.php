@extends('layouts.main')

@section('title')
    <title>Pindai Karcis Keluar</title>
@endsection

@section('page')
    Pindai Karcis Keluar
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-center">
                        <video width="400" height="400" id="preview"></video>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    {{-- <div class="card-header">
                        Exit Ticket
                    </div> --}}
                    <div class="card-body">
                        <form action="/scan_out/confirm" method="POST">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <div class="col-sm-9">
                                    <input type="text" name="id" class="form-control" id="id">
                                </div>
                                <div class="col-sm-3">
                                    <button id="btn-search" type="button" class="btn btn-success btn-block">Cari</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lisence_number" class="form-label">Plat Nomor</label>
                                <input type="text" name="lisence_number" class="form-control" id="lisence_number">
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="time_in" class="form-label">Jam Masuk</label>
                                    <input type="text" name="real_time_in" class="form-control" id="real_time_in">
                                </div>
                                <div class="col-sm-6">
                                    <label for="time_out" class="form-label">Jam Keluar</label>
                                    <input type="text" name="time_out" class="form-control" id="time_out"
                                        value="{{ $exit }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Durasi</label>
                                <input type="text" name="duration" class="form-control" id="duration">
                            </div>
                            <div class="mb-3">
                                <label for="total_price" class="form-label">Total Harga</label>
                                <input type="text" name="total_price" class="form-control" id="total_price">
                            </div>
                            <div class="mb-3 text-right">
                                <button type="submit" class=" btn btn-primary btn-block">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });
        scanner.addListener('scan', function(content) {
            $('#id').val(content);
        });
    </script>

    <script type="text/javascript">
        $('#btn-search').on('click', function() {
            var id = $("#id").val();
            $.ajax({
                // type: "GET",
                url: "{{ url('ajax') }}/" + id,
                // url:'url_folder/ajax.php',
                data: "id=" + id,
                // data: {'id':id},
                // dataType: 'json',
                success: function(data) {
                    var json = data;
                    let obj = JSON.parse(json);

                    $('#lisence_number').val(obj.lisence_number);
                    $('#duration').val(obj.duration);
                    $('#real_time_in').val(obj.real_time_in);
                    console.log(obj);
                },
                error: function(data) {
                    alert("Data tidak ditemukan");
                },

            });
        });

        function isi_otomatis() {
            var id = $("#id").val();
            $.ajax({
                // type: "GET",
                url: "{{ url('ajax') }}/" + id,
                // url:'url_folder/ajax.php',
                data: "id=" + id,
                // data: {'id':id},
                // dataType: 'json',
                success: function(data) {
                    var json = data;
                    let obj = JSON.parse(json);

                    $('#lisence_number').val(obj.lisence_number);
                    $('#vehicle').val(obj.vehicle);
                    $('#duration').val(obj.duration);
                    $('#real_time_in').val(obj.real_time_in);
                },
                error: function(data) {
                    alert("Data tidak ditemukan");
                },

            });

        }
    </script>
    <script>
        let duration = document.getElementById('duration');
        let total_price = document.getElementById('total_price');
        duration.addEventListener('input', updateTotal);

        function updateTotal() {
            total_price.value = (parseInt(duration.value) * parseFloat('4000'));
        }
    </script>
@endsection
