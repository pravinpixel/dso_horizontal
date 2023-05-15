<?php

namespace App\Http\Controllers;

use App\Models\BatchFiles;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class DownloadController extends Controller
{
    public function download($id, $type)
    {
        $batch     = BatchFiles::find($id);
        $file_path = $batch->file_name;
        try {
            securityLog("Download ".strtoupper(str_replace('_',' ',$type))." Filename ".str_replace('public/','',$file_path));
            return Storage::download($file_path);
        } catch (\Throwable $th) {
            Flash::error('File not found');
            return back();
        }
    }
}