<?php

namespace App\Interfaces;

interface DsoRepositoryInterface {
    public function renderPage($page_name, $view);
    public function renderTableData($data,$config);
}
