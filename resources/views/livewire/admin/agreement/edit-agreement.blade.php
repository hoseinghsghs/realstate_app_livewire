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
                            <form wire:submit="update" method="POST" enctype="multipart/form-data" autocomplete="off"
                                  class="d-inline-block">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">نوع قرارداد</label>
                                            <select name="agreement_type" id="typeSelector"
                                                    wire:model.live="form.agreement_type"
                                                    class="form-control show-tick ms @error('form.agreement_type') is-invalid @enderror"
                                                    data-placeholder="انتخاب کنید"
                                                    required>
                                                <option value="rental" selected>اجاره نامه</option>
                                                <option value="sale">فروش</option>
                                            </select>
                                            @error('form.agreement_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group ">
                                            <label class="form-label">تاریخ عقد قرارداد <abbr title="ضروری"
                                                                                              style="color:red;">*</abbr></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend" onclick="$('#create-date').focus();">
                                                    <span class="input-group-text"><i
                                                                class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input type="hidden" wire:ignore.self id="create-date-alt">
                                                <input type="text"
                                                       class="form-control @error('form.agreement_date') is-invalid @enderror"
                                                       id="create-date"
                                                       autocomplete="off" dir="ltr">
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="destroy-create-date"
                                                      style="cursor: pointer;"><i
                                                            class="zmdi zmdi-close"></i></span>
                                                </div>
                                                @error('form.agreement_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group ">
                                            <label class="form-label">نام مشاور</label>
                                            <input name="adviser" type="text"
                                                   class="form-control @error('form.adviser') is-invalid @enderror"
                                                   wire:model="form.adviser">
                                            @error('form.adviser')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-12 mb-1"><label class="form-label">مشخصات
                                            موجر/فروشنده:</label></div>
                                    <div class="form-group col-md-4 ">
                                        <label class="form-label">نام <abbr title="ضروری"
                                                                            style="color:red;">*</abbr></label>
                                        <input name="owner_name" type="text"
                                               class="form-control @error('form.owner_name') is-invalid @enderror"
                                               wire:model="form.owner_name">
                                        @error('form.owner_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label class="form-label">تاریخ تولد</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend" onclick="$('#owner-birth').focus();">
                                                    <span class="input-group-text"><i
                                                                class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input type="hidden" id="owner-birth-alt">
                                            <input type="text"
                                                   class="form-control @error('form.owner_birth') is-invalid @enderror"
                                                   id="owner-birth"
                                                   autocomplete="off" dir="ltr">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="destroy-owner-birth"
                                                      style="cursor: pointer;"><i
                                                            class="zmdi zmdi-close"></i></span>
                                            </div>
                                            @error('form.owner_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label class="form-label">تلفن همراه</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-hc-fw"></i></span>
                                            </div>
                                            <input name="owner_tel" dir="ltr" type="number"
                                                   class="form-control @error('form.owner_tel') is-invalid @enderror"
                                                   wire:model="form.owner_tel">
                                            @error('form.owner_tel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mb-1"><label class="form-label">مشخصات
                                            مستاجر/خریدار:</label></div>
                                    <div class="form-group col-md-4 ">
                                        <label class="form-label">نام <abbr title="ضروری"
                                                                            style="color:red;">*</abbr></label>
                                        <input name="customer_name" type="text"
                                               class="form-control @error('form.customer_name') is-invalid @enderror"
                                               wire:model="form.customer_name">
                                        @error('form.customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label class="form-label">تاریخ تولد</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend" onclick="$('#customer-birth').focus();">
                                                    <span class="input-group-text"><i
                                                                class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input type="hidden" id="customer-birth-alt">
                                            <input type="text"
                                                   class="form-control @error('form.customer_birth') is-invalid @enderror"
                                                   id="customer-birth"
                                                   autocomplete="off" dir="ltr">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="destroy-customer-birth"
                                                      style="cursor: pointer;"><i
                                                            class="zmdi zmdi-close"></i></span>
                                            </div>
                                            @error('form.customer_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label class="form-label">تلفن همراه</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-hc-fw"></i></span>
                                            </div>
                                            <input dir="ltr" name="customer_tel" wire:model="form.customer_tel"
                                                   type="number"
                                                   class="form-control @error('form.customer_tel') is-invalid @enderror">
                                            @error('form.customer_tel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <div class="form-line">
                                            <label class="form-label">توضیحات</label>
                                            <textarea wire:model="form.description" name="description" rows="3"
                                                      class="form-control no-resize @error('form.description') is-invalid @enderror"></textarea>
                                            @error('form.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div @class(["row",'d-none'=>$form->agreement_type==='sale'])>
                                    <div class="col-md-4 col-lg-3">
                                        <label class="form-label">مدت اجاره <abbr title="ضروری"
                                                                                  style="color:red;">*</abbr></label>
                                        <div class="form-group">
                                            <input type="text" name="rent_term" class="form-control @error('form.rent_term') is-invalid @enderror" maxlength="20"
                                                   wire:model="form.rent_term">
                                            @error('form.rent_term')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">تاریخ شروع قرارداد <abbr title="ضروری"
                                                                                               style="color:red;">*</abbr></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"
                                                     onclick="$('#start-date').focus();">
                                                    <span class="input-group-text"><i
                                                                class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input type="hidden" id="start-date-alt">
                                                <input type="text"
                                                       class="form-control @error('form.start_date') is-invalid @enderror"
                                                       id="start-date"
                                                       autocomplete="off" dir="ltr">
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="destroy-start-date"
                                                      style="cursor: pointer;"><i class="zmdi zmdi-close"></i>
                                                </span>
                                                </div>
                                                @error('form.start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">تاریخ اتمام قرارداد <abbr title="ضروری"
                                                                                                style="color:red;">*</abbr></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend" onclick="$('#end-date').focus();">
                                                    <span class="input-group-text"><i
                                                                class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input type="hidden" id="end-date-alt">
                                                <input type="text"
                                                       class="form-control @error('form.end_date') is-invalid @enderror"
                                                       id="end-date"
                                                       autocomplete="off" dir="ltr">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="destroy-end-date"
                                                          style="cursor: pointer;"><i
                                                                class="zmdi zmdi-close"></i></span>
                                                </div>
                                                @error('form.end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">مبلغ رهن <abbr title="ضروری"
                                                                                     style="color:red;">*</abbr></label>
                                            <div class="input-group">
                                                <input type="number" name="mortgage_price" dir="ltr"
                                                       class="form-control @error('form.mortgage_price') is-invalid @enderror"
                                                       wire:model="form.mortgage_price">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">تومان</span>
                                                </div>
                                                @error('form.mortgage_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">مبلغ اجاره <abbr title="ضروری"
                                                                                       style="color:red;">*</abbr></label>
                                            <div class="input-group">
                                                <input type="number" name="rent_price" dir="ltr"
                                                       class="form-control @error('form.rent_price') is-invalid @enderror"
                                                       wire:model="form.rent_price">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">تومان</span>
                                                </div>
                                                @error('form.rent_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div @class(["row",'d-none'=>$form->agreement_type==='rental'])>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">مبلغ فروش <abbr title="ضروری"
                                                                                      style="color:red;">*</abbr></label>
                                            <div class="input-group">
                                                <input type="number" name="sell_price" dir="ltr"
                                                       class="form-control @error('form.sell_price') is-invalid @enderror"
                                                       wire:model="form.sell_price">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">تومان</span>
                                                </div>
                                                @error('form.sell_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="form-label"
                                               for="exampleFormControlFile1">
                                            آپلود تصویر قولنامه / چک

                                        </label>
                                        <input wire:model.live="form.images"
                                               type="file" style="display: none"
                                               id="imageUpload"
                                               class="@error('form.images.*') is-invalid @enderror"
                                               multiple>
                                        <label class="btn btn-raised btn-info" for="imageUpload"><i
                                                    class="zmdi zmdi-image"></i> انتخاب
                                            تصویر <span wire:loading
                                                        wire:target="form.images"
                                                        class="spinner-border spinner-border-sm"
                                                        role="status"
                                                        aria-hidden="true"></span></label>
                                        @error('form.images.*')
                                        <small class="text-danger d-block">{{$message}}</small>
                                        @enderror
                                    </div>
                                    @if($photos && count($photos)>0 || $form->images && count($form->images)>0)
                                        <div class="col-12 mb-3">
                                            <div class="d-flex flex-wrap rounded border border-secondary shadow-md bg-light p-1">
                                                @foreach($photos as $key=> $image)
                                                    <div wire:key="default-{{$key}}"
                                                         class="position-relative  mx-2 my-1" style="width: 150px;">
                                                        <img width="100%" class="rounded border shadow-md"
                                                             src="{{ url('storage/'.$image->url) }}">
                                                        <a wire:click="delete_photo({{$image->id}})"
                                                           class="position-absolute text-danger text-md"
                                                           style="top: 5px;right: 10px;cursor:pointer;"><i
                                                                    class="zmdi zmdi-close"></i></a>
                                                    </div>
                                                @endforeach
                                                @foreach($form->images as $key=> $image)
                                                    <div wire:key="new-{{$key}}" class="position-relative  mx-2 my-1"
                                                         style="width: 150px;">
                                                        <img width="100%" class="rounded border shadow-md"
                                                             src="{{ $image->temporaryUrl() }}">
                                                        <a wire:click="delete_temp_image({{$key}})"
                                                           class="position-absolute text-danger text-md"
                                                           style="top: 5px;right: 10px;cursor:pointer;"><i
                                                                    class="zmdi zmdi-close"></i></a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary waves-effect"
                                        wire:loading.attr="disabled">
                                    <span wire:loading class="spinner-border spinner-border-sm" role="status"
                                          aria-hidden="true"></span> ذخیره
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
@push('styles')
    <link rel="stylesheet" type="text/css"
          href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css"/>
@endpush

@script
<script>
    $(document).ready(async function () {
        $('#typeSelector').on('change', function () {
            console.log('test');
            // $wire.$refresh()
            // endDate.options = {};
        })
        //persian date picker
        const createDate = $("#create-date").pDatepicker({
            format: 'L',
            initialValue: true,
            initialValueType: 'persian',
            altField: `#create-date-alt`,
            altFormat: 'g',
            timePicker: {
                enabled: true,
                second: {
                    enabled: false
                },
            },
            altFieldFormatter: function (unixDate) {
                const self = this;
                const thisAltFormat = self.altFormat.toLowerCase();
                if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                    const date1 = new Date(unixDate);
                    const pad = (num) => String(num).padStart(2,
                        '0'); // Helper to pad single digits
                    const year = date1.getFullYear();
                    const month = pad(date1.getMonth() + 1); // Months are zero-indexed
                    const day = pad(date1.getDate());
                    const hours = pad(date1.getHours());
                    const minutes = pad(date1.getMinutes());
                    const seconds = pad(date1.getSeconds());

                    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                } else if (thisAltFormat === 'shamsi' || thisAltFormat === 's') {
                    persianDate.toLocale('en');
                    let p = new persianDate(unixDate).format(
                        'YYYY/MM/DD HH:mm');
                    return p;
                } else if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                    return unixDate;
                } else {
                    let pd = new persianDate(unixDate);
                    pd.formatPersian = this.persianDigit;
                    return pd.format(self.altFormat);
                }
            },
            onSelect: function (unix) {
                @this.
                set(`form.agreement_date`, $(`#create-date-alt`).val(), true);
            },
        })

        const ownerBirth = $("#owner-birth").pDatepicker({
            format: 'L',
            initialValue: "{!! (bool)$form->owner_birth !!}",
            altField: `#owner-birth-alt`,
            altFormat: 'g',
            timePicker: {
                enabled: false,
            },
            altFieldFormatter: function (unixDate) {
                const self = this;
                const thisAltFormat = self.altFormat.toLowerCase();
                if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                    const date1 = new Date(unixDate);
                    const pad = (num) => String(num).padStart(2,
                        '0'); // Helper to pad single digits
                    const year = date1.getFullYear();
                    const month = pad(date1.getMonth() + 1); // Months are zero-indexed
                    const day = pad(date1.getDate());
                    const hours = pad(date1.getHours());
                    const minutes = pad(date1.getMinutes());
                    const seconds = pad(date1.getSeconds());

                    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                } else if (thisAltFormat === 'shamsi' || thisAltFormat === 's') {
                    persianDate.toLocale('en');
                    let p = new persianDate(unixDate).format(
                        'YYYY/MM/DD HH:mm');
                    return p;
                } else if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                    return unixDate;
                } else {
                    let pd = new persianDate(unixDate);
                    pd.formatPersian = this.persianDigit;
                    return pd.format(self.altFormat);
                }
            },
            onSelect: function (unix) {
                @this.
                set(`form.owner_birth`, $(`#owner-birth-alt`).val(), true);
            },
        });

        const customerBirth = $("#customer-birth").pDatepicker({
            format: 'L',
            initialValue: "{!! (bool)$form->customer_birth !!}",
            altField: `#customer-birth-alt`,
            altFormat: 'g',
            timePicker: {
                enabled: false,
            },
            altFieldFormatter: function (unixDate) {
                const self = this;
                const thisAltFormat = self.altFormat.toLowerCase();
                if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                    const date1 = new Date(unixDate);
                    const pad = (num) => String(num).padStart(2,
                        '0'); // Helper to pad single digits
                    const year = date1.getFullYear();
                    const month = pad(date1.getMonth() + 1); // Months are zero-indexed
                    const day = pad(date1.getDate());
                    const hours = pad(date1.getHours());
                    const minutes = pad(date1.getMinutes());
                    const seconds = pad(date1.getSeconds());

                    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                } else if (thisAltFormat === 'shamsi' || thisAltFormat === 's') {
                    persianDate.toLocale('en');
                    let p = new persianDate(unixDate).format(
                        'YYYY/MM/DD HH:mm');
                    return p;
                } else if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                    return unixDate;
                } else {
                    let pd = new persianDate(unixDate);
                    pd.formatPersian = this.persianDigit;
                    return pd.format(self.altFormat);
                }
            },
            onSelect: function (unix) {
                @this.
                set(`form.customer_birth`, $(`#customer-birth-alt`).val(), true);
            },
        });

        const startDate = $("#start-date").pDatepicker({
            format: 'L',
            initialValue: false,
            altField: `#start-date-alt`,
            altFormat: 'g',
            timePicker: {
                enabled: false,
            },
            altFieldFormatter: function (unixDate) {
                const self = this;
                const thisAltFormat = self.altFormat.toLowerCase();
                if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                    const date1 = new Date(unixDate);
                    const pad = (num) => String(num).padStart(2,
                        '0'); // Helper to pad single digits
                    const year = date1.getFullYear();
                    const month = pad(date1.getMonth() + 1); // Months are zero-indexed
                    const day = pad(date1.getDate());
                    const hours = pad(date1.getHours());
                    const minutes = pad(date1.getMinutes());
                    const seconds = pad(date1.getSeconds());

                    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                } else if (thisAltFormat === 'shamsi' || thisAltFormat === 's') {
                    persianDate.toLocale('en');
                    let p = new persianDate(unixDate).format(
                        'YYYY/MM/DD HH:mm');
                    return p;
                } else if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                    return unixDate;
                } else {
                    let pd = new persianDate(unixDate);
                    pd.formatPersian = this.persianDigit;
                    return pd.format(self.altFormat);
                }
            },
            onSelect: function (unix) {
                @this.
                set(`form.start_date`, $(`#start-date-alt`).val(), true);
            },
        });

        const endDate = $("#end-date").pDatepicker({
            format: 'L',
            initialValue: false,
            altField: `#end-date-alt`,
            altFormat: 'g',
            timePicker: {
                enabled: false,
            },
            altFieldFormatter: function (unixDate) {
                const self = this;
                const thisAltFormat = self.altFormat.toLowerCase();
                if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                    const date1 = new Date(unixDate);
                    const pad = (num) => String(num).padStart(2,
                        '0'); // Helper to pad single digits
                    const year = date1.getFullYear();
                    const month = pad(date1.getMonth() + 1); // Months are zero-indexed
                    const day = pad(date1.getDate());
                    const hours = pad(date1.getHours());
                    const minutes = pad(date1.getMinutes());
                    const seconds = pad(date1.getSeconds());

                    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                } else if (thisAltFormat === 'shamsi' || thisAltFormat === 's') {
                    persianDate.toLocale('en');
                    let p = new persianDate(unixDate).format(
                        'YYYY/MM/DD HH:mm');
                    return p;
                } else if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                    return unixDate;
                } else {
                    let pd = new persianDate(unixDate);
                    pd.formatPersian = this.persianDigit;
                    return pd.format(self.altFormat);
                }
            },
            onSelect: function (unix) {
                @this.
                set(`form.end_date`, $(`#end-date-alt`).val(), true);
            },
        });

        $('#destroy-create-date').click(function () {
            $(`#create-date`).val(null);
            $(`#create-date-alt`).val(null);
            createDate.touched = false;
            createDate.options = {
                initialValue: false
            }
            @this.set(`form.agreement_date`, null, true);
        })

        $('#destroy-owner-birth').click(function () {
            $(`#owner-birth`).val(null);
            $(`#owner-birth-alt`).val(null);
            ownerBirth.touched = false;
            ownerBirth.options = {
                initialValue: false
            }
            @this.set(`form.owner_birth`, null, true);
        })

        $('#destroy-customer-birth').click(function () {
            $(`#owner-birth`).val(null);
            $(`#owner_birth-alt`).val(null);
            customerBirth.touched = false;
            customerBirth.options = {
                initialValue: false
            }
            @this.set(`form.customer_birth`, null, true);
        })

        $('#destroy-start-date').click(function () {
            $(`#start-date`).val(null);
            $(`#start-date-alt`).val(null);
            startDate.touched = false;
            startDate.options = {
                initialValue: false
            }
            @this.set(`form.start_date`, null, true);
        })

        $('#destroy-end-date').click(function () {
            $(`#end-date`).val(null);
            $(`#end-date-alt`).val(null);
            endDate.touched = false;
            endDate.options = {
                initialValue: false
            }
            @this.set(`form.end_date`, null, true);
        })

        // set initial value for agreement date
        if ("{!! $form->agreement_date !!}") {
            let date = "{!! \Illuminate\Support\Carbon::parse($form->agreement_date)->valueOf() !!}";
            createDate.setDate(Number(date)); // Set the time in milliseconds
        }
        if ("{!! $form->owner_birth !!}") {
            let date = "{!! \Illuminate\Support\Carbon::parse($form->owner_birth)->valueOf() !!}";
            ownerBirth.setDate(Number(date)); // Set the time in milliseconds
        }
        if ("{!! $form->customer_birth !!}") {
            let date = "{!! \Illuminate\Support\Carbon::parse($form->customer_birth)->valueOf() !!}";
            customerBirth.setDate(Number(date)); // Set the time in milliseconds
        }
        if ("{!! $form->agreement_type==='rental' !!}}") {
            if ("{!! (bool)$form->start_date !!}") {
                let date = "{!! \Illuminate\Support\Carbon::parse($form->start_date)->valueOf() !!}";
                startDate.setDate(Number(date)); // Set the time in milliseconds
            }
            if ("{!! (bool)$form->end_date !!}") {
                let date = "{!! \Illuminate\Support\Carbon::parse($form->end_date)->valueOf() !!}";
                endDate.setDate(Number(date)); // Set the time in milliseconds
            }
        }
    })
</script>
@endscript