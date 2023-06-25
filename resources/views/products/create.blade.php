@extends('layout')

@section('content')
    <div class="container-fluid">
        <h6> create product</h6>

        <form class="mx-5"
              enctype="multipart/form-data"
              method="post" action="{{route('products.store')}}">
            @csrf
            @isset($product)

                <input type="hidden" name="id" value="{{$product->id}}">
            @endisset
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{old('name',$product??"")}}" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter name" id="name">
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="brand_id">Example Brand</label>
                <select class="form-control select2  @error('name') is-invalid @enderror" name="brand_id"
                        id="brand_id">
                    <option value="">select brand</option>
                    @foreach($brands as $brand)
                        <option value="{{$brand->id}}"
                            {{--                @if(old('brand_id')==$brand->id) selected @endif--}}

                            @selected(old('brand_id',$product??"") == $brand->id)
                        >{{$brand->name}}</option>
                    @endforeach

                </select>
                @error('brand_id')
                {{--            <div class="alert alert-danger">{{ $message }}</div>--}}
                @enderror
            </div>

            <div class="form-group">
                <label for="brand_id">Example Categories</label>
                <select class="form-control select2 " multiple name="categories[]"
                        id="categories">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            {{--                    @selected( is_array(old('categories')) and in_array($brand->id,old('categories')))--}}
                        >{{$category->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" value="{{old('price',$product??"")}}" name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       placeholder="Enter price" id="price">
            </div>
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="Description">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                          id="Description">{{old('description',$product??"")}}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" value="{{old('image',$product??"")}}"
                       accept="image/*"
                       name="image" class="form-control @error('image') is-invalid @enderror"
                       id="image">
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @isset($product)
                    <img width="100" src="{{url('storage/'.$product->image)}}">
                @endisset
            </div>

            <div class="form-group form-check">
                <label class="form-check-label">
                    <input name="status"

                           @checked(old('status',$product??"") )

                           class="form-check-input" type="checkbox"> Status

                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
