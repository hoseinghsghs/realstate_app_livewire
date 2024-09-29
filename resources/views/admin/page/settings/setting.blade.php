@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>تنظیمات</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i> خانه</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">تنظیمات</a></li>
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
                        <div class="body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form id="form_advanced_validation" action="{{route('admin.settings.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group form-float col-md-4">
                                        <div class="form-line">
                                            <label class="form-label">عنوان سایت</label>
                                            <input type="text" name="title" class="form-control" value="{{$settings->title}}">
                                        </div>
                                    </div>
                                    <div id="inputWrapper" class="form-group form-float col-md-4">
                                        <label class="form-label">ایمیل</label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control">
                                            <div class="input-group-append">
                                                <button id="addInput" class="btn btn-info m-0" type="button" data-input-name="email[]"><strong>افزودن</strong></button>
                                            </div>
                                        </div>
                                        @isset($settings->email)
                                        @foreach($settings->email as $email)
                                        <div class="input-group mb-1">
                                            <input type="text" name="email[]" class="form-control" value="{{$email}}" readonly>
                                            <div class="input-group-append">
                                                <button id="rInput" type="button" class="btn btn-warning m-0"><i class="zmdi zmdi-delete"></i></button>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endisset
                                    </div>
                                    <div id="inputWrapper" class="form-group form-float col-md-4">
                                        <label class="form-label">شماره تماس</label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control">
                                            <div class="input-group-append">
                                                <button id="addInput" class="btn btn-info m-0" data-input-name="phone[]" type="button"><strong>افزودن</strong></button>
                                            </div>
                                        </div>
                                        @isset($settings->phone)
                                        @foreach($settings->phone as $phone)
                                        <div class="input-group mb-1">
                                            <input name="phone[]" type="text" class="form-control" value="{{$phone}}" readonly>
                                            <div class="input-group-append">
                                                <button id="rInput" type="button" class="btn btn-warning m-0"><i class="zmdi zmdi-delete"></i></button>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endisset
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="form-group form-float col-md-4">
                                        <div class="form-line">
                                            <label class="form-label">لینک اینستاگرام </label>
                                            <input type="text" name="instagram" class="form-control" value="{{$settings->instagram}}">
                                        </div>
                                    </div>

                                    <div class="form-group form-float col-md-4">
                                        <div class="form-line">
                                            <label class="form-label">لینک واتس آپ</label>
                                            <input type="text" name="whatsapp" class="form-control" value="{{$settings->whatsapp}}">
                                        </div>
                                    </div>
                                    <div class="form-group form-float col-md-4">
                                        <div class="form-line">
                                            <label class="form-label">لینک تلگرام</label>
                                            <input type="text" name="telegram" class="form-control" value="{{$settings->telegram}}">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="form-group form-float col-md-6">
                                        <div class="form-line">
                                            <label class="form-label">آدرس</label>
                                            <input type="text" name="address" class="form-control" value="{{$settings->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group form-float col-md-6">
                                        <div class="form-line">
                                            <label class="form-label">ساعات کاری</label>
                                            <input type="text" name="workday" class="form-control" value="{{$settings->workday}}">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div id="inputWrapper" class="form-group form-float col-12">
                                        <label class="form-label">لینک های مفید</label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" placeholder="عنوان لینک">
                                            <input type="text" class="form-control" placeholder="آدرس لینک">
                                            <div class="input-group-append">
                                                <button id="addInput" class="btn btn-info m-0" data-input-name="links" type="button"><strong>افزودن</strong></button>
                                            </div>
                                        </div>
                                        @isset($settings->links)
                                        @foreach($settings->links as $link)
                                        <div class="input-group mb-1">
                                            <input type="text" name="links[][title]" class="form-control" value="{{$link->title}}" readonly>
                                            <input type="text" name="links[][url]" class="form-control" value="{{$link->url}}" readonly>
                                            <div class="input-group-append">
                                                <button id="rInput" type="button" class="btn btn-warning m-0"><i class="zmdi zmdi-delete"></i></button>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endisset
                                    </div>

                                    <div class="form-group col-12 mb-1"><label class="form-label">مکان روی نقشه:</label></div>
                                    <div class="form-group form-float col-md-6">
                                        <small>طول جغرافیایی</small>
                                        <div class="form-line">
                                            <input type="number" name="longitude" class="form-control" value="{{$settings->longitude}}">
                                        </div>
                                    </div>
                                    <div class="form-group form-float col-md-6">
                                        <div class="form-line">
                                            <small>عرض جغرافیایی</small>
                                            <input type="number" name="latitude" class="form-control" value="{{$settings->latitude}}">
                                        </div>
                                    </div>
                                    <div class="form-group form-float col-md-6">
                                        <div class="form-line">
                                            <small>کلید دسترسی نقشه</small>
                                            <input type="text" name="apiKey" class="form-control" value="{{$settings->apiKey}}">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="form-group col-md-12">
                                        <div class="form-line">
                                            <label class="form-label">توضیحات</label>
                                            <textarea name="description" rows="4" class="form-control no-resize">{{ $settings->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">آپلود لوگوی سایت</label>
                                        <input name="icon" type="file" class="dropify" @isset($settings->icon) data-default-file="{{asset('storage/'.$settings->icon)}}" @endisset data-max-file-size="1024K">
                                    </div>
                                </div>
                                <button onclick="loadbtn(event)" type="submit" class="btn btn-raised btn-primary waves-effect">
                                    ذخیره
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '#addInput', function() {
            var html = '';
            html += '<div class="input-group mb-1">';
            if ($(this).data('input-name') == 'links') {
                var inputs = $(this).parent().prevAll();
                html += `<input type="text" name="links[][title]" class="form-control" value="${inputs[1].value}" readonly>`;
                html += `<input type="text" name="links[][url]" class="form-control" value="${inputs[0].value}" readonly>`;
                inputs.val('');
            } else {
                var input = $(this).parent().prev();
                html += `<input type="text" name="${$(this).data('input-name')}" class="form-control" value="${input.val()}" readonly>`;
                input.val('');
            }
            html += '<div class="input-group-append">';
            html += '<button id="rInput" type="button" class="btn btn-warning m-0"><i class="zmdi zmdi-delete"></i></button>';
            html += '</div>';
            html += '</div>';

            $(this).closest('#inputWrapper').append(html);
        });
        // remove row
        $(document).on('click', '#rInput', function() {
            $(this).closest('.input-group').remove();
        });
    })
</script>
@endpush