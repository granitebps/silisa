@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Kecamatan : {{$kecamatan->NAMA_KECAMATAN}}</div>

                <div class="card-body">
                    <form action="{{ route('kecamatan.update', ['id'=>$kecamatan->ID_KECAMATAN]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Provinsi</label>
                            <input type="text" name="" class="form-control" disabled value="{{$kecamatan->kabupaten->provinsi->NAMA_PROVINSI}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Kabupaten/Kota</label>
                            <input type="text" name="" class="form-control" disabled value="{{$kecamatan->kabupaten->NAMA_KABUPATEN_KOTA}}">
                        </div>
                        <div class="form-group">
                            <label>Kode Kecamatan</label>
                            <input type="text" name="kode_kecamatan" class="form-control" required value="{{$kecamatan->KODE_KECAMATAN}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Kecamatan</label>
                            <input type="text" name="nama_kecamatan" class="form-control" required value="{{$kecamatan->NAMA_KECAMATAN}}">
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
