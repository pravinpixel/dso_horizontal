<?php

namespace App\Interfaces;

interface ExportRepositoryInterface {
    public function barCodeSearchExport($request);
    public function storeBulkSearchExport($row,$request);
    public function advanced_searchExport($request);
    public function sortingOrderExport($request);
}