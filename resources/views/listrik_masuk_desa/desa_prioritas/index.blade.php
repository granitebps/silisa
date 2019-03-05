@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Filter</div>
                <div class="card-body">
                    <form action="{{ route('desa_prioritas.index') }}" method="get">
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
                            <label>Kecamatan</label>
                            <select name="kecamatan" class="form-control" id="kecamatan">
                                <option selected value=0>Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Triwulan</label>
                            <select name="triwulan" class="form-control">
                                <option value="">Pilih Triwulan</option>
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Desa</label>
                            <input type="text" name="kode_desa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama Desa</label>
                            <input type="text" name="nama_desa" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success float-right">Filter</button>
                        <a href="{{ route('desa_prioritas.index') }}" class="btn btn-primary float-right">All</a>
                    </form>
                </div>
            </div>
            <br>
            <div class="card border-primary">
            <div class="card-header">
                <span>Desa Prioritas | Jumlah Data : {{$desa_prioritas->total()}}</span>
                <a href="{{ route('desa_prioritas.create') }}" class="btn btn-secondary float-right">Tambah</a>
            </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Desa</th>
                                <th>Provinsi</th>
                                <th>Kabupaten/Kota</th>
                                <th>Kecamatan</th>
                                <th>Nama Desa</th>
                                <th colspan="3" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($desa_prioritas->currentpage()-1)* $desa_prioritas->perpage() + 1;?>
                            @foreach ($desa_prioritas as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->KODE_DESA}}</td>
                                    <td>{{$row->kecamatan->kabupaten->provinsi->NAMA_PROVINSI}}</td>
                                    <td>{{$row->kecamatan->kabupaten->NAMA_KABUPATEN_KOTA}}</td>
                                    <td>{{$row->kecamatan->NAMA_KECAMATAN}}</td>
                                    <td>{{$row->NAMA_DESA}}</td>
                                    <td>
                                        <a href="{{ route('desa_prioritas.show', ['id'=>$row->ID_DESA]) }}" class="btn btn-info">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('desa_prioritas.edit', ['id'=>$row->ID_DESA]) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form id="form-id" action="{{ route('desa_prioritas.destroy', ['id'=>$row->ID_DESA]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger tombol-hapus">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$desa_prioritas->links()}}
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

        $('#kabupaten').on('change', function() {
            id_kabupaten_kota = $(this).val();
            $.get('dropdown_kecamatan', { id_kabupaten_kota:id_kabupaten_kota }, function(data) {
                $('#kecamatan').html('');
                $('#kecamatan').append('<option selected value=0>Pilih Kecamatan</option>');
                $.each(data, function(key, val){
                    $('#kecamatan').append('<option value='+val.ID_KECAMATAN+'>'+val.NAMA_KECAMATAN+'</option>');
                });
            });
        });
    });
    $('.tombol-hapus').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href');
        Swal({
            title: 'Apakah Anda Yakin Ingin Menghapus Data Desa Prioritas?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            width: '600px',
        }).then((result) => {
            if (result.value) {
                var form = document.getElementById("form-id");
                form.submit();
            }
        })
    });
</script>

@endsection