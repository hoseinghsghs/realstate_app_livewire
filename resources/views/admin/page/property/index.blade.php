@extends('admin.layout.MasterAdmin')

@section('Content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست املاک</h2>
                    <br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">املاک</a></li>
                        <li class="breadcrumb-item active">لیست املاک</li>
                    </ul>
                    </br>
                    <a onclick="loadbtn(event)" href="{{route('admin.properties.create')}}"
                        class="btn btn-raised btn-info waves-effect">
                        اضافه کردن ملک </a>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <!-- Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        {{-- <div class="header">
                            <h2><strong>ردیف های</strong> شناور</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                        data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">اقدام</a></li>
                                        <li><a href="javascript:void(0);">اقدام دیگر</a></li>
                                        <li><a href="javascript:void(0);">چیز دیگری</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div> --}}
                        <div class="body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-1 col-form-label">جستجو </label>
                                <div class="col-sm-11">
                                    <input id="searchInput" class="form-control col-md-3"
                                        placeholder="یک عبارت بنویسید....">
                                </div>
                            </div>
                            @if(count($property)===0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
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
                                        @foreach ($property as $key => $properties)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{$properties->code}}</td>
                                            <td>
                                                {{$properties->user->name}}
                                                @if ($properties->user->role_id===1)
                                                (ادمین)
                                                @elseif ($properties->user->role_id===2)
                                                (مشاور)
                                                @elseif ($properties->user->role_id===3)
                                                (کاربر)
                                                @endif
                                            </td>
                                            <td>{{$properties->title}}</td>
                                            <td>{{$properties->tr_type}}</td>
                                            <td>
                                                <div class="row clearfix">

                                                    <div class="col-6">
                                                        @if ($properties->isactive)
                                                        <span class="badge badge-success">منتشر شده</span>
                                                        @else
                                                        <span class="badge badge-danger">منتشر نشده</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center js-sweetalert">
                                                <a onclick="loadbtn(event)"
                                                    href="{{route('admin.properties.edit',$properties->id)}}"
                                                    class="btn btn-raised btn-info waves-effect">
                                                    ویرایش
                                                </a>
                                                <a onclick="loadbtn(event)"
                                                    href="{{route('admin.properties.show',$properties->id)}}"
                                                    class="btn btn-raised btn-info waves-effect">
                                                    نمایش
                                                </a>
                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    data-type="confirm"
                                                    data-form-id="del-property-{{$properties->id}}">حذف</button>
                                                <form action="{{route('admin.properties.destroy',$properties->id)}}"
                                                    id="del-property-{{$properties->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
                        {{$property->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </div>

        @push('scripts')
        <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        </script>
        @endpush

    </section>

    @endsection