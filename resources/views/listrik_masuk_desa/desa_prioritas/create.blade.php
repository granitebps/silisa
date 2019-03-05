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
                            {{-- =========================== Table Desa Prioritas ================================= --}}
                            <div class="form-group">
                                <h2>Desa Prioritas</h2>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="">Tertinggal</label>
                                <input type="text" name="tertinggal" id="tertinggal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Terdepan dan Terluar</label>
                                <input type="text" name="terdepan_dan_terluar" id="terdepan_dan_terluar" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">PKSN</label>
                                <input type="text" name="pksn" id="pksn" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lokpri BNPP</label>
                                <input type="text" name="lokpri_bnpp" id="lokpri_bnpp" class="form-control">
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
                            url: '{{route("autocomplete.desa_prioritas")}}',
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
                        // Table Desa Prioritas
                        $('#tertinggal').val(ui.item.desa_prioritas['TERTINGGAL']);
                        $('#terdepan_dan_terluar').val(ui.item.desa_prioritas['TERDEPAN_DAN_TERLUAR']);
                        $('#pksn').val(ui.item.desa_prioritas['PKSN']);
                        $('#lokpri_bnpp').val(ui.item.desa_prioritas['LOKPRI_BNPP']);
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