<?php

namespace App\Interfaces;

interface SearchRepositoryInterface {
    public function barCodeSearch($request);
    public function storeBulkSearch($row,$request);
    public function advanced_search($request);
    public function sortingOrder($request);
}