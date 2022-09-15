<?php

namespace App\Repositories;

use App\Models\MaterialProducts;
use App\Models\ProductCart;
use App\Repositories\Interfaces\ProductCartRepositoryInterface;
 
class ProductCartRepository implements ProductCartRepositoryInterface
{
    public function __construct(ProductCart $ProductCart)
    {
        $this->ProductCart = $ProductCart;
    }
    public function add_to_cart($request) {
        if(!is_null($request->batch_id)) {
            $this->ProductCart::updateOrCreate([
                'batch_id' => $request->batch_id,
                'user_id'  => auth_user()->id,
                'type'     => $request->type,
            ]);
        } 
        if(!is_null($request->material_id)) {
            $material = MaterialProducts::find($request->material_id);
            foreach ($material->Batches as$batch) {
                $this->ProductCart::updateOrCreate([
                    'batch_id' => $batch->id,
                    'user_id'  => auth_user()->id,
                    'type'     => $request->type,
                ]);
            } 
        }
       return true;
    }
    public function remove_to_cart($id)
    {
        return $this->ProductCart->findOrFail($id)->delete();
    }
}