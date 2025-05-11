<?php

use App\Livewire\Admin\Agreement\AgreementList;
use App\Livewire\Admin\Agreement\CreateAgreement;
use App\Livewire\Admin\Agreement\EditAgreement;
use App\Livewire\Admin\Agreement\ShowAgreement;
use App\Livewire\Home\Pages\ContactUs;
use App\Livewire\Home\Pages\PropertiesList;
use App\Livewire\Home\Pages\ShowArticle;
use App\Livewire\Home\Pages\ShowBlog;
use App\Livewire\Home\Pages\ShowProperty;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\UploadController;
use App\Notifications\OtpSms;
use App\Channels\SmsChannel;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Home\HomeController;
use App\Models\Image;
use App\Models\PropertyImage;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RouteController;
use App\Livewire\Admin\Article\ArticleComponent as AdminArticleComponent;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\Feature\FeatureComponent;
use App\Livewire\Admin\Post\PostComponent;
use App\Livewire\Admin\Profile\EditProfile;
use App\Livewire\Admin\Property\CreateProperty;
use App\Livewire\Admin\Property\EditProperty;
use App\Livewire\Admin\Property\PropertyComponent;
use App\Livewire\Admin\Property\ShowProperty as AdminShowProperty;
use App\Livewire\Admin\Services\ServiceComponent;
use App\Livewire\Admin\Setting\SettingComponent;
use App\Livewire\Admin\Slider\SliderComponent;
use App\Livewire\Admin\User\Create;
use App\Livewire\Admin\User\Edit;
use App\Livewire\Admin\User\UserList;
use App\Livewire\Home\Pages\ArticleComponent;
use App\Livewire\Home\Pages\BlogComponent;
use App\Livewire\Home\Pages\HomeComponent;
use App\Livewire\Home\Pages\UserProfile\CreateProperty as UserProfileCreateProperty;
use App\Livewire\Home\Pages\UserProfile\Index;
use App\Livewire\Home\Pages\UserProfile\WishList;

//define route
Route::get('/router', [RouteController::class, 'index'])->name('setroute');

//livewire home route
Route::get('/', HomeComponent::class)->name('home');
Route::get('/blog', BlogComponent::class)->name('blog.index');
Route::get('/blog/{post}', ShowBlog::class)->name('blog.show');
Route::get('/articles', ArticleComponent::class)->name('articles.index');
Route::get('/article/{article}', ShowArticle::class)->name('article.show');
Route::get('/properties/list', PropertiesList::class)->name('properties.list');
Route::get('/properties/fetch_list', [HomeController::class, 'fetch_list']);
Route::get('/properties/{property}', ShowProperty::class)->name('properties.show');
// Route::post('/properties/{property}/comments', [HomeController::class, 'register_comment'])->middleware('auth')->name('comments.register');
Route::get('/contact-us', ContactUs::class)->name('contact_us');

Route::get('/forget_password', function () {
    return view('auth.passwords.ForgetPassword');
})->name('forget_password');

//------------------------------------------------------------------------------------
//Livewire user route
Route::prefix('user')->middleware(['auth', 'user'])->name('user.')->group(function () {
    Route::get('/properties/createproperty', UserProfileCreateProperty::class)->name('properties.create');
    Route::get('/dashboard', Index::class)->name('home');
    // Route::resource('/profile', ProfileController::class)->except(['show', 'index']);
    Route::get('/add-to-wishlist/{property}', [WishListController::class, 'add'])->name('home.wishlist.add');
    Route::get('/wish_list', WishList::class)->name('show');

    // Route::resource('/properties', PropertyController::class)->except(['show', 'update', 'edit']);

    Route::post('/upload/store', [UploadController::class, 'store'])->name('upload');
    Route::post('/delete', [UploadController::class, 'delete'])->name('del');
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
        Route::get('/properties/show/{property}', AdminShowProperty::class)->name('properties.show');
        Route::get('/properties/create', CreateProperty::class)->name('properties.create');
        Route::get('/properties/{property}/edit', EditProperty::class)->name('properties.edit');
        Route::get('/properties', PropertyComponent::class)->name('properties.index');
        Route::get('/profile/edit/{user}', EditProfile::class)->name('edit-profile');
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');

        //livewire routes
        Route::get('/dashboard', DashboardComponent::class)->name('home');
        Route::get('/agreements', AgreementList::class)->name('agreements.index');
        Route::get('/agreements/show/{agreement}', ShowAgreement::class)->name('agreements.show');
        Route::get('/agreements/create', CreateAgreement::class)->name('agreements.create');
        Route::get('/agreements/{agreement}/edit', EditAgreement::class)->name('agreements.edit');

        Route::get('/services', ServiceComponent::class)->name('services');
        Route::get('/features', FeatureComponent::class)->name('features');
        Route::get('/articles', AdminArticleComponent::class)->name('articles');
        Route::get('/posts', PostComponent::class)->name('posts');
        Route::get('/sliders', SliderComponent::class)->name('sliders');

        Route::get('/settings', SettingComponent::class)->name('settings');

        Route::get('/user/create', Create::class)->name('create-user');
        Route::get('/user/edit/{user}', Edit::class)->name('edit-user');
        Route::get('/user/user-list', UserList::class)->name('list-user');


        Route::resource('/comments', CommentController::class)->only(['index', 'edit', 'destroy']);

        Route::get('/settings', SettingComponent::class)->name('settings');

        Route::delete('/delete-image/{image}', function (Image $image, ToastrFactory $flasher) {

            $image->delete();
            Storage::delete($image->url);
            $flasher->addSuccess('عکس با موفقیت حذف شد');
            return back();
        })->name('deleteImage')->middleware('cors');
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
