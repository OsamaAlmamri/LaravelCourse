@extends('layout')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('roles.store')}}">
                @csrf

                @isset($role)

                    <input type="hidden" name="id" value="{{$role->id}}">
                @endisset
                <div class="col-12 col-lg-5 p-0 main-box">
                    <div class="col-12 px-0">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span>Add New
                        </div>
                        <div class="col-12 divider" style="min-height: 2px;"></div>
                    </div>
                    <div class="col-12 p-3 row">


                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                              Role Name
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="name" required maxlength="190" class="form-control" value="{{old('name',$role??"")}}">
                            </div>
                        </div>

                    </div>
                    <div class="col-12 p-2">
                        <table class="table table-hover">
                            <thead>
                            <tr style="">
                                <th>Permission</th>
                                <th style="width: 56px;">Create</th>
                                <th style="width: 56px;">View</th>
                                <th style="width: 56px;">Update</th>
                                <th style="width: 56px;">Delete</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($groups as $permission)
                                @php
                                    $sub_permissions = \Spatie\Permission\Models\Permission::where('group',$permission->group)->get();
                                @endphp
                                <tr>

                                    <td>{{$permission->group}}</td>

                                    @if($sub_permissions->where('name','create-'.$permission->group)->first())
                                        <td style="width: 56px;">

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="{{'create-'.$permission->group}}"
                                                       value="{{'create-'.$permission->group}}"
                                                       @if(isset($role)&&$role->hasPermissionTo('create-'.$permission->group)) checked @endif
                                                       name="permissions[]">
                                            </div>
                                        </td>
                                    @else
                                        <td style="width: 56px;">
                                        </td>
                                    @endif
                                    @if($sub_permissions->where('name','access-'.$permission->group)->first())
                                        <td style="width: 56px;">

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="{{'access-'.$permission->group}}"
                                                       value="{{'access-'.$permission->group}}"
                                                       @if(isset($role)&&$role->hasPermissionTo('access-'.$permission->group)) checked @endif
                                                       name="permissions[]">
                                            </div>
                                        </td>
                                    @else
                                        <td style="width: 56px;">
                                        </td>
                                    @endif
                                    @if($sub_permissions->where('name','update-'.$permission->group)->first())
                                        <td style="width: 56px;">

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="{{'update-'.$permission->group}}" value="{{'update-'.$permission->group}}" @if(isset($role)&&$role->hasPermissionTo('update-'.$permission->group)) checked @endif name="permissions[]">
                                            </div>
                                        </td>
                                    @else
                                        <td style="width: 56px;">
                                        </td>
                                    @endif
                                    @if($sub_permissions->where('name','delete-'.$permission->group)->first())
                                        <td style="width: 56px;">

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="{{'delete-'.$permission->group}}" value="{{'delete-'.$permission->group}}" @if(isset($role)&&$role->hasPermissionTo('delete-'.$permission->group)) checked @endif name="permissions[]">
                                            </div>
                                        </td>
                                    @else
                                        <td style="width: 56px;">
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
                <div class="col-12 p-3">
                    <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
