<?php

namespace App\Interfaces;

interface SearchRepositoryInterface {
    public function barCodeSearch($request);
    public function bulkSearch($request);
    public function StoreBulkSearch($row,$request);
    public function advanced_search($request);
    public function sortingOrder($request);
}