@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Filter</div>
                    <div class="card-body">
                        <form action="{{ route('rayon.index') }}" method="get">
                            <div class="form-group">
                                <label>Nama Rayon</label>
                                <input type="text" name="nama_rayon" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success float-right">Filter</button>
                            <a href="{{ route('rayon.index') }}" class="btn btn-primary float-right">All</a>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card border-primary">
                    <div class="card-header">Master Rayon</div>
    
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Rayon</th>
                                    <th colspan="2" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = ($rayon->currentpage()-1)* $rayon->perpage() + 1;?>
                                @foreach ($rayon as $row)
                                    <tr>
                                        {{-- {{dd($row->desa)}} --}}
                                        <td>{{$i++}}</td>
                                        <td>{{$row->NAMA_RAYON}}</td>
                                        <td>
                                            <a href="{{ route('rayon.edit', ['id'=>$row->ID_RAYON]) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('rayon.destroy', ['id'=>$row->ID_RAYON]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$rayon->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection