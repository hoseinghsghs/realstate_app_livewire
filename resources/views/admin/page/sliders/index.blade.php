@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست اسلایدر ها</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">اسلایدر</a></li>
                        <li class="breadcrumb-item active">لیست اسلایدر ها</li>
                    </ul>
                    </br>
                    <a onclick="loadbtn(event)" href="{{route('admin.sliders.create')}}"
                        class="btn btn-raised btn-info waves-effect">
                        اضافه کردن اسلایدر </a>
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
                        <div class="body">
                            @if(count($sliders)===0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عکس</th>
                                            <th>عنوان</th>
                                            <th>محل قرار گیری</th>
                                            <th>توضیحات</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $key => $slider)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            @if(Storage::exists('slider/'.$slider->image))
                                            <td>
                                                <img src="{{asset('storage/slider/'.$slider->image)}}"
                                                    alt="{{$slider->title}}" width="120" class="img-fluid rounded"
                                                    style="min-height: 3rem;">
                                            </td>
                                            @endif
                                            <td>{{$slider->title}}</td>
                                            <td>{{$slider->position}}</td>
                                            <td>{{$slider->description}}</td>
                                            <td class="text-center js-sweetalert">
                                                <a href="{{route('admin.sliders.edit',$slider->id)}}"
                                                    class="btn btn-raised btn-info waves-effect"
                                                    onclick="loadbtn(event)">
                                                    ویرایش
                                                </a>
                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    data-type="confirm"
                                                    data-form-id="del-slider-{{$slider->id}}">حذف</button>
                                                <form action="{{route('admin.sliders.destroy',$slider->id)}}"
                                                    id="del-slider-{{$slider->id}}" method="POST">
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
        </div>
    </div>
</section>
@endsection