<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('role:Doctor')->except(['index', 'show']);
    }

    /**
     * Display a listing of posts (public)
     */
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->with(['doctor.user', 'doctor.specialty'])
            ->latest()
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        $doctor = Auth::user()->doctor;
        
        if (!$doctor) {
            return redirect()->route('doctor.create-profile')->withErrors(['error' => 'Please create your doctor profile first.']);
        }

        $validated['doctor_id'] = $doctor->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()->route('doctor.posts')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified post
     */
    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }

        // Increment views
        $post->increment('views');

        $post->load(['doctor.user', 'doctor.specialty']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post
     */
    public function edit(Post $post)
    {
        if ($post->doctor->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, Post $post)
    {
        if ($post->doctor->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        } else {
            unset($validated['image']);
        }

        // Update slug if title changed
        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }

        $post->update($validated);

        return redirect()->route('doctor.posts')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post
     */
    public function destroy(Post $post)
    {
        if ($post->doctor->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Delete image if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('doctor.posts')->with('success', 'Post deleted successfully.');
    }
}
