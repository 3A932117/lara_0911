<?php

namespace App\Http\Controllers;

use App\Models\Post;//使用Model讀取資料
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    public function index()
    {
        /////使用Model讀取資料/////
        $posts = Post::orderBy('created_at', 'DESC')->get();
        $data = ['posts' => $posts];
        return view('admin.posts.index', $data);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        /////將表單送過來的資料用 Model 寫入資料庫/////
        /////意思是將View送出的表單資料跟Post這個Model連接(Model用來存取資料表)，進行新增/////
        Post::create($request->all());
        /////設定頁面跳轉/////
        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        /////在控制器當中，取出要進行修改的文章/////
        $data = [
            'post'=>$post,
        ];
        return view('admin.posts.edit', $data);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
