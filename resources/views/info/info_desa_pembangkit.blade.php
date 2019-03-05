@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Info Desa Pembangkit</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Desa</th>
                                <th>PLN (Grid / Isolated)</th>
                                <th>Jenis Pembangkit Isolated</th>
                                <th>Jam Nyala PLN</th>
                                <th>(Grid / Komunal)</th>
                                <th>Jenis Pembangkit</th>
                                <th>Jam Nyala Non PLN</th>
                                <th>Status Kondisi Pasokan Listrik</th>
                                <th>Keterangan</th>
                                <th>Tahun</th>
                                <th>Triwulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($info_desa_pembangkit->currentpage()-1)* $info_desa_pembangkit->perpage() + 1;?>
                            @foreach ($info_desa_pembangkit as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->desa->nama_desa}}</td>
                                    <td>{{$row->pln_grid_istoled}}</td>
                                    <td>{{$row->jenis_pembangkit_istoled}}</td>
                                    <td>{{$row->jam_nyala_pln}}</td>
                                    <td>{{$row->grid_komunal_standalone}}</td>
                                    <td>{{$row->jenis_pembangkit}}</td>
                                    <td>{{$row->jam_nyala_non_pln}}</td>
                                    <td>{{$row->status_kondisi_pasokan_listrik}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>{{$row->tahun}}</td>
                                    <td>{{$row->triwulan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$info_desa_pembangkit->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
