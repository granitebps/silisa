@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Filter</div>
                <div class="card-body">
                    <form action="{{ route('kabupatenkota.index') }}" method="get">
                        <div class="form-group">
                            <label>Nama Provinsi</label>
                            <select name="provinsi" class="form-control" id="provinsi">
                                <option selected value=0>Pilih Provinsi</option>
                                @foreach ($provinsi as $row)
                                    <option value="{{$row->ID_PROVINSI}}">{{$row->NAMA_PROVINSI}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Kabupaten/Kota</label>
                            <input type="text" name="kode_kabupaten_kota" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama Kabupaten/Kota</label>
                            <input type="text" name="nama_kabupaten_kota" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success float-right">Filter</button>
                        <a href="{{ route('kabupatenkota.index') }}" class="btn btn-primary float-right">All</a>
                    </form>
                </div>
            </div>
            <br>
            <div class="card border-primary">
                <div class="card-header">Master Kabupaten/Kota</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kabupaten/Kota</th>
                                <th>Provinsi</th>
                                <th>Nama Kabupaten/Kota</th>
                                <th colspan="2" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = ($kabupatenkota->currentpage()-1)* $kabupatenkota->perpage() + 1;?>
                            @foreach ($kabupatenkota as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->KODE_KABUPATEN_KOTA}}</td>
                                    <td>{{$row->provinsi->NAMA_PROVINSI}}</td>
                                    <td>{{$row->NAMA_KABUPATEN_KOTA}}</td>
                                    <td>
                                        <a href="{{ route('kabupatenkota.edit', ['id'=>$row->ID_KABUPATEN_KOTA]) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('kabupatenkota.destroy', ['id'=>$row->ID_KABUPATEN_KOTA]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$kabupatenkota->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection