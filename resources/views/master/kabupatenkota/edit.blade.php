@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Kabupaten/Kota : {{$kabupatenkota->NAMA_KABUPATEN_KOTA}}</div>

                <div class="card-body">
                    <form action="{{ route('kabupatenkota.update', ['id'=>$kabupatenkota->ID_KABUPATEN_KOTA]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Provinsi</label>
                            <input type="text" name="" class="form-control" disabled value="{{$kabupatenkota->provinsi->NAMA_PROVINSI}}">
                        </div>
                        <div class="form-group">
                            <label>Kode Kabupaten/Kota</label>
                            <input type="text" name="kode_kabupaten_kota" class="form-control" required value="{{$kabupatenkota->KODE_KABUPATEN_KOTA}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Kabupaten/Kota</label>
                            <input type="text" name="nama_kabupaten_kota" class="form-control" required value="{{$kabupatenkota->NAMA_KABUPATEN_KOTA}}">
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
