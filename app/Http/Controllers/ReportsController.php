<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Interfaces\DsoRepositoryInterface;
use App\Repositories\MartialProductRepository;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct(
        DsoRepositoryInterface $dsoRepositoryInterface,
        MartialProductRepository $MartialProductRepository
    ){
        $this->dsoRepository    =   $dsoRepositoryInterface;
        $this->MartialProduct   =   $MartialProductRepository;
    }
    public function utilisation_cart()
    {
        $page_name  = "REPORT_UTILISATION_CART";
        $view       = "crm.reports.utilisation-cart";
        return $this->dsoRepository->renderPage($page_name, $view); 
    }
    public function export_cart()
    {
        $page_name  = "REPORT_EXPORT_CART";
        $view       = "crm.reports.export-cart";
        return $this->dsoRepository->renderPage($page_name, $view); 
    }
    public function history()
    {
        $product_batches    =   LogActivity::all();
        return view('crm.reports.history', compact('product_batches'));
    }
    public function disposed_items()
    {
        $page_name  = "REPORT_DISPOSED_ITEMS";
        $view       = "crm.reports.disposed-items";
        return $this->dsoRepository->renderPage($page_name, $view); 
    }
}