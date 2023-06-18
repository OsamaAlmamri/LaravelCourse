<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {

        $bath = $request->file('image')->store('brands');
        Brand::create([
            'name' => $request->name,
            'image' => $bath
        ]);
        toastr()->success('تم الاضافة بنجاح');
        return redirect(route('brands.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit')
            ->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $bath = $brand->image;
        if ($request->hasFile('image')) {
            $bath = $request->file('image')->store('brands');
            Storage::delete($brand->image);

        }
        $brand->update([
            'name' => $request->name,
            'image' => $bath
        ]);

        toastr()->success('تم التعديل بنجاح');
        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->products->count() == 0) {
            Storage::delete($brand->image);
            $brand->delete();
            toastr()->success('تم الحذف بنجاح');

        } else
            toastr()->error('لم يتم الحذف  ');
        return redirect(route('brands.index'));

    }
}
