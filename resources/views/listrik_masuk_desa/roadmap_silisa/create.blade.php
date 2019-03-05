@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah</div>

                    <div class="card-body">
                        <form action="{{ route('roadmap_silisa.store') }}" method="POST">
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
                            {{-- =========================== Tahun dan Triwulan ================================= --}}
                            <div class="form-group">
                                <label for="">Tahun Info Data Desa</label>
                                <input type="number" name="tahun" value="{{date('Y')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Triwulan Info Data Desa</label>
                                <select name="triwulan" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            {{-- =========================== Table Road Map Target ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Target</h2>                                
                            </div>
                            <div class="form-group">
                                <label for="">Target Pembangkit (kW/Wp)</label>
                                <input type="text" id="target_pembangkit" name="target_pembangkit"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target JTM (Kms)</label>
                                <input type="text" id="target_jtm" name="target_jtm"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target JTR (Kms)</label>
                                <input type="text" id="target_jtr" name="target_jtr"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target Gardu (Unit/kVA)</label>
                                <input type="text" id="target_gardu" name="target_gardu"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Target Pelanggan (RT)</label>
                                <input type="text" id="target_pelanggan" name="target_pelanggan"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Target</label>
                                <input type="text" id="keterangan_target" name="keterangan_target"  class="form-control">
                            </div>
                            {{-- =========================== Table Road Map Realisasi ================================= --}}
                            <div class="form-group">
                                <hr>
                                <h2>Realisasi</h2>                                
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi Pembangkit (kW/Wp)</label>
                                <input type="text" id="realisasi_pembangkit" name="realisasi_pembangkit"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi JTM (Kms)</label>
                                <input type="text" id="realisasi_jtm" name="realisasi_jtm"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi JTR (Kms)</label>
                                <input type="text" id="realisasi_jtr" name="realisasi_jtr"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi Gardu (Unit/kVA)</label>
                                <input type="text" id="realisasi_gardu" name="realisasi_gardu"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Realisasi Pelanggan (RT)</label>
                                <input type="text" id="realisasi_pelanggan" name="realisasi_pelanggan"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Realisasi</label>
                                <input type="text" id="keterangan_realisasi" name="keterangan_realisasi"  class="form-control">
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
                            url: '{{route("autocomplete.roadmap")}}',
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
                        // Table Roadmap Target
                        $('#target_pembangkit').val(ui.item.roadmap_target['TARGET_PEMBANGKIT']);
                        $('#target_jtm').val(ui.item.roadmap_target['TARGET_JTM']);
                        $('#target_jtr').val(ui.item.roadmap_target['TARGET_JTR']);
                        $('#target_gardu').val(ui.item.roadmap_target['TARGET_GARDU']);
                        $('#target_pelanggan').val(ui.item.roadmap_target['TARGET_PELANGGAN']);
                        $('#keterangan_target').val(ui.item.roadmap_target['KETERANGAN']);
                        // Table Roadmap Realisasi
                        $('#realisasi_pembangkit').val(ui.item.roadmap_realisasi['REALISASI_PEMBANGKIT']);
                        $('#realisasi_jtm').val(ui.item.roadmap_realisasi['REALISASI_JTM']);
                        $('#realisasi_jtr').val(ui.item.roadmap_realisasi['REALISASI_JTR']);
                        $('#realisasi_gardu').val(ui.item.roadmap_realisasi['REALISASI_GARDU']);
                        $('#realisasi_pelanggan').val(ui.item.roadmap_realisasi['REALISASI_PELANGGAN']);
                        $('#keterangan_realisasi').val(ui.item.roadmap_realisasi['KETERANGAN']);
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