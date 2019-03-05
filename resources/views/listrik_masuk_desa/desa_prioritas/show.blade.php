@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">View Desa Prioritas : {{$desa_prioritas->NAMA_DESA}}</div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="">Nama Provinsi</label>
                                <input type="text" disabled value="{{$desa_prioritas->kecamatan->kabupaten->provinsi->NAMA_PROVINSI}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kabupaten/Kota</label>
                                <input type="text" disabled value="{{$desa_prioritas->kecamatan->kabupaten->NAMA_KABUPATEN_KOTA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kecamatan</label>
                                <input type="text" disabled value="{{$desa_prioritas->kecamatan->NAMA_KECAMATAN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Desa</label>
                                <input type="text" disabled value="{{$desa_prioritas->KODE_DESA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Desa</label>
                                <input type="text" disabled value="{{$desa_prioritas->NAMA_DESA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <h2>Info Desa</h2>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="">Wilayah</label>
                                <input type="text" disabled value="{{$desa_prioritas->WILAYAH}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Area</label>
                                <input type="text" disabled value="{{$desa_prioritas->AREA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Rayon</label>
                                <input type="text" disabled value="{{$desa_prioritas->RAYON}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lintang</label>
                                <input type="text" disabled value="{{$desa_prioritas->LINTANG}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Bujur</label>
                                <input type="text" disabled value="{{$desa_prioritas->BUJUR}}" class="form-control">
                            </div>
                            {{-- =========================== Table Desa Prioritas ================================= --}}
                            <div class="form-group">
                                <h2>Desa Prioritas</h2>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label>Sumber Data Desa Prioritas : </label>
                                {{$desa_prioritas->desa_prioritas->SOURCE}}
                            </div>
                            <div class="form-group">
                                <label for="">Tertinggal</label>
                                <input type="text" disabled value="{{$desa_prioritas->desa_prioritas->TERTINGGAL}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Terdepan dan Terluar</label>
                                <input type="text" disabled value="{{$desa_prioritas->desa_prioritas->TERDEPAN_DAN_TERLUAR}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">PKSN</label>
                                <input type="text" disabled value="{{$desa_prioritas->desa_prioritas->PKSN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lokpri BNPP</label>
                                <input type="text" disabled value="{{$desa_prioritas->desa_prioritas->LOKPRI_BNPP}}" class="form-control">
                            </div>
                            <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection