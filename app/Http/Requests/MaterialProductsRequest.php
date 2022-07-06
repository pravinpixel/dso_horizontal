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
            'barcode_number'                    =>   'required', 
            'category_selection'                =>   'required', 
            'item_description'                  =>   'required', 
            'unit_of_measure'                   =>   'required', 
            'unit_packing_value'                =>   'required', 
            'owner_one'                         =>   'required', 
            'owner_two'                         =>   'required', 
            'statutory_body'                    =>   'required', 
            'alert_threshold_qty_upper_limit'   =>   'required', 
            'alert_threshold_qty_lower_limit'   =>   'required', 
            'alert_before_expiry'               =>   'required', 
        ];
    }
}
