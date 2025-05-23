    @section('title', 'لیست اخبار')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>مدیریت اخبار</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item active">مدیریت اخبار</li>
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
                <!-- add post -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="form-group col-12 @error('title') is-invalid @enderror">
                                        <label>عنوان <abbr class="required" title="ضروری"
                                                style="color:red;">*</abbr></label>
                                        <input type="text" name="title" wire:model.defer="title"
                                            class="form-control">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="form-group col-12 @error('description') is-invalid @enderror">
                                        <label> خلاصه خبر <abbr class="required" title="ضروری"
                                                style="color:red;">*</abbr></label>
                                        <textarea class="form-control" rows="9" wire:model.defer="description">{!! $description !!}</textarea>
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 @error('body') is-invalid @enderror">
                                        <label for="summernote">متن<abbr class="required" title="ضروری"
                                                style="color:red;">*</abbr></label>

                                        <div wire:ignore>
                                            <textarea id="summernote" wire:key="summernote"></textarea>
                                        </div>
                                        @error('body')
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
                                        <div class="col-lg-12">
                                            <img src="{{ $this->image->temporaryUrl() }}"
                                                style="border: #00ff40 2px solid ; border-radius: 0.5rem"
                                                height="300rem">
                                        </div>
                                    @else
                                    @isset($post->image)
                                    </hr>
                                    <div class="col-lg-12">
                                        <a href="{{ asset('storage/' . $post->image->url) }}" class="file"
                                            target="_blank">
                                            <div class="image">
                                                <img src="{{ asset('storage/' . $post->image->url) }}"
                                                    style="border: #00c3ff 2px solid ; border-radius: 0.5rem ; width: 25%"
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
                                    <button wire:click="add_post" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-warning waves-effect">
                                        ویرایش
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="add_post"></span>
                                    </button>
                                    @elseif(!$is_edit)
                                    <button wire:click="add_post" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-primary waves-effect">
                                        افزودن
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="add_post"></span>
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
                            <h5 style="display: inline; float: right; color:#e47297"><strong>لیست اخبار </strong>
                                ({{ $posts->total() }})
                            </h5>
                        </div>
                        <div class="body">
                            @if (count($posts) === 0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover c_table theme-color">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>تصویر</th>
                                            <th>عنوان</th>
                                            <th>خلاصه تیتر</th>
                                            <th>وضعیت</th>
                                            <th>ثبت کننده</th>
                                            <th>تاریخ ثبت درخواست</th>
                                            <th>تاریخ بروز رسانی</th>
                                            <th class="text-center js-sweetalert">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                        <tr wire:key="{{ $post->id }}" wire:loading.attr="disabled">
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>
                                                @if ($post->image)
                                                <a href="{{ asset('storage/' . $post->image->url) }}"
                                                    data-lightbox="post-{{ $post->id }}"
                                                    data-title={{ $post->title }}><img
                                                        class="rounded avatar"
                                                        src="{{ asset('storage/' . $post->image->url) }}"
                                                        width="55" alt={{ $post->title }}></a>
                                                @endif
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->description }}</td>
                                            <td>
                                                @if ($post->status)
                                                <span class='badge badge-success'> فعال </span>
                                                @else
                                                <span class='badge badge-danger'>غیر فعال </span>
                                                @endif
                                            </td>
                                            </td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ verta($post->created_at)->format('Y-n-j H:i') }}
                                            </td>
                                            <td>{{ verta($post->updated_at)->format('Y-n-j H:i') }}
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <button wire:click="edit_post({{ $post->id }})"
                                                    wire:loading.attr="disabled" {{ $display }}
                                                    class="btn btn-raised btn-info waves-effect scroll">
                                                    <i class="zmdi zmdi-edit"></i>
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading
                                                        wire:target="edit_post({{ $post->id }}) "></span>
                                                </button>
                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    wire:loading.attr="disabled"
                                                    wire:click="destroy({{ $post->id }})"
                                                    wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
                                                    {{ $display }}>
                                                    <i class="zmdi zmdi-delete"></i>
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading
                                                        wire:target="destroy({{ $post->id }})"></span>
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

                        {{ $posts->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <head>
        <script data-navigate-track>
            document.addEventListener('livewire:navigated', function() {
                initSummernote();
            });
            document.addEventListener('init-summernote', function() {
                initSummernote();
            });

            function initSummernote() {
                if (window.jQuery && $('#summernote').length) {
                    // Destroy نمونه های موجود Summernote
                    $(document).ready(function() {
                        let secondSummernote = $('.note-editor').eq(1); // گرفتن دومین نمونه‌ی Summernote
                        if (secondSummernote.length > 0) {
                            secondSummernote.remove(); // حذف دومین نمونه از صفحه
                        }
                    });
                    // مقداردهی اولیه Summernote
                    $('#summernote').summernote({
                        height: 200,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
                    // نمایش محتوای قبلی در حالت ویرایش
                    if (@this.is_edit) {
                        $('#summernote').summernote('code', @this.body);
                    } else {
                        $('#summernote').summernote('code', ''); // پاک کردن محتوا در حالت افزودن/صرف نظر
                    }

                    $('#summernote').on('summernote.change', function(we, contents, $editable) {
                        console.log(contents);
                        @this.set('body', contents);
                    });
                    $('#summernote').addClass('summernote-loaded');
                }
            }
        </script>
    </head>

    @push('scripts')
    <script>
        $('.scroll').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
        $(document).ready(function() {
            $('#summernote').on('summernote.change', function(we, contents, $editable) {
                @this.set('body', contents);
            });
        });
    </script>
    @endpush