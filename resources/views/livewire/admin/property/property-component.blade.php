<div>
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>لیست املاک</h2>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">املاک</a></li>
                            <li class="breadcrumb-item active">لیست املاک</li>
                        </ul>
                        </br>
                        <a href="/admin/properties/create" wire:navigate class="btn btn-raised btn-info waves-effect">
                            اضافه کردن ملک </a>
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
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <form wire:submit.prevent="$refresh">
                                <div class="header">
                                    <h2>
                                        جست و جو
                                    </h2>
                                </div>
                                {{-- <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                        wire:model.live.debounce.500ms="ids" placeholder="کد یکتا">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                        wire:model.live.debounce.500ms="title"
                                                        placeholder="نام شواهد دیجیتال، کد">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select data-placeholder="وضعیت" wire:model.live="is_active"
                                                        class="form-control ms">
                                                        <option value="">وضعیت</option>
                                                        <option value="1">فعال</option>
                                                        <option value="0">غیرفعال</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @hasanyrole(['Super Admin', 'viewer'])
                                            @php($laboratories = \App\Models\Laboratory::all())
                                            <div
                                                class="form-group col-md-3 col-sm-3 @error('laboratory_id') is-invalid @enderror">
                                                <div wire:ignore>
                                                    <select id="laboratorySelect" wire:model.live="laboratory_id_search"
                                                        data-placeholder="انتخاب آزمایشگاه"
                                                        class="form-control ms search-select">
                                                        <option></option>
                                                        @foreach ($laboratories as $laboratory)
                                                            <option value={{ $laboratory->id }}>
                                                                {{ $laboratory->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @php($dossiers = \App\Models\Dossier::all())
                                            <div
                                                class="form-group col-md-3 col-sm-3 @error('dossier_id') is-invalid @enderror">
                                                <div wire:ignore>
                                                    <select id="dossierSelect" wire:model.live="dossier_id_search"
                                                        data-placeholder="انتخاب پرونده"
                                                        class="form-control ms search-select">
                                                        <option></option>
                                                        @foreach ($dossiers as $dossier)
                                                            <option value={{ $dossier->id }}>
                                                                {{ $dossier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endhasanyrole
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select data-placeholder="موجودی" wire:model.live="status"
                                                        class="form-control ms">
                                                        <option value="">وضعیت بررسی (همه)</option>
                                                        <option value="0">پذیرش شواهد دیجیتال</option>
                                                        <option value="1">در حال بررسی</option>
                                                        <option value="2"> تکمیل تجزیه و تحلیل
                                                        </option>
                                                        <option value="3">خروج شواهد دیجیتال</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                            <div class="input-group" wire:ignore>
                                                <div class="input-group-prepend" onclick="$('#CreateDate').focus();">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="zmdi zmdi-calendar-alt"></i></span>
                                                </div>
                                                <input type="hidden" id="CreateDate-alt" name="receive_date">
                                                <input type="text" class="form-control" placeholder="تاریخ پذیرش"
                                                    id="CreateDate" value="{{ $Judicial_date ?? null }}"
                                                    autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1"
                                                        style="cursor: pointer;" onclick="destroyDatePicker()"><i
                                                            class="zmdi zmdi-close"></i></span>
                                                </div>
                                            </div>
                                            @error('receive_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}
                            </form>
                            {{-- <div class="header d-flex align-items-center">
                                <h2><strong>لیست شواهد دیجیتال </strong> ( {{ $devices->total() }} )</h2>
                                <div class="mr-auto">
                                    @can('devices-create')
                                        <a onclick="loadbtn(event)" href="{{ route('admin.devices.create') }}"
                                            class="btn btn-raised btn-info waves-effect mr-auto">
                                            افزودن<i class="zmdi zmdi-plus mr-1"></i></a>
                                    @endcan
                                    @can('devices-export')
                                        <a onclick="loadbtn(event)" href="{{ route('admin.file-device') }}"
                                            class="btn btn-raised btn-warning waves-effect ">
                                            خروجی شواهد دیجیتال<i class="zmdi zmdi-developer-board mr-1"></i></a>
                                    @endcan
                                    @can('actions-export')
                                        <a onclick="loadbtn(event)" href="{{ route('admin.file-action') }}"
                                            class="btn btn-raised btn-warning waves-effect ml-4 ">
                                            خروجی اقدامات <i class="zmdi zmdi-developer-board mr-1"></i></a>
                                    @endcan
                                </div>
                            </div> --}}
                            <div class="body">
                                <div class="loader" wire:loading.flex>
                                    درحال بارگذاری ...
                                </div>
                                @if ($properties->count() === 0)
                                    <p>هیچ رکوردی وجود ندارد</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover c_table theme-color">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>کد ملک</th>
                                                    <th>نام ثبت کننده</th>
                                                    <th>عنوان</th>
                                                    <th>نوع معامله</th>
                                                    <th>وضعیت</th>
                                                    <th class="text-center js-sweetalert">عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($properties as $key => $property)
                                                    <tr wire:key="name_{{ $property->id }}">

                                                        <td scope="row">{{ $key + 1 }}</td>
                                                        <td>{{ $property->code }}</td>
                                                        <td>
                                                            {{ $property->user->name }}
                                                            @if ($property->user->role_id === 1)
                                                                (ادمین)
                                                            @elseif ($property->user->role_id === 2)
                                                                (مشاور)
                                                            @elseif ($property->user->role_id === 3)
                                                                (کاربر)
                                                            @endif
                                                        </td>
                                                        <td>{{ $property->title }}</td>
                                                        <td>{{ $property->tr_type }}</td>
                                                        <td>
                                                            <div class="row clearfix">

                                                                <div class="col-6">
                                                                    @if ($property->isactive)
                                                                        <span class="badge badge-success">منتشر
                                                                            شده</span>
                                                                    @else
                                                                        <span class="badge badge-danger">منتشر
                                                                            نشده</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="text-center js-sweetalert">


                                                            <a onclick="loadbtn(event)"
                                                                href="/admin/properties/{{ $property->id }}/edit"
                                                                class="btn btn-raised btn-info waves-effect">
                                                                ویرایش
                                                            </a>
                                                            <a onclick="loadbtn(event)"
                                                                href="/admin/properties/show/{{ $property->id }}"
                                                                wire:navigate
                                                                class="btn btn-raised btn-info waves-effect">
                                                                نمایش
                                                            </a>
                                                            <button class="btn btn-raised btn-danger waves-effect"
                                                                data-type="confirm"
                                                                data-form-id="del-property-{{ $property->id }}">حذف</button>
                                                            <form
                                                                action="{{ route('admin.properties.destroy', $property->id) }}"
                                                                id="del-property-{{ $property->id }}" method="POST">
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
                        {{ $properties->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>



    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#searchInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endpush

</div>
