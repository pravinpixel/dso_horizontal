<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_selection'            =>   'required',
            'item_description'              =>   'required',
            'in_house_product_logsheet_id'  =>   'required',
            'brand'                         =>   'required',
            'supplier'                      =>   'required',
            'unit_packing_size'             =>   'required',
            'quantity'                      =>   'required',
            'batch'                         =>   'required',
            'serial'                        =>   'required',
            'po_number'                     =>   'required',
            'statutory_body'                =>   'required',
            'euc_material'                  =>   'required',
        ];
    }
}
