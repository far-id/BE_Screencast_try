<?php

namespace App\Http\Controllers\Screencast;

use Illuminate\Support\Str;
use App\Models\Screencast\Playlist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Screencast\PlaylistRequest;
use App\Http\Resources\Screencast\PlaylistResource;
use App\Models\Screencast\Tag;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{

    public function index()
    {
        $playlist = Playlist::latest()
                            ->paginate(3);
        return PlaylistResource::collection($playlist);
    }

    public function show(Playlist $playlist)
    {
        return new PlaylistResource($playlist);
    }

    public function create()
    {
        return view('playlists.create', [
            'playlist' => new Playlist(),
            'tags' => Tag::all(),
        ]);
    }

    public function store(PlaylistRequest $request)
    {

        $playlist = Auth::user()->playlists()->create([
            'thumbnail' => $request->file('thumbnail')->store('images/playlist'),
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . Str::random(6)),
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $playlist->tags()->sync($request->tags);

        return redirect(route('playlists.table'));
    }

    public function table()
    {
        $playlists = Auth::user()->playlists()->latest()->paginate(16);
        return view('playlists.table', compact('playlists'));
    }

    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $tags = Tag::get();
        return view('playlists.edit', compact('playlist', 'tags'));
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        if($request->thumbnail){
            Storage::delete($playlist->thumbnail);
            $thumbnail = $request->file('thumbnial')->store('images/playlist');
        }else{
            $thumbnail = $playlist->thumbnail;
        }
        $playlist->update([
            'thumbnail' => $thumbnail,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $playlist->tags()->sync($request->tags);

        return redirect(route('playlists.table'));
    }

    public function destroy(Playlist $playlist)
    {
        $this->authorize('delete', $playlist);

        Storage::delete($playlist->thumbnail);
        $playlist->tags()->detach();
        $playlist->delete();
        
        return back();
    }
}
