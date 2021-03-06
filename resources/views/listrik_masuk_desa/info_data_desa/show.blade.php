@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">View Info Data Desa : {{$info_data_desa->NAMA_DESA}}</div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="">Nama Provinsi</label>
                                <input type="text" disabled value="{{$info_data_desa->kecamatan->kabupaten->provinsi->NAMA_PROVINSI}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kabupaten/Kota</label>
                                <input type="text" disabled value="{{$info_data_desa->kecamatan->kabupaten->NAMA_KABUPATEN_KOTA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kecamatan</label>
                                <input type="text" disabled value="{{$info_data_desa->kecamatan->NAMA_KECAMATAN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Desa</label>
                                <input type="text" disabled value="{{$info_data_desa->KODE_DESA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Desa</label>
                                <input type="text" disabled value="{{$info_data_desa->NAMA_DESA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Wilayah</label>
                                <input type="text" disabled value="{{$info_data_desa->WILAYAH}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Area</label>
                                <input type="text" disabled value="{{$info_data_desa->AREA}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Rayon</label>
                                <input type="text" disabled value="{{$info_data_desa->RAYON}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lintang</label>
                                <input type="text" disabled value="{{$info_data_desa->LINTANG}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Bujur</label>
                                <input type="text" disabled value="{{$info_data_desa->BUJUR}}" class="form-control">
                            </div>
                            {{-- =========================== Table Info Desa ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa</h2>
                            </div>
                            <div class="form-group">
                                <label>Sumber Data Info Desa : </label>
                                <label>
                                    {{$info_data_desa->info_desa->SOURCE}}
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik PLN</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa->DESA_BERLISTRIK}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik LTSHE</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa->DESA_BERLISTRIK_LTSHE}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik Non PLN</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa->DESA_BERLISTRIK_NON_PLN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Belum Berlistrik</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa->DESA_BELUM_BERLISTRIK}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jarak Dari Jaringan Eksisting</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa->JARAK_DARI_JARINGAN_EKSISTENSI}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Info Desa</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa->KETERANGAN}}" class="form-control">
                            </div>
                            {{-- =========================== Table Potensi Energi ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Potensi Energi Desa</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Potensi Sumber Energi Setempat</label>
                                @foreach ($info_data_desa->info_desa->potensi_energi as $item)
                                <div class="checkbox-inline">
                                    <input type="checkbox" disabled checked> {{$item->NAMA_POTENSI_ENERGI}}
                                </div>
                                @endforeach
                            </div>
                            {{-- =========================== Table Info Desa RT ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa RT</h2>
                            </div>
                            <div class="form-group">
                                <label>Sumber Data Info Desa RT : </label>
                                {{$info_data_desa->info_desa_rt->SOURCE}}
                            </div>
                            <div class="form-group">
                                <label for="">Total RT Desa</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->TOTAL_RT}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik PLN</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->RT_LISTRIK_PLN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik PLN (Menyalur)</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->RT_LISTRIK_PLN_MENYALUR}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik Non PLN (LTSHE)</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->RT_LISTRIK_NON_PLN_LTSHE}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik Non PLN Selain (LTSHE)</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->RT_LISTRIK_NON_PLN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Tidak Berlistrik</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->RT_TIDAK_BERLISTRIK}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Akan Dilistriki</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->RT_AKAN_DILISTRIK}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Belum Dapat Dilistriki</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->RT_BELUM_DAPAT_DILISTRIK}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Rumah Tangga Calon Penerima Bantuan  Subsidi Listrik</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->JUMLAH_CALON_PENERIMA_SUBSIDI}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Status Kondisi Pasokan Listrik</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_rt->UPDATE_JMLH_CALON_PENERIMA_SUBSIDI}}" class="form-control">
                            </div>
                            {{-- =========================== Table Info Desa Pembangkit ============================== --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa Pembangkit</h2>
                            </div>
                            <div class="form-group">
                                <label>Sumber Data Info Desa Pembangkit : </label>
                                {{$info_data_desa->info_desa_pembangkit->SOURCE}}
                            </div>
                            <div class="form-group">
                                <label for="">PLN (GRID/ISOLATED)</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->PLN_GRID_ISOLATED}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pembangkit ISOLATED</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->JENIS_PEMBANGKIT_ISOLATED}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Nyala PLN</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->JAM_NYALA_PLN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Grid Komunal/Stand Alone</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->GRID_KOMUNAL_STANDALONE}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pembangkit</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->JENIS_PEMBANGKIT}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Nyala Non PLN</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->JAM_NYALA_NON_PLN}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Status Kondisi Pasokan Listrik</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->STATUS_KONDISI_PASOKAN_LISTRIK}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Info Desa Pembangkit</label>
                                <input type="text" disabled value="{{$info_data_desa->info_desa_pembangkit->KETERANGAN}}" class="form-control">
                            </div>
                            <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection