@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Wilayah : {{$wilayah->NAMA_WILAYAH}}</div>

                <div class="card-body">
                    <form action="{{ route('wilayah.update', ['id'=>$wilayah->ID_WILAYAH]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Wilayah</label>
                            <input type="text" name="nama_wilayah" class="form-control" required value="{{$wilayah->NAMA_WILAYAH}}">
                        </div>
                        <a href="{{ route('wilayah.index') }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
