<?php

namespace App\Http\Controllers;

use App\Interfaces\DsoRepositoryInterface;
use App\Models\Batches;
use Illuminate\Http\Request;

class ExtendExpiryController extends Controller
{
    public function __construct(DsoRepositoryInterface $dsoRepositoryInterface){
        $this->dsoRepository    =   $dsoRepositoryInterface;
    }

    public function index(Request $request)
    {
        $page_name  = "EXTEND_EXPIRY";
        $view       = "crm.extend-expiry.index";
        return $this->dsoRepository->renderPage($page_name, $view);
    }
    public function show($id)
    {
        try {
            return Batches::findOrFail($id);
        } catch (\Throwable $th) {
            return 404;
        }
    }
}