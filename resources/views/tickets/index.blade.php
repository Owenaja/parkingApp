@extends('layouts.main')

@section('title')
    <title>New Ticket</title>
@endsection

@section('page')
    New Ticket
@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('tickets.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No Kendaraan</th>
                            <th>Jenis</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                         </tr>
                        @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $transaction->lisence_number }}</td>
                            @if($transaction->type =='car')        
                                <td>Mobil</td>         
                            @else
                                <td>Motor</td>        
                            @endif
                            <td>{{ $transaction->time_in }}</td>
                            <td>{{ $transaction->time_out }}</td>
                            @if($transaction->status =='0')        
                                <td>Parkir</td>         
                            @else
                                <td>Selesai</td>        
                            @endif
                            <td>
                            <form action="{{ route('tickets.destroy',$transaction->id) }}" method="POST">
                                <a href="{{ route('generate',$transaction->id) }}" class="btn btn-primary">Generate</a>
                                <a class="btn btn-primary" href="{{ route('tickets.edit',$transaction->id) }}">Ubah</a>
            
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
