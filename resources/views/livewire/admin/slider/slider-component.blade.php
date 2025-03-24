<div>
    @section('title', 'لیست اسلایدر ها')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>مدیریت اسلایدر ها</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item active">مدیریت اسلایدر ها</li>
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
                <!-- add slider -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="form-group col-md-6 col-sm-12 @error('title') is-invalid @enderror">
                                        <label>عنوان<abbr class="required" title="ضروری"
                                                style="color:red;">*</abbr></label>
                                        <input type="text" name="title" wire:model.defer="title"
                                            class="form-control">
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group col-md-6 col-sm-12 @error('description') is-invalid @enderror">
                                        <label class="form-label">محل قرار گیری</label>
                                        <select name="position" wire:model.live="position" class="form-control"
                                            required>
                                            <option>
                                                اسلایدر
                                            </option>
                                            <option>بنر</option>
                                            <option>
                                                تصویرسرویس
                                            </option>

                                        </select>
                                    </div>

                                    <div class="form-group col-12 @error('description') is-invalid @enderror">
                                        <label>توضیحات<abbr class="required" title="ضروری"
                                                style="color:red;">*</abbr></label>
                                        <textarea class="form-control" rows="9" wire:model.defer="description">{!! $description !!}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="form-group col-12 @error('image') is-invalid @enderror">
                                        <label class="form-label" for="exampleFormControlFile1">آپلود
                                            تصویر <span wire:loading wire:target="image"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span></label>
                                        <div class="custom-file d-flex flex-row-reverse">
                                            <input onchange="validateImage(this)" wire:model.defer.live="image"
                                                type="file" class="custom-file-input" id="customFile" lang="ar"
                                                dir="rtl">
                                            <label class="custom-file-label text-right" for="customFile">
                                            </label>
                                        </div>
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    @if ($this->image)
                                        <img src="{{ $this->image->temporaryUrl() }}"
                                            style="border: #00ff40 2px solid ; border-radius: 0.5rem" height="300rem">
                                    @else
                                        @isset($slider->image)
                                            </hr>
                                            <div class="col-lg-12">
                                                <a href="{{ asset('storage/slider/' . $slider->image) }}" class="file"
                                                    target="_blank">
                                                    <div class="image">
                                                        <img src="{{ asset('storage/slider/' . $slider->image) }}"
                                                            alt="img" class="img-fluid">
                                                    </div>
                                                </a>
                                            </div>
                                        @endisset
                                    @endif
                                </div>

                                <div class="row clearfix mt-4">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="checkbox">
                                            <input id="status" class="form-group" type="checkbox"
                                                wire:model.defer='status'>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <label for="status">انتشار
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-12">
                                    @if ($is_edit)
                                        <button wire:click="add_slider" wire:loading.attr="disabled"
                                            class="btn btn-raised btn-warning waves-effect">
                                            ویرایش
                                            <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                wire:target="add_slider"></span>
                                        </button>
                                    @elseif(!$is_edit)
                                        <button wire:click="add_slider" wire:loading.attr="disabled"
                                            class="btn btn-raised btn-primary waves-effect">
                                            افزودن
                                            <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                wire:target="add_slider"></span>
                                        </button>
                                    @endif

                                    @if ($is_edit)
                                        <button class="btn btn-raised btn-info waves-effect"
                                            wire:loading.attr="disabled" wire:click="ref">صرف نظر
                                            <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                wire:target="ref"></span>
                                        </button>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
            <!-- لیست -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div>
                            <h5 style="display: inline; color: #e47297; float: right;"><strong>لیست اسلایدر ها
                                </strong>
                                ({{ $sliders->total() }})
                            </h5>
                        </div>
                        <div class="body">
                            @if (count($sliders) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>تصویر</th>
                                                <th>عنوان</th>
                                                <th>توضیحات</th>
                                                <th>وضعیت</th>
                                                <th>تاریخ ثبت درخواست</th>
                                                <th>تاریخ بروز رسانی</th>
                                                <th class="text-center js-sweetalert">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $slider)
                                                <tr wire:key="{{ $slider->id }}" wire:loading.attr="disabled">
                                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        @if ($slider->image)
                                                            <a href="{{ asset('storage/slider/' . $slider->image) }}"
                                                                data-lightbox="slider-{{ $slider->id }}"
                                                                data-title={{ $slider->title }}><img
                                                                    class="rounded avatar"
                                                                    src="{{ asset('storage/slider/' . $slider->image) }}"
                                                                    width="55" alt={{ $slider->title }}></a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $slider->title }}</td>
                                                    <td>{{ $slider->description }}</td>
                                                    <td>
                                                        @if ($slider->status)
                                                            <span class='badge badge-success'> فعال </span>
                                                        @else
                                                            <span class='badge badge-danger'>غیر فعال </span>
                                                        @endif

                                                    </td>
                                                    </td>
                                                    <td>{{ verta($slider->created_at)->format('Y-n-j H:i') }}
                                                    </td>
                                                    <td>{{ verta($slider->updated_at)->format('Y-n-j H:i') }}
                                                    </td>
                                                    <td class="text-center js-sweetalert">
                                                        <button wire:click="edit_slider({{ $slider->id }})"
                                                            wire:loading.attr="disabled" {{ $display }}
                                                            class="btn btn-raised btn-info waves-effect scroll">
                                                            <i class="zmdi zmdi-edit"></i>
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="edit_slider({{ $slider->id }}) "></span>
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
            <!-- پایان لیست -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">

                        {{ $sliders->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>

</div>
</section>
@push('scripts')
    <script>
        $('.scroll').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    </script>
@endpush
</div>
