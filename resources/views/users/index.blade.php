@extends('layout')

@section('content')

    <div class="container-fluid bg-white">
        <h1> users</h1>

        <a href="{{route('users.create')}}" class="btn btn-primary mb-5 float-right"> create</a>
        <a href="{{route('users.export')}}" class="btn btn-info mb-5 "> export to excel </a>
        <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#exampleModal">
            import
        </button>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Image</th>
                <th>status</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        <div>
                            @foreach($user->roles as $role)
                                <span class="mx-1"> {{$role->name}} </span>
                            @endforeach
                        </div>

                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td><img width="50" src="{{url('storage/'.$user->image)}}"></td>

                    <td>{{$user->status}}</td>
                    <td style="width: 180px;">
                        <a href="{{route('users.edit',$user)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                        </a>
                        <form method="POST" action="{{route('users.destroy',$user)}}"
                              class="d-inline-block">
                            @csrf
                            @method("DELETE")
                            <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                    onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');
                         if(result){}else{event.preventDefault()}">
                                <span class="fas fa-trash "></span> حذف
                            </button>
                        </form>


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-12 p-3">
            {!! $users->render() !!}
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="mx-5" method="post"
                      enctype="multipart/form-data"
                      action="{{route('users.import')}}">
                    @csrf
                    <div class="modal-body">


                        <div class="form-group">
                            <label for="image">Excel File</label>
                            <input type="file" required value="{{old('file')}}"
                                   accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                   name="file" class="form-control @error('file') is-invalid @enderror"
                                   id="image">
                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
