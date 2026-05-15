<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('player', 'team')
            ->when($request->team_id, fn($q) => $q->where('team_id', $request->team_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'player_id' => 'required|exists:players,id',
            'team_id'   => 'nullable|exists:teams,id',
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
        ]);
        $data['status'] = 'pending';
        return response()->json(Post::create($data), 201);
    }

    public function show($id)
    {
        return response()->json(Post::with('player', 'team')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function approve($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['status' => 'approved']);
        return response()->json($post);
    }

    public function reject($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['status' => 'rejected']);
        return response()->json($post);
    }
}