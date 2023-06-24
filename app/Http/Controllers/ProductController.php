<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function deleted_index()
    {
        $products = Product::onlyTrashed()->paginate(5);

        return view('products.index')
            ->with('deleted', 1)
            ->with('products', $products);
    }

    public function restore($id )
    {

      //  return dd($id);
        Product::withTrashed()
            ->where('id',$id)
    ->restore();

        toastr()->success('تم الاسنعادة بنجاح');
        return redirect(route('products.index'));
    }
    public function forceDelete($id)
    {

      //  return dd($id);
        Product::onlyTrashed()
            ->where('id',$id)
    ->forceDelete();

        toastr()->success('تم الحذف بنجاح');
        return redirect(route('products.trashed'));
    }

    public function index()
    {


//        $products = DB::table('products')
//            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
//            ->select('products.*', 'brands.name as brand_name')
//            ->get();
//        $products=Product::get()->min('price');

//        return dd($products);
        $products = Product::
//        where('status','=',1)
//            ->orWhere('name','like',"%s%")
//            -> whereBetween('price',[10,100])
//            whereIn('price',[100,50,10])
//            ->whereColumn('price','brand_id')
//            where([
//                ['status', '=', '1'],
//                ['brand_id', '<>', '1'],
//            ])
//            ->Where(function ($q){
//                $q->where('price','>',100)
//                    ->orWhere('status',0);
//            })

//whereDate('created_at','<','2023-06-22')
//whereYear('created_at','2023')
//            ->whereMonth('created_at','06')
//            ->whereDay('created_at','22')
            //->whereTime('created_at','09')
           // whereNull('description')
          //  whereNotNull('description')

            // =,<>,!=,>,>=,<,<=,like

                // where status=1 or  name like '%n%'
//               ->inRandomOrder()

//                ->skip(5)->take(5)->get();
            paginate(10);
        return view('products.index')
            ->with('deleted', 0)
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create')
            ->with('categories', $categories)
            ->with('brands', $brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if ($request->id > 0)
        $product = Product::findOrFail($request->id);
        $bath = "";
        if ($request->id > 0) {
            $bath = $product->image;
        }
        if ($request->hasFile('image'))
            $bath = $request->file('image')->store('products');


        $product = Product::updateOrCreate(
            [
                'id' => $request->id,
                'name' => $request->name
            ]
            , [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $bath,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'status' => isset($request->status)
        ]);

        $product->categories()->sync($request->categories);
        if ($request->id > 0)
            toastr()->success('تم الاضافة بنجاح');
        else
            toastr()->success('تم التعديل بنجاح');
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create')
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $product->deleted_by=auth()->id();
        $product->save();
        $product->delete();

        toastr()->success('تم الحذف بنجاح');
        return redirect(route('products.index'));
    }
}
