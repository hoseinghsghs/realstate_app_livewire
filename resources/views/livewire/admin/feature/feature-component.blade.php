@section('title', 'امکانات ')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>امکانات </h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item active">امکانات </li>
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
            <!-- add section -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-4 col-sm-6">
                                    <input type="text" placeholder="عنوان" title="name" wire:model.defer="name"
                                        class="form-control">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-auto">
                                    <button wire:click="add_feature" wire:loading.attr="disabled"
                                        class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                        {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="add_feature"></span>
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
                        <div class="header">
                            <h2><strong>لیست امکانات </strong>
                                ({{ $features->total() }})
                            </h2>
                        </div>
                        <div class="body">
                            @if (count($features) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>عنوان</th>
                                                <th class="text-center js-sweetalert">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($features as $feature)
                                                <tr wire:key="{{ $feature->id }}" wire:loading.attr="disabled">
                                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                                    <td>{{ $feature->name }}</td>
                                                    <td class="text-center js-sweetalert">
                                                        <button wire:click="edit_feature({{ $feature->id }})"
                                                            wire:loading.attr="disabled" {{ $display }}
                                                            class="btn btn-raised btn-info waves-effect scroll">
                                                            <i class="zmdi zmdi-edit"></i>
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="edit_feature({{ $feature->id }}) "></span>
                                                        </button>

                                                        <button class="btn btn-raised btn-danger waves-effect"
                                                            wire:loading.attr="disabled"
                                                            wire:click="del_feature({{ $feature->id }})"
                                                            wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
                                                            {{ $display }}>
                                                            <i class="zmdi zmdi-delete"></i>
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="del_feature({{ $feature->id }})"></span>
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
                        {{ $features->onEachSide(1)->links() }}
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
