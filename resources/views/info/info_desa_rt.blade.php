@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card border-primary">
                <div class="card-header">Info Desa RT</div>

                <div class="card-body">
                    <div class="table-bordered">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Desa</th>
                                    <th>Total RT Desa</th>
                                    <th>RT Berlistrik PLN</th>
                                    <th>RT Berlistrik PLN (Menyalur)</th>
                                    <th>RT Berlistrik Non PLN (LTSHE)</th>
                                    <th>RT Berlistrik Non PLN Selain LTSHE</th>
                                    <th>RT Tidak Berlistrik</th>
                                    <th>RT Akan Dilistriki</th>
                                    <th>RT Belum Dapat Dilistriki</th>
                                    <th>Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listri</th>
                                    <th>Update Status Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listrik</th>
                                    <th>Tahun</th>
                                    <th>Triwulan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = ($info_desa_rt->currentpage()-1)* $info_desa_rt->perpage() + 1;?>
                                @foreach ($info_desa_rt as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->desa->nama_desa}}</td>
                                        <td>{{$row->total_rt}}</td>
                                        <td>{{$row->rt_listrik_pln}}</td>
                                        <td>{{$row->rt_listrik_pln_menyalur}}</td>
                                        <td>{{$row->rt_listrik_non_pln_ltshe}}</td>
                                        <td>{{$row->rt_listrik_non_pln}}</td>
                                        <td>{{$row->rt_tidak_berlistrik}}</td>
                                        <td>{{$row->rt_akan_dilistrik}}</td>
                                        <td>{{$row->rt_belum_dapat_dilistrik}}</td>
                                        <td>{{$row->jumlah_calon_penerima_subsidi}}</td>
                                        <td>{{$row->update_jmlh_calon_penerima_subsidi}}</td>
                                        <td>{{$row->tahun}}</td>
                                        <td>{{$row->triwulan}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$info_desa_rt->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection