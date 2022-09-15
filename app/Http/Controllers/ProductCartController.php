<?php

namespace App\Http\Controllers;

use App\Models\ProductCart;
use App\Repositories\ProductCartRepository;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function __construct(ProductCartRepository $ProductCartRepository)
    {
        $this->ProductCartRepository = $ProductCartRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        return ProductCart::with('batches','batches.BatchMaterialProduct')->where('type',$type)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $data =  $this->ProductCartRepository->add_to_cart($request);

        if($data) {
            return response([
                "status"  => 200,
                "message" => "Item Added successfully !",
                "type"    => $request->type,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCart  $productCart
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCart $productCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCart  $productCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCart $productCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCart  $productCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCart $productCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCart  $productCart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =  $this->ProductCartRepository->remove_to_cart($id);
        
        if($data) {
            return response([
                "status"  => 200,
                "message" => "Item Deleted successfully !"
            ]);
        } 
    }
}