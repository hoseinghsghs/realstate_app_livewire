<div>
    @section('title', 'لیست سرویس ها')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>تنظیمات</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">تنظیمات</a></li>
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
                                <form wire:submit.prevent="save" id="form_advanced_validation">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group form-float col-md-4">
                                            <div class="form-line">
                                                <label class="form-label">عنوان سایت</label>
                                                <input wire:model.defer="title" type="text" name="title"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group form-float col-md-4">
                                            <label class="form-label">ایمیل</label>
                                            <div class="input-group mb-1">
                                                <input wire:model.defer="email" type="email" class="form-control">
                                                <div class="input-group-append">
                                                    <button wire:click="addEmail" wire:loading.attr="disabled"
                                                        wire:target="addEmail" class="btn btn-info m-0" type="button">
                                                        <strong>افزودن</strong>
                                                        <span wire:loading wire:target="addEmail"
                                                            class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                            @isset($emails)
                                                @foreach ($emails as $index => $email)
                                                    <div class="input-group mb-1" wire:key="email-{{ $index }}">
                                                        <input type="text" class="form-control"
                                                            value="{{ $email }}" readonly>
                                                        <div class="input-group-append">
                                                            <button wire:click="removeEmail({{ $index }})"
                                                                wire:loading.attr="disabled"
                                                                wire:target="removeEmail({{ $index }})"
                                                                type="button" class="btn btn-warning m-0"><i
                                                                    class="zmdi zmdi-delete"
                                                                    wire:target="removeEmail({{ $index }})"
                                                                    wire:loading.remove></i>
                                                                <span wire:loading
                                                                    wire:target="removeEmail({{ $index }})"
                                                                    class="spinner-border spinner-border-sm" role="status"
                                                                    aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </div>
                                        <div class="form-group form-float col-md-4">
                                            <label class="form-label">شماره تماس</label>
                                            <div class="input-group mb-1">
                                                <input wire:model.defer="phone" type="number"
                                                    class="form-control without-spin">
                                                <div class="input-group-append">
                                                    <button wire:click="addPhone" wire:loading.attr="disabled"
                                                        wire:target="addPhone" class="btn btn-info m-0" type="button">
                                                        <strong>افزودن</strong>
                                                        <span wire:loading wire:target="addPhone"
                                                            class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                            @isset($phones)
                                                @foreach ($phones as $index => $phone)
                                                    <div class="input-group mb-1" wire:key="phone-{{ $index }}">
                                                        <input type="text" class="form-control"
                                                            value="{{ $phone }}" readonly>
                                                        <div class="input-group-append">
                                                            <button wire:click="removePhone({{ $index }})"
                                                                wire:loading.attr="disabled"
                                                                wire:target="removePhone({{ $index }})"
                                                                type="button" class="btn btn-warning m-0"><i
                                                                    wire:target="removePhone({{ $index }})"
                                                                    wire:loading.remove class="zmdi zmdi-delete"></i>
                                                                <span wire:loading
                                                                    wire:target="removePhone({{ $index }})"
                                                                    class="spinner-border spinner-border-sm" role="status"
                                                                    aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="form-group form-float col-md-4">
                                            <div class="form-line">
                                                <label class="form-label">لینک اینستاگرام </label>
                                                <input type="text" wire:model="instagram" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-4">
                                            <div class="form-line">
                                                <label class="form-label">لینک واتس آپ</label>
                                                <input type="text" wire:model="whatsapp" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group form-float col-md-4">
                                            <div class="form-line">
                                                <label class="form-label">لینک تلگرام</label>
                                                <input type="text" wire:model="telegram" class="form-control">
                                            </div>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <label class="form-label">آدرس</label>
                                                <input wire:model.defer="address" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <label class="form-label">ساعات کاری</label>
                                                <input type="text" class="form-control"
                                                    wire:model.defer="work_days">
                                            </div>
                                        </div>
                                        <div class="w-100"></div>

                                        <div class="form-group col-12 mb-1"><label class="form-label">مکان روی
                                                نقشه:</label></div>
                                        <div class="form-group form-float col-md-6">
                                            <small>طول جغرافیایی</small>
                                            <div class="form-line">
                                                <input type="number" step=any wire:model.defer="longitude"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <small>عرض جغرافیایی</small>
                                                <input type="number" step=any wire:model.defer="latitude"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="form-group col-md-12">
                                            <div class="form-line">
                                                <label class="form-label">توضیحات</label>
                                                <textarea wire:model.defer="description" rows="4" class="form-control no-resize">{{ $description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-line">
                                                <label class="form-label">توضیحات سئو سایت (120~320 کاراکتر) </label>
                                                <textarea wire:model="seo_description" rows="3" @class([
                                                    'form-control no-resize',
                                                    'is-warning' =>
                                                        $seo_description &&
                                                        (strlen($seo_description) < 120 || strlen($seo_description) > 320),
                                                ])></textarea>
                                                @if ($seo_description)
                                                    <small class="mr-2 text-muted"> {{ strlen($seo_description) }}
                                                        کاراکتر </small>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="form-group form-float col-12">
                                            <label class="form-label">لینک های مفید</label>
                                            <div class="input-group mb-2 col-md-6">
                                                <input type="text"
                                                    class="form-control @error('group_name') is-invalid @enderror"
                                                    wire:model.defer="group_name" placeholder="عنوان دسته" />
                                                <div class="input-group-append">
                                                    <button wire:click="addGroupName" wire:loading.attr="disabled"
                                                        wire:target="addGroupName" class="btn btn-info m-0"
                                                        type="button">
                                                        <strong>افزودن</strong>
                                                        <span wire:loading wire:target="addGroupName"
                                                            class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="panel-group" id="accordion_1" role="tablist"
                                                aria-multiselectable="true">
                                                @isset($links)
                                                    @foreach ($links as $index => $parent)
                                                        <div class="panel panel-primary"
                                                            wire:key="heading-{{ $index }}">
                                                            <div class="panel-heading" role="tab"
                                                                id="heading_{{ $index }}">
                                                                <h4 class="panel-title">
                                                                    <div class="row no-gutters align-items-center">
                                                                        <div class="col-10 col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md">
                                                                                    <div class="input-group my-1">
                                                                                        <input type="text"
                                                                                            @class([
                                                                                                'form-control',
                                                                                                'is-invalid' => $errors->has('links.' . $index . '.name'),
                                                                                            ])
                                                                                            wire:model.defer="links.{{ $index }}.name" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-auto">
                                                                                    <button
                                                                                        wire:click="addLink({{ $index }})"
                                                                                        wire:loading.attr="disabled"
                                                                                        wire:target="addLink({{ $index }})"
                                                                                        class="btn btn-info ml-2"
                                                                                        data-collaps-id="${collaps_id}"
                                                                                        type="button"><i
                                                                                            wire:target="addLink({{ $index }})"
                                                                                            wire:loading.remove
                                                                                            class="zmdi zmdi-hc-fw"></i>لینک
                                                                                        <span wire:loading
                                                                                            wire:target="addLink({{ $index }})"
                                                                                            class="spinner-border spinner-border-sm"
                                                                                            role="status"
                                                                                            aria-hidden="true"></span>
                                                                                    </button>
                                                                                    <button
                                                                                        wire:click="removeGroupName({{ $index }})"
                                                                                        wire:loading.attr="disabled"
                                                                                        wire:target="removeGroupName({{ $index }})"
                                                                                        class="btn btn-warning ml-2"
                                                                                        data-collaps-id="${collaps_id}"
                                                                                        type="button"><i
                                                                                            class="zmdi zmdi-delete"
                                                                                            wire:target="removeGroupName({{ $index }})"
                                                                                            wire:loading.remove></i>
                                                                                        <span wire:loading
                                                                                            wire:target="removeGroupName({{ $index }})"
                                                                                            class="spinner-border spinner-border-sm"
                                                                                            role="status"
                                                                                            aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-2 col-md">
                                                                            <a class="text-center text-md-left"
                                                                                role="button" data-toggle="collapse"
                                                                                data-parent="#accordion_1"
                                                                                href="#collapse_{{ $index }}"
                                                                                aria-expanded="true"
                                                                                aria-controls="collapse_{{ $index }}">
                                                                                <span>&#10095</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse_{{ $index }}"
                                                                class="panel-collapse collapse bg-ghostwhite in show"
                                                                role="tabpanel"
                                                                aria-labelledby="heading_{{ $index }}">
                                                                <div class="panel-body">
                                                                    @isset($parent['children'])
                                                                        @foreach ($parent['children'] as $key => $value)
                                                                            <div class="input-group mb-2 mr-2"
                                                                                wire:key="body-{{ $index }}-{{ $key }}">
                                                                                <input
                                                                                    wire:model.defer="links.{{ $index }}.children.{{ $key }}.title"
                                                                                    type="text" @class([
                                                                                        'form-control',
                                                                                        'is-invalid' => $errors->has(
                                                                                            'links.' . $index . '.children.' . $key . '.title'),
                                                                                    ])
                                                                                    placeholder="عنوان لینک">
                                                                                <input
                                                                                    wire:model.defer="links.{{ $index }}.children.{{ $key }}.url"
                                                                                    type="url" @class([
                                                                                        'form-control',
                                                                                        'is-invalid' => $errors->has(
                                                                                            'links.' . $index . '.children.' . $key . '.url'),
                                                                                    ])
                                                                                    placeholder="آدرس لینک">
                                                                                <div class="input-group-append">
                                                                                    <button
                                                                                        wire:click="removeLink({{ $index }},{{ $key }})"
                                                                                        wire:loading.attr="disabled"
                                                                                        wire:target="removeLink({{ $index }},{{ $key }})"
                                                                                        type="button"
                                                                                        class="btn btn-warning m-0"><i
                                                                                            class="zmdi zmdi-delete"
                                                                                            wire:target="removeLink({{ $index }},{{ $key }})"
                                                                                            wire:loading.remove></i>
                                                                                        <span wire:loading
                                                                                            wire:target="removeLink({{ $index }},{{ $key }})"
                                                                                            class="spinner-border spinner-border-sm"
                                                                                            role="status"
                                                                                            aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endisset
                                                                    @empty($parent['children'])
                                                                        <div class="text-center text-muted">لینکی وجود ندارد
                                                                        </div>
                                                                    @endempty
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endisset
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="exampleFormControlFile1">آپلود لوگوی سایت
                                                <span wire:loading wire:target="logo"
                                                    class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span></label>
                                            <div class="custom-file d-flex flex-row-reverse">
                                                <input wire:model="logo" type="file" class="custom-file-input"
                                                    id="customFile" lang="ar" dir="rtl">
                                                <label class="custom-file-label text-right" for="customFile">انتخاب
                                                    عکس</label>
                                            </div>
                                            @if ($logo || $logo_url)
                                                <img src="{{ isset($logo) ? $logo->temporaryUrl() : asset('storage/logo/' . $logo_url) }}"
                                                    class="rounded mx-auto d-block img-fluid img-thumbnail preview-img mt-2">
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-primary waves-effect">
                                        ذخیره
                                        <span wire:loading class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
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
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#addInput', function() {
                    var html = '';
                    html += '<div class="input-group mb-1">';
                    if ($(this).data('input-name') == 'links') {
                        var inputs = $(this).parent().prevAll();
                        html +=
                            `<input type="text" name="links[][title]" class="form-control" value="${inputs[1].value}" readonly>`;
                        html +=
                            `<input type="text" name="links[][url]" class="form-control" value="${inputs[0].value}" readonly>`;
                        inputs.val('');
                    } else {
                        var input = $(this).parent().prev();
                        html +=
                            `<input type="text" name="${$(this).data('input-name')}" class="form-control" value="${input.val()}" readonly>`;
                        input.val('');
                    }
                    html += '<div class="input-group-append">';
                    html +=
                        '<button id="rInput" type="button" class="btn btn-warning m-0"><i class="zmdi zmdi-delete"></i></button>';
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
        <script>
            $(document).ready(function() {
                $('#privacy-summernote').on('summernote.change', function(we, contents, $editable) {
                    Livewire.emit('privacyChanged', contents);
                });
                $('#rules-summernote').on('summernote.change', function(we, contents, $editable) {
                    Livewire.emit('rulesChanged', contents);
                });
                $('#keywords').on('itemAdded', function(event) {
                    Livewire.emit('keywordsChanged', $(this).val());
                });
            });
        </script>
    @endpush
</div>
