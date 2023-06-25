<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
class ProductController extends BaseAPIController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::paginate(5);

        ProductResource::collection($products);
      return  $this->sendResponse($products);
    }



    public function store(Request $request)
    {
        if(!auth()->user()->can('create-products'))
            return $this->sendError('unauthorized',[]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price'=>'required|numeric',
            'categories' => "nullable|array",
            'categories.*' => "required|exists:categories,id",
            'brand_id'=>'required|numeric|exists:brands,id',
            "image"=>[request()->id>0?"nullable":"required","image","max:51120"]

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $bath='';
        if ($request->hasFile('image'))
            $bath = $request->file('image')->store('products');


        $product = Product::create([
            'name' => $request->name,
            'user_id'=>auth()->id(),
            'description' => $request->description,
            'image' => $bath,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'status' => isset($request->status)
        ]);

        $product->categories()->sync($request->categories);

        return  $this->sendResponse(new ProductResource($product));


    }


    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
