@extends('layouts.main')

@section('title')
    <title>Karcis Baru</title>
@endsection

@section('page')
    Karcis Baru
@endsection

@section('content')
    <div class="container">
        <div class="col">
            <div class="card">
                {{-- <div class="card-header">
                    New Ticket
                </div> --}}
                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input name="user_id" type="hidden" value={{ Auth::id() }}>
                        <input name="slot_id" type="hidden" value={{ $parkingslots }}>
                        <input name="type" type="hidden" value="nonmember">
                        <div class="mb-3">
                            <label for="lisence_number" class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" name="lisence_number" required>
                        </div>
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
