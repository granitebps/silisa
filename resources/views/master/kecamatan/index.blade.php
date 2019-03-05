@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Filter</div>
                <div class="card-body">
                    <form action="{{ route('kecamatan.index') }}" method="get">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select name="provinsi" class="form-control" id="provinsi">
                                <option selected value=0>Pilih Provinsi</option>
                                @foreach ($provinsi as $row)
                                    <option value="{{$row->ID_PROVINSI}}">{{$row->NAMA_PROVINSI}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kabupaten/Kota</label>
                            <select name="kabupaten" class="form-control" id="kabupaten">
                                <option selected value=0>Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Kecamatan</label>
                            <input type="text" name="kode_kecamatan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama Kecamatan</label>
                            <input type="text" name="nama_kecamatan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success float-right">Filter</button>
                        <a href="{{ route('kecamatan.index') }}" class="btn btn-primary float-right">All</a>
                    </form>
                </div>
            </div>
            <br>
            <div class="card border-primary">
                <div class="card-header">Master Kecamatan</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kecamatan</th>
                                <th>Provinsi</th>
                                <th>Kabupaten/Kota</th>
                                <th>Nama Kecamatan</th>
                                <th colspan="2" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($kecamatan->currentpage()-1)* $kecamatan->perpage() + 1;?>
                            @foreach ($kecamatan as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->KODE_KECAMATAN}}</td>
                                    <td>{{$row->kabupaten->provinsi->NAMA_PROVINSI}}</td>
                                    <td>{{$row->kabupaten->NAMA_KABUPATEN_KOTA}}</td>
                                    <td>{{$row->NAMA_KECAMATAN}}</td>
                                    <td>
                                        <a href="{{ route('kecamatan.edit', ['id'=>$row->ID_KECAMATAN]) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('kecamatan.destroy', ['id'=>$row->ID_KECAMATAN]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$kecamatan->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#provinsi').on('change', function() {
            id_provinsi = $(this).val();
            $.get('dropdown_kabupaten', { id_provinsi:id_provinsi }, function(data) {
                $('#kabupaten').html('');
                $('#kabupaten').append('<option selected value=0>Pilih Kabupaten/Kota</option>');
                $.each(data, function(key, val){
                    $('#kabupaten').append('<option value='+val.ID_KABUPATEN_KOTA+'>'+val.NAMA_KABUPATEN_KOTA+'</option>');
                });
            });
        });
    });
</script>

@endsection