@extends('layouts.main')

@section('title')
    <title>Daftar Slot Parkir</title>
@endsection

@section('page')
    Daftar Slot Parkir
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 text-right">
                        <a href="{{ route('parkingslots.create') }}" class="btn btn-primary mb-2">
                            Tambah
                        </a>
                    </div>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($parkingslots as $parkingslot)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $parkingslot->name }}</td>
                                    <td>{{ $parkingslot->location }}</td>
                                    @if ($parkingslot->status == '0')
                                        <td>Kosong</td>
                                    @else
                                        <td>Terisi</td>
                                    @endif
                                    <td>
                                        <form action="{{ route('parkingslots.destroy', $parkingslot->id) }}"
                                            method="POST">
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
