<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsApiController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'enabled' => 'sometimes|boolean',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'enabled' => $request->enabled ?? true,
            'user_id' => Auth::id(),
        ]);

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
            'enabled' => 'sometimes|boolean',
        ]);

        $post->update($request->all());

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::where('user_id', Auth::id())->findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
