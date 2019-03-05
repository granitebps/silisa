<?php

namespace App\Http\Controllers\ListrikMasukDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Imports\SilisaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\UploadData\UploadDoc;

class UploaderDataController extends Controller
{
    public function upload()
    {
        return view('listrik_masuk_desa.uploader_data.upload');
    }

    public function log()
    {
        $data['log'] = UploadDoc::orderBy('created_at', 'desc')->paginate(25);
        return view('listrik_masuk_desa.uploader_data.log', $data);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);
        $file = $request->file;
        $file_name = time() . "_" . $file->getClientOriginalName();
        $file_type = $file->getClientOriginalExtension();
        $file->storeAs('public/excel', $file_name);
        // $file->move('excel', $file_name);
        $user = Auth::user()->NAMA_USER;
        UploadDoc::create([
            'DOC_NAME' => $request->doc_name,
            'FILENAME' => $file_name,
            'FILETYPE' => $file_type,
            'FILE_PATH' => 'public/excel/' . $file_name,
            'USER_CREATED' => $user
        ]);
        $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array(' memoryCacheSize ' => '8MB');
        \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
        Excel::import(new SilisaImport, $file_name, 'excel');
        return redirect()->route('home');
    }

    public function download($name)
    {
        return response()->download(storage_path('app/public/excel/' . $name));
    }
}
