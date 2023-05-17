<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        // コントローラーにGateを設定
        Gate::authorize('test');

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);
        $validated['user_id']=auth()->id();

        $post = Post::create($validated);
        $request->session()->flash('message', '保存しました');
        return back();
    }

    //一覧表示のメソッド
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }
// 個別表示
    public function show(Post $post){
        return view('post.show',compact('post'));
    }
    // 編集
    public function edit(Post $post){
        return view('post.edit',compact('post'));
    }

    public function update(Request $request, Post $post){
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);
        $validated['user_id']=auth()->id();

        $post->update($validated);

        $request->session()->flash('message','更新しました');
        return back();
    }

    // 削除機能
    public function destroy(Request $request,Post $post){
        $post->delete();
        $request->session()->flash('message','削除しました');

        return redirect()->route('post.index');
    }

}
