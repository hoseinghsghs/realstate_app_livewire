<div class="container-fluid">
    <!-- Hover Rows -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="body">
                    @if(count($properties)===0)
                    <p>هیچ رکوردی وجود ندارد</p>
                    @else
                    <p class="mb-2"><strong>تعداد نتایج:<span class="mx-1">{{$properties->total()}}</span></strong></p>
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>کد ملک</th>
                                    <th>نام ثبت کننده</th>
                                    <th>عنوان</th>
                                    <th>نوع معامله</th>
                                    <th>وضعیت</th>
                                    <th class="text-center js-sweetalert">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $key => $property)
                                <tr>
                                    <td scope="row">{{$key+1}}</td>
                                    <td>{{$property->code}}</td>
                                    <td>
                                        {{$property->user->name}}
                                        @if ($property->user->role_id===1)
                                        (ادمین)
                                        @elseif ($property->user->role_id===2)
                                        (مشاور)
                                        @elseif ($property->user->role_id===3)
                                        (کاربر)
                                        @endif
                                    </td>
                                    <td>{{$property->title}}</td>
                                    <td>{{$property->tr_type}}</td>
                                    <td>
                                        <div class="row clearfix">

                                            <div class="col-6">
                                                @if ($property->isactive)
                                                <span class="badge badge-success">منتشر شده</span>
                                                @else
                                                <span class="badge badge-danger">منتشر نشده</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center js-sweetalert">
                                        <button onclick="showDetail(event,{{$property->id}})" class="btn btn-raised btn-info waves-effect">
                                            نمایش
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                {{$properties->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</div>
