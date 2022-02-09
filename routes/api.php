<?php

use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Order\CartController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Screencast\CheckIfUserHasBoughtPlaylistController;
use App\Http\Controllers\Screencast\MyPlaylistsController;
use App\Http\Controllers\Screencast\PlaylistController;
use App\Http\Controllers\Screencast\TagController;
use App\Http\Controllers\Screencast\VideoController;
use Illuminate\Support\Facades\Route;

Route::prefix('playlists')->group(function() {
    Route::get('', [PlaylistController::class, 'index']);
    Route::get('{playlist:slug}', [PlaylistController::class, 'show']);

    Route::get('{playlist:slug}/videos', [VideoController::class, 'index']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', MeController::class);

    Route::get('playlists/{playlist:slug}/{video:episode}', [VideoController::class, 'show']);

    Route::get('carts', [CartController::class, 'show']);
    Route::post('add-to-cart/{playlist:slug}', [CartController::class, 'store']);
    Route::delete('carts/{cart}', [CartController::class, 'destroy']);

    Route::post('orders/create', [OrderController::class, 'store']);

    Route::get('my-playlists', MyPlaylistsController::class);

    Route::get('user-has-bougt-playlist-{playlist:slug}', CheckIfUserHasBoughtPlaylistController::class);
});
Route::post('notification-handler', [OrderController::class, 'notificationHandler']);