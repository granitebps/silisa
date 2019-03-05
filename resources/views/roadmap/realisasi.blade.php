@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Roadmap Realisasi</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Desa</th>
                                <th>Realisasi Pembangkit</th>
                                <th>Realisasi JTM</th>
                                <th>Realisasi JTR</th>
                                <th>Realisasi Gardu</th>
                                <th>Realisasi Pelanggan</th>
                                <th>Keterangan</th>
                                <th>Tahun</th>
                                <th>Triwulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($realisasi->currentpage()-1)* $realisasi->perpage() + 1;?>
                            @foreach ($realisasi as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->desa->nama_desa}}</td>
                                    <td>{{$row->realisasi_pembangkit}}</td>
                                    <td>{{$row->realisasi_jtm}}</td>
                                    <td>{{$row->realisasi_jtr}}</td>
                                    <td>{{$row->realisasi_gardu}}</td>
                                    <td>{{$row->realisasi_pelanggan}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>{{$row->tahun}}</td>
                                    <td>{{$row->triwulan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$realisasi->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
