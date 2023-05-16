<?php

namespace App\Http\Controllers;

use App\Models\BatchFiles;
use App\Models\SecurityReport;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class DownloadController extends Controller
{
    public function download($id, $type)
    {
        $batch     = BatchFiles::find($id);
        $file_path = $batch->file_name;
        try {
            SecurityReport::create([
                'user_name' => auth_user()->alias_name,
                'user_id'   => auth_user()->id,
                'file_path' => $batch->file_name,
                'file_id'   => $id,
                'type'      => $type,
                'action'    => "Download ".strtoupper(str_replace('_',' ',$type))
            ]); 
            return Storage::download($file_path);
        } catch (\Throwable $th) {
            Flash::error('File not found');
            return back();
        }
    }
}