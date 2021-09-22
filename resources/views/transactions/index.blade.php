@extends('layouts.main')

@section('title')
    <title>Riwayat Parkir</title>
@endsection

@section('page')
    Riwayat Parkir
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 text-right">
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-2">
                            Tambah
                        </a>
                    </div>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>No Kendaraan</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Slot</th>
                                <th>Status</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->lisence_number }}</td>
                                    <td>{{ $transaction->real_time_in }}</td>
                                    <td>{{ $transaction->real_time_out }}</td>
                                    <td>{{ $transaction->slot->name }}</td>
                                    @if ($transaction->status == '0')
                                        <td>Parkir</td>
                                    @else
                                        <td>Selesai</td>
                                    @endif
                                    <td>
                                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                            <a href="{{ route('generate', $transaction->id) }}"
                                                class="btn btn-primary">Generate</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('transactions.edit', $transaction->id) }}">Ubah</a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>

                                    </td>
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
