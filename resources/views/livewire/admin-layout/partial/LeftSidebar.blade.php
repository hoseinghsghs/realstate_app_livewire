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


                <li @class([
                    'active open' => request()->routeIs('admin.home'),
                ])><a href="/admin/dashboard" wire:navigate><i
                            class="zmdi zmdi-view-dashboard zmdi-hc-2x"></i><span> داشبورد </span></a></li>

                <li @class([
                    'active open' =>
                        request()->routeIs(
                            'admin.properties.index',
                            'admin.properties.create') && request()->query('type_property') !== 'advertise',
                ])>
                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>املاک</span></a>
                    <ul class="ml-menu">
                        <li @class(['active' => request()->routeIs('admin.properties.create')])>
                            <a href="/admin/properties/create" wire:navigate>اضافه کردن ملک</a>
                        </li>
                        <li @class([
                            'active' =>
                                request()->routeIs('admin.properties.index') &&
                                request()->query('type_property') !== 'advertise',
                        ])>
                            <a href="/admin/properties" wire:navigate>لیست املاک</a>
                        </li>
                    </ul>
                </li>


                <li @class([
                    'active open' => request()->routeIs(
                        'admin.agreements.create',
                        'admin.agreements.index'),
                ])> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-hc-fw"></i><span>قولنامه
                        </span></a>
                    <ul class="ml-menu">
                        <li @class(['active' => request()->routeIs('admin.agreements.index')])><a wire:navigate href={{ route('admin.agreements.index') }}>لیست
                                قولنامه ها</a></li>
                        <li @class(['active' => request()->routeIs('admin.agreements.create')])><a wire:navigate href={{ route('admin.agreements.create') }}>ایجاد
                                قولنامه</a></li>
                    </ul>
                </li>


                <li @class([
                    'active open' => request()->routeIs('admin.services'),
                ])> <a href="/admin/services" wire:navigate><i
                            class="zmdi zmdi-collection-item"></i><span>سرویس ها</span></a>
                </li>



                <li @class([
                    'active open' => request()->query('type_property') === 'advertise',
                ])><a
                        href="{{ route('admin.properties.index', ['type_property' => 'advertise']) }}" wire:navigate><i
                            class="zmdi zmdi-assignment-o"></i><span>
                            آگهی ها </span></a></li>



                <li @class([
                    'active open' => request()->routeIs('admin.articles'),
                ])> <a href="/admin/articles" wire:navigate><i
                            class="zmdi zmdi-graduation-cap"></i><span>مقالات
                        </span></a>
                </li>


                <li @class([
                    'active open' => request()->routeIs('admin.features'),
                ])> <a href="/admin/features" wire:navigate><i
                            class="zmdi zmdi-assignment-check"></i><span>امکانات
                        </span></a>
                </li>


                <li @class([
                    'active open' => request()->routeIs('admin.posts'),
                ])> <a href="/admin/posts" wire:navigate><i
                            class="zmdi zmdi-blogger"></i><span>خبر
                        </span></a>
                </li>


                <li @class([
                    'active open' => request()->routeIs('admin.sliders'),
                ])> <a href="/admin/sliders" wire:navigate><i
                            class="zmdi zmdi-hc-fw"></i><span>اسلایدر</span></a>
                </li>


                <li><a target="_blank" href="https://app.raychat.io/login"><i class="zmdi zmdi-hc-fw"></i><span>چت
                            آنلاین</span></a>
                    {{-- <li> <a href={{ route('admin.comments.index') }}>
                        <i class="zmdi zmdi-hc-fw"></i><span>نظرات</span></a>
                </li> --}}


                <li @class([
                    'active open' => request()->routeIs('admin.settings'),
                ])><a href="/admin/settings" wire:navigate><i
                            class="zmdi zmdi-hc-fw"></i><span>
                            درباره ما </span></a></li>


                <!-- تنظیمات -->
                <li @class([
                    'active open' => request()->routeIs(
                        'admin.cearte-user',
                        'admin.edit-user',
                        'admin.list-user',
                        'admin.edit-profile'),
                ])> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i><span>تنظیمات</span></a>
                    <ul class="ml-menu">
                        <li @class(['active' => request()->routeIs('admin.list-user')])><a href="/admin/user/user-list" wire:navigate>لیست کاربران</a>
                        </li>
                        <li @class(['active' => request()->routeIs('admin.cearte-user')])><a href="/admin/user/cearte" wire:navigate>اضافه کردن مشاور </a>
                        </li>
                        <li @class(['active' => request()->routeIs('admin.edit-profile')])><a href="{{ route('admin.edit-profile', Auth::user()->id) }}"
                                wire:navigate>ویرایش پروفایل
                                کاربری </a></li>
                        <li @class(['active' => request()->routeIs('admin.properties.index')])><a href={{ route('admin.chenge') }} wire:navigate>تغییر کلمه عبور
                            </a></li>
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
            <a href="{{ route('home') }}" wire:navigate><img
                    src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                    width="45" style="margin-right:20px"><span class="m-l-10"></span></a>

        </div>
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <a class="image" href="{{ route('home') }}" wire:navigate><img default=""
                                src={{ Auth::user()->image === null
                                    ? asset('storage/profile/admin.png')
                                    : asset('storage/profile/' . Auth::user()->image) }}></a>

                        <div class="detail">
                            <h6><strong>{{ Auth::user()->name }}</strong></h6>
                            <small>مشاور</small>
                        </div>
                    </div>
                </li>
                <li @class([
                    'active open' => request()->routeIs('agent.home'),
                ])><a href="/agent/dashboard" wire:navigate><i
                            class="zmdi zmdi-view-dashboard zmdi-hc-2x"></i><span> داشبورد </span></a></li>


                <li @class([
                    'active open' => request()->routeIs(
                        'admin.properties.index',
                        'admin.properties.create'),
                ])><a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-home"></i><span>
                            املاک</span></a>
                    <ul class="ml-menu">
                        <li @class(['active' => request()->routeIs('admin.properties.create')])><a href="/admin/properties/create" wire:navigate>اضافه کردن
                                ملک</a>
                        </li>
                        <li @class(['active' => request()->routeIs('admin.properties.index')])><a href="/admin/properties" wire:navigate>لیست املاک</a></li>
                    </ul>
                </li>

                <!-- تنظیمات -->
                <li @class([
                    'active open' => request()->routeIs('admin.edit-profile'),
                ])> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i><span>تنظیمات</span></a>
                    <ul class="ml-menu">
                        <li @class(['active' => request()->routeIs('admin.edit-profile')])><a href="{{ route('admin.edit-profile', Auth::user()->id) }}"
                                wire:navigate>ویرایش پروفایل
                                کاربری </a></li>
                        <li><a href={{ route('admin.chenge') }} wire:navigate>تغییر کلمه عبور </a></li>
                    </ul>
                </li>
                <!-- خروج -->
                <li><a href=" {{ route('logout') }}" class="mega-menu" title="Sign Out" wire:navigate><i
                            class="zmdi zmdi-power"></i>
                        خروج
                    </a>
                </li>
                <!-- خروج -->
            </ul>
        </div>
    </aside>
@endcan
