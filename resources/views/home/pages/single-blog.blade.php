@extends('home.layout.HomeLayout')
@section('title',$post->title)
@section('content')
<div class="page-title" style="background:#f4f4f4 url(/assets/home/img/slider-2.jpg);" data-overlay="5">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="breadcrumbs-wrap">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">جزئیات خبر</li>
                    </ol>
                    <h2 class="breadcrumb-title">{{$post->title}}</h2>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
<section class="gray">

    <div class="container">

        <!-- row Start -->
        <div class="row">

            <!-- Blog Detail -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="article_detail_wrapss single_article_wrap format-standard">
                    <div class="article_body_wrap">

                        <div class="article_featured_image">
                            <img class="img-fluid" src="{{asset('storage/'.$post->image->url)}}" alt="">
                        </div>

                        <div class="article_top_info">
                            <ul class="article_middle_info">
                                <li><a href="#"><span class="icons"><i class="ti-user"></i></span>نویسنده:
                                        {{$post->user->name}}
                                    </a></li>

                                </li>
                            </ul>
                        </div>
                        <h2 class="post-title">{{$post->title}}</h2>
                        <p>{{$post->body}}</p>




                    </div>
                </div>



            </div>

            <!-- Single blog Grid -->


        </div>
        <!-- /row -->

    </div>

</section>
@endsection