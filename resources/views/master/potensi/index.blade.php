@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header">
                    Master Potensi Energi
                    <a href="{{ route('potensi.create') }}" class="btn btn-success float-right">Tambah</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Potensi Energi</th>
                                <th colspan="2" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($potensi->currentpage()-1)* $potensi->perpage() + 1;?>
                            @foreach ($potensi as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->NAMA_POTENSI_ENERGI}}</td>
                                    <td>
                                        <a href="{{ route('potensi.edit', ['id'=>$row->ID_POTENSI_ENERGI]) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('potensi.destroy', ['id'=>$row->ID_POTENSI_ENERGI]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$potensi->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
