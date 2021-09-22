@extends('layouts.main')

@section('title')
    <title>Transaksi Dompet</title>
@endsection

@section('page')
    Transaksi Dompet
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 text-right">
                        <a href="{{ route('topups.create') }}" class="btn btn-primary mb-2">
                            Tambah
                        </a>
                    </div>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Tipe</th>
                                <th>Customer</th>
                                <th>Nominal</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                            @foreach ($wallettransactions as $wallettransaction)
                                <tr>
                                    <td>{{ $wallettransaction->id }}</td>
                                    <td>{{ $wallettransaction->date }}</td>
                                    @if ($wallettransaction->type == 'topup')
                                        <td>Top-Up</td>
                                    @else
                                        <td>Pembayaran</td>
                                    @endif
                                    <td>{{ $wallettransaction->customer->name }}</td>
                                    <td>{{ $wallettransaction->balance }}</td>
                                    {{-- <td>
                                        <form action="{{ route('topups.destroy', $wallettransaction->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>

                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
