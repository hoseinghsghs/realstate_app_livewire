<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>مشاهده قولنامه</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a wire:navigate href={{route('admin.home')}}><i
                                        class="zmdi zmdi-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">قولنامه</a></li>
                        <li class="breadcrumb-item active">مشاهده قولنامه</li>
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
                        <div class="row clearfix">
                            <div class="header col-12">
                                <a class="btn btn btn-raised btn-info waves-effect" wire:navigate
                                   href={{route('admin.agreements.edit',$agreement->id)}}>ویرایش</a>
                            </div>
                            <div class="list-group rounded col-12">
                                <div class="list-group-item list-group-item-primary">
                                    قرارداد {{$agreement->agreement_type==='rental'?'اجاره':'فروش'}}
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام مشاور:</strong></div>
                                        <div class="col-6">{{$agreement->adviser}}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تاریخ عقد قرارداد:</strong></div>
                                        <div class="col-6">{{verta($agreement->agreement_date)->format('Y/m/d')}}</div>
                                    </div>
                                </div>
                                @if($agreement->agreement_type==='rental')
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>مدت اجاره :</strong></div>
                                            <div class="col-6">{{$agreement->rent_term}}</div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>تاریخ شروع قرارداد :</strong></div>
                                            <div class="col-6">{{verta($agreement->start_date)->format('Y/m/d')}}</div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>تاریخ اتمام قرارداد :</strong></div>
                                            <div class="col-6">{{verta($agreement->end_date)->format('Y/m/d')}}</div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>مبلغ رهن :</strong></div>
                                            <div class="col-6">{{number_format($agreement->mortgage_price)}} تومان</div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>مبلغ اجاره :</strong></div>
                                            <div class="col-6">{{number_format($agreement->rent_price)}} تومان</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>مبلغ فروش :</strong></div>
                                            <div class="col-6">{{number_format($agreement->sell_price)}} تومان</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-3 list-group col-md-6">
                                <div class="list-group-item list-group-item-primary">
                                    مشخصات موجر/فروشنده
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام :</strong></div>
                                        <div class="col-6">{{ $agreement->owner_name}}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تاریخ تولد :</strong></div>
                                        <div class="col-6">{{ verta($agreement->owner_birth)->format('Y/m/d')}}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تلفن همراه :</strong></div>
                                        <div class="col-6">{{ $agreement->owner_tel}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 list-group col-md-6">
                                <div class="list-group-item list-group-item-primary">
                                    مشخصات مستاجر/خریدار
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام :</strong></div>
                                        <div class="col-6">{{ $agreement->customer_name}}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تاریخ تولد :</strong></div>
                                        <div class="col-6">{{ verta($agreement->customer_birth)->format('Y/m/d')}}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تلفن همراه :</strong></div>
                                        <div class="col-6">{{ $agreement->customer_tel}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 list-group col-12">
                                <div class="list-group-item list-group-item-primary">
                                    توضیحات
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    {{ $agreement->description }}
                                </div>
                            </div>

                            @if($photos && count($photos)>0 )
                                <div class="mt-3 list-group col-12">
                                    <div class="list-group-item list-group-item-primary">
                                        عکس قولنامه / چک
                                    </div>
                                    <div class="mt-3 d-flex flex-wrap rounded border border-secondary shadow-md bg-light p-1">
                                        @foreach($photos as $key=> $image)
                                            <div wire:key="default-{{$key}}"
                                                 class="position-relative  mx-2 my-1" style="width: 25%">
                                                <a href={{asset('storage/'.$image->url)}}>
                                                    <img width="100%" class="rounded border shadow-md"
                                                         src="{{ url('storage/'.$image->url) }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
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