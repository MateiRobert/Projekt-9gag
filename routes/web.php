<?php
namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardUser;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    
    // this should be the home page /posts
    return redirect('/posts');
});

Route::get('/dashboard', function () {
    return redirect('/posts');
});

Route::middleware('auth')->group(function () {
    //Pentru profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');


    //Pentru postari
    Route::resource('/posts', PostController::class);

    //Pentru voturi
    Route::post('/post/{post}/upvote', [VoteController::class, 'upvote'])->name('post.upvote');
    Route::post('/post/{post}/downvote', [VoteController::class, 'downvote'])->name('post.downvote');

    //Pentru comentarii
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


    //Pentru raportari
    Route::post('/report/{postId}', [PostController::class, 'report'])->name('report.post');




    //Pentru admin (dashboard)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/administrator', [DashboardUser::class, 'dashboard'])->name('administrator.index');
        })->name('administrator.index');


    });
    



    





Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


require __DIR__.'/auth.php';
