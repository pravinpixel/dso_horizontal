<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use Illuminate\Http\Request;

class dsoDevController extends Controller
{
    public function dev()
    {
        $batches =  Batches::with("BatchOwners")->get();
        foreach ($batches as $batch) {
            $owners = $batch->BatchOwners()->pluck("id")->toArray();
            $batch->update([
                "owners" => implode(',', $owners)
            ]);
        }
        dd("OK");
    }
}
