<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $categories=   Category::paginate(25);;
 //  $results = DB::select('select * from categories where id = :id', ['id' => 1]);
//        $orders = DB::table('categories')
//            ->select(DB::raw(1));
//        $users = DB::table('users')
//            ->whereExists($orders)
//            ->get();
//        return ($users);
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {


        Category::create(
            [
                'name'=>$request->name,
                "description"=>$request->description,
                "type"=>$request->type,
                "status"=>isset($request->status)
            ]
        );

        toastr()->success('تم الاضافة بنجاح');
       // return redirect()->back() ;
        return redirect(route('categories.index')) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update([
            'name'=>$request->name,
            "description"=>$request->description,
            "type"=>$request->type,
            "status"=>isset($request->status)
        ]);
        toastr()->success('تم التعديل بنجاح');
        return redirect(route('categories.index')) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->id>4) {
            $category->delete();
            // Display an error toast with no title
            toastr()->success('تم الحذف بنجاح');
        }
        else
            toastr()->error('لايمكن حذف هذا الصنف');
        return redirect()->back();
    }
}
