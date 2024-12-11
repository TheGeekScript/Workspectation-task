<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class PocketbaseService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('POCKETBASE_URL');
    }

    public function authenticate($email, $password)
    {
        $response = Http::post("{$this->baseUrl}/api/collections/users/auth-with-password", [
            'identity' => $email,
            'password' => $password,
        ]);
        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'Authentication failed');
        }
        return $response->json();
    }

    public function createPost($data, $token)
    {
        $response = Http::withToken($token)->post("{$this->baseUrl}/api/collections/posts/records", $data);
        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'Failed to create post');
        }
        return $response->json();
    }

    public function getPosts($token)
    {
        $response = Http::withToken($token)->get("{$this->baseUrl}/api/collections/posts/records");
        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'Failed to retrieve posts');
        }
        return $response->json();
    }

    public function updatePost($id, $data, $token)
    {
        $response = Http::withToken($token)->patch("{$this->baseUrl}/api/collections/posts/records/{$id}", $data);
        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'Failed to update post');
        }
        return $response->json();
    }

    public function deletePost($id, $token)
    {
        $response = Http::withToken($token)->delete("{$this->baseUrl}/api/collections/posts/records/{$id}");
        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'Failed to delete post');
        }
        return $response->json();
    }
}