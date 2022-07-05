<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('news', NewsController::class)->except(['create', 'edit']);
Route::get('news/upvote/{id}', [NewsController::class, 'upvote']);

Route::apiResource('comment', CommentController::class)->except(['index', 'create', 'edit']);
Route::get('comment/by-news/{id}', [CommentController::class, 'allByNews']);
