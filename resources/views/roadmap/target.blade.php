@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Roadmap Target</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Desa</th>
                                <th>Target Pembangkit</th>
                                <th>Target JTM</th>
                                <th>Target JTR</th>
                                <th>Target Gardu</th>
                                <th>Target Pelanggan</th>
                                <th>Keterangan</th>
                                <th>Tahun</th>
                                <th>Triwulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($target->currentpage()-1)* $target->perpage() + 1;?>
                            @foreach ($target as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->desa->nama_desa}}</td>
                                    <td>{{$row->target_pembangkit}}</td>
                                    <td>{{$row->target_jtm}}</td>
                                    <td>{{$row->target_jtr}}</td>
                                    <td>{{$row->target_gardu}}</td>
                                    <td>{{$row->target_pelanggan}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>{{$row->tahun}}</td>
                                    <td>{{$row->triwulan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$target->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
