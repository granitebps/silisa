@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">Upload Document</div>

                <div class="card-body">
                    <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Nama Document</label>
                            <input type="text" name="doc_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="number" name="tahun" class="form-control" value="{{date('Y')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Triwulan</label>
                            <select name="triwulan" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Upload File</label>
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
