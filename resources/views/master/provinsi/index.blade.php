@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Filter</div>
                <div class="card-body">
                    <form action="{{ route('provinsi.index') }}" method="get">
                        <div class="form-group">
                            <label>Kode Provinsi</label>
                            <input type="text" name="kode_provinsi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama Provinsi</label>
                            <input type="text" name="nama_provinsi" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success float-right">Filter</button>
                        <a href="{{ route('provinsi.index') }}" class="btn btn-primary float-right">All</a>
                    </form>
                </div>
            </div>
            <br>
            <div class="card border-primary">
                <div class="card-header">Master Provinsi</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Provinsi</th>
                                    <th>Nama Provinsi</th>
                                    <th colspan="2" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = ($provinsi->currentpage()-1)* $provinsi->perpage() + 1;?>
                                @foreach ($provinsi as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->KODE_PROVINSI}}</td>
                                        <td>{{$row->NAMA_PROVINSI}}</td>
                                        <td>
                                            <a href="{{ route('provinsi.edit', ['id'=>$row->ID_PROVINSI]) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('provinsi.destroy', ['id'=>$row->ID_PROVINSI]) }}" method="post">
                                                {{ csrf_field() }}
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$provinsi->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
