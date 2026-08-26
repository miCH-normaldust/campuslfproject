<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function welcome() {
    // Redirect authenticated users away from the guest welcome page
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else if (Auth::user()->role === 'user') {
            return redirect()->route('user.dashboard');
        }
        return redirect()->route('guest.dashboard');
    }

    return view('welcome');
    }
    public function guest() {
        $posts = Post::where('status', 'active')->latest()->get(); // Browse active posts[cite: 1]
        return view('guest.dashboard', compact('posts'));
    }

    public function user() {
        $posts = Post::where('status', '!=', 'hidden')->latest()->get();
        return view('user.dashboard', compact('posts'));
    }

    public function admin() {
        $posts = Post::latest()->get();
        return view('admin.dashboard', compact('posts')); // Moderation & Activity Logs[cite: 1]
    }
}
