@extends('layouts.main')

@section('title')
    <title>Slot Parkir Baru</title>
@endsection

@section('page')
Slot Parkir Baru
@endsection

@section('content')
    <div class="container">
        <div class="col">
            <div class="card">
                {{-- <div class="card-header">
                    Slot Parkir Baru
                </div> --}}
                <div class="card-body">
                    <form action="{{ route('parkingslots.store') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Slot</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <select class="form-control" name="location" required focus>
                                <option value="" disabled selected> - Lokasi - </option>        
                                <option value="Gedung A"> Gedung A </option>
                                <option value="Gedung B"> Gedung B </option>
                                <option value="Gedung C"> Gedung C </option>
                              </select>
                        </div>
                        <input name="status" type="hidden" value="0">
                        <div class="mb-3 text-right">
                            <button type="submit" class=" btn btn-success padding-top">Buat</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
