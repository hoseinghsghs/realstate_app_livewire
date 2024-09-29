@extends('home.layout.HomeLayout')
@section('title','404')
@section('content')
<!-- ============================ User Dashboard ================================== -->
<section class="error-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="text-center">
                    <img src="/assets/home/img/404.png" class="img-fluid" alt="">
                    <p>متاسفانه صفحه مورد نظر پیدا نشد!!!</p>
                    <a class="btn btn-theme" href="{{route('home')}}">بازگشت به صفحه اصلی</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ User Dashboard End ================================== -->
@endsection