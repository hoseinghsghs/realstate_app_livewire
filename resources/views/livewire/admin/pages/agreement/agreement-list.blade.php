<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col">
                    <h2>لیست قولنامه ها</h2>
                    <ul class="breadcrumb mt-3">
                        <li class="breadcrumb-item"><a wire:navigate href={{ route('admin.home') }}><i
                                    class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">قولنامه</a></li>
                        <li class="breadcrumb-item active">لیست قولنامه ها</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-auto">
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
                        <div class="header d-flex align-items-center justify-content-between">
                            <h2>
                                <strong>جست و جو</strong>
                            </h2>
                            <a wire:navigate href="{{ route('admin.agreements.create') }}"
                                class="btn btn-raised btn-info waves-effect">
                                <i class="zmdi zmdi-plus align-middle"></i> افزودن </a>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                    {{--                                    <label class="form-label">نوع قرارداد</label> --}}
                                    <select name="agreement_type" id="typeSelector" wire:model.live="agreement_type"
                                        class="form-control show-tick ms @error('form.agreement_type') is-invalid @enderror"
                                        data-placeholder="انتخاب کنید" required>
                                        <option value="">نوع قرارداد</option>
                                        <option value="rental">اجاره نامه</option>
                                        <option value="sale">فروش</option>
                                    </select>
                                    @error('form.agreement_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                    <input type="text"
                                        class="form-control @error('name_lastname') is-invalid @enderror"
                                        wire:model.live.debounce.500ms="name_lastname" placeholder="نام، نام خانوادگی">
                                    @error('name_lastname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                    <div class="input-group" wire:ignore>
                                        <div class="input-group-prepend" onclick="$('#agreement-date').focus();">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="zmdi zmdi-calendar-alt"></i></span>
                                        </div>
                                        <input type="hidden" id="agreement-date-alt" name="receive_date">
                                        <input type="text" class="form-control" placeholder="تاریخ قرارداد"
                                            id="agreement-date" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="destroy-agreement-date"
                                                style="cursor: pointer;"><i class="zmdi zmdi-close"></i></span>
                                        </div>
                                    </div>
                                    @error('receive_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="header">
                            <h2>
                                <strong>لیست قولنامه ها</strong>
                            </h2>
                        </div>
                        <div class="body">
                            @if (count($agreements) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نوع قولنامه</th>
                                                <th>تاریخ قرارداد</th>
                                                <th>موجر/فروشنده</th>
                                                <th>مستاجر/خریدار</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($agreements as $key => $agreement)
                                                <tr wire:key="{{ $agreement->id }}">
                                                    <td>{{ $agreements->firstItem() + $key }}</td>
                                                    <td>{{ $agreement->agreement_type === 'rental' ? 'اجاره' : 'فروش' }}</td>
                                                    <td dir="ltr">
                                                        {{ verta($agreement->agreement_date)->format('Y/m/d') }}</td>
                                                    <td>{{ $agreement->owner_name }}</td>
                                                    <td>{{ $agreement->customer_name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.agreements.show', $agreement->id) }}"
                                                            class="btn btn-raised btn-primary waves-effect"
                                                            wire:navigate>
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.agreements.edit', $agreement->id) }}"
                                                            class="btn btn-raised btn-info waves-effect" wire:navigate>
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                        <a class="btn btn-raised btn-danger waves-effect"
                                                            wire:click="delete_agreement({{ $agreement->id }})"><i
                                                                class="zmdi zmdi-delete text-light"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $agreements->onEachSide(1)->links() }}
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

@push('styles')
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" />
@endpush

@script
    <script>
        $(document).ready(async function() {

            const agreementDate = $("#agreement-date").pDatepicker({
                format: 'L',
                initialValue: false,
                altField: `#agreement-date-alt`,
                altFormat: 'g',
                timePicker: {
                    enabled: true,
                    second: {
                        enabled: false
                    },
                },
                altFieldFormatter: function(unixDate) {
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
                onSelect: function(unix) {
                    @this.
                    set(`agreement_date`, $(`#agreement-date-alt`).val(), true);
                },
            })

            $('#destroy-agreement-date').click(function() {
                $(`#agreement-date`).val(null);
                $(`#agreement-date-alt`).val(null);
                agreementDate.touched = false;
                agreementDate.options = {
                    initialValue: false
                }
                @this.set(`agreement_date`, null, true);
            })
        })
    </script>
@endscript
