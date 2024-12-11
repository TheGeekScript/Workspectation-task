<?php
namespace App\Http\Controllers;

use App\Services\PocketbaseService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $pocketbaseService;

    public function __construct(PocketbaseService $pocketbaseService)
    {
        $this->pocketbaseService = $pocketbaseService;
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try {
            $user = $this->pocketbaseService->authenticate($request->email, $request->password);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $token = $request->header('Authorization');
        try {
            $post = $this->pocketbaseService->createPost($request->only('title', 'content'), $token);
            return response()->json($post, 201 );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function index(Request $request)
    {
        $token = $request->header('Authorization');
        try {
            $posts = $this->pocketbaseService->getPosts($token);
            return response()->json($posts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
        ]);
        $token = $request->header('Authorization');
        try {
            $post = $this->pocketbaseService->updatePost($id, $request->only('title', 'content'), $token);
            return response()->json($post);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy($id, Request $request)
    {
        $token = $request->header('Authorization');
        try {
            $this->pocketbaseService->deletePost($id, $token);
            return response()->json(['message' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}