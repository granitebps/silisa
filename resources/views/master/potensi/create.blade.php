@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Tambah Master Potensi Energi</div>

                <div class="card-body">
                    <form action="{{ route('potensi.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Potensi Energi</label>
                            <input type="text" name="nama_potensi" class="form-control" required value="">
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
