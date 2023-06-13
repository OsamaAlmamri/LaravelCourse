@extends('layout')

@section('content')

    <h6> create category</h6>


    <form class="mx-5" method="post" action="{{route('categories.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter name" id="name">
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="Description">Description:</label>
            <textarea  class="form-control @error('description') is-invalid @enderror" name="description" id="Description"></textarea>
        </div>

        <div class="">
            <input type="radio" class="" id="customRadio"
                   name="type" checked value="New">
            <label class=" mr-5" for="customRadio">New</label>


            <input  type="radio" class=" " id="customRadio2"
                   name="type" value="Old">
            <label class="" for="customRadio2">Old</label>
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input name="status" class="form-check-input" type="checkbox"> Status
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
