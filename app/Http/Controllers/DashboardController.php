<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function welcome() 
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }

        return view('welcome');
    }

    public function guest(Request $request) 
    {
        $data = $this->handleFeedAndSearch($request, Post::where('status', 'active'));
        return view('guest.dashboard', $data);
    }

    public function user(Request $request) 
    {
        $data = $this->handleFeedAndSearch($request, Post::where('status', '!=', 'hidden'));
        return view('user.dashboard', $data);
    }

    public function admin(Request $request) 
    {
        $data = $this->handleFeedAndSearch($request, Post::query());
        return view('admin.dashboard', $data);
    }

    /**
     * Handles feed filtering, search logic, sub-category, and dynamic sorting.
     */
    private function handleFeedAndSearch(Request $request, $basePostQuery)
    {
        $category = $request->input('category', 'posts');
        $postType = $request->input('post_type', 'all'); // 'all', 'found', 'lost'
        $sort = $request->input('sort', $category === 'profiles' ? 'a-z' : 'latest');
        $searchTerm = trim($request->input('search', ''));

        // Dual-state check
        $isSearching = !empty($searchTerm);

        $posts = collect();
        $profiles = collect();

        if ($category === 'profiles') {
            $userQuery = User::query();

            if ($isSearching) {
                $userQuery->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('email', 'like', "%{$searchTerm}%");
                });
            }

            // Profile Sorting (Alphabetical)
            if ($sort === 'z-a') {
                $profiles = $userQuery->orderBy('name', 'desc')->get();
            } else {
                $profiles = $userQuery->orderBy('name', 'asc')->get();
            }
        } else {
            // Posts Category Logic
            $postQuery = clone $basePostQuery;

            // Apply Sub-Category Filter (Found / Lost)
            if ($postType === 'found') {
                $postQuery->where('status', 'found');
            } elseif ($postType === 'lost') {
                $postQuery->where('status', 'lost');
            }

            // Apply Keyword Search if active
            if ($isSearching) {
                $postQuery->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%");
                });
            }

            // Post Sorting (Time-based)
            if ($sort === 'oldest') {
                $posts = $postQuery->orderBy('created_at', 'asc')->get();
            } else {
                $posts = $postQuery->orderBy('created_at', 'desc')->get();
            }
        }

        return compact(
            'posts', 
            'profiles', 
            'category', 
            'postType', 
            'sort', 
            'isSearching', 
            'searchTerm'
        );
    }
}