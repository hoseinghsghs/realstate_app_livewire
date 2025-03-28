@extends('livewire.home.layout.HomeLayout')
@section('title','لیست علاقه مندی ها')

@section('content')
    @push('styles')
        <link type="text/css" rel="stylesheet" href="/assets/home/css/dashboard-style.css">
    @endpush

    <section class="gray pt-5 pb-5">
        <div class="container-fluid">

            <div class="row">

                @include('home.pages.UserProfile.right')

                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="dashboard-body">

                        <div class="dashboard-wraper">

                            <!-- Bookmark Property -->
                            <div class="frm_submit_block">
                                <h4>املاک ذخیره شده</h4>
                            </div>

                            <table class="property-table-wrap responsive-table bkmark">

                                <tbody>
                                <tr>
                                    <th><i class="fa fa-file-text"></i> ملک ها</th>
                                    <th></th>
                                </tr>
                                @if (!count($wishlist))
                                    <h3><strong>لیست علاقه مندی های شما خالی است</strong></h3>
                                @endif
                                @foreach ($property as $property )
                                    @if ($property->checkUserWishlist(auth()->id()))
                                        <!-- Item #1 -->
                                        <tr id="{{$property->id}}wish">
                                            <td class="dashboard_propert_wrapper">
                                                <img src="{{'/storage/preview/'.$property->img}}" alt="">
                                                <div class="title">
                                                    <h4><a
                                                                href="{{route('properties.show',[$property->id])}}">{{$property->title}}</a>
                                                    </h4>
                                                    <span> {{$property->province}}, {{$property->city}},
                                                {{$property->district}} </span>
                                                    <span class="table-property-price">{{$property->type}}</span>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <a onclick="return send('{{$property->id}}')" class="delete"><i
                                                            class="ti-close"></i> حذف</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>

                        </div>


                        <!-- row -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- dashboard-footer -->

    <!-- content end -->
    <!-- <div class="dashbard-bg gray-bg" style=""></div>
    </div> -->
@endsection
@push('scripts')
    <script>
        function send(property) {
            console.log(property);

            $.get("/user/add-to-wishlist/" + [property],
                function (response, status) {
                    if (response.errors == 'deleted') {
                        $('#count').html(parseInt($('#count').html(), 10) - 1);
                        $('#count1').html(parseInt($('#count1').html(), 10) - 1)
                        $('#count2').html(parseInt($('#count2').html(), 10) - 1)
                        $("#" + property + "wish").hide();
                        $.notify("ملک از لیست علاقه مندی ها حذف شد", "info", {
                            position: "tap",
                        });
                    }
                }).fail(function () {

            })


        }
    </script>

    <script src="/assets/home/js/dashboard.js"></script>
@endpush