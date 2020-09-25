<?php

use App\File;
use Illuminate\Support\Facades\Route;
use Illuminate\http\Request;


Route::get('/', function ()
{
    return view('welcome');
});

Auth::routes();
/*
| Domain | Method   | URI                           | Name                  | Action                                                                 | Middleware
|        | POST     | login                         |                       | App\Http\Controllers\Auth\LoginController@login                        | web,guest
|        | GET|HEAD | login                         | login                 | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest
|        | POST     | logout                        | logout                | App\Http\Controllers\Auth\LoginController@logout                       | web
|        | GET|HEAD | password/confirm              | password.confirm      | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth
|        | POST     | password/confirm              |                       | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth
|        | POST     | password/email                | password.email        | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web
|        | GET|HEAD | password/reset                | password.request      | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web
|        | POST     | password/reset                | password.update       | App\Http\Controllers\Auth\ResetPasswordController@reset                | web
|        | GET|HEAD | password/reset/{token}        | password.reset        | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web
|        | GET|HEAD | register                      | register              | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest
|        | POST     | register                      |                       | App\Http\Controllers\Auth\RegisterController@register                  | web,guest
 */

            # start gesut middleware

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/search_result', 'HomeController@Search_Result')->name('search_result');

Route::get('home/show/item/{id}','HomeController@show_item_detile')->name('user.item.show');

Route::get('/register', 'HomeController@show_registe_form')->name('register');
Route::post('/user/add/user_request', 'HomeController@add_user_request')->name('user.store_user_request');

Route::get('user/error/notAdmin',function ()
{
    return view('user.errors.notAdmin');
});

Route::get('user/error/notActive',function ()
{
    return view('user.errors.notActive');
});


            # end gesut middleware



            # start admin_auth middleware
Route::get('admin/index',function ()
{
    return view('admin_panel.index');
})->middleware('admin_auth');


Route::resource('admin/user','admin\UserController');
Route::put('admin/user/{id}/updatePassword','admin\UserController@updatePassword')->name('user.updatePassword');

Route::get('admin/user/add/user_request','admin\UserController@show_add_user_request')->name('user.add_user_request');

Route::post('admin/user/accept/{id}','admin\UserController@accept_add_user_request')->name('user.accept_add_user_request');
Route::delete('admin/user/rejection/{id}','admin\UserController@rejection_add_user_request')->name('user.rejection_add_user_request');



/*
| Domain | Method    | URI                           | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/user                    | user.index            | App\Http\Controllers\admin\UserController@index               | web,admin_auth
|        | POST      | admin/user                    | user.store            | App\Http\Controllers\admin\UserController@store               | web,admin_auth
|        | GET|HEAD  | admin/user/create             | user.create           | App\Http\Controllers\admin\UserController@create              | web,admin_auth
|        | GET|HEAD  | admin/user/{user}             | user.show             | App\Http\Controllers\admin\UserController@show                | web,admin_auth
|        | PUT|PATCH | admin/user/{user}             | user.update           | App\Http\Controllers\admin\UserController@update              | web,admin_auth
|        | DELETE    | admin/user/{user}             | user.destroy          | App\Http\Controllers\admin\UserController@destroy             | web,admin_auth
|        | GET|HEAD  | admin/user/{user}/edit        | user.edit             | App\Http\Controllers\admin\UserController@edit                | web,admin_auth

 */
Route::resource('admin/role','admin\RoleController');
/*
| Domain | Method    | URI                           | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/role                    | role.index            | App\Http\Controllers\admin\RoleController@index               | web,admin_auth
|        | POST      | admin/role                    | role.store            | App\Http\Controllers\admin\RoleController@store               | web,admin_auth
|        | GET|HEAD  | admin/role/create             | role.create           | App\Http\Controllers\admin\RoleController@create              | web,admin_auth
|        | GET|HEAD  | admin/role/{role}             | role.show             | App\Http\Controllers\admin\RoleController@show                | web,admin_auth
|        | PUT|PATCH | admin/role/{role}             | role.update           | App\Http\Controllers\admin\RoleController@update              | web,admin_auth
|        | DELETE    | admin/role/{role}             | role.destroy          | App\Http\Controllers\admin\RoleController@destroy             | web,admin_auth
|        | GET|HEAD  | admin/role/{role}/edit        | role.edit             | App\Http\Controllers\admin\RoleController@edit                | web,admin_auth
 */

Route::resource('admin/borrow','admin\BorrowController');
Route::get('admin/borrow/setitem/1','admin\BorrowController@setItem')->name('borrow.setitem');
Route::post('admin/borrow/setuser/1','admin\BorrowController@setUser')->name('borrow.setuser');
Route::put('admin/borrow/cancel/reservation','admin\BorrowController@cansel_reservation')->name('borrow.canselreservation');

Route::get('admin/borrows/extend/all','admin\BorrowController@show_extend_borrows_requsets')->name('borrow.extend.all');

Route::post('admin/borrow/accept/{id}','admin\BorrowController@accept_extend_borrow')->name('borrow.accept_extend_borrow');
Route::delete('admin/borrow/rejection/{id}','admin\BorrowController@rejection_extend_borrow')->name('borrow.rejection_extend_borrow');



/*
| Domain | Method    | URI                           | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/borrow                  | borrow.index          | App\Http\Controllers\admin\BorrowController@index             | web,admin_auth
|        | POST      | admin/borrow                  | borrow.store          | App\Http\Controllers\admin\BorrowController@store             | web,admin_auth
|        | GET|HEAD  | admin/borrow/create           | borrow.create         | App\Http\Controllers\admin\BorrowController@create            | web,admin_auth
|        | GET|HEAD  | admin/borrow/{borrow}         | borrow.show           | App\Http\Controllers\admin\BorrowController@show              | web,admin_auth
|        | PUT|PATCH | admin/borrow/{borrow}         | borrow.update         | App\Http\Controllers\admin\BorrowController@update            | web,admin_auth
|        | DELETE    | admin/borrow/{borrow}         | borrow.destroy        | App\Http\Controllers\admin\BorrowController@destroy           | web,admin_auth
|        | GET|HEAD  | admin/borrow/{borrow}/edit    | borrow.edit           | App\Http\Controllers\admin\BorrowController@edit              | web,admin_auth
 */

Route::resource('admin/borrow_state','admin\Borrow_StateController');
/*
| Domain | Method    | URI                                    | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/borrow_state                     | borrow_state.index    | App\Http\Controllers\admin\Borrow_StateController@index       | web,admin_auth
|        | POST      | admin/borrow_state                     | borrow_state.store    | App\Http\Controllers\admin\Borrow_StateController@store       | web,admin_auth
|        | GET|HEAD  | admin/borrow_state/create              | borrow_state.create   | App\Http\Controllers\admin\Borrow_StateController@create      | web,admin_auth
|        | GET|HEAD  | admin/borrow_state/{borrow_state}      | borrow_state.show     | App\Http\Controllers\admin\Borrow_StateController@show        | web,admin_auth
|        | PUT|PATCH | admin/borrow_state/{borrow_state}      | borrow_state.update   | App\Http\Controllers\admin\Borrow_StateController@update      | web,admin_auth
|        | DELETE    | admin/borrow_state/{borrow_state}      | borrow_state.destroy  | App\Http\Controllers\admin\Borrow_StateController@destroy     | web,admin_auth
|        | GET|HEAD  | admin/borrow_state/{borrow_state}/edit | borrow_state.edit     | App\Http\Controllers\admin\Borrow_StateController@edit        | web,admin_auth

 */

Route::resource('admin/item','admin\ItemController');
Route::post('admin/item/tosetAuthor','admin\ItemController@tosetAuthor')->name('item.tosetAuthor');
Route::post('admin/item/tosetTag','admin\ItemController@tosetTag')->name('item.tosetTag');

Route::get('admin/item/add/item_request','admin\ItemController@show_add_item_request')->name('item.add_item_request');
Route::delete('admin/item/add/rejection/{id}','admin\ItemController@rejection_add_item_request')->name('item.rejection_add_item_request');
Route::post('admin/item/add/accept/{id}','admin\ItemController@accept_add_item_request')->name('item.accept_add_item_request');

/*
| Domain | Method    | URI                           | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/item                    | item.index            | App\Http\Controllers\admin\ItemController@index               | web,admin_auth
|        | POST      | admin/item                    | item.store            | App\Http\Controllers\admin\ItemController@store               | web,admin_auth
|        | GET|HEAD  | admin/item/create             | item.create           | App\Http\Controllers\admin\ItemController@create              | web,admin_auth
|        | GET|HEAD  | admin/item/{item}             | item.show             | App\Http\Controllers\admin\ItemController@show                | web,admin_auth
|        | PUT|PATCH | admin/item/{item}             | item.update           | App\Http\Controllers\admin\ItemController@update              | web,admin_auth
|        | DELETE    | admin/item/{item}             | item.destroy          | App\Http\Controllers\admin\ItemController@destroy             | web,admin_auth
|        | GET|HEAD  | admin/item/{item}/edit        | item.edit             | App\Http\Controllers\admin\ItemController@edit                | web,admin_auth
 */

Route::resource('admin/item_type','admin\Item_TypeController');
/*
| Domain | Method    | URI                              | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/item_type                  | item_type.index       | App\Http\Controllers\admin\Item_TypeController@index          | web,admin_auth
|        | POST      | admin/item_type                  | item_type.store       | App\Http\Controllers\admin\Item_TypeController@store          | web,admin_auth
|        | GET|HEAD  | admin/item_type/create           | item_type.create      | App\Http\Controllers\admin\Item_TypeController@create         | web,admin_auth
|        | GET|HEAD  | admin/item_type/{item_type}      | item_type.show        | App\Http\Controllers\admin\Item_TypeController@show           | web,admin_auth
|        | PUT|PATCH | admin/item_type/{item_type}      | item_type.update      | App\Http\Controllers\admin\Item_TypeController@update         | web,admin_auth
|        | DELETE    | admin/item_type/{item_type}      | item_type.destroy     | App\Http\Controllers\admin\Item_TypeController@destroy        | web,admin_auth
|        | GET|HEAD  | admin/item_type/{item_type}/edit | item_type.edit        | App\Http\Controllers\admin\Item_TypeController@edit           | web,admin_auth
 */

Route::resource('admin/item_state','admin\Item_StateController');
/*
| Domain | Method    | URI                                | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/item_state                   | item_state.index      | App\Http\Controllers\admin\Item_StateController@index         | web,admin_auth
|        | POST      | admin/item_state                   | item_state.store      | App\Http\Controllers\admin\Item_StateController@store         | web,admin_auth
|        | GET|HEAD  | admin/item_state/create            | item_state.create     | App\Http\Controllers\admin\Item_StateController@create        | web,admin_auth
|        | GET|HEAD  | admin/item_state/{item_state}      | item_state.show       | App\Http\Controllers\admin\Item_StateController@show          | web,admin_auth
|        | PUT|PATCH | admin/item_state/{item_state}      | item_state.update     | App\Http\Controllers\admin\Item_StateController@update        | web,admin_auth
|        | DELETE    | admin/item_state/{item_state}      | item_state.destroy    | App\Http\Controllers\admin\Item_StateController@destroy       | web,admin_auth
|        | GET|HEAD  | admin/item_state/{item_state}/edit | item_state.edit       | App\Http\Controllers\admin\Item_StateController@edit          | web,admin_auth
 */

Route::resource('admin/author','admin\AuthorController');
/*
| Domain | Method    | URI                           | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/author                  | author.index          | App\Http\Controllers\admin\AuthorController@index             | web,admin_auth
|        | POST      | admin/author                  | author.store          | App\Http\Controllers\admin\AuthorController@store             | web,admin_auth
|        | GET|HEAD  | admin/author/create           | author.create         | App\Http\Controllers\admin\AuthorController@create            | web,admin_auth
|        | GET|HEAD  | admin/author/{author}         | author.show           | App\Http\Controllers\admin\AuthorController@show              | web,admin_auth
|        | PUT|PATCH | admin/author/{author}         | author.update         | App\Http\Controllers\admin\AuthorController@update            | web,admin_auth
|        | DELETE    | admin/author/{author}         | author.destroy        | App\Http\Controllers\admin\AuthorController@destroy           | web,admin_auth
|        | GET|HEAD  | admin/author/{author}/edit    | author.edit           | App\Http\Controllers\admin\AuthorController@edit              | web,admin_auth
 */

Route::resource('admin/maintainer','admin\MaintainerController');
/*
| Domain | Method    | URI                                | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/maintainer                   | maintainer.index      | App\Http\Controllers\admin\MaintainerController@index         | web,admin_auth
|        | POST      | admin/maintainer                   | maintainer.store      | App\Http\Controllers\admin\MaintainerController@store         | web,admin_auth
|        | GET|HEAD  | admin/maintainer/create            | maintainer.create     | App\Http\Controllers\admin\MaintainerController@create        | web,admin_auth
|        | GET|HEAD  | admin/maintainer/{maintainer}      | maintainer.show       | App\Http\Controllers\admin\MaintainerController@show          | web,admin_auth
|        | PUT|PATCH | admin/maintainer/{maintainer}      | maintainer.update     | App\Http\Controllers\admin\MaintainerController@update        | web,admin_auth
|        | DELETE    | admin/maintainer/{maintainer}      | maintainer.destroy    | App\Http\Controllers\admin\MaintainerController@destroy       | web,admin_auth
|        | GET|HEAD  | admin/maintainer/{maintainer}/edit | maintainer.edit       | App\Http\Controllers\admin\MaintainerController@edit          | web,admin_auth

 */

Route::resource('admin/subject','admin\SubjectController');
/*
| Domain | Method    | URI                           | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/subject                 | subject.index         | App\Http\Controllers\admin\SubjectController@index            | web,admin_auth
|        | POST      | admin/subject                 | subject.store         | App\Http\Controllers\admin\SubjectController@store            | web,admin_auth
|        | GET|HEAD  | admin/subject/create          | subject.create        | App\Http\Controllers\admin\SubjectController@create           | web,admin_auth
|        | GET|HEAD  | admin/subject/{subject}       | subject.show          | App\Http\Controllers\admin\SubjectController@show             | web,admin_auth
|        | PUT|PATCH | admin/subject/{subject}       | subject.update        | App\Http\Controllers\admin\SubjectController@update           | web,admin_auth
|        | DELETE    | admin/subject/{subject}       | subject.destroy       | App\Http\Controllers\admin\SubjectController@destroy          | web,admin_auth
|        | GET|HEAD  | admin/subject/{subject}/edit  | subject.edit          | App\Http\Controllers\admin\SubjectController@edit             | web,admin_auth
 */

Route::resource('admin/academic_year','admin\Academic_YearController');
/*
| Domain | Method    | URI                                      | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/academic_year                      | academic_year.index   | App\Http\Controllers\admin\Academic_YearController@index      | web,admin_auth
|        | POST      | admin/academic_year                      | academic_year.store   | App\Http\Controllers\admin\Academic_YearController@store      | web,admin_auth
|        | GET|HEAD  | admin/academic_year/create               | academic_year.create  | App\Http\Controllers\admin\Academic_YearController@create     | web,admin_auth
|        | GET|HEAD  | admin/academic_year/{academic_year}      | academic_year.show    | App\Http\Controllers\admin\Academic_YearController@show       | web,admin_auth
|        | PUT|PATCH | admin/academic_year/{academic_year}      | academic_year.update  | App\Http\Controllers\admin\Academic_YearController@update     | web,admin_auth
|        | DELETE    | admin/academic_year/{academic_year}      | academic_year.destroy | App\Http\Controllers\admin\Academic_YearController@destroy    | web,admin_auth
|        | GET|HEAD  | admin/academic_year/{academic_year}/edit | academic_year.edit    | App\Http\Controllers\admin\Academic_YearController@edit       | web,admin_auth

 */

Route::resource('admin/specialize','admin\SpecializeController');
/*
| Domain | Method    | URI                                | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/specialize                   | specialize.index      | App\Http\Controllers\admin\SpecializeController@index         | web,admin_auth
|        | POST      | admin/specialize                   | specialize.store      | App\Http\Controllers\admin\SpecializeController@store         | web,admin_auth
|        | GET|HEAD  | admin/specialize/create            | specialize.create     | App\Http\Controllers\admin\SpecializeController@create        | web,admin_auth
|        | GET|HEAD  | admin/specialize/{specialize}      | specialize.show       | App\Http\Controllers\admin\SpecializeController@show          | web,admin_auth
|        | PUT|PATCH | admin/specialize/{specialize}      | specialize.update     | App\Http\Controllers\admin\SpecializeController@update        | web,admin_auth
|        | DELETE    | admin/specialize/{specialize}      | specialize.destroy    | App\Http\Controllers\admin\SpecializeController@destroy       | web,admin_auth
|        | GET|HEAD  | admin/specialize/{specialize}/edit | specialize.edit       | App\Http\Controllers\admin\SpecializeController@edit          | web,admin_auth
 */


Route::resource('admin/tag','admin\TagController');
/*
| Domain | Method    | URI                           | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/tag                     | tag.index             | App\Http\Controllers\admin\TagController@index                | web,admin_auth
|        | POST      | admin/tag                     | tag.store             | App\Http\Controllers\admin\TagController@store                | web,admin_auth
|        | GET|HEAD  | admin/tag/create              | tag.create            | App\Http\Controllers\admin\TagController@create               | web,admin_auth
|        | GET|HEAD  | admin/tag/{tag}               | tag.show              | App\Http\Controllers\admin\TagController@show                 | web,admin_auth
|        | PUT|PATCH | admin/tag/{tag}               | tag.update            | App\Http\Controllers\admin\TagController@update               | web,admin_auth
|        | DELETE    | admin/tag/{tag}               | tag.destroy           | App\Http\Controllers\admin\TagController@destroy              | web,admin_auth
|        | GET|HEAD  | admin/tag/{tag}/edit          | tag.edit              | App\Http\Controllers\admin\TagController@edit                 | web,admin_auth
 */

Route::resource('admin/site_setting','admin\Site_SettingController');
Route::put('admin/site_setting/update_all','admin\Site_SettingController@update_all')->name('site_setting.update_all');
/*
| Domain | Method    | URI                                    | Name                  | Action                                                        | Middleware
|        | GET|HEAD  | admin/site_setting                     | site_setting.index    | App\Http\Controllers\admin\Site_SettingController@index       | web,admin_auth
|        | POST      | admin/site_setting                     | site_setting.store    | App\Http\Controllers\admin\Site_SettingController@store       | web,admin_auth
|        | GET|HEAD  | admin/site_setting/create              | site_setting.create   | App\Http\Controllers\admin\Site_SettingController@create      | web,admin_auth
|        | GET|HEAD  | admin/site_setting/{site_setting}      | site_setting.show     | App\Http\Controllers\admin\Site_SettingController@show        | web,admin_auth
|        | PUT|PATCH | admin/site_setting/{site_setting}      | site_setting.update   | App\Http\Controllers\admin\Site_SettingController@update      | web,admin_auth
|        | DELETE    | admin/site_setting/{site_setting}      | site_setting.destroy  | App\Http\Controllers\admin\Site_SettingController@destroy     | web,admin_auth
|        | GET|HEAD  | admin/site_setting/{site_setting}/edit | site_setting.edit     | App\Http\Controllers\admin\Site_SettingController@edit        | web,admin_auth

 */

            # end admin_auth middleware

            # start auth middleware



Route::get('home/add_item','UserController@show_add_item_project_request')->name('user.item.add');
Route::post('home/add_item/post','UserController@store_item_project_request')->name('user.item.store');

Route::get('home/myBorrows','UserController@show_my_borrows_and_reservations')->name('user.borrows.show');

Route::get('home/extend/Borrow/{id}','UserController@extend_borrow')->name('user.extend.borrow.show');
Route::post('home/extend/Borrow/store','UserController@store_extend_borrow')->name('user.extend.borrow.store');


Route::post('home/add_favorite/{id}','UserController@add_item_to_favorite')->name('user.favorite.add');

Route::post('home/add_reservation/{id}','UserController@add_item_to_reservation')->name('user.reservation.add');

Route::get('download/{id}', 'UserController@download_file')->name('download');


            # end auth middleware
