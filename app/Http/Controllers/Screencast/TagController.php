<?php

namespace App\Http\Controllers\Screencast;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Screencast\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Screencast\TagRequest;
use App\Http\Resources\Screencast\TagsResource;

class TagController extends Controller
{
    public function index()
    {
        return TagsResource::collection(Tag::all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table()
    {
        $tags = Tag::withCount('playlists')->orderBy('name')->paginate();
        return view('tags.table', [
            'tags' => $tags,
            'title' => 'Tag List',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create', [
            'title' => 'Create New Tag',
            'tag' => new Tag()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('tags.table'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', [
            'title' => "Edit Tag : $tag->name",
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect(route('tags.table'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->playlists()->detach();
        $tag->delete();

        return back();
    }
}
