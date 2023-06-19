@extends('layout')


@section('content')
    <div class="container-fluid">
        <h1> roles</h1>
        <a href="{{route('roles.create')}}" class="btn btn-primary mb-5 float-right"> create</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td style="width: 270px;">


                        <a href="{{route('roles.show',$role)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-search "></span> عرض
								</span>
                        </a>

                        <a href="{{route('roles.edit',$role)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
                        </a>

                        <form method="POST" action="{{route('roles.destroy',$role)}}"
                              class="d-inline-block">@csrf @method("DELETE")
                            <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                    onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                <span class="fas fa-trash "></span> حذف
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-12 p-3">
            {!! $roles->render() !!}
        </div>
    </div>
@endsection
