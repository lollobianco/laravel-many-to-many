<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Post;
Use App\Models\Category;
Use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [

            'posts' => Post::with('category', 'tags', )->paginate(10)

        ];

        return view('admin.post.index', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        $tags = Tag::All();

        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                'title' => 'required|max:50'
            ]
        );

        $new_post = new Post();

        if(array_key_exists('cover', $data)){

            $cover_url = Storage::put('post_images', $data['cover']);
            $data['cover'] = $cover_url;
            //  dd($data);

        }

        $new_post->fill($data);
        $new_post->save();

        //controllo dopo aver fatto l'array prodotta dalla checkbox nella create

        if (array_key_exists('tags', $data)) {
            $new_post->tags()->sync($data['tags']);
        }

        $mail = new SendNewMail($new_post);
        $userEmail = Auth::user()->email;
        Mail::to($userEmail)->send($mail);

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::All();
        $tags = Tag::All();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
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
        $data = $request->all();
        $post = Post::findOrFail($id);
        $request->validate(
            [
                'title' => 'required|max:50'
            ]
        );

        
        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }
        
        $post->update($data);
        return redirect()->route('admin.posts.show', $post->id)->with('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
