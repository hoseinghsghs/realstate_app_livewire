@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>مشاهده قولنامه</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i> خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">قولنامه</a></li>
                        <li class="breadcrumb-item active">مشاهده قولنامه</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header js-sweetalert">
                            <a class="btn btn btn-raised btn-info waves-effect" href={{route('admin.agreements.edit',$agreement->id)}}>ویرایش</a>
                            <button class="btn btn-raised btn-danger waves-effect" data-type="confirm" data-form-id="del-agreement">حذف</button>
                            <form method="POST" id="del-agreement" class="d-inline" action={{route('admin.agreements.destroy',$agreement->id)}}>
                                @csrf
                                @method('DELETE')
                            </form>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md">
                                    <p> <strong>نوع قرارداد:</strong>
                                        {{$agreement->agreement_type==='rental'?'اجاره ای':'فروشی'}}
                                    </p>
                                </div>
                                <div class="col-md">
                                    <p> <strong class="form-label">نام مشاور:</strong>
                                        {{$agreement->adviser}}
                                    </p>
                                </div>
                                <div class="col-md">
                                    <p><strong>تاریخ عقد قرارداد:</strong>
                                        {{$agreement->agreement_date}}
                                    </p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <strong class="col-12">مشخصات موجر/فروشنده</strong>
                                <div class="col-md-4">
                                    <p> <strong>نام :</strong>
                                        {{ $agreement->owner_name}}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p> <strong>تاریخ تولد :</strong>
                                        {{ $agreement->owner_birth}}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p> <strong>تلفن همراه :</strong>
                                        {{ $agreement->owner_tel}}
                                    </p>
                                </div>
                                <strong class="col-12">مشخصات مستاجر/خریدار</strong>
                                <div class="col-md-4">
                                    <p> <strong>نام :</strong>
                                        {{ $agreement->customer_name}}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p> <strong>تاریخ تولد :</strong>
                                        {{ $agreement->customer_birth}}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p> <strong>تلفن همراه :</strong>
                                        {{ $agreement->customer_tel}}
                                    </p>
                                </div>
                            </div>

                            @if($agreement->agreement_type==='rental')
                            <div id="rental">
                                <div class="row clearfix">
                                    <div class="col-md">
                                        <p> <strong>مدت اجاره:</strong>
                                            {{$agreement->rent_term}}
                                        </p>
                                    </div>
                                    <div class="col-md">
                                        <p><strong>تاریخ شروع قرارداد:</strong>
                                            {{$agreement->start_date}}
                                        </p>
                                    </div>
                                    <div class="col-md">
                                        <p><strong>تاریخ اتمام قرارداد:</strong>
                                            {{$agreement->end_date}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md">
                                        <p> <strong>مبلغ رهن:</strong>
                                            {{$agreement->mortgage_price}}<span>تومان</span>
                                        </p>
                                    </div>
                                    <div class="col-md">
                                        <p> <strong>مبلغ اجاره:</strong>
                                            {{$agreement->rent_price}}<span>تومان</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div id="sale" class="row clearfix">
                                <div class="col-md-4">
                                    <p><strong> مبلغ فروش:</strong>
                                        {{$agreement->sell_price}}<span>تومان</span>
                                    </p>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <p><strong>توضیحات:</strong>
                                    {{ $agreement->description }}
                                </p>
                            </div>

                            @if(count($images)>0)
                            <div class="mb-2">
                                <strong class="d-block">عکس قرارداد:</strong>
                                <small>برای بزرگ نمایی و دانلود عکس روی آن کلیک کنید </small>
                            </div>
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                @foreach($images as $image)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-30 hover">
                                    <a href={{asset('storage/'.$image->url)}}> <img class="img-fluid img-thumbnail  w-100" style="height: 130px;" src={{asset('storage/'.$image->url)}} alt=""> </a>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </div>
</section>
@endsection