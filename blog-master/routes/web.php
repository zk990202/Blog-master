<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/AllBlog', ['as' => 'All', 'uses' => 'BlogController@AllBlog']);

//Blog:
//show a blog
Route::get('/article/{id}', ['uses'=> 'BlogController@get', 'as'=> 'A_blog']);

//add a Blog
Route::get('/article', function(){
   return view('Blog.add');
});
Route::post('/article', 'BlogController@add');

//update a Blog
Route::get('/article/update/{id}', function($id){
    $blog = DB::select('select * from blog where id = ?', [(int)$id]);
    return view('Blog.update', ['id' => $id, 'blog' => $blog]);
});
Route::put('/article/{id}', 'BlogController@update');

//delete a Blog
Route::get('/article/delete/{id}', 'BlogController@delete');


//Comment:
//add a comment
Route::get('/comment/{bid}', function ($bid){
    return view('Comment.Add', ['bid' => $bid, ]);
});
Route::post('/comment/{bid}', 'BlogController@CommentAdd');

//update a comment

Route::get('/comment/update/{bid}/{id}', function ($bid, $id){
    $comment = DB::select('select * from comment where id = ?', [$id]);
    return view('comment.update', ['id' => $id, 'bid' => $bid, 'comment' => $comment]);
});
Route::put('/comment/{bid}/{id}', 'BlogController@CommentUpdate');

//delete a comment
Route::get('comment/delete/{bid}/{id}', 'BlogController@CommentDelete');


//Admin:
Route::get('/admin', function (){
    $user = Auth::user();
    $id = $user->is_admin;
    if($id == 0)
    {
        return view('Admin.AdminFail');
    }
    else
    {
        return view('Admin.AdminSuccess');
    }
});

//view users
Route::get('/admin/user', ['as' => 'AdminU', function (){
    return view('Admin.AdminUser');
}]);
Route::get('/admin/user/view','UserController@UserView');

//add a user
Route::get('/admin/user/add', function (){
    return view('Admin.UserAdd');
});
Route::post('/admin/user', 'UserController@UserAdd');

//update a user
Route::get('/admin/user/update/{id}', function ($id){
    $user = DB::select('select * from users where id = ?', [$id]);
    return view('Admin.UserUpdate', ['id' => $id, 'user' => $user]);
});
Route::put('/admin/user/{id}', 'UserController@UserUpdate');

//delete a user
Route::get('/admin/user/delete/{id}', 'UserController@UserDelete');


Auth::routes();

Route::get('/home', 'HomeController@index');
