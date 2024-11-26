@php
    use App\Models\Setting;
    $setting = Setting::firstOrNew();
@endphp
@can('is_admin')
    <aside id="leftsidebar" class="sidebar">
        <div class="navbar-brand">
            <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
            <a href="{{ route('home') }}"><img
                    src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}" width="45"
                    style="margin-right:20px"><span class="m-l-10"></span></a>

        </div>
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <a class="image" href="{{ route('home') }}"><img default=""
                                src={{ Auth::user()->image === null
                                    ? asset('storage/profile/admin.png')
                                    : asset('storage/profile/' . Auth::user()->image) }}></a>

                        <div class="detail">
                            <h6><strong>{{ Auth::user()->name }}</strong></h6>
                            <small>مدیر سایت</small>
                        </div>
                    </div>
                </li>
                <li class="active open"><a href="/admin/dashboard" wire:navigate><i
                            class="zmdi zmdi-view-dashboard zmdi-hc-2x"></i><span> داشبورد </span></a></li>
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>
                            املاک</span></a>
                    <ul class="ml-menu">
                        <li><a href="/admin/properties/create" wire:navigate>اضافه کردن ملک</a></li>
                        <li><a href="/admin/properties" wire:navigate>لیست املاک</a></li>
                    </ul>
                </li>
                <ul class="ml-menu">
                    <li><a href="mail-inbox.html">ایمیل</a></li>
                    <li><a href="chat.html">برنامه چت</a></li>
                    <li><a href="events.html">تقویم</a></li>
                    <li><a href="contact.html">مخاطب</a></li>
                </ul>
                </li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>قولنامه
                        </span></a>
                    <ul class="ml-menu">
                        <li><a href={{ route('admin.agreements.index') }}>لیست قولنامه ها</a></li>
                        <li><a href={{ route('admin.agreements.create') }}>ایجاد قولنامه</a></li>
                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-assignment"></i><span>سرویس</span></a>
                    <ul class="ml-menu">
                        <li><a href="/admin/services" wire:navigate> سرویس ها</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('admin.properties.index', ['type_property' => 'advertise']) }}"><i
                            class="zmdi zmdi-assignment-o"></i><span>
                            آگهی ها </span></a></li>

                <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-graduation-cap"></i><span>مقالات
                        </span></a>
                    <ul class="ml-menu">
                        <li><a href="/admin/articles" wire:navigate>مقالات</a></li>
                    </ul>
                </li>

                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-assignment-check"></i><span>امکانات
                        </span></a>
                    <ul class="ml-menu">
                        <li><a href="/admin/features" wire:navigate>امکانات</a></li>
                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>خبر
                        </span></a>
                    <ul class="ml-menu">
                        <li><a href="/admin/posts" wire:navigate>مدیریت خبر ها</a></li>
                    </ul>
                </li>

                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-hc-fw"></i><span>اسلایدر</span></a>
                    <ul class="ml-menu">
                        <li><a href="/admin/sliders" wire:navigate>اسلایدر</a></li>
                    </ul>
                </li>
                <li><a target="_blank" href="https://app.raychat.io/login"><i class="zmdi zmdi-hc-fw"></i><span>چت
                            آنلاین</span></a>
                    {{-- <li> <a href={{ route('admin.comments.index') }}>
                        <i class="zmdi zmdi-hc-fw"></i><span>نظرات</span></a>
                </li> --}}
                    {{-- <li> <a href={{ route('admin.properties.search') }}>
                        <i class="zmdi zmdi-hc-fw"></i><span>جستجو ملک</span></a>
                </li> --}}
                <li><a href="/admin/settings" wire:navigate><i class="zmdi zmdi-hc-fw"></i><span>
                            درباره ما </span></a></li>
                <!-- تنظیمات -->
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i><span>تنظیمات</span></a>
                    <ul class="ml-menu">
                        <li><a href={{ route('admin.users.index') }}>لیست کاربران</a></li>
                        <li><a href={{ route('admin.users.create') }}>اضافه کردن مشاور </a></li>
                        <li><a href="{{ route('admin.profile.edit', Auth::user()->id) }}">ویرایش پروفایل کاربری </a></li>
                        <li><a href={{ route('admin.chenge') }}>تغییر کلمه عبور </a></li>
                    </ul>
                </li>
                <!-- خروج -->
                <li><a href=" {{ route('logout') }}" class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i>
                        خروج
                    </a>
                </li>
                <!-- خروج -->
            </ul>
        </div>
    </aside>
@endcan

@can('is_agent')
    <aside id="leftsidebar" class="sidebar">
        <div class="navbar-brand">
            <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
            <a href="{{ route('home') }}"><img
                    src=" {{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}}"
                    width="45" alt="Aero"><span class="m-l-10">پنل مدیریت</span></a>
        </div>
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <a class="image" href="{{ route('home') }}"><img default=""
                                src={{ Auth::user()->image === null
                                    ? asset('storage/profile/admin.png')
                                    : asset('storage/profile/' . Auth::user()->image) }}></a>

                        <div class="detail">
                            <h6><strong>{{ Auth::user()->name }}</strong></h6>
                            <small>مدیر سایت</small>
                        </div>
                    </div>
                </li>
                <li class="active open"><a href="{{ route('agent.home') }}"><i
                            class="zmdi zmdi-view-dashboard zmdi-hc-2x"></i><span> داشبورد </span></a></li>
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>
                            املاک</span></a>
                    <ul class="ml-menu">
                        <li><a href={{ route('agent.properties.index') }}>لیست املاک</a></li>
                        <li><a href={{ route('agent.properties.create') }}>اضافه کردن ملک</a></li>
                    </ul>
                </li>
                <ul class="ml-menu">
                    <li><a href="mail-inbox.html">ایمیل</a></li>
                    <li><a href="chat.html">برنامه چت</a></li>
                    <li><a href="events.html">تقویم</a></li>
                    <li><a href="contact.html">مخاطب</a></li>
                </ul>
                </li>

                <!-- تنظیمات -->
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i><span>تنظیمات</span></a>
                    <ul class="ml-menu">
                        <li><a href="{{ route('agent.profile.edit', Auth::user()->id) }}">ویرایش پروفایل کاربری </a></li>
                        <li><a href={{ route('agent.chenge') }}>تغییر کلمه عبور </a></li>
                    </ul>
                </li>
                <!-- خروج -->
                <li><a href=" {{ route('logout') }}" class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i>
                        خروج
                    </a>
                </li>
                <!-- خروج -->
            </ul>
        </div>
    </aside>
@endcan
