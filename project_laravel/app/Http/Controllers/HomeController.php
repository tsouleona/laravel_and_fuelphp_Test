<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 9/1/16
 * Time: 12:31 AM
 */
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index()
    {
        $posts = Post::all();
        return View('home')
            ->with('title', 'My Blog')
            ->with('posts', $posts);
    }
    public function create()
    {
        return View('create')
            ->with('title', '新增文章');
    }
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect('post');
    }
    public function show($id)
    {
        $post = Post::find($id);
        return View('show')
            ->with('title', 'My Blog - '. $post->title)
            ->with('post', $post);
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return View('edit')
            ->with('title', '編輯文章')
            ->with('post', $post);
    }
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect('post');
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('post');
    }
}