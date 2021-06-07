<?php


use App\Http\Controllers\StudentController;
use App\Http\Controllers\SignUpController;
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

Route::get('/', function () {
    return view('Index');
});

//Route::get('/data', [StudentController::class, 'index'])->name('data.index');
Route::get('/data', [StudentController::class, 'index']);
Route::post('/store' , [StudentController::class, 'store']);
Route::get('/delete/{id}', [StudentController::class, 'delete']);
Route::post('/edit/{id}', [StudentController::class, 'edit'] );

Route::post('/signup',[SignUpController::class, 'signup']);
Route::post('/login', [SignUpController::class, 'login']);
Route::get('/logout',[SignUpController::class, 'logout']);
Route::get('/profile', [SignUpController::class, 'profile']);
Route::post('/changeProfile', [SignUpController::class, 'changeProfile']);


Route::get('/autocomplete', [SignUpController::class, 'index']);
Route::post('/autocomplete/fetch', [SignUpController::class, 'fetch'])->name('autocomplete.fetch');
Route::get('/userprofile/{id}', [SignUpController::class, 'personProfile']);
Route::get('/find', function () {
    return view('/');
});
Route::get('/findPeople', [SignUpController::class, 'findPeople']);
Route::get('/addfriend/{id}', [SignUpController::class, 'addfriend']);
Route::get('/friendlist/{id}', [SignUpController::class, 'friendlist']);
Route::get('/decline/{id}', [SignUpController::class, 'decline']);
Route::get('/block/{id}',[SignUpController::class, 'block']);
Route::get('/declinesent/{id}', [SignUpController::class, 'declinesent']);
Route::post('postdata', [SignUpController::class, 'postdata']);
Route::get('cancel/{id}', [SignUpController::class, 'cancel']);
Route::get('dec/{id}', [SignUpController::class, 'dec']);
Route::get('like/{id}', [SignUpController::class, 'like']);
Route::post('comment', [SignUpController::class, 'comment']);//Ajax
Route::post('commentEdit', [SignUpController::class, 'commentEdit']);
//Route::get('commentDelete/{id}', [SignUpController::class, 'commentDelete']);
Route::get('delete-post/{id}', [SignUpController::class, 'deletepost']);
Route::post('findpeoplecomment', [SignUpController::class, 'findpeoplecomment']);
Route::post('profile/like', [SignUpController::class, 'profileLike']);//Ajax
Route::get('LikeAjax', [SignUpController::class, 'LikeAjax']);
Route::get('CommentAjax', [SignUpController::class, 'CommentAjax']);
Route::post('CommentDeleteAjax', [SignUpController::class, 'CommentDeleteAjax']);
Route::post('commentDelete', [SignUpController::class, 'commentDelete']);
Route::get('EditAjax',[SignUpController::class, 'EditAjax']);
Route::post('SenderPost', [SignUpController::class, 'SenderPost']);
Route::get('AjaxSenderPost', [SignUpController::class, 'AjaxSenderPost']);
Route::get('AjaxReceiverPost', [SignUpController::class, 'AjaxReceiverPost']);
Route::post('PasswordChange', [SignUpController::class, 'passwordChange']);
Route::post('forgotPassword', [SignUpController::class, 'forgotPassword']);



//Route::get('/autocomplete', 'AutocompleteController@index');
//Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');


