@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('kasir.order.index') }}" method="GET">
                    <div class="input-group">
                        <input type="date" name="search" id="search" class="form-control" placeholder="Search by Date" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-info">Cari Data</button>
                        @if(request('search'))
                        <a href="{{ route('kasir.order.index') }}" class="btn btn-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('kasir.order.create') }}" class="btn btn-primary">Pembelian Baru</a>
            </div>
        </div>
        <br>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Pembeli</th>
                    <th>Obat</th>
                    <th>Total Bayar</th>
                    <th>Kasir</th>
                    <th>Tanggal Pembelian</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($orders as $item)
                    <tr>
                        <td class="tect-center">{{ $no++ }}</td>
                        <td>{{ $item['name_customer'] }}</td>
                        <td>
                            {{-- karna coloumn medicines pada table orders bertipe json yang diubah formatnya menjadi array, maka dari itu untuk mengakses/menampilkan item nya perlu menggunakan looping --}}
                            @foreach($item['medicines'] as $medicine)
                                <ol>
                                    <li>
                                        {{-- mengakses key array assoc dari tiap item array value coloumn medicines --}}
                                        {{ $medicine['name_medicine'] }} ( {{ number_format($medicine['price'],0,'.','.') }} ) : Rp. {{ number_format($medicine['sub_price'],0,'.','.') }} <small>qty {{ $medicine['qty'] }}</small>
                                    </li>
                                </ol>
                            @endforeach
                        </td>
                        <td>Rp. {{ number_format($item['total_price'],0,'.','.') }}</td>
                        {{-- karna nama kasir terdapat pada table users, dan relasi antara order dan users telah didefinisikan pada function relasi bernama user. maka, untuk mengakses coloumn pada table users melalui relasi antara keduanya dapat dilakukan dengan $var ['namaFuncRelasi']['coloumnDariTableLainnya'] --}}
                        <td>{{ $item['user']['name'] }}</td>
                        @php setLocale(LC_ALL, 'IND'); @endphp
                        w
                        <td>
                            <a href="{{ route('kasir.order.download', $item['id']) }}" class="btn btn-primary">Download Setruk </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{-- jika data ada atau > 0 --}}
            @if($orders->count())
            {{-- munculkan tampilan pagination --}}
                {{ $orders->links() }}
            @endif
        </div>
    </div>
@endsection