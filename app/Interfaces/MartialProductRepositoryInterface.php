<?php

namespace App\Interfaces;

interface MartialProductRepositoryInterface {
    public function save_material_product($material_product_id, $batch_id, $request);
}