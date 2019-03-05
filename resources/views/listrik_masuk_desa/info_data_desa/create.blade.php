@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah</div>

                    <div class="card-body">
                        <form action="{{ route('info_data_desa.store') }}" method="POST">
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
                            {{-- =========================== Notifikasi Tambah atau Edit ================================= --}}
                            <div id="alert"></div>
                            {{-- <input type="text" value="" name="" id="alert" class="form-control"> --}}
                            {{-- =========================== Tahun dan Triwulan ================================= --}}
                            <div class="form-group">
                                <label for="">Tahun Info Data Desa</label>
                                <input type="number" id="tahun" name="tahun" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Info Data Desa</label>
                                <select name="triwulan" class="form-control">
                                    <option value="">Pilih Triwulan</option>
                                    <option id="triwulan1" value="1">1</option>
                                    <option id="triwulan2" value="2">2</option>
                                    <option id="triwulan3" value="3">3</option>
                                    <option id="triwulan4" value="4">4</option>
                                </select>
                            </div>
                            {{-- =========================== Table Info Desa ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik PLN</label>
                                <input type="text" id="desa_berlistrik" name="desa_berlistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik LTSHE</label>
                                <input type="text" id="desa_berlistrik_ltshe" name="desa_berlistrik_ltshe"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Berlistrik Non PLN</label>
                                <input type="text" id="desa_berlistrik_non_pln" name="desa_berlistrik_non_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Desa Belum Berlistrik</label>
                                <input type="text" id="desa_belum_berlistrik" name="desa_belum_berlistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jarak Dari Jaringan Eksisting</label>
                                <input type="text" id="jarak_dari_jaringan_eksistensi" name="jarak_dari_jaringan_eksistensi"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Info Desa</label>
                                <input type="text" id="keterangan_info_desa" name="keterangan_info_desa"  class="form-control">
                            </div>
                            {{-- =========================== Table Potensi Energi ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Potensi Energi Desa</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Potensi Sumber Energi Setempat</label>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($potensi as $item)
                                <div class="checkbox-inline">
                                    <input id="potensi{{$i}}" type="checkbox" name="potensi[]" value="{{$item->ID_POTENSI_ENERGI}}"> {{$item->NAMA_POTENSI_ENERGI}}
                                    @php
                                        $potensijs[] = $item->ID_POTENSI_ENERGI;
                                        $i = $i+1
                                    @endphp
                                </div>
                                @endforeach
                            </div>
                            {{-- =========================== Table Info Desa RT ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa RT</h2>
                            </div>
                            <div class="form-group">
                                <label for="">Total RT Desa</label>
                                <input type="text" id="total_rt" name="total_rt"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik PLN</label>
                                <input type="text" id="rt_listrik_pln" name="rt_listrik_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik PLN (Menyalur)</label>
                                <input type="text" id="rt_listrik_pln_menyalur" name="rt_listrik_pln_menyalur"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik Non PLN (LTSHE)</label>
                                <input type="text" id="rt_listrik_non_pln_ltshe" name="rt_listrik_non_pln_ltshe"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Berlistrik Non PLN Selain (LTSHE)</label>
                                <input type="text" id="rt_listrik_non_pln" name="rt_listrik_non_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Tidak Berlistrik</label>
                                <input type="text" id="rt_tidak_berlistrik" name="rt_tidak_berlistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Akan Dilistriki</label>
                                <input type="text" id="rt_akan_dilistrik" name="rt_akan_dilistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">RT Belum Dapat Dilistriki</label>
                                <input type="text" id="rt_belum_dapat_dilistrik" name="rt_belum_dapat_dilistrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Rumah Tangga Calon Penerima Bantuan  Subsidi Listrik</label>
                                <input type="text" id="jumlah_calon_penerima_subsidi" name="jumlah_calon_penerima_subsidi"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Status Kondisi Pasokan Listrik</label>
                                <input type="text" id="update_jmlh_calon_penerima_subsidi" name="update_jmlh_calon_penerima_subsidi"  class="form-control">
                            </div>
                            {{-- =========================== Table Info Desa Pembangkit ============================== --}}
                            <div class="form-group">
                                <hr>
                                <h2>Info Desa Pembangkit</h2>
                            </div>
                            <div class="form-group">
                                <label for="">PLN (GRID/ISOLATED)</label>
                                <input type="text" id="pln_grid_isolated" name="pln_grid_isolated"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pembangkit ISOLATED</label>
                                <input type="text" id="jenis_pembangkit_isolated" name="jenis_pembangkit_isolated"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Nyala PLN</label>
                                <input type="text" id="jam_nyala_pln" name="jam_nyala_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Grid Komunal/Stand Alone</label>
                                <input type="text" id="grid_komunal_standalone" name="grid_komunal_standalone"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Pembangkit</label>
                                <input type="text" id="jenis_pembangkit" name="jenis_pembangkit"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Nyala Non PLN</label>
                                <input type="text" id="jam_nyala_non_pln" name="jam_nyala_non_pln"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Status Kondisi Pasokan Listrik</label>
                                <input type="text" id="status_kondisi_pasokan_listrik" name="status_kondisi_pasokan_listrik"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Info Desa Pembangkit</label>
                                <input type="text" id="keterangan_info_desa_pembangkit" name="keterangan_info_desa_pembangkit"  class="form-control">
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
            var pjs = {!! json_encode($potensijs) !!};
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
                        $('#nama_provinsi').val(ui.item.NAMA_PROVINSI);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_provinsi').val(ui.item.NAMA_PROVINSI);
                        $('#id_provinsi').val(ui.item.ID_PROVINSI);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.NAMA_PROVINSI + "</div>" )
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
                        $('#nama_kabupaten_kota').val(ui.item.NAMA_KABUPATEN_KOTA);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_kabupaten_kota').val(ui.item.NAMA_KABUPATEN_KOTA);
                        $('#id_kabupaten_kota').val(ui.item.ID_KABUPATEN_KOTA);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.NAMA_KABUPATEN_KOTA + "</div>" )
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
                        $('#nama_kecamatan').val(ui.item.NAMA_KECAMATAN);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_kecamatan').val(ui.item.NAMA_KECAMATAN);
                        $('#id_kecamatan').val(ui.item.ID_KECAMATAN);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.NAMA_KECAMATAN + "</div>" )
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
                        $('#nama_desa').val(ui.item.NAMA_DESA);
                        return false;
                    },
                    select: function(event, ui){
                        $('#nama_desa').val(ui.item.NAMA_DESA);
                        $('#id_desa').val(ui.item.ID_DESA);
                        $('#kode_desa').val(ui.item.KODE_DESA);
                        $('#wilayah').val(ui.item.WILAYAH);
                        $('#area').val(ui.item.AREA);
                        $('#rayon').val(ui.item.RAYON);
                        $('#bujur').val(ui.item.BUJUR);
                        $('#lintang').val(ui.item.LINTANG);
                        $('#alert').append('<div class="alert alert-danger">Data Sudah Ada</div>');
                        // console.log(ui.item.ID_POTENSI_ENERGI);
                        // for(var i=1;i<=pjs.length;i++){
                        //     console.log(potensi+i)
                        // }
                        // var potensi = $('#potensi').val();
                        // console.log(pjs.length);
                        // Potensi Energi
                        var a = ui.item.info_desa['potensi_energi'];
                        for(var i=1;i<=pjs.length;i++){
                            var potensi = $('#potensi'+i).val();
                            $.each(a, function (key, val) {
                                // console.log(val.ID_POTENSI_ENERGI);
                                if(potensi == val.ID_POTENSI_ENERGI){
                                    $('#potensi'+i).prop('checked', true);
                                }
                            });
                        }
                        // Tahun Triwulan
                        $('#tahun').val(ui.item.info_desa['TAHUN']);
                        var triwulan = ui.item.info_desa['TRIWULAN'];
                        for (var j = 1; j <= 4; j++) {
                            var b = $('#triwulan'+j).val();
                            // console.log($('#triwulan'+j).val());
                            if(b == triwulan){
                                $('#triwulan'+j).prop('selected', true);
                            }
                        }
                        // Table Info Desa
                        $('#desa_berlistrik').val(ui.item.info_desa['DESA_BERLISTRIK']);
                        $('#desa_berlistrik_ltshe').val(ui.item.info_desa['DESA_BERLISTRIK_LTSHE']);
                        $('#desa_berlistrik_non_pln').val(ui.item.info_desa['DESA_BERLISTRIK_NON_PLN']);
                        $('#desa_belum_berlistrik').val(ui.item.info_desa['DESA_BELUM_BERLISTRIK']);
                        $('#jarak_dari_jaringan_eksistensi').val(ui.item.info_desa['JARAK_DARI_JARINGAN_EKSISTENSI']);
                        $('#keterangan_info_desa').val(ui.item.info_desa['KETERANGAN']);
                        // Table Info Desa RT
                        $('#total_rt').val(ui.item.info_desa_rt['TOTAL_RT']);
                        $('#rt_listrik_pln').val(ui.item.info_desa_rt['RT_LISTRIK_PLN']);
                        $('#rt_listrik_pln_menyalur').val(ui.item.info_desa_rt['RT_LISTRIK_PLN_MENYALUR']);
                        $('#rt_listrik_non_pln_ltshe').val(ui.item.info_desa_rt['RT_LISTRIK_NON_PLN_LTSHE']);
                        $('#rt_listrik_non_pln').val(ui.item.info_desa_rt['RT_LISTRIK_NON_PLN']);
                        $('#rt_tidak_berlistrik').val(ui.item.info_desa_rt['RT_TIDAK_BERLISTRIK']);
                        $('#rt_akan_dilistrik').val(ui.item.info_desa_rt['RT_AKAN_DILISTRIK']);
                        $('#rt_belum_dapat_dilistrik').val(ui.item.info_desa_rt['RT_BELUM_DAPAT_DILISTRIK']);
                        $('#jumlah_calon_penerima_subsidi').val(ui.item.info_desa_rt['JUMLAH_CALON_PENERIMA_SUBSIDI']);
                        $('#update_jmlh_calon_penerima_subsidi').val(ui.item.info_desa_rt['UPDATE_JMLH_CALON_PENERIMA_SUBSIDI']);
                        // Table Info Desa Pembangkit
                        $('#pln_grid_isolated').val(ui.item.info_desa_pembangkit['PLN_GRID_ISOLATED']);
                        $('#jenis_pembangkit_isolated').val(ui.item.info_desa_pembangkit['JENIS_PEMBANGKIT_ISOLATED']);
                        $('#jam_nyala_pln').val(ui.item.info_desa_pembangkit['JAM_NYALA_PLN']);
                        $('#grid_komunal_standalone').val(ui.item.info_desa_pembangkit['GRID_KOMUNAL_STANDALONE']);
                        $('#jenis_pembangkit').val(ui.item.info_desa_pembangkit['JENIS_PEMBANGKIT']);
                        $('#jam_nyala_non_pln').val(ui.item.info_desa_pembangkit['JAM_NYALA_NON_PLN']);
                        $('#status_kondisi_pasokan_listrik').val(ui.item.info_desa_pembangkit['STATUS_KONDISI_PASOKAN_LISTRIK']);
                        $('#keterangan_info_desa_pembangkit').val(ui.item.info_desa_pembangkit['KETERANGAN']);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item){
                    return $( "<li>" )
                    .append( "<div>" + item.NAMA_DESA + "</div>" )
                    .appendTo( ul );
                };
            });
        });
    </script>
@endsection