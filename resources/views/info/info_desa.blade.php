@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Info Desa</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Desa</th>
                                <th>Nama Desa</th>
                                <th>Desa Berlistrik PLN</th>
                                <th>Desa Berlistrik LTSHE</th>
                                <th>Desa Berlistrik Non PLN (Selain LTSHE)</th>
                                <th>Desa Belum Berlistrik</th>
                                <th>Jarak Dari Jaringan Eksisting</th>
                                <th>Keterangan</th>
                                <th>Tahun</th>
                                <th>Triwulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($info_desa->currentpage()-1)* $info_desa->perpage() + 1;?>
                            @foreach ($info_desa as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->kode_desa}}</td>
                                    <td>{{$row->nama_desa}}</td>
                                    <td>{{$row->desa_berlistrik}}</td>
                                    <td>{{$row->desa_berlistrik_ltshe}}</td>
                                    <td>{{$row->desa_berlistrik_non_pln}}</td>
                                    <td>{{$row->desa_belum_berlistrik}}</td>
                                    <td>{{$row->jarak_dari_jaringan_eksistensi}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>{{$row->tahun}}</td>
                                    <td>{{$row->triwulan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$info_desa->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection