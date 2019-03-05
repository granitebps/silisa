@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah</div>

                    <div class="card-body">
                        <form action="{{ route('tambah_proses') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <hr>
                                <h2>Data Master</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Provinsi</label>
                                <input type="text" name="nama_provinsi" id="nama_provinsi" class="form-control">
                                <input type="hidden" name="id_provinsi" id="id_provinsi">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kabupaten/Kota</label>
                                <input type="text" name="nama_kabupaten_kota" id="nama_kabupaten_kota" class="form-control">
                                <input type="hidden" name="id_kabupaten_kota" id="id_kabupaten_kota">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kecamatan</label>
                                <input type="text" name="nama_kecamatan" id="nama_kecamatan" class="form-control">
                                <input type="hidden" name="id_kecamatan" id="id_kecamatan">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Desa</label>
                                <input type="text" name="kode_desa" id="kode_desa" class="form-control">
                                <input type="hidden" name="id_desa" id="id_desa">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Desa</label>
                                <input type="text" name="nama_desa" id="nama_desa" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Wilayah</label>
                                <input type="text" name="wilayah" id="wilayah" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Area</label>
                                <input type="text" name="area" id="area" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Rayon</label>
                                <input type="text" name="rayon" id="rayon" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lintang</label>
                                <input type="text" name="lintang" id="lintang" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Bujur</label>
                                <input type="text" name="bujur" id="bujur" class="form-control">
                            </div>
                            {{-- =========================== Table Info Desa ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Info Desa</label>
                                <input type="number" name="tahun_info_desa" value="{{date('Y')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Info Desa</label>
                                <select name="triwulan_info_desa" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik PLN</label>
                                <input type="text" name="desa_berlistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik LTSHE</label>
                                <input type="text" name="desa_berlistrik_ltshe"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik Non PLN</label>
                                <input type="text" name="desa_berlistrik_non_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Belum Berlistrik</label>
                                <input type="text" name="desa_belum_berlistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jarak Dari Jaringan Eksisting</label>
                                <input type="text" name="jarak_dari_jaringan_eksistensi"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Info Desa</label>
                                <input type="text" name="keterangan_info_desa"  class="form-control">
                            </div>
                            {{-- =========================== Table Potensi Energi ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Potensi Energi Desa</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Potensi Sumber Energi Setempat</label>
                                @foreach ($potensi as $item)
                                <div class="checkbox-inline">
                                    <input type="checkbox" name="potensi[]" value="{{$item->id_potensi_energi}}"> {{$item->nama_potensi_energi}}
                                </div>
                                @endforeach
                            </div>
                            {{-- =========================== Table Info Desa RT ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa RT</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Info Desa RT</label>
                                <input type="number" name="tahun_info_desa_rt" value="{{date('Y')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Info Desa RT</label>
                                <select name="triwulan_info_desa_rt" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Total RT Desa</label>
                                <input type="text" name="total_rt"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik PLN</label>
                                <input type="text" name="rt_listrik_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik PLN (Menyalur)</label>
                                <input type="text" name="rt_listrik_pln_menyalur"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik Non PLN (LTSHE)</label>
                                <input type="text" name="rt_listrik_non_pln_ltshe"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik Non PLN Selain (LTSHE)</label>
                                <input type="text" name="rt_listrik_non_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Tidak Berlistrik</label>
                                <input type="text" name="rt_tidak_berlistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Akan Dilistriki</label>
                                <input type="text" name="rt_akan_dilistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Belum Dapat Dilistriki</label>
                                <input type="text" name="rt_belum_dapat_dilistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Rumah Tangga Calon Penerima Bantuan  Subsidi Listrik</label>
                                <input type="text" name="jumlah_calon_penerima_subsidi"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Status Kondisi Pasokan Listrik</label>
                                <input type="text" name="update_jmlh_calon_penerima_subsidi"  class="form-control">
                            </div>
                            {{-- =========================== Table Info Desa Pembangkit ============================== --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa Pembangkit</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Info Desa Pembangkit</label>
                                <input type="number" name="tahun_info_desa_pembangkit" value="{{date('Y')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Info Desa Pembangkit</label>
                                <select name="triwulan_info_desa_pembangkit" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">PLN (GRID/ISOLATED)</label>
                                <input type="text" name="pln_grid_isolated"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pembangkit ISOLATED</label>
                                <input type="text" name="jenis_pembangkit_isolated"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Nyala PLN</label>
                                <input type="text" name="jam_nyala_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Grid Komunal/Stand Alone</label>
                                <input type="text" name="grid_komunal_standalone"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pembangkit</label>
                                <input type="text" name="jenis_pembangkit"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Nyala Non PLN</label>
                                <input type="text" name="jam_nyala_non_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Status Kondisi Pasokan Listrik</label>
                                <input type="text" name="status_kondisi_pasokan_listrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Info Desa Pembangkit</label>
                                <input type="text" name="keterangan_info_desa_pembangkit"  class="form-control">
                            </div>
                            {{-- =========================== Table Road Map Target ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Target</h2>                                
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Roadmap Targe</label>
                                <input type="number" name="tahun_roadmap_target" value="{{date('Y')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Roadmap Target</label>
                                <select name="triwulan_roadmap_target" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Target Pembangkit (kW/Wp)</label>
                                <input type="text" name="target_pembangkit"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target JTM (Kms)</label>
                                <input type="text" name="target_jtm"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target JTR (Kms)</label>
                                <input type="text" name="target_jtr"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target Gardu (Unit/kVA)</label>
                                <input type="text" name="target_gardu"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target Pelanggan (RT)</label>
                                <input type="text" name="target_pelanggan"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Target</label>
                                <input type="text" name="keterangan_target"  class="form-control">
                            </div>
                            {{-- =========================== Table Road Map Realisasi ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Realisasi</h2>                                
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Roadmap Realisasi</label>
                                <input type="number" name="tahun_roadmap_realisasi" value="{{date('Y')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Roadmap Realisasi</label>
                                <select name="triwulan_roadmap_realisasi" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi Pembangkit (kW/Wp)</label>
                                <input type="text" name="realisasi_pembangkit"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi JTM (Kms)</label>
                                <input type="text" name="realisasi_jtm"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi JTR (Kms)</label>
                                <input type="text" name="realisasi_jtr"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi Gardu (Unit/kVA)</label>
                                <input type="text" name="realisasi_gardu"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi Pelanggan (RT)</label>
                                <input type="text" name="realisasi_pelanggan"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Realisasi</label>
                                <input type="text" name="keterangan_realisasi"  class="form-control">
                            </div>
                            {{-- =========================== Table Desa Prioritas ================================= --}}
                            <div class="form-group">
                                <h2>Desa Prioritas</h2>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Desa Prioritas</label>
                                <input type="number" name="tahun_desa_prioritas" value="{{date('Y')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Desa Prioritas</label>
                                <select name="triwulan_desa_prioritas" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tertinggal</label>
                                <input type="text" name="tertinggal"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Terdepan dan Terluar</label>
                                <input type="text" name="terdepan_dan_terluar"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">PKSN</label>
                                <input type="text" name="pksn"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lokpri BNPP</label>
                                <input type="text" name="lokpri_bnpp"  class="form-control">
                            </div>
                            <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $( function() {
                $( "#nama_provinsi" ).autocomplete({
                    source: function(request, response ){
                        $.ajax({
                            url: '{{route("autocomplete.provinsi")}}',
                            dataType: "json",
                            data:
                            {
                                nama_provinsi: request.term,
                            },
                            success: response
                        });
                    },
                    focus: function(event, ui){
                        $('#nama_provinsi').val(ui.item.nama_provinsi);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_provinsi').val(ui.item.nama_provinsi);
                        $('#id_provinsi').val(ui.item.id_provinsi);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.nama_provinsi + "</div>" )
                    .appendTo( ul );
                };

                $( "#nama_kabupaten_kota" ).autocomplete({
                    source: function(request, response ){
                        $.ajax({
                            url: '{{route("autocomplete.kabupaten")}}',
                            dataType: "json",
                            data:
                            {
                                id_provinsi: $('#id_provinsi').val(),
                                nama_kabupaten_kota: request.term,
                            },
                            success: response
                        });
                    },
                    focus: function(event, ui){
                        $('#nama_kabupaten_kota').val(ui.item.nama_kabupaten_kota);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_kabupaten_kota').val(ui.item.nama_kabupaten_kota);
                        $('#id_kabupaten_kota').val(ui.item.id_kabupaten_kota);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.nama_kabupaten_kota + "</div>" )
                    .appendTo( ul );
                };

                $( "#nama_kecamatan" ).autocomplete({
                    source: function(request, response ){
                        $.ajax({
                            url: '{{route("autocomplete.kecamatan")}}',
                            dataType: "json",
                            data:
                            {
                                id_kabupaten_kota: $('#id_kabupaten_kota').val(),
                                nama_kecamatan: request.term,
                            },
                            success: response
                        });
                    },
                    focus: function(event, ui){
                        $('#nama_kecamatan').val(ui.item.nama_kecamatan);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_kecamatan').val(ui.item.nama_kecamatan);
                        $('#id_kecamatan').val(ui.item.id_kecamatan);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.nama_kecamatan + "</div>" )
                    .appendTo( ul );
                };

                $( "#nama_desa" ).autocomplete({
                    source: function(request, response ){
                        $.ajax({
                            url: '{{route("autocomplete.desa")}}',
                            dataType: "json",
                            data:
                            {
                                id_kecamatan: $('#id_kecamatan').val(),
                                nama_desa: request.term,
                            },
                            success: response
                        });
                    },
                    focus: function(event, ui){
                        $('#nama_desa').val(ui.item.nama_desa);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_desa').val(ui.item.nama_desa);
                        $('#id_desa').val(ui.item.id_desa);
                        $('#kode_desa').val(ui.item.kode_desa);
                        $('#wilayah').val(ui.item.wilayah);
                        $('#area').val(ui.item.area);
                        $('#rayon').val(ui.item.rayon);
                        $('#bujur').val(ui.item.bujur);
                        $('#lintang').val(ui.item.lintang);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.nama_desa + "</div>" )
                    .appendTo( ul );
                };
            });
        });
    </script>
@endsection