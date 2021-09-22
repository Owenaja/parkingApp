@extends('layouts.main')

@section('title')
    <title>New Ticket</title>
@endsection

@section('page')
    New Ticket
@endsection

@section('content')
    <div class="container">
        <div class="col">
            <div class="card">
                {{-- <div class="card-header">
                    New Ticket
                </div> --}}
                <div class="card-body">
                    <form action="{{ route('topups.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input name="user_id" type="hidden" value={{ Auth::id() }}>
                        <input name="type" type="hidden" value="topup">
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Customer</label>
                            <select class="form-control" name="customer_id" required focus>
                                <option value="" disabled selected> - Pilih Customer - </option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer['id'] }}">{{ $customer['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="balance" class="form-label">Nominal</label>
                            <input type="text" class="form-control" name="balance" required>
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
