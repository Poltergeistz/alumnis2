<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = \App\Category::pluck('name','id');

        $posts = Post::with('categories')->orderBy('id', 'desc')->get();
        return view('homePost', ['posts' => $posts,'categories'=>$categories]);
    }

    /**
     * Display a listing of the resource after research by category
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $categories = \App\Category::pluck('name','id');

        $allposts = Post::with('categories')->get();

        $posts = [];

        foreach($allposts as $post){
            if(in_array($request->categories, $post->getTagListAttribute()))
                array_push($posts, $post);
        }

        return view('homePost', ['posts' => $posts,'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = \App\Category::pluck('name','id');
        return view('createPost', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->author = Auth::user()->name;
        $post->image = str_replace('?','&#63;', $request->image);
        $post->user_id = Auth::user()->id;

        $post->save();
        $post->tags()->attach($request->input('categories'));

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('showPosts', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = \App\Category::pluck('name','id');

        $post = Post::find($id);
        $hisCategories = $post->getTagListAttribute();

        return view('editPost',['post'=>$post,'categories'=>$categories,'hisCategories'=>$hisCategories]);
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
        //
        $post = Post::find($id);

        $post->update([
            'title' => $request->title,
            'image' => str_replace('?','&#63;', $request->image),
            'content' => $request->content
        ]);

        $this->syncTags($post, $request->input('tags', []));
        
        return $this->index();
    }

    private function syncTags(Post $post, $categories)
    {
      $post->tags()->sync(!$categories ? [] : $categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('posts')
        ->where('id','=',$id)->delete();

        return $this->index();
    }
}
