@extends('layout')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 main-box">

            <div class="col-12 px-0">
                <div class="col-12 p-0 row">
                    <div class="col-12 col-lg-4 py-3 px-3">
                        <span class="fas fa-categories"></span> notifictions
                    </div>
                    <div class="col-12 col-lg-4 p-0">
                    </div>
                    <div class="col-12 col-lg-4 p-2 text-lg-end">
                        <a href="{{route('custom-notifications.create')}}">
                            <span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 divider" style="min-height: 2px;"></div>
            </div>

            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0" style="min-width:1100px;">


                    <table class="table table-bordered  table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>الفئة المستهدفة</th>
                            <th> الصورة</th>
                            <th>اضيق بواسطة</th>
                            <th>الوصف</th>
                            <th>تحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notifications as $notification)
                            <tr>
                                <td>{{$notification->id}}</td>
                                <td>{{$notification->title}}</td>
                                <td>{{trans('lang.'.$notification->target)}}</td>
                                <td>
                                    @if($notification->image!=null)
                                        <img src="{{url('storage/'.$notification->image)}}" style="width:40px">
                                    @endif
                                </td>
                                <td>{{$notification->user->name}}</td>
                                <td>{!! $notification->description !!}</td>
                                <td style="width: 360px;">
                                    <a href="{{route('custom-notifications.edit',$notification)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                                    </a>

                                    <a href="{{route('custom-notifications.resend',$notification->id)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-retuen "></span> اعادة ارسال
							</span>
                                    </a>


                                    <form method="POST" action="{{route('custom-notifications.destroy',$notification)}}"
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
                </div>
            </div>
            <div class="col-12 p-3">
                {{$notifications->render()}}
            </div>
        </div>
    </div>
@endsection
