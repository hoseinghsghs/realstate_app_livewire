<div>
    <section class="content">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>داشبورد</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><i class="zmdi zmdi-home"></i> خانه</li>
                        <li class="breadcrumb-item active">داشبورد</li>
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
        @can('is_admin')
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card info-box-2">
                            <div class="body bg-red">
                                <i class="zmdi zmdi-home zmdi-hc-4x"></i>
                                <div class="content col-12">
                                    <div class="text">املاک ثبت شده</div>
                                    <div class="number">{{ $propertycount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card info-box-2">
                            <div class="body bg-green">

                                <i class="zmdi zmdi-account zmdi-hc-4x"></i>

                                <div class="content col-12">
                                    <div class="text">تعداد کاربران</div>
                                    <div class="number">{{ $usercount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card info-box-2">
                            <div class="body bg-blue">
                                <i class="zmdi zmdi-comment-text zmdi-hc-4x"></i>
                                <div class="content col-12">
                                    <div class="text">مجموع پست ها و اخبار</div>
                                    <div class="number">{{ $postcount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card info-box-2">
                            <div class="body bg-amber">
                                <i class="zmdi zmdi-assignment zmdi-hc-4x"></i>
                                <div class="content col-12">
                                    <div class="text">تعداد قولنامه ها</div>
                                    <div class="number">{{ $agreementcount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong><i class="zmdi zmdi-chart"></i> گزارش</strong> املاک ثبت شده</h2>
                            </div>
                            <div class="body">
                                <div id="chart-area-spline-sracked" class="c3_chart d_sales"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong> درصد </strong> نوع معامله </h2>
                            </div>
                            <div class="body">
                                <div id="chart-pie" class="c3_chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong> درصد </strong> نوع کاربری </h2>
                            </div>
                            <div class="body">
                                <div id="chart-pie-2" class="c3_chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">

                        <div class="body_scroll">

                            <div class="col-lg-12">
                                <h5>آخرین کاربران</h5>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table table-hover product_item_list c_table theme-color mb-0">
                                            <thead>
                                                <tr>
                                                    <th>کد</th>
                                                    <th>نام کاربر</th>
                                                    <th data-breakpoints="sm xs">نقش</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>
                                                            {{ $user->name }}
                                                        </td>
                                                        <td><span class="text-muted">{{ $user->role->slug }}</span></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="body_scroll">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <h5> آخرین املاک ثبت شده</h5>
                                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                                        <thead>
                                            <tr>
                                                <th>تصویر</th>
                                                <th>کد ملک</th>
                                                <th data-breakpoints="sm xs">عنوان</th>
                                                <th data-breakpoints="xs">نوع معامله</th>
                                                <th data-breakpoints="xs md">نوع ملک</th>
                                                <th data-breakpoints="xs md">ثبت کننده</th>
                                                <th data-breakpoints="xs md">عملیات</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($properties as $property)
                                                <tr>
                                                    <td><img src="{{ asset('storage/preview/' . $property->img) }}"
                                                            width="48" alt="Product img"></td>
                                                    <td>
                                                        {{ $property->id }}
                                                    </td>
                                                    <td><span class="text-muted">{{ $property->title }}</td>

                                                    <td>{{ $property->tr_type }}</td>
                                                    <td>{{ $property->type }}</td>
                                                    <td>{{ $property->user->name }}</td>

                                                    <td><span class="col-green"><a
                                                                href="/admin/properties/show/{{ $property->id }}"
                                                                wire:navigate class="btn btn-raised btn-info waves-effect">
                                                                نمایش
                                                            </a></span></td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endcan

        @can('is_agent')
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card info-box-2">
                        <div class="body bg-red">
                            <i class="zmdi zmdi-home zmdi-hc-4x"></i>
                            <div class="content col-12">
                                <div class="text">املاک ثبت شده</div>
                                <div class="number">{{ $propertycountAgent }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


    </section>

    <script>
        initC3Chart();
        // initSparkline();

        // function initSparkline() {
        //     $(".sparkline").each(function() {
        //         var $this = $(this);
        //         $this.sparkline("html", $this.data());
        //     });
        // }

        function initC3Chart() {
            setTimeout(function() {
                $(document).ready(function() {
                    $monthlyCounts = @json($monthlyCounts);

                    $rent = @json($rent);
                    $sell = @json($sell);
                    $presell = @json($presell);

                    $apr = @json($apr);
                    $vil = @json($vil);
                    $kol = @json($kol);
                    $mag = @json($mag);
                    $kar = @json($kar);
                    $bag = @json($bag);
                    $anb = @json($anb);


                    var chart = c3.generate({
                        bindto: "#chart-area-spline-sracked", // id of chart wrapper

                        data: {
                            columns: [
                                // each columns data
                                ["data1",
                                    $monthlyCounts[1],
                                    $monthlyCounts[2],
                                    $monthlyCounts[3],
                                    $monthlyCounts[4],
                                    $monthlyCounts[5],
                                    $monthlyCounts[6],
                                    $monthlyCounts[7],
                                    $monthlyCounts[8],
                                    $monthlyCounts[9],
                                    $monthlyCounts[10],
                                    $monthlyCounts[11],
                                    $monthlyCounts[12],
                                ],
                            ],
                            type: "area-spline", // default type of chart
                            groups: [
                                ["data1"]
                            ],
                            colors: {
                                data1: Aero.colors["teal"],
                            },
                            names: {
                                // name of each serie
                                data1: "املاک ثبت شده",
                            },
                        },
                        axis: {
                            x: {
                                type: "category",
                                // name of each category
                                categories: [
                                    "فروردین",
                                    "اردیبهشت",
                                    "خرداد",
                                    "تیر",
                                    "مرداد",
                                    "شهریور",
                                    "مهر",
                                    "آبان",
                                    "آذر",
                                    "دی",
                                    "بهمن",
                                    "اسفند",
                                ],
                            },
                        },
                        legend: {
                            show: true, //hide legend
                        },
                        padding: {
                            bottom: 0,
                            top: 0,
                        },
                    });
                });

                $(document).ready(function() {
                    var chart = c3.generate({
                        bindto: '#chart-pie', // id of chart wrapper
                        data: {
                            columns: [
                                // each columns data
                                ['data1', $rent],
                                ['data2', $sell],
                                ['data3', $presell],
                            ],
                            type: 'pie', // default type of chart
                            colors: {
                                'data1': Aero.colors["blue-darker"],
                                'data2': Aero.colors["green"],
                                'data3': Aero.colors["orange"],
                            },
                            names: {
                                // name of each serie
                                'data1': ' رهن و اجاره  ',
                                'data2': '  فروش ',
                                'data3': ' پیش فروش ',
                            }
                        },
                        axis: {},
                        legend: {
                            show: true, //hide legend
                        },
                        padding: {
                            bottom: 0,
                            top: 0
                        },
                    });
                });

                $(document).ready(function() {
                    var chart = c3.generate({
                        bindto: '#chart-pie-2', // id of chart wrapper
                        data: {
                            columns: [
                                // each columns data
                                ['data1', $apr],
                                ['data2', $vil],
                                ['data3', $kol],
                                ['data4', $mag],
                                ['data5', $kar],
                                ['data6', $bag],
                                ['data7', $anb],
                            ],
                            type: 'pie', // default type of chart
                            colors: {
                                'data1': Aero.colors["blue-darker"],
                                'data2': Aero.colors["green"],
                                'data3': Aero.colors["orange"],
                                'data4': Aero.colors["red"],
                                'data5': Aero.colors["yellow"],
                                'data6': Aero.colors["pink"],
                                'data7': Aero.colors["gray"],
                            },
                            names: {
                                'data1': "آپارتمان",
                                'data2': "ویلایی",
                                'data3': "کلنگی",
                                'data4': "مغازه",
                                'data5': "اداری",
                                'data6': "باغ",
                                'data7': "انبار",

                            }
                        },
                        axis: {},
                        legend: {
                            show: true, //hide legend
                        },
                        padding: {
                            bottom: 0,
                            top: 0
                        },
                    });
                });



            }, 500);
        }



        initC3Chart();
    </script>
</div>
