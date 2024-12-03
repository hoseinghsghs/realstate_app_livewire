<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":attribute باید پذیرفته شده باشد.",
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    "between" => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    "boolean" => "The :attribute field must be true or false",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    "distinct" => "فیلد :attribute تکراری می باشد",
    "email" => "فرمت :attribute معتبر نیست.",
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    "max" => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    "min" => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    "numeric" => ":attribute باید شامل عدد باشد.",
    "regex" => ":attribute یک فرمت معتبر نیست",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باید شامل :size آیتم باشد.",
    ),
    "timezone" => "The :attribute must be a valid zone.",
    "unique" => ":attribute قبلا انتخاب شده است.",
    "url" => "فرمت آدرس :attribute اشتباه است.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    'values' =>[
        'agreement_type'=>['sale' =>'فروش','rental' =>'اجاره ای']
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        'address' => 'نشانی',
        'age' => 'سن',
        'amount' => 'مبلغ',
        'area' => 'منطقه',
        'available' => 'موجود',
        'birthday' => 'تاریخ تولد',
        'city' => 'شهر',
        'content' => 'محتوا',
        'country' => 'کشور',
        'created_at' => 'ایجاد شده در',
        'creator' => 'سازنده',
        'current_password' => 'رمزعبور فعلی',
        'date' => 'تاریخ',
        'date_of_birth' => 'تاریخ تولد',
        'day' => 'روز',
        'deleted_at' => 'حذف شده در',
        'description' => 'توضیحات',
        'district' => 'ناحیه',
        'duration' => 'مدت',
        'email' => 'ایمیل',
        'excerpt' => 'گزیده مطلب',
        'filter' => 'فیلتر',
        'first_name' => 'نام',
        'gender' => 'جنسیت',
        'group' => 'گروه',
        'hour' => 'ساعت',
        'image' => 'تصویر',
        'last_name' => 'نام خانوادگی',
        'lesson' => 'درس',
        'line_address_1' => 'آدرس 1',
        'line_address_2' => 'آدرس 2',
        'message' => 'پیام',
        'middle_name' => 'نام وسط',
        'minute' => 'دقیقه',
        'mobile' => 'شماره همراه',
        'month' => 'ماه',
        'name' => 'نام',
        'national_code' => 'کد ملی',
        'number' => 'شماره',
        'password' => 'رمز عبور',
        'password_confirmation' => 'تکرار رمز عبور',
        'phone' => 'شماره ثابت',
        'photo' => 'تصویر',
        'postal_code' => 'کد پستی',
        'price' => 'قیمت',
        'province' => 'استان',
        'recaptcha_response_field' => 'فیلد جواب ریکپچا',
        'remember' => 'به خاطر سپردن',
        'restored_at' => 'بازیابی شده در',
        'result_text_under_image' => 'متن نتیجه زیر تصویر',
        'role' => 'نقش',
        'second' => 'ثانیه',
        'sex' => 'جنسیت',
        'short_text' => 'متن کوتاه',
        'size' => 'اندازه',
        'state' => 'استان',
        'street' => 'خیابان',
        'student' => 'دانش آموز',
        'subject' => 'موضوع',
        'teacher' => 'معلم',
        'terms' => 'شرایط',
        'test_description' => 'شرح آزمون',
        'test_locale' => 'منطقه آزمون',
        'test_name' => 'نام آزمون',
        'text' => 'متن',
        'time' => 'زمان',
        'title' => 'عنوان',
        'updated_at' => 'بروزشده در',
        'username' => 'نام کاربری',
        'year' => 'سال',
        'agreement_type' => 'نوع قرارداد',
        'agreement_date' => 'تاریخ قرارداد',
        'start_date' => 'تاریخ شروع',
        'end_date' => 'تاریخ پایان',
        'rent_term' => 'مدت اجاره',
        'adviser' => 'مشاور',
        'customer_name' => 'نام خریدار',
        'customer_birth' => 'تاریخ تولد مشتری',
        'customer_tel' => 'تلفن مشتری',
        'owner_name' => 'نام مالک',
        'owner_birth' => 'تاریخ تولد مالک',
        'owner_tel' => 'تلفن مالک',
        'mortgage_price' => 'قیمت رهن',
        'rent_price' => 'قیمت اجاره',
        'sell_price' => 'قیمت فروش',
        "parent_id" => "والد",
        "code" => "کد ملک",
        "cellphone" => "شماره تماس",
        "province_id" => "استان",
        "city_id" => "شهر",
        "display_name" => "نام نمایشی",
        "otp_code" => "کد تایید",
        "address_id" => "آدرس",
        "cellphone2" => "تلفن ثابت",
        "lastaddress" => "آدرس جایگزین",
        "unit" => 'واحد',
        "status" => 'وضعیت',
        "section" => 'بخش',
        "summary_description" => "خلاصه توضیحات",
        "expert" => "کازشناس یا متخصص",
        "img.*" => "فایل",
        "fil.*" => "فایل",
        "video" => "فایل",
        "captcha" => "کد امنیتی",
        "vid" => "فایل",
        "img" => "فایل",
        "fil" => "فایل",
        "zone_id" => "حوزه",
        "section_id" => "معاونت",
        "internal_number" => "شماره داخلی",
        "lable" => "لیبل",
        "tr_type" => "نوع معامله",
        "usertype" => "نوع کاربری",
        'type' => "نوع ملک",
        'bedroom' => 'تعداد خواب',
        'floorsell' => 'طبقه مورد معامله',
        'floor' => 'تعداد طبقات',
        'meter' => 'متراژ زیر بنا',
        'lon' => 'طول جغرافیایی',
        'lat' => 'عرض جغرافیایی',
        'rent' => 'مبلغ اجاره',
        'rahn' => 'مبلغ رهن',
        'people_number' => 'حد اکثر تعداد نفرات',
        'loan' => 'وام بانکی',
        'loanamount' => 'مبلغ وام',
        'meter_price' => 'قیمت هر متر',
        'bidprice' => 'قیمت پیشنهادی',
        'name_family' => 'نام و نام خانوادگی',
        'telephone' => 'تلفن',
        'body' => 'توضیحات',
    ),
);
