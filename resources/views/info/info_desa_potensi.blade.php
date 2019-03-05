@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Info Desa Potensi</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Desa</th>
                                <th>Potensi Energi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($info_desa_potensi->currentpage()-1)* $info_desa_potensi->perpage() + 1;?>
                            @foreach ($info_desa_potensi as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->desa->nama_desa}}</td>
                                    <td>
                                        @foreach ($row->potensi_energi as $item)
                                            {{$item->nama_potensi_energi}}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$info_desa_potensi->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
