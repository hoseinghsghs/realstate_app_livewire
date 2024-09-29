@extends('admin.layout.MasterAdmin')

@section('Content')
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
                            <div class="number">{{$propertycount}}</div>
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
                            <div class="number">{{$usercount}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card info-box-2">
                    <div class="body bg-blue">
                        <i class="zmdi zmdi-comment-text zmdi-hc-4x"></i>
                        <div class="content col-12">
                            <div class="text">مجموع کامنت ها</div>
                            <div class="number">{{$commentcount}}</div>
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
                            <div class="number">{{$agreementcount}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong><i class="zmdi zmdi-chart"></i> گزارش</strong> بازدید</h2>
                    </div>
                    <div class="body">
                        <div id="chart-area-spline-sracked" class="c3_chart d_sales"></div>
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
                                        <th data-breakpoints="sm xs md">زیر بنا</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $property )
                                    <tr>
                                        <td><img src="{{asset('storage/preview/'.$property->img)}}" width="48"
                                                alt="Product img"></td>
                                        <td>
                                            <h5>{{$property->id}}</h5>
                                        </td>
                                        <td><span class="text-muted">{{$property->title}}</span></td>

                                        <td><span class="col-green">{{$property->tr_type}}</span></td>
                                        <td><span class="col-green">{{$property->type}}</span></td>
                                        <td><span class="col-green">{{$property->meter}}</span></td>
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
    <div class="body_scroll">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-6">
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
                                        <td>{{$user->id}}</td>
                                        <td>
                                            <h5>{{$user->name}}</h5>
                                        </td>
                                        <td><span class="text-muted">{{$user->role->slug}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5>آخرین نظرات</h5>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover product_item_list c_table theme-color mb-0">
                                <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>نام</th>
                                        <th>وضعیت </th>
                                        <th>متن </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $comments as $comment )
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td>
                                            <h5>{{$comment->user->name}}</h5>
                                        </td>
                                        <td>
                                            @if($comment->approved)
                                            <span class="badge badge-success">تایید شده</span>
                                            @else
                                            <span class="badge badge-warning">در انتظار تایید</span>
                                            @endif
                                        </td>
                                        <td><span class="text-muted">{{$comment->body}}</span></td>
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
                        <div class="number">{{$propertycountAgent}}</div>
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
            var chart = c3.generate({
                bindto: "#chart-area-spline-sracked", // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        ["data1",
                            "{{ $m1->count()}}",
                            "{{ $m2->count()}}",
                            "{{ $m3->count()}}",
                            "{{ $m4->count()}}",
                            "{{ $m5->count()}}",
                            "{{ $m6->count()}}",
                            "{{ $m7->count()}}",
                            "{{ $m8->count()}}",
                            "{{ $m9->count()}}",
                            "{{ $m10->count()}}",
                            "{{ $m11->count()}}",
                            "{{ $m12->count()}}",
                        ],
                    ],
                    type: "area-spline", // default type of chart
                    groups: [
                        ["data1", "data2", "data3"]
                    ],
                    colors: {
                        data1: Aero.colors["teal"],
                    },
                    names: {
                        // name of each serie
                        data1: "میزان بازدید",
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
    }, 500);

}
</script>

@endsection