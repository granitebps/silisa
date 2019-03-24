@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Filter</div>
                    <div class="card-body">
                        <form action="{{ route('wilayah.index') }}" method="get">
                            <div class="form-group">
                                <label>Nama Wilayah</label>
                                <input type="text" name="nama_wilayah" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success float-right">Filter</button>
                            <a href="{{ route('wilayah.index') }}" class="btn btn-primary float-right">All</a>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card border-primary">
                    <div class="card-header">Master Wilayah</div>
    
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Wilayah</th>
                                    <th colspan="2" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = ($wilayah->currentpage()-1)* $wilayah->perpage() + 1;?>
                                @foreach ($wilayah as $row)
                                    <tr>
                                        {{-- {{dd($row->desa)}} --}}
                                        <td>{{$i++}}</td>
                                        <td>{{$row->NAMA_WILAYAH}}</td>
                                        <td>
                                            <a href="{{ route('wilayah.edit', ['id'=>$row->ID_WILAYAH]) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('wilayah.destroy', ['id'=>$row->ID_WILAYAH]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$wilayah->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection