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
                                <th>Tertinggal</th>
                                <th>Terdepan dan Terluar</th>
                                <th>PKSN</th>
                                <th>Lokpri BNPP</th>
                                <th>Tahun</th>
                                <th>Triwulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($desa_prioritas->currentpage()-1)* $desa_prioritas->perpage() + 1;?>
                            @foreach ($desa_prioritas as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->desa->nama_desa}}</td>
                                    <td>{{$row->tertinggal}}</td>
                                    <td>{{$row->terdepan_dan_terluar}}</td>
                                    <td>{{$row->pksn}}</td>
                                    <td>{{$row->lokpri_bnpp}}</td>
                                    <td>{{$row->tahun}}</td>
                                    <td>{{$row->triwulan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$desa_prioritas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
