@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Filter</div>
                    <div class="card-body">
                        <form action="{{ route('area.index') }}" method="get">
                            <div class="form-group">
                                <label>Nama Area</label>
                                <input type="text" name="nama_area" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success float-right">Filter</button>
                            <a href="{{ route('area.index') }}" class="btn btn-primary float-right">All</a>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card border-primary">
                    <div class="card-header">Master Area</div>
    
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Area</th>
                                    <th colspan="2" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = ($area->currentpage()-1)* $area->perpage() + 1;?>
                                @foreach ($area as $row)
                                    <tr>
                                        {{-- {{dd($row->desa)}} --}}
                                        <td>{{$i++}}</td>
                                        <td>{{$row->NAMA_AREA}}</td>
                                        <td>
                                            <a href="{{ route('area.edit', ['id'=>$row->ID_AREA]) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('area.destroy', ['id'=>$row->ID_AREA]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$area->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection