<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col">
                    <h2>لیست قولنامه ها</h2>
                    <ul class="breadcrumb mt-3">
                        <li class="breadcrumb-item"><a wire:navigate href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
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
                        <div class="header d-flex align-items-center justify-content-end">
                            {{-- <h2><strong>لیست پرونده </strong> ( {{ $dossier }} )</h2> --}}
                                <a wire:navigate href="{{route('admin.agreements.create')}}"
                                   class="btn btn-raised btn-info waves-effect">
                                    <i class="zmdi zmdi-plus align-middle"></i> افزودن </a>
                        </div>
                        <div class="body">
                            @if(count($agreements)===0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-1 col-form-label">جستجو </label>
                                    <div class="col-sm-11">
                                        <input id="searchInput" class="form-control col-md-3"
                                               placeholder="یک عبارت بنویسید....">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th>نوع قولنامه</th>
                                            <th>تاریخ قرارداد</th>
                                            <th>موجر/فروشنده</th>
                                            <th>مستاجر/خریدار</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($agreements as $agreement)
                                            <tr wire:key="{{$agreement->id}}">
                                                <td>{{$agreement->id}}</td>
                                                <td>{{$agreement->agreement_type==='rental'?'اجاره':"فروش"}}</td>
                                                <td dir="ltr">{{verta( $agreement->agreement_date)->format('Y/m/d')}}</td>
                                                <td>{{$agreement->owner_name}}</td>
                                                <td>{{$agreement->customer_name}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('admin.agreements.show',$agreement->id)}}"
                                                       class="btn btn-raised btn-primary waves-effect"
                                                       wire:navigate>
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </a>
                                                    <a href="{{route('admin.agreements.edit',$agreement->id)}}"
                                                       class="btn btn-raised btn-info waves-effect"
                                                       wire:navigate>
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <a class="btn btn-raised btn-danger waves-effect"
                                                       wire:click="delete_agreement({{$agreement->id}})"><i
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
