@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Provinsi : {{$provinsi->NAMA_PROVINSI}}</div>

                <div class="card-body">
                    <form action="{{ route('provinsi.update', ['id'=>$provinsi->ID_PROVINSI]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Kode Provinsi</label>
                            <input type="text" name="kode_provinsi" class="form-control" required value="{{$provinsi->KODE_PROVINSI}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Provinsi</label>
                            <input type="text" name="nama_provinsi" class="form-control" required value="{{$provinsi->NAMA_PROVINSI}}">
                        </div>
                        <a href="{{ route('provinsi.index') }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
