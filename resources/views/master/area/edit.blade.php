@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Area : {{$area->NAMA_AREA}}</div>

                <div class="card-body">
                    <form action="{{ route('area.update', ['id'=>$area->ID_AREA]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Area</label>
                            <input type="text" name="nama_area" class="form-control" required value="{{$area->NAMA_AREA}}">
                        </div>
                        <a href="{{ route('area.index') }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
