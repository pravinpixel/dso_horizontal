<?php

namespace App\Interfaces;

interface BarCodeLabelRepositoryInterface {
    public function generateBarcode($material_product, $batch);
}