@extends('layout')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                  action="{{($type=="create")?route('custom-notifications.store'):route('custom-notifications.update',$customNotification)}}">
                @csrf
                @if($type!="create")
                    @method("PUT")
                @endif
                <div class="col-12 col-lg-8 p-0 main-box">
                    <div class="col-12 px-0">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span>
                            @if($type=="create")
                                إضافة جديد
                            @else
                                تعديل
                            @endif
                        </div>
                        <div class="col-12 divider" style="min-height: 2px;"></div>
                    </div>
                    <div class="col-12 p-3 row">


                        <div class="col-12 p-2">
                            <div class="col-12">
                                العنوان
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="title" required maxlength="190" class="form-control"
                                       value="{{($type=="create")?old('title'):$customNotification->title}}">
                            </div>
                        </div>

                        <div class="col-12 p-2">
                            <div class="col-12">
                                الفئة المستهدفة
                            </div>
                            <div class="col-12 pt-3">
                                <select name="target" class="form-control">
                                    @php($types=['all','users','sellers','admins'])
                                    @foreach($types as $q_type)
                                        <option
                                            @if($type=="create" and $q_type == old('target')  )
                                                selected
                                            @elseif(isset($customNotification) and $customNotification->target== $q_type) selected
                                            @endif
                                            {{($type=="create")?old('name'):$customNotification->target}}
                                            value="{{$q_type}}">{{$q_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 p-2">
                            <div class="col-12">
                                الشعار
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                            @if($type!="create")
                                <div class="col-12 pt-3">
                                    <img src="{{$customNotification->image()}}" style="width:100px">
                                </div>
                            @endif
                            <div class="col-12 pt-3">

                            </div>
                        </div>

                        <div class="col-12  p-2">
                            <div class="col-12">
                                الوصف
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="description"
                                          class="form-control">{{($type=="create")?old('name'):$customNotification->description}}</textarea>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="col-12 p-3">
                    <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
