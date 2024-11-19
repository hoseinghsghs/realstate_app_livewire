<div>
    @section('title', 'خبر ها')
    <!-- content -->
    <div class="page-title" style="background:#f4f4f4 url(assets/home/img/slider-3.jpg);" data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="breadcrumbs-wrap">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                        <h2 class="breadcrumb-title">اخبار</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ Agency List Start ================================== -->
    <section class="gray">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="sec-heading center">
                        <h2>آخرین اخبار</h2>
                        <p></p>
                    </div>
                </div>
            </div>
            <!-- row Start -->
            <div class="row">
                @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                        <!-- Single blog Grid -->
                        <div class="col-lg-4 col-md-6">
                            <div class="grid_blog_box">
                                <div class="gtid_blog_thumb">
                                    @isset($post->image->url)
                                        <a href="/blog/{{ $post->id }}" wire:navigate><img
                                                src="{{ asset('storage/' . $post->image->url) }}" class="img-fluid"
                                                alt="{{ $post->slug }}" /></a>
                                    @endisset
                                    <div class="gtid_blog_info">
                                        <span>تاریخ</span>{{ Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y/n/j') }}
                                    </div>
                                </div>

                                <div class="blog-body">
                                    <h4 class="bl-title"><a href="/blog/{{ $post->id }}"
                                            wire:navigate>{{ $post->title }}</a><span
                                            class="latest_new_post">خبر</span>
                                    </h4>
                                    <div class="text-overflow">
                                        <p>{{ $post->body }} </p>
                                    </div>
                                </div>

                                <div class="modern_property_footer">
                                    <div class="property-author">
                                        <div class="path-img"><a tabindex="-1"><img
                                                    src="{{ asset('storage/profile/' . $post->user->image) }}"
                                                    class="img-fluid" alt=""></a></div>
                                        <h5><a tabindex="-1">{{ $post->user->name }}</a></h5>
                                    </div>
                                    <span class="article-pulish-date">
                                        <div class="footer-flex">
                                            <a href="/blog/{{ $post->id }}" wire:navigate
                                                class="prt-view">مشاهده</a>
                                        </div>
                                    </span>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <!-- pagination-->
                    {{-- {{ $posts->links('home.partials.pagination') }} --}}


                    <!-- pagination end-->
                @else
                    <h1 class="loader-text">هیچ خبری یافت نشد</h1>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $posts->onEachSide(1)->links('home.partials.pagination') }}
                </div>
            </div>
        </div>
    </section>
</div>
