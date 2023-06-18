@extends('layout')

@section('content')
    <div class="container-fluid">
    <h6> create category</h6>


    <form class="mx-5" method="post"
          enctype="multipart/form-data"
          action="{{route('brands.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter name" id="name">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" value="{{old('image')}}"
                   accept="image/*"
                   name="image" class="form-control @error('image') is-invalid @enderror"
                  id="image">
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
