@extends('admin.layout.MasterAdmin')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" />
@endpush

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش قولنامه</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">قولنامه</a></li>
                        <li class="breadcrumb-item active">ویرایش قولنامه</li>
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
                            <form id="form_advanced_validation" action={{route('admin.agreements.update',$agreement->id)}} method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <label class="form-label">نوع قرارداد</label>
                                            <select name="agreement_type" id="typeSelector" class="form-control show-tick ms" data-placeholder="انتخاب کنید" required>
                                                <option value="rental" {{ (old('greement_type')==='rental' || $agreement->agreement_type==='rental') ? 'selected' :null }}>
                                                    اجاره نامه </option>
                                                <option value="sale" {{ (old('greement_type')==='sale' || $agreement->agreement_type==='sale') ? 'selected' :null }}>
                                                    فروش</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-auto">
                                        <div class="form-group">
                                            <label class="form-label">تاریخ عقد قرارداد</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input name="agreement_date" type="text" id="agreementDate" class="form-control" value="{{$agreement->agreement_date}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="form-label">نام مشاور</label>
                                            <input name="adviser" type="text" class="form-control" maxlength="40" value="{{old('adviser') ?? $agreement->adviser}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-12 mb-1"><label class="form-label">مشخصات موجر/فروشنده:</label></div>
                                    <div class="form-group col-md-4">
                                        <small>نام </small>
                                        <input name="owner_name" type="text" class="form-control" value="{{old('owner_name') ?? $agreement->owner_name}}" maxlength="30" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <small>تاریخ تولد</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input id="owner_birth" name="owner_birth" type="text" class="form-control" value="{{old('owner_birth') ?? $agreement->owner_birth}}" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <small>تلفن همراه</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-hc-fw"></i></span>
                                            </div>
                                            <input name="owner_tel" type="number" class="form-control" value="{{old('owner_tel') ?? $agreement->owner_tel}}" maxlength="11">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mb-1"><label class="form-label">مشخصات مستاجر/خریدار:</label></div>
                                    <div class="form-group col-md-4">
                                        <small>نام </small>
                                        <input name="customer_name" type="text" class="form-control" value="{{old('customer_name') ?? $agreement->customer_name}}" maxlength="30" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <small>تاریخ تولد</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input id="customer_birth" name="customer_birth" type="text" class="form-control" value="{{old('customer_birth') ?? $agreement->customer_birth}}" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <small>تلفن همراه</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-hc-fw"></i></span>
                                            </div>
                                            <input name="customer_tel" type="number" class="form-control" value="{{old('customer_tel') ?? $agreement->customer_tel}}" maxlength="11">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label class="form-label">توضیحات</label>
                                        <textarea name="description" rows="3" class="form-control no-resize" maxlength="200" minlength="5">{{ old('description') ?? $agreement->description }}</textarea>
                                    </div>
                                </div>
                                <div id="rental">
                                    <div class="row clearfix">
                                        <div class="col-md-3">
                                            <label class="form-label">مدت اجاره</label>
                                            <div class="form-group">
                                                <input type="text" name="rent_term" class="form-control" maxlength="20" value="{{old('rent_term') ?? $agreement->rent_term}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">تاریخ شروع قرارداد</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                    </div>
                                                    <input id="startDate" name="start_date" class="form-control" type="text" maxlength="10" value="{{$agreement->start_date}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">تاریخ اتمام قرارداد</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                    </div>
                                                    <input id="endDate" name="end_date" class="form-control" type="text" maxlength="10" value="{{$agreement->end_date}}" required>
                                                </div>
                                            </div>
                                        </div>
                                          <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">sms</label>
                                                    <?php
                                                    use Hekmatinasser\Verta\Verta;
                                                    $v = verta();
                                                    $v3 = verta($agreement->end_date);
                                                    $v2 = verta($v->year.'/'.$v->month.'/'.$v->day);
                                                    ?>
                                                    <input type="text" class="form-control"
                                                        value="{{$v2->diffDays($v3)}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row clearfix">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label class="form-label">مبلغ رهن</label>
                                                <div class="input-group">
                                                    <input type="number" name="mortgage_price" class="form-control" value="{{old('mortgage_price') ?? $agreement->mortgage_price}}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label class="form-label">مبلغ اجاره</label>
                                                <div class="input-group">
                                                    <input type="number" name="rent_price" class="form-control" value="{{old('rent_price') ?? $agreement->rent_price}}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div id="sale" class="row clearfix" style="display: none;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label"> مبلغ فروش</label>
                                                <div class="input-group">
                                                    <input type="number" name="sell_price" class="form-control" value="{{old('sell-price') ?? $agreement->sell_price}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                                    <label class="form-label">آپلود عکس قولنامه</label>
                                    <label class="float-left">
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">حذف همه عکس ها<button type="button" class="close float-right color-red" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input name="images[]" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" multiple />
                                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                        <span class="custom-file-container__custom-file__custom-file-control text-left text-md-center"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview my-2" style=" height: fit-content;max-height:15rem;overflow: auto;"></div>

                                </div>
                            </form>

                            @if(count($images)>0)
                            <label class="form-label">عکس های آپلود شده:</label>
                            <small>برای بزرگ نمایی و دانلود عکس روی آن کلیک کنید </small>
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix js-sweetalert">
                                @foreach($images as $image)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-30 hover">
                                    <button type="button" data-type="confirm" data-form-id="del-image-{{$image->id}}" class="btn btn-icon btn-icon-mini btn-round btn-danger position-absolute m-2" style="z-index:100">
                                        <i class="zmdi zmdi-hc-fw"></i>
                                    </button>
                                    <a href={{asset('storage/'.$image->url)}}> <img class="img-fluid img-thumbnail  w-100" style="height: 120px;" src={{asset('storage/'.$image->url)}} alt=""> </a>
                                </div>
                                <form action="{{route('admin.deleteImage',$image->id)}}" id="del-image-{{$image->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endforeach
                            </div>
                            @endif
                            <button type="submit" form="form_advanced_validation" class="btn btn-raised btn-primary waves-effect" onclick="loadbtn(event)">
                                ذخیره
                            </button>

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
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
<script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
<script>
    $(document).ready(function() {

        var upload = new FileUploadWithPreview("myUniqueUploadId", {
            maxFileCount: 10,
            text: {
                selectedCount: 'عکس انتخاب شده',
                browse: "انتخاب عکس",
                chooseFile: "",
            },
        });
        //persian date picker
        var agDate = $("#agreementDate").pDatepicker({
            format: 'L',
        });
        $("#startDate").pDatepicker({
            format: 'L',
        });
        $("#endDate").pDatepicker({
            initialValue: false,
            format: 'L'
        });
        $("#owner_birth").pDatepicker({
            initialValue: false,
            format: 'L'
        });
        $("#customer_birth").pDatepicker({
            initialValue: false,
            format: 'L'
        });
        // show or hide content on type select
        if ($('#typeSelector').val() == 'sale') {
            $("#rental").hide();
            $("#sale").show();
        }
        $('#typeSelector').on('change', function() {
            if (this.value == 'sale') {
                $("#rental").hide();
                $("#rental").hide();
                $("#sale").show();
            } else {
                $("#sale").hide();
                $("#rental").show();
            }
        });
    });
</script>

@endpush