<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::paginate(25);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Permission::select('group')->distinct()->get();


        // $permissions =Permission::groupBy('group')->get();

        return view('roles.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|unique:roles,name,".$request->id,
        ]);
        $role = Role::UpdateOrCreate(
            ["id"=>$request->id],
            [
            'name' => $request->name,

        ]);
        $role->syncPermissions($request->permissions);
        toastr()->success("تمت العملية بنجاح");
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Role $role)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $role)
    {

        $groups = Permission::select('group')->distinct()->get();
        // $permissions =Permission::groupBy('group')->get();
        //  return dd($role->hasPermissionTo('create-users'));

        return view('roles.create', compact('groups', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        toastr()->success("تمت العملية بنجاح");
        return redirect()->route('roles.index');
    }
}
