@section('title', 'لیست سرویس ها')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>مدیریت سرویس ها</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> مدیریت سرویس ها </a></li>
                        <li class="breadcrumb-item active"> سرویس ها</li>
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
            <!-- add Service -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-3 col-sm-6">
                                    <label>عنوان</label>
                                    <input type="text" name="name" wire:model.defer="title" class="form-control">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <small> برای گرفتن نام آیکن ها روی این لینک کلیک کنید و نام آیکن را در فیلد زیر
                                        قرار دهید <a href="https://materializecss.com/icons.html"
                                            target="_blank">Materialize
                                            Icon</a></small>
                                    <label> آیکن </label>
                                    <input type="text" name="icon" wire:model.defer="icon" class="form-control">
                                    @error('icon')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <label>مرتب سازی
                                    </label>
                                    <input type="number" name="service_order" wire:model.defer="service_order"
                                        class="form-control">
                                    @error('service_order')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 @error('description') is-invalid @enderror mt-3">
                                    <label>توضیحات</label>
                                    <div>
                                        <textarea class="form-control" rows="6" wire:model.defer="description">{!! $description !!}</textarea>
                                    </div>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>



                                <div class="col-auto">
                                    <button wire:click="add_services" wire:loading.attr="disabled"
                                        class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                        {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="add_services"></span>
                                    </button>
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


                        <div class="body">
                            @if (count($services) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>عنوان</th>
                                                <th>آیکن</th>
                                                <th>مرتب سازی</th>
                                                <th class="text-center js-sweetalert">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $Service)
                                                <tr wire:key="{{ $Service->id }}" wire:loading.attr="disabled">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $Service->title }}</td>
                                                    <td>{{ $Service->icon }}</td>
                                                    <td>{{ $Service->service_order }}</td>
                                                    <td class="text-center js-sweetalert">
                                                        <button wire:click="edit_service({{ $Service->id }})"
                                                            wire:loading.attr="disabled" {{ $display }}
                                                            class="btn btn-raised btn-info waves-effect scroll">
                                                            <i class="zmdi zmdi-edit"></i>
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="edit_service({{ $Service->id }}) "></span>
                                                        </button>

                                                        {{-- <button class="btn btn-raised btn-danger waves-effect"
                                                            wire:loading.attr="disabled"
                                                            wire:click="del_Service({{ $Service->id }})"
                                                wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
                                                {{ $display }}>
                                                <i class="zmdi zmdi-delete"></i>
                                                <span class="spinner-border spinner-border-sm text-light" wire:loading wire:target="del_Service({{ $Service->id }})"></span>
                                                </button> --}}
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
                        {{ $services->onEachSide(1)->links() }}
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
