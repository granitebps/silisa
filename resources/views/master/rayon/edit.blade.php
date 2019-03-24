@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Edit Master Rayon : {{$rayon->NAMA_RAYON}}</div>

                <div class="card-body">
                    <form action="{{ route('rayon.update', ['id'=>$rayon->ID_RAYON]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Rayon</label>
                            <input type="text" name="nama_rayon" class="form-control" required value="{{$rayon->NAMA_RAYON}}">
                        </div>
                        <a href="{{ route('rayon.index') }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
