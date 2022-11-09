<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\BatchFiles;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class DownloadController extends Controller
{
    public function download($id, $type)
    {
        if($type == 'coc_coa_mill_cert') {
            $batch     = BatchFiles::find($id);
            $file_path = $batch->file_name;
        } else {
            $batch     = Batches::find($id);
            $file_path = $batch[$type];
        }
        
        try {
            securityLog('Download');
            return Storage::download($file_path);
        } catch (\Throwable $th) {
            Flash::error('File not found');
            return back();
        }
    }
}
