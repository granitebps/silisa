@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Desa : {{$desa->NAMA_DESA}}</div>

                <div class="card-body">
                    <form action="{{ route('desa.update', ['id'=>$desa->ID_DESA]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Provinsi</label>
                            <input type="text" name="" class="form-control" disabled value="{{$desa->kecamatan->kabupaten->provinsi->NAMA_PROVINSI}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Kabupaten/Kota</label>
                            <input type="text" name="" class="form-control" disabled value="{{$desa->kecamatan->kabupaten->NAMA_KABUPATEN_KOTA}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Kecamatan</label>
                            <input type="text" name="" class="form-control" disabled value="{{$desa->kecamatan->NAMA_KECAMATAN}}">
                        </div>
                        <div class="form-group">
                            <label>Kode Desa</label>
                            <input type="text" name="kode_desa" class="form-control" required value="{{$desa->KODE_DESA}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Desa</label>
                            <input type="text" name="nama_desa" class="form-control" required value="{{$desa->NAMA_DESA}}">
                        </div>
                        <div class="form-group">
                            <label>Wilayah</label>
                            <input type="text" name="wilayah" class="form-control" required value="{{$desa->WILAYAH}}">
                        </div>
                        <div class="form-group">
                            <label>Rayon</label>
                            <input type="text" name="rayon" class="form-control" required value="{{$desa->RAYON}}">
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <input type="text" name="area" class="form-control" required value="{{$desa->AREA}}">
                        </div>
                        <div class="form-group">
                            <label>Lintang</label>
                            <input type="number" name="lintang" class="form-control" required value="{{$desa->LINTANG}}">
                        </div>
                        <div class="form-group">
                            <label>Bujur</label>
                            <input type="number" name="bujur" class="form-control" required value="{{$desa->BUJUR}}">
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
