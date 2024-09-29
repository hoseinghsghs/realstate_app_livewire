<div class="col-lg-3 col-md-4 col-sm-12">
    <div class="property_dashboard_navbar">

        <div class="dash_user_avater">
            <img src={{Auth::user()->image===null ? asset('/storage/profile/admin.png')
                            :asset('storage/profile/'.auth::user()->image) }} class="img-fluid avater" alt="">
            <h4>{{Auth::user()->name}}</h4>
            <!-- <span>ایران تبریز</span> -->
        </div>

        <div class="dash_user_menues">
            <ul>
                <!-- class="active" -->
                <li><a href="{{route('user.home')}}"><i class="fa fa-user-tie"></i>پروفایل من</a>
                </li>

                <li><a href="{{route('user.show')}}"><i class="fa fa-bookmark"></i>املاک ذخیره شده<span id="count2"
                            class="notti_coun style-2">{{$wishlist->count()}}</span></a></li>
                <li><a href="{{route('user.submit-propert')}}"><i class="fa fa-pen-nib"></i>ثبت املاک جدید</a>
                </li>
            </ul>
        </div>

        <div class="dash_user_footer">

            <ul>

                <li></li>
                <li><a href="{{route('logout')}}"> خروج <i class="fa fa-power-off"></i></a></li>
                <li></li>

            </ul>


        </div>

    </div>
</div>