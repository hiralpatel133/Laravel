<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\postImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::withCount('comment')->with('tags')->with('user')->latest()->get();
        //$mostCommented = post::withCount('comment')->take(4)->orderby('comment_count','desc')->get();
        
        $mostCommented = Cache::remember('mostCommented', 60, function() {
            return post::withCount('comment')->take(4)->orderby('comment_count','desc')->get();
        });

        return view('posts.index',['posts'=>$posts,'most_commented_posts'=>$mostCommented]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo '<pre>';print_r($request->input());exit;
        $validated = $request->validate([
            'title' => 'required|max:100|min:2',
            'content' => 'required',
            'photo' => 'image'
        ]);

        $validated['user_id'] = $request->user()->id;
        $post = post::create($validated);

        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('postImages');
            $post->image()->save(
                postImage::make(['image'=>$path])
            );
        }

        $request->session()->flash('status', 'Post was created!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo $id;exit;
        //$post = post::with('comment')->findOrFail($id);

        $post =  post::with('comment')->with('user')->with('comment.user')->findOrFail($id);
        //echo '<pre>';print_r($post);exit;
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = post::findOrFail($id);
        $this->authorize($post);

        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = post::findOrFail($id);
        $this->authorize($post);

        $validated = $request->validate([
            'title' => 'required|max:100|min:2',
            'content' => 'required',
            'photo' => 'image'
        ]);

        $post->fill($validated);
        $post->save();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('postImages');

            if ($post->image) {
                Storage::delete($post->image->image);
                $post->image->image = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    postImage::make(['image'=>$path])
                );
            }
        }

        $request->session()->flash('status', 'Post was edited!');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post = post::findOrFail($id);
        $this->authorize($post);
        
        $post->delete();

        $request->session()->flash('status', 'Post was deleted!');
        return redirect()->route('posts.index');
    }
}
