<div>
    @section('title', 'مقالات')
    <!-- content -->
    <div class="page-title" style="background:#f4f4f4 url(assets/home/img/slider-3.jpg);" data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="breadcrumbs-wrap">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                        <h2 class="breadcrumb-title">مقالات</h2>
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
                        <h2>آخرین مقالات</h2>
                    </div>
                </div>
            </div>

            <!-- row Start -->
            <div class="row">
                @if ($articles->count() > 0)
                    @foreach ($articles as $article)
                        <!-- Single blog Grid -->
                        <div class="col-lg-4 col-md-6">
                            <div class="grid_blog_box">
                                <div class="gtid_blog_thumb">
                                    @isset($article->image->url)
                                        <a href="{{ route("article.show",$article->id) }}" wire:navigate><img
                                                src="{{ asset('storage/' . $article->image->url) }}" class="img-fluid"
                                                alt="{{ $article->slug }}" /></a>
                                    @endisset
                                    <div class="gtid_blog_info">
                                        <span>تاریخ</span>{{ verta($article->created_at)->format('Y/n/j') }}
                                    </div>
                                </div>

                                <div class="blog-body">
                                    <h4 class="bl-title"><a href="{{ route("article.show",$article->id) }}"
                                            wire:navigate>{{ $article->title }}</a><span
                                            class="latest_new_post">مقاله</span></h4>
                                    <div class="text-overflow">
                                        <p>{!! $article->body !!} </p>
                                    </div>
                                </div>

                                <div class="modern_property_footer">
                                    <div class="property-author">
                                        <div class="path-img"><a tabindex="-1"><img
                                                    src="{{ asset('storage/profile/' . $article->user->image) }}"
                                                    class="img-fluid" alt=""></a></div>
                                        <h5><a tabindex="-1">{{ $article->user->name }}</a></h5>
                                    </div>
                                    <span class="article-pulish-date">
                                        <span class="article-pulish-date">
                                            <div class="footer-flex">
                                                <a href="{{ route("article.show",$article->id) }}" wire:navigate
                                                    class="prt-view">مشاهده</a>
                                            </div>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="loader-text">هیچ مقاله ای یافت نشد</h4>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $articles->onEachSide(1)->links('livewire.home.partials.pagination') }}
                </div>
            </div>
        </div>
    </section>
</div>
