<?php

use App\Livewire\Admin\Agreement\AgreementList;
use App\Livewire\Admin\Agreement\CreateAgreement;
use App\Livewire\Admin\Agreement\EditAgreement;
use App\Livewire\Admin\Agreement\ShowAgreement;
use App\Livewire\Home\Pages\PropertyList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Home\ArticleHomeController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\UploadController;
use App\Notifications\OtpSms;
use App\Channels\SmsChannel;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\BlogController;
use App\Models\Image;
use App\Models\PropertyImage;
use App\Models\Setting;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RouteController;
use App\Livewire\Admin\Article\ArticleComponent;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\Feature\CreateFeature;
use App\Livewire\Admin\Feature\FeatureComponent;
use App\Livewire\Admin\Post\PostComponent;
use App\Livewire\Admin\Profile\EditProfile;
use App\Livewire\Admin\Property\CreateProperty;
use App\Livewire\Admin\Property\DeviceComponent;
use App\Livewire\Admin\Property\EditProperty;
use App\Livewire\Admin\Property\PropertyComponent;
use App\Livewire\Admin\Property\ShowProperty;
use App\Livewire\Admin\Services\ServiceComponent;
use App\Livewire\Admin\Setting\SettingComponent;
use App\Livewire\Admin\Slider\SliderComponent;
use App\Livewire\Admin\User\Create;
use App\Livewire\Admin\User\Edit;
use App\Livewire\Admin\User\UserList;
use App\Livewire\Home\Pages\ArticleComponent as PagesArticleComponent;
use App\Livewire\Home\Pages\BlogComponent;
use App\Livewire\Home\Pages\HomeComponent;
use App\Livewire\Home\Pages\UserProfile\CreateProperty as UserProfileCreateProperty;
use App\Livewire\Home\Pages\UserProfile\Index;
use App\Models\Article;
use App\Models\WishList;
use Livewire\Livewire;

//define route
Route::get('/router', [RouteController::class, 'index'])->name('setroute');

//home route
//-------------------------------------------------------------------------------------------------------------------

// Route::view('/contact-us','home.pages.contact-us');
// Route::get('/', [HomeController::class, 'index'])->name('home');
// livewire home route
Route::get('/', HomeComponent::class)->name('home');
Route::get('/blog', BlogComponent::class)->name('blog.index');
Route::get('/articled', PagesArticleComponent::class)->name('articled.index');

Route::get('/properties/list', PropertyList::class)->name('properties.list');
Route::get('/properties/fetch_list', [HomeController::class, 'fetch_list']);
Route::get('/properties/{property}', [HomeController::class, 'show_property'])->name('properties.show');
Route::post('/properties/{property}/comments', [HomeController::class, 'register_comment'])->middleware('auth')->name('comments.register');
// Route::any('/admin', [AuthController::class,'login']);
// Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');
// Route::get('/articled', [ArticleHomeController::class, 'index'])->name('articled.index');
Route::get('/article/{article}', [ArticleHomeController::class, 'show'])->name('article.show');
Route::get('/contact-us', function () {
    $setting = Setting::firstOrNew();
    $setting['phone'] = json_decode($setting->phone);
    $setting['email'] = json_decode($setting->email);
    return view('home.pages.contact-us', compact('setting'));
})->name('contactus');

Route::get('/forget_password', function () {
    return view('auth.passwords.ForgetPassword');
})->name('forget_password');

//------------------------------------------------------------------------------------
//user route
Route::prefix('user')->middleware(['auth', 'user'])->name('user.')->group(function () {

    // Livewire route
    Route::get('/properties/createproperty', UserProfileCreateProperty::class)->name('properties.create');
    Route::get('/dashboard', Index::class)->name('home');
    Route::resource('/profile', ProfileController::class)->except(['show', 'index']);
    Route::get('/add-to-wishlist/{property}', [WishListController::class, 'add'])->name('home.wishlist.add');
    Route::get('/wish_list', [WishListController::class, 'show'])->name('show');

    Route::resource('/properties', PropertyController::class)->except(['show', 'update', 'edit']);

    // Route::get('/submit-propert', function () {
    //     $wishlist = Wishlist::where('user_id', auth()->id())->get();
    //     return view('home.pages.UserProfile.submit-property', compact('wishlist'));
    // })->name('submit-propert');

    Route::post('/upload/store', [UploadController::class, 'store'])->name('upload');
    Route::post('/delete', [UploadController::class, 'delete'])->name('del');

    // Route::get('/dashboard', function () {
    //     return view('home.pages.UserProfile.index');
    // })->name('home');
});

//------------------------------------------------------------------------------------

//agent route
Route::prefix('agent')->name('agent.')->middleware(['auth', 'agent'])->group(function () {
    Route::get('/dashboard', DashboardComponent::class)->name('home');
    Route::resource('/properties', PropertyController::class);
    Route::resource('/profile', ProfileController::class)->except(['show', 'index']);
    Route::get('/chenge', function () {
        return view('auth.passwords.chenge');
    })->name('chenge');
});


//------------------------------------------------------------------------------------

//admin route
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/chenge', function () {
        return view('auth.passwords.chenge');
    })->name('chenge');


    Route::group(['middleware' => ['auth', 'adminagent']], function () {
        Route::get('/properties/show/{property}', ShowProperty::class)->name('properties.show');
        Route::get('/properties/create', CreateProperty::class)->name('properties.create');
        Route::get('/properties/{property}/edit', EditProperty::class)->name('properties.edit');
        Route::get('/properties', PropertyComponent::class)->name('properties.index');
        Route::get('/profile/edit/{user}', EditProfile::class)->name('edit-profile');
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');
        // Route::resource('/properties', PropertyController::class);

        //livewire routes
        Route::get('/dashboard', DashboardComponent::class)->name('home');
        Route::get('/agreements', AgreementList::class)->name('agreements.index');
        Route::get('/agreements/show/{agreement}', ShowAgreement::class)->name('agreements.show');
        Route::get('/agreements/create', CreateAgreement::class)->name('agreements.create');
        Route::get('/agreements/{agreement}/edit', EditAgreement::class)->name('agreements.edit');

        Route::get('/services', ServiceComponent::class)->name('services');
        Route::get('/features', FeatureComponent::class)->name('features');
        Route::get('/articles', ArticleComponent::class)->name('articles');
        Route::get('/posts', PostComponent::class)->name('posts');
        Route::get('/sliders', SliderComponent::class)->name('sliders');

        Route::get('/settings', SettingComponent::class)->name('settings');

        Route::get('/user/cearte', Create::class)->name('cearte-user');
        Route::get('/user/edit/{user}', Edit::class)->name('edit-user');
        Route::get('/user/user-list', UserList::class)->name('list-user');





        // Route::resource('/profile', ProfileController::class)->except(['show', 'index']);

        Route::resource('/comments', CommentController::class)->only(['index', 'edit', 'destroy']);


        Route::get('/settings', SettingComponent::class)->name('settings');


        Route::delete('/delete-image/{image}', function (Image $image, ToastrFactory $flasher) {

            $image->delete();
            Storage::delete($image->url);
            $flasher->addSuccess('عکس با موفقیت حذف شد');
            return back();
        })->name('deleteImage')->middleware('cors');

        // Route::resource('/posts', PostController::class);
    });
});

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');

Route::delete('/test/{imageid}', function ($imageid) {
    $image = PropertyImage::find($imageid);
    $image->delete();
    Storage::delete('otherpreview/' . $image->name);
    return [
        'initialPreviewConfig' => [
            [    // check previewTypes (set it to 'other' if you want no content preview)
                'fileId' => $image->id,    // file identifier
            ]
        ],
        'append' => true
    ];
})->name('del')->middleware('cors');

Route::get('/test1', function () {
    ini_set("soap.wsdl_cache_enabled", "0");
    try {
        $user = "9131254642";
        $pass = "1270236581";


        $client = new SoapClient("http://panelis.ir/post/send.php?wsdl");


        $encoding = "UTF-8"; //CP1256, CP1252
        $textMessage = iconv($encoding, 'UTF-8//TRANSLIT', "ugiuguig");

        $sendsms_parameters = array(
            'username' => $user,
            'password' => $pass,
            'from' => "5000125475",
            'to' => array("9162418808"),
            'text' => "textMessage",
            'isflash' => false,
            'udh' => "",
            'recId' => array(0),
            'status' => 0
        );

        $status = $client->SendSms($sendsms_parameters)->SendSmsResult;
        echo "Status: " . $status . "<br />";

        $getnewmessage_parameters = array(
            "username" => $user,
            "password" => $pass,
            "from" => "5000125475"
        );
    } catch (SoapFault $ex) {
        echo $ex->faultstring;
    }
});
Route::get('/sms', [AuthController::class, 'sms']);
