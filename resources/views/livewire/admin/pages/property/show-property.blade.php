<div>
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>نمایش ملک</h2>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">لیست املاک</a></li>
                            <li class="breadcrumb-item active">نمایش ملک</li>
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
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-dark">

                                    مشخصات اصلی ملک

                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>کد ملک:</strong></div>
                                        <div class="col-6">{{ $property->code }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>عنوان:</strong></div>
                                        <div class="col-6">{{ $property->title }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>وضعیت انتشار:</strong></div>
                                        <div class="col-6">
                                            @if ($property->isactive)
                                                <span class="badge badge-success">منتشر شده</span>
                                            @else
                                                <span class="badge badge-danger">منتشر نشده</span>
                                            @endif
                                        </div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>لیبل:</strong></div>
                                        <div class="col-6">{{ $property->lable }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نوع معامله:</strong></div>
                                        <div class="col-6">{{ $property->tr_type }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نوع کابری:</strong></div>
                                        <div class="col-6">{{ $property->usertype }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نوع:</strong></div>
                                        <div class="col-6">{{ $property->type }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>کد ملک:</strong></div>
                                        <div class="col-6">{{ $property->id }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تعداد خواب:</strong></div>
                                        <div class="col-6">{{ $property->bedroom }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>طبقه مورد معامله:</strong></div>
                                        <div class="col-6">{{ $property->floorsell }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تعداد طبقات:</strong></div>
                                        <div class="col-6">{{ $property->floor }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>قدمت ساخت:</strong></div>
                                        <div class="col-6">{{ $property->year }} سال </div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>مساحت زمین:</strong></div>
                                        <div class="col-6">{{ $property->area }} متر مربع </div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>متراژ زیر بنا:</strong></div>
                                        <div class="col-6">{{ $property->meter }}</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class=" list-group">
                                        <button type="button" class="list-group-item list-group-item-dark">
                                            موقعیت مکانی </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>استان:</strong></div>
                                                <div class="col-6">{{ $property->province }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>شهر:</strong></div>
                                                <div class="col-6">{{ $property->city }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>محله:</strong></div>
                                                <div class="col-6">{{ $property->district }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>طول جغرافیایی:</strong></div>
                                                <div class="col-6">{{ $property->lon }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>عرض جغرافیایی:</strong></div>
                                                <div class="col-6">{{ $property->lat }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-12"><strong>آدرس:</strong></div>
                                                <div class="col-12">{{ $property->address }}</div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="card">
                                    <div class=" list-group">
                                        <button type="button" class="list-group-item list-group-item-dark">
                                            اطلاعات مربوط به خرید ملک
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>وام بانکی
                                                        :</strong></div>
                                                <div class="col-6">{{ $property->loan }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>مبلغ وام
                                                        :</strong></div>
                                                <div class="col-6">
                                                    {{ $property->loanamount == null ? '' : number_format($property->loanamount) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>قیمت متری:</strong></div>
                                                <div class="col-6">
                                                    {{ $property->meter_price == null ? '' : number_format($property->meter_price) }}
                                                    تومان
                                                </div>

                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>قیمت پیشنهادی:</strong></div>
                                                <div class="col-6">
                                                    {{ $property->bidprice == null ? '' : number_format($property->bidprice) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>قیمت کارشناسی:</strong></div>
                                                <div class="col-6">
                                                    {{ $property->ugprice == null ? '' : number_format($property->ugprice) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-dark">
                                    اطلاعات مربوط به اجاره</button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تعداد نفرات:</strong></div>
                                        <div class="col-6">{{ $property->people_number }}</div>

                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>مبلغ اجاره:</strong></div>
                                        <div class="col-6">
                                            {{ $property->rent == null ? '' : number_format($property->rent) }}
                                            تومان
                                        </div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>مبلغ رهن:</strong></div>
                                        <div class="col-6">
                                            {{ $property->rahn == null ? '' : number_format($property->rahn) }}

                                            تومان
                                        </div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تغیر اجاره و رهن:</strong></div>
                                        <div class="col-6">
                                            @if ($property->ischenge)
                                                <span class="badge badge-success">قابل تغییر</span>
                                            @else
                                                <span class="badge badge-danger"> غیر قابل تغییر</span>
                                            @endif


                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-dark">
                                    مشخصات مالک</button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام نام خانوادگی
                                                :</strong></div>
                                        <div class="col-6">{{ $property->name_family }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>شماره تلفن:</strong></div>
                                        <div class="col-6">{{ $property->telephone }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>شماره موبایل:</strong></div>
                                        <div class="col-6">{{ $property->phone }}</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- سایر مشخصات -->
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-dark">
                                    سایر مشخصات</button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نوع سند:</strong></div>
                                        <div class="col-6">{{ $property->doc }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>ابعاد:</strong></div>
                                        <div class="col-6">{{ $property->dimension }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نما:</strong></div>
                                        <div class="col-6">{{ $property->view }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>درب ورودی:</strong></div>
                                        <div class="col-6">{{ $property->door }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>کفپوش:</strong></div>
                                        <div class="col-6">{{ $property->cover }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>خط تلفن
                                                :</strong></div>
                                        <div class="col-6">{{ $property->phone_line }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>سیستم برودتی:</strong></div>
                                        <div class="col-6">{{ $property->cool }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>سیستم حرارتی
                                                :</strong></div>
                                        <div class="col-6">{{ $property->heat }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>کابینت
                                                :</strong></div>
                                        <div class="col-6">{{ $property->cabinet }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تعداد واحد های مجموعه:</strong></div>
                                        <div class="col-6">{{ $property->collection }}</div>
                                    </div>
                                </button>


                            </div>
                        </div>
                    </div>
                    <!-- امکانات -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-dark">
                                    امکانات</button>
                                @if (!$property->features->isEmpty())
                                    @foreach ($property->features as $feature)
                                        <button type="button" class="list-group-item list-group-item-action">
                                            {{ $feature->name }}
                                        </button>
                                    @endforeach
                                @else
                                    <button type="button" class="list-group-item list-group-item-action">
                                        وجود ندارد
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>


                </div>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-dark">
                                    توضیحات</button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{{ $property->description }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-dark">
                                    توضیحات مشاور</button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{{ $property->agent_description }}</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h5 style="color:#04BE5B">تصویر پیش نمایش</h5>
                <hr>
                <div class="row clearfix">
                    @if (isset($property->img))
                        <div class="col-12 mb-5">
                            <img src="{{ asset('storage/preview/' . $property->img) }}" />
                        </div>
                    @else
                        تصویر وجود ندارد
                    @endif




                </div>

                <br>
                <h5 style="color:#04BE5B">سایر تصاویر</h5>
                <hr>
                <div class="row clearfix">
                    @if ($property->images->isEmpty())
                        تصویر وجود ندارد
                    @else
                        @foreach ($property->images as $image)
                            <div class="col-sm-4 mb-3">
                                <img src="{{ asset('storage/otherpreview/' . $image->name) }}" />
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
