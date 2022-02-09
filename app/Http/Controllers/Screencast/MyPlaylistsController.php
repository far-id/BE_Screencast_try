<?php

namespace App\Http\Controllers\Screencast;

use App\Http\Controllers\Controller;
use App\Http\Resources\Screencast\PlaylistResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPlaylistsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $playlist = Auth::user()->purchases()->latest()->paginate(10);
        return PlaylistResource::collection($playlist);
    }
}
