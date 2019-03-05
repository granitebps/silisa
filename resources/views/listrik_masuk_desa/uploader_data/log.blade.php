@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Log
                    <a href="{{ route('upload') }}" class="btn btn-info float-right">Upload Data</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Dokumen</th>
                                        <th>Nama File</th>
                                        <th>Created At</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = ($log->currentpage()-1)* $log->perpage() + 1;?>
                                    @foreach ($log as $item)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$item->USER_CREATED}}</td>
                                            <td>{{$item->DOC_NAME}}</td>
                                            <td>{{$item->FILENAME}}</td>
                                            <td>{{$item->created_at->toFormattedDateString()}}</td>
                                            <td>
                                                <a href="{{ route('download', ['name'=>$item->FILENAME]) }}" class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{$log->links()}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection