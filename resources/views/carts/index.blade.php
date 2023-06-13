@extends('layout')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cards</h1>
        </div>

        <div class="row">

            @forelse( $companies as $i=> $item)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div

{{--                        class="card @if($item['price']>=40)--}}
{{--                     border-left-primary--}}
{{--                     @endif--}}
{{--                      @if($item['price']<40)--}}
{{--                     border-left-warning--}}
{{--                     @endif--}}

{{--                     shadow h-100 py-2"--}}

{{--@style([--}}
{{--                    'background-color: red'=>$item['price']<40,--}}

{{--                    ])--}}
                        @class([
          'card h-100 shadow py-2',
   'border-left-primary'=>$item['price']>=40,
   'border-left-warning'=>$item['price']<40,

])
                    >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{$item['name']}}
                                        {{($loop->iteration)}}
{{--                                        {{$i+1}}--}}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{$item['price']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div> Not data found</div>
            @endforelse

        </div>


    </div>

@endsection
