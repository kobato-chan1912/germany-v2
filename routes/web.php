<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Auth Routes for admin
|--------------------------------------------------------------------------
*/

Route::prefix("/CDM")->group(function (){
    Route::get("/login", "AuthController@GetLogin")->name("login");
    Route::post("/login", "AuthController@Login");
    Route::get("/logout", "AuthController@logout")->name("logout");
});


// Dashboard Route //

Route::prefix("/CDM")->middleware("auth")->group(function () {


    Route::get('/', "HomeController@index")->name("dashboard");

    Route::prefix("/")->middleware("isRoot")->group(function (){
        Route::get("/users", "UserController@index")->name("usersIndex");
        Route::post("/users", "UserController@create");
        Route::delete("/users/{id}", "UserController@destroy");
        Route::post("/users/{id}", "UserController@update");
    });

    Route::get("/header", "HeaderController@index");
    Route::post("/header", "HeaderController@edit");

    /*
    |--------------------------------------------------------------------------
    | Categories Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/categories", "CategoryController@index")->name("categoriesIndex");
    Route::post("/categories", "CategoryController@create");
    Route::delete("/categories/{id}", "CategoryController@destroy");
    Route::post("/categories/{id}", "CategoryController@edit");

    /*
    |--------------------------------------------------------------------------
    | Randomization Routes
    |--------------------------------------------------------------------------
    */
    Route::get("/random-songs-title", "RandomController@indexTitle");
    Route::post("/random-songs-title", "RandomController@editTitle");
    Route::get("/random-songs-description", "RandomController@indexDescription");
    Route::post("/random-songs-description", "RandomController@editDescription");
    Route::get("/random-categories-title", "RandomController@indexCategories");
    Route::post("/random-categories-title", "RandomController@editCategories");

    /*
    |--------------------------------------------------------------------------
    | Outside Post Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/post-outside", "OutsideController@indexPost")->name("post_outside");
    Route::post("/post-outside", "OutsideController@editPost");
//Route::get("/post-outside/preview", "OutsideController@previewPost")->name("post_outside_preview");


    /*
    |--------------------------------------------------------------------------
    | Posts Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/posts", "PostController@index")->name("postsIndex");
    Route::get("/posts/create", "PostController@indexCreate")->name("postsCreate");
    Route::post("/posts/create", "PostController@create");
    Route::get("/posts/{id}", "PostController@indexEdit");
    Route::post("/posts/{id}", "PostController@edit")->name("postsEdit");
    Route::delete("/posts/{id}", "PostController@destroy");

    /*
    |--------------------------------------------------------------------------
    | Songs Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/songs", "SongController@index")->name("songsIndex");
    Route::get("/songs/create", "SongController@indexCreate")->name("songsCreate");
    Route::post("/songs/create", "SongController@create");
    Route::delete("/songs/{id}", "SongController@destroy");
    Route::get("/songs/{id}", "SongController@indexEdit")->name("songsEdit");
    Route::post("/songs/{id}", "SongController@edit");


    /*
        |--------------------------------------------------------------------------
        | Config Routes
        |--------------------------------------------------------------------------
    */

    Route::get("/configs", "ConfigController@index");
    Route::post("/configs", "ConfigController@update");

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/api/random-song", "ApiController@randomSong")->name("random_song");
    Route::get("/api/random-cate", "ApiController@randomCategory")->name("random_category");
    Route::post("/api/check-song", "ApiController@checkSong")->name("checkSong_API");


});
Route::prefix("/admin")->middleware("auth")->group(function () {


    Route::get('/', "HomeController@index")->name("dashboard");

    Route::prefix("/")->middleware("isRoot")->group(function (){
        Route::get("/users", "UserController@index")->name("usersIndex");
        Route::post("/users", "UserController@create");
        Route::delete("/users/{id}", "UserController@destroy");
        Route::post("/users/{id}", "UserController@update");
    });

    Route::get("/header", "HeaderController@index");
    Route::post("/header", "HeaderController@edit");

    /*
    |--------------------------------------------------------------------------
    | Categories Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/categories", "CategoryController@index")->name("categoriesIndex");
    Route::post("/categories", "CategoryController@create");
    Route::delete("/categories/{id}", "CategoryController@destroy");
    Route::post("/categories/{id}", "CategoryController@edit");

    /*
    |--------------------------------------------------------------------------
    | Randomization Routes
    |--------------------------------------------------------------------------
    */
    Route::get("/random-songs-title", "RandomController@indexTitle");
    Route::post("/random-songs-title", "RandomController@editTitle");
    Route::get("/random-songs-description", "RandomController@indexDescription");
    Route::post("/random-songs-description", "RandomController@editDescription");
    Route::get("/random-categories-title", "RandomController@indexCategories");
    Route::post("/random-categories-title", "RandomController@editCategories");

    /*
    |--------------------------------------------------------------------------
    | Outside Post Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/post-outside", "OutsideController@indexPost")->name("post_outside");
    Route::post("/post-outside", "OutsideController@editPost");
//Route::get("/post-outside/preview", "OutsideController@previewPost")->name("post_outside_preview");


    /*
    |--------------------------------------------------------------------------
    | Posts Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/posts", "PostController@index")->name("postsIndex");
    Route::get("/posts/create", "PostController@indexCreate")->name("postsCreate");
    Route::post("/posts/create", "PostController@create");
    Route::get("/posts/{id}", "PostController@indexEdit");
    Route::post("/posts/{id}", "PostController@edit")->name("postsEdit");
    Route::delete("/posts/{id}", "PostController@destroy");

    /*
    |--------------------------------------------------------------------------
    | Songs Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/songs", "SongController@index")->name("songsIndex");
    Route::get("/songs/create", "SongController@indexCreate")->name("songsCreate");
    Route::post("/songs/create", "SongController@create");
    Route::delete("/songs/{id}", "SongController@destroy");
    Route::get("/songs/{id}", "SongController@indexEdit")->name("songsEdit");
    Route::post("/songs/{id}", "SongController@edit");


    /*
        |--------------------------------------------------------------------------
        | Config Routes
        |--------------------------------------------------------------------------
    */

    Route::get("/configs", "ConfigController@index");
    Route::post("/configs", "ConfigController@update");

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    Route::get("/api/random-song", "ApiController@randomSong")->name("random_song");
    Route::get("/api/random-cate", "ApiController@randomCategory")->name("random_category");
    Route::post("/api/check-song", "ApiController@checkSong")->name("checkSong_API");


});
/*
    |--------------------------------------------------------------------------
    | CKFinder Routes
    |--------------------------------------------------------------------------
    */

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector')->middleware("auth");

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser')->middleware("auth");


/*
    |--------------------------------------------------------------------------
    | Webpage Routes
    |--------------------------------------------------------------------------
*/
Route::get("/sitemap.xml", "SitemapController@index");
Route::get("/post-sitemap.xml", "SitemapController@postSitemap");
Route::get("/category-sitemap.xml", "SitemapController@categorySitemap");



Route::prefix("/")->group(function (){
   Route::get("/", "WebPageController@indexHome")->name("webPageIndex");

    // Search Routes

    Route::get("/search/{search}", "WebPageCategoryController@search");


//   Route::get("/newest", "WebPageController@newest");
    Route::get("/page/{page}", function($page){
        return redirect(env("WEBPAGE_URL"). "?page=". $page);
    });
    Route::get("/beste-klingeltone", "WebPageCategoryController@losMejores")->name("lostMejores");
   Route::get("/neueste-klingeltone", "WebPageCategoryController@newestSongs")->name("newest");
   Route::get("/top-klingeltone", "WebPageCategoryController@popularSongs")->name("popularSongs");
   Route::get("/{slug}", "WebPageCategoryController@categorySongs")->name("categoriesSongs");



    // Download

//    Route::get("/{category}/{song}/download", "WebPageController@download");
    Route::get("/download/{id}", "WebPageController@download");
    Route::get("/dl/download", "WebPageController@dlDownload")->name("dlDownload");

});
