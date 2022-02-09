<?php

namespace App\Http\Controllers\Screencast;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Screencast\Video;
use App\Models\Screencast\Playlist;
use App\Http\Controllers\Controller;
use App\Http\Requests\Screencast\VideoRequest;
use App\Http\Resources\Screencast\VideoResource;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Playlist $playlist)
    {
        $videos = $playlist->videos()->orderBy('episode')->get();
        return (VideoResource::collection($videos))->additional(compact('playlist'));
    }

    public function table(Playlist $playlist)
    {
        return view('videos.table', [
            'title' => "Videos of $playlist->name Playlist",
            'playlist' => $playlist,
            'videos' => $playlist->videos()->orderBy('episode')->paginate(20),
        ]);
    }

    public function create(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        return view('videos.create', [
            'title' => "New Video: $playlist->name",
            'playlist' => $playlist,
            'video' => new Video(),
        ]);
    }

    public function store(Playlist $playlist, VideoRequest $request)
    {
        $this->authorize('update', $playlist);

        $attr = $request->all();
        $attr['slug'] = Str::slug($request->title. '-'. Str::random(6));
        $attr['intro'] = $request->intro ? true : false;

        $playlist->videos()->create($attr);

        return redirect(route('videos.table', $playlist->slug));
    }

    public function show(Playlist $playlist, Video $video)
    {
        if (Auth::user()->hasBought($playlist) || $video->intro == 1) {
            return new VideoResource($video);
        }
        return response()->json([
            'message' => 'you are must be bought the playlist before watching'
        ])->setStatusCode(403);
    }

    public function edit(Playlist $playlist, Video $video)
    {
        return view('videos.edit', [
            'title' => "Edit {$video->title} - {$playlist->name}",
            'video' => $video,
            'playlist' => $playlist
        ]);
    }

    public function update(VideoRequest $request,  Playlist $playlist,Video $video)
    {
        $this->authorize('update', $playlist);

        $attr = $request->all();
        $attr['intro'] = $request->intro ? true : false;

        $video->update($attr);

        return redirect(route('videos.table', $playlist->slug));
    }

    public function destroy(Playlist $playlist, Video $video)
    {
        $this->authorize('update', $playlist);
        $video->delete();
        return redirect(route('videos.table', $playlist->slug));
    }
}
