@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">View Road Map Silisa : {{$roadmap_silisa->NAMA_DESA}}</div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="">Nama Provinsi</label>
                                <input type="text" disabled value="{{$roadmap_silisa->kecamatan->kabupaten->provinsi->NAMA_PROVINSI}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kabupaten/Kota</label>
                                <input type="text" disabled value="{{$roadmap_silisa->kecamatan->kabupaten->NAMA_KABUPATEN_KOTA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kecamatan</label>
                                <input type="text" disabled value="{{$roadmap_silisa->kecamatan->NAMA_KECAMATAN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Desa</label>
                                <input type="text" disabled value="{{$roadmap_silisa->KODE_DESA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Desa</label>
                                <input type="text" disabled value="{{$roadmap_silisa->NAMA_DESA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Wilayah</label>
                                <input type="text" disabled value="{{$roadmap_silisa->WILAYAH}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Area</label>
                                <input type="text" disabled value="{{$roadmap_silisa->AREA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Rayon</label>
                                <input type="text" disabled value="{{$roadmap_silisa->RAYON}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lintang</label>
                                <input type="text" disabled value="{{$roadmap_silisa->LINTANG}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Bujur</label>
                                <input type="text" disabled value="{{$roadmap_silisa->BUJUR}}" class="form-control">
                            </div>
                            {{-- =========================== Table Road Map Target ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Target</h2>                                
                            </div>
                            <div class="form-group">
                                <label>Sumber Data Roadmap Target : </label>
                                {{$roadmap_silisa->roadmap_target->SOURCE}}
                            </div>
                            <div class="form-group">
                                <label for="">Target Pembangkit (kW/Wp)</label>
                                <input type="text" disabled value="{{$roadmap_silisa->roadmap_target->TARGET_PEMBANGKIT}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target JTM (Kms)</label>
                                <input type="text" disabled value="{{$roadmap_silisa->roadmap_target->TARGET_JTM}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target JTR (Kms)</label>
                                <input type="text" disabled value="{{$roadmap_silisa->roadmap_target->TARGET_JTR}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target Gardu (Unit/kVA)</label>
                                <input type="text" disabled value="{{$roadmap_silisa->roadmap_target->TARGET_GARDU}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target Pelanggan (RT)</label>
                                <input type="text" disabled value="{{$roadmap_silisa->roadmap_target->TARGET_PELANGGAN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Target</label>
                                <input type="text" disabled value="{{$roadmap_silisa->roadmap_target->KETERANGAN}}" class="form-control">
                            </div>
                            {{-- =========================== Table Road Map Realisasi ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Realisasi</h2>                                
                            </div>
                            <div class="form-group">
                                <label>Sumber Data Roadmap Realisasi : </label>
                                {{$roadmap_silisa->roadmap_realisasi->SOURCE}}
                            </div>
                            <div class="form-group">
                                    <label for="">Realisasi Pembangkit (kW/Wp)</label>
                                    <input type="text" disabled value="{{$roadmap_silisa->roadmap_realisasi->REALISASI_PEMBANGKIT}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Realisasi JTM (Kms)</label>
                                    <input type="text" disabled value="{{$roadmap_silisa->roadmap_realisasi->REALISASI_JTM}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Realisasi JTR (Kms)</label>
                                    <input type="text" disabled value="{{$roadmap_silisa->roadmap_realisasi->REALISASI_JTR}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Realisasi Gardu (Unit/kVA)</label>
                                    <input type="text" disabled value="{{$roadmap_silisa->roadmap_realisasi->REALISASI_GARDU}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Realisasi Pelanggan (RT)</label>
                                    <input type="text" disabled value="{{$roadmap_silisa->roadmap_realisasi->REALISASI_PELANGGAN}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan Realisasi</label>
                                    <input type="text" disabled value="{{$roadmap_silisa->roadmap_realisasi->KETERANGAN}}" class="form-control">
                                </div>
                            <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection