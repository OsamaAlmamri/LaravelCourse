@extends('layout')

@section('content')

    <div class="container-fluid">
        <h1> products</h1>

        <a href="{{route('products.create')}}" class="btn btn-primary mb-5 float-right"> create</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Brand</th>
                <th>Categories</th>
                <th>Price</th>
                <th>Description</th>
                <th>status</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td><img  width="50" src="{{url('storage/'.$product->image)}}"></td>
                    <td>{{$product->brand->name}}</td>
                    <td>



                            <div class="d-flex justify-content-between">
                                @foreach($product->categories as $category)
                                <span class="mx-1">{{$category->name}}</span>
                                @endforeach
                            </div>

                    </td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->status}}</td>
                    <td style="width: 180px;">
                        <a href="{{route('products.edit',$product)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                        </a>
                        <form method="POST" action="{{route('products.destroy',$product)}}"
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
            {!! $products->render() !!}
        </div>
    </div>
@endsection
