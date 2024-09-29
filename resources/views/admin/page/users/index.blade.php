@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست مشاوران</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item">تنظیمات</li>
                        <li class="breadcrumb-item active">لیست کاربران</li>
                    </ul>
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
                            <ul class="header-dropdown">                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div> --}}
                        <div class="body">
                            @if(!count($users)===0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>کد</th>
                                            <th data-breakpoints="sm xs">نام کاربر</th>
                                            <th data-breakpoints="sm xs">نقش</th>
                                            <th data-breakpoints="sm xs">ایمیل</th>
                                            <th class="text-center js-sweetalert">عملیات</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>
                                                <span class="text-muted">{{$user->name}} </span>
                                            </td>
                                            <td><span class="text-muted">{{$user->role->slug}}</span></td>
                                            <td><span class="text-muted">{{$user->email}}</span></td>
                                            <td class="text-center js-sweetalert">
                                                <a href="{{route('admin.users.edit',$user->id)}}"
                                                    class="btn btn-raised btn-info waves-effect">
                                                    ویرایش
                                                </a>
                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    data-type="confirm"
                                                    data-form-id="del-user-{{$user->id}}">حذف</button>
                                                <form action="{{route('admin.users.destroy',$user->id)}}"
                                                    id="del-user-{{$user->id}}" method="POST">
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
            <!-- #END# Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        {{$users->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection