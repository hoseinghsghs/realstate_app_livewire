@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ایجاد اسلایدر</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">اسلایدر</a></li>
                        <li class="breadcrumb-item active">ایجاد اسلایدر</li>
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
                            <form id="form_advanced_validation" class="needs-validation"
                                action={{route('admin.sliders.store')}} method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">عنوان (شهر یا استان) </label>
                                        <input type="text" name="title" class="form-control" maxlength="100"
                                            minlength="3" value="{{ old('title') }}" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">مکان</label>
                                        <select name="position" class="form-control show-tick ms select2" required>
                                            <option {{ old('lable')== 'اسلایدر' ? 'selected' : ""}}>
                                                اسلایدر</option>
                                            <option {{ old('lable')== 'بنر' ? 'selected' : ""}}>
                                                بنر</option>
                                            <option {{ old('lable')== 'تصویرسرویس' ? 'selected' : ""}}>
                                                تصویرسرویس</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <label class="form-label">توضیحات</label>
                                        <textarea required name="description" rows="4" class="form-control no-resize"
                                            maxlength="200" minlength="5">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">آپلود عکس</label>
                                    <div class="col-lg-6 px-0">
                                        <input name="image" type="file" class="dropify"
                                            data-allowed-file-extensions="jpg png jpeg" data-max-file-size="1024K"
                                            required>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-raised btn-primary waves-effect"
                                    onclick="loadbtn(event)">
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
<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        //         // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>