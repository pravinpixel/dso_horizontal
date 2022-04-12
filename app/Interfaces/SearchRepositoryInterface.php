<?php

namespace App\Interfaces;

interface SearchRepositoryInterface {
    public function bulkSearch($request);
    public function StoreBulkSearch($row,$request);
    public function advanced_search($request);
}