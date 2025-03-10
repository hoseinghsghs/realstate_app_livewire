<div class="{{ url()->current() == route('home') ? 'header header-transparent change-logo' : 'header header-light' }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        @if (url()->current() == route('home'))
                            <a class="nav-brand static-logo" href="/" wire:navigate><img
                                        src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                                        width="70px" class="logo" alt=""/></a>
                            <a class="nav-brand fixed-logo" href="/" wire:navigate><img
                                        src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo2.png' }}"
                                        width="70px" class="logo" alt=""/></a>
                        @else
                            <a class="nav-brand" href="/" wire:navigate>
                                <img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                                     width="70px" class="logo" alt=""/>
                            </a>
                        @endif
                        <div style="color: white !important;" class="nav-toggle"></div>

                        <div class="mobile_nav">
                            @auth
                                @can('is_admin')
                                    <ul>
                                        <li><a href="/admin/dashboard" wire:navigate><i
                                                        class="fas fa-user-circle fa-lg"></i></a>
                                        </li>
                                        <li class="_my_prt_list"><a href="/logout" wire:navigate>خروج</a></li>
                                    </ul>
                                @endcan
                                @can('is_agent')
                                    <ul>
                                        <li><a href="/agent/dashboard" wire:navigate><i
                                                        class="fas fa-user-circle fa-lg"></i></a>
                                        </li>
                                        <li class="_my_prt_list"><a href="/logout" wire:navigate>خروج</a></li>
                                    </ul>
                                @endcan
                                @can('is_user')
                                    <ul>
                                        <li><a href="/user/wish_list" wire:navigate><i
                                                        class="fas fa-user-circle fa-lg"></i></a>
                                        </li>
                                        <li class="_my_prt_list"><a href="/user/wish_list" wire:navigate><span
                                                        id="count1">{{ $wishlist->count() }}</span>علاقه مندی ها</a>
                                        </li>
                                    </ul>
                                @endcan
                            @else
                                <ul>
                                    <li class="_my_prt_list"><a id="target1" style="color: white;"><span
                                                    id="count">{{ $wishlist->count() }}</span>علاقه
                                            مندی
                                            ها</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#login"><i
                                                    style="font-size: 40px;" class="fas fa-user-circle fa-lg"></i></a>
                                    </li>
                                </ul>
                            @endauth

                        </div>

                    </div>

                    <div class="nav-menus-wrapper" style="transition-property: none;">
                        <ul class="nav-menu">
                            <li style="display: none;" class="active"><a href="#">خانه<span
                                            class="submenu-indicator"></span></a>

                            </li>
                            <li @class(['active' => request()->routeIs('home')])><a href="/"
                                                                                           wire:navigate>خانه</a></li>
                            <li @class(['active' => request()->routeIs('properties.list') && empty(request()->query())])>
                                <a href="{{route('properties.list')}}" wire:navigate>املاک<span
                                            class="submenu-indicator"></span></a>
                            </li>

                            <li @class(['active' => request()->routeIs('properties.list') && request()->get('deal_type') == 'رهن و اجاره'])>
                                <a href="{{route('properties.list',['deal_type'=>'رهن و اجاره'])}}" wire:navigate>رهن و
                                    اجاره
                                    <span class="submenu-indicator"></span></a>
                            </li>

                            <li @class(['active' => request()->routeIs('properties.list') && request()->get('deal_type') == 'فروش'])>
                                <a href="{{route('properties.list',['deal_type'=>'فروش'])}}" wire:navigate>فروش<span
                                            class="submenu-indicator"></span></a>
                            </li>
                            <li @class(['active' => url()->current() == route('blog.index')])><a href="/blog"
                                                                                                 wire:navigate>اخبار</a>
                            </li>

                            <li @class(['active' => url()->current() == route('articled.index')])><a href="/articled"
                                                                                                     wire:navigate>مقالات</a>
                            </li>

                            <li @class(['active' => url()->current() == route('contactus')])><a href='/contact-us'
                                                                                                wire:navigate>تماس با
                                    ما</a></li>
                        </ul>

                        <ul class="nav-menu nav-menu-social align-to-right">

                            @auth
                                @can('is_admin')
                                    <li class="_my_prt_list"><a href="/logout" wire:navigate>خروج</a></li>
                                    <li class="add-listing">
                                        <a href="/admin/dashboard" wire:navigate class="theme-cl">
                                            <i class="fa fa-user ml-1"></i>داشبورد
                                        </a>
                                    </li>
                                @endcan
                                @can('is_agent')
                                    <li class="_my_prt_list"><a href="/logout" wire:navigate>خروج</a></li>
                                    <li class="add-listing">
                                        <a href="/agent/dashboard" wire:navigate class="theme-cl">
                                            <i class="fa fa-user ml-1"></i>داشبورد
                                        </a>
                                    </li>
                                @endcan
                                @can('is_user')
                                    <li><a href="#">پروفایل</a>
                                        <ul class="nav-dropdown">
                                            <li><a href="#">{{ Auth::user()->name }} عزیز خوش آمدید</a></li>
                                            <li><a href="/user/dashboard" wire:navigate>پروفایل </a>
                                            </li>
                                            <li><a href="/logout" wire:navigate>خروج</a></li>
                                        </ul>
                                    </li>

                                    <li class="_my_prt_list"><a href="/user/wish_list" wire:navigate
                                                                style="color:#00c746"><span
                                                    class="cart-btn_counter color-bg"
                                                    id="count">{{ $wishlist->count() }}</span>علاقه
                                            مندی
                                            ها</a>
                                        <!-- <li> <a href="" class="color-bg db_log-out"><i class="far fa-power-off"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                </a>
                                                                                                                                                                                                                                                                                                                                                                                                                            </li> -->
                                    <li class="add-listing">
                                        <a href="/user/properties/createproperty" wire:navigate class="theme-cl">
                                            <i class="fas fa-plus-circle ml-1"></i>ثبت آگهی
                                        </a>
                                    </li>
                                    </li>
                                @endcan
                            @else
                                <li>
                                    <a href="#" class="alio_green" data-toggle="modal" data-target="#login">
                                        <i class="fas fa-sign-in-alt ml-1"></i><span class="dn-lg">ورود</span>
                                    </a>
                                </li>
                                <li class="_my_prt_list">
                                    <a id="target"><span>{{ $wishlist->count() }}</span>علاقه مندی
                                        ها</a>
                                </li>
                                <li class="add-listing">

                                    <a data-toggle="modal" data-target="#login" class="theme-cl">
                                        <i class="fas fa-plus-circle ml-1"></i>ثبت آگهی
                                    </a>
                                </li>

                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
@push('scripts')
    <script>
        $("#target").click(function () {
            $.notify("کاربر گرامی ابتدا باید وارد شوید.", "info", {
                position: "tap",
            });
        })
        $("#target1").click(function () {
            $.notify("کاربر گرامی ابتدا باید وارد شوید.", "info", {
                position: "tap",
            });
        })
    </script>
@endpush
