<?php

namespace App\Interfaces;

interface MasterRepositoryInterface {
    public function storeMaster($value, $type);
    public function deleteMaster($id, $type);
}