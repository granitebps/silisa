@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Potensi Energi : {{$potensi->NAMA_POTENSI_ENERGI}}</div>

                <div class="card-body">
                    <form action="{{ route('potensi.update', ['id'=>$potensi->ID_POTENSI_ENERGI]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Potensi Energi</label>
                            <input type="text" name="nama_potensi" class="form-control" required value="{{$potensi->NAMA_POTENSI_ENERGI}}">
                        </div>
                        <a href="{{ route('potensi.index') }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
