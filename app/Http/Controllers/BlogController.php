<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Jab tak Post model nahi bana, hardcoded data dein
        $allPosts = [
            ['title' => 'Learn Quran Easily',              'image' => 'blog1.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Tajweed',         'excerpt' => 'Discover simple methods to learn Quran with correct Tajweed rules.',   'slug' => 'learn-quran-easily'],
            ['title' => 'Islamic Parenting Tips',           'image' => 'blog2.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Parenting',        'excerpt' => 'Practical tips every Muslim parent should know for raising kids.',     'slug' => 'islamic-parenting-tips'],
            ['title' => 'How Our Teachers Guide Students',  'image' => 'blog4.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Teaching',         'excerpt' => 'Our certified tutors guide every student step by step.',              'slug' => 'teacher-guidance'],
            ['title' => 'Benefits Of Sultana Quran Learning','image' => 'blog5.jpg', 'author' => 'Admin', 'date' => 'Feb 05, 2022', 'category' => 'Online Learning',  'excerpt' => 'Online Quran learning offers many advantages for busy families.',     'slug' => 'benefits-online-quran'],
            ['title' => 'Common Tajweed Mistakes',          'image' => 'blog6.jpg', 'author' => 'Admin', 'date' => 'Feb 12, 2022', 'category' => 'Tajweed',         'excerpt' => 'New students often repeat the same Tajweed mistakes. Here is how.',    'slug' => 'tajweed-mistakes'],
            ['title' => 'Basic Masalah Every Muslim Needs', 'image' => 'blog7.jpg', 'author' => 'Admin', 'date' => 'Mar 10, 2022', 'category' => 'Basic Masalah',    'excerpt' => 'Essential everyday masalah every Muslim family should know.',         'slug' => 'basic-masalah-guide'],
        ];

        return view('blogs.index', compact('allPosts'));
    }

    public function show($slug)
    {
        $allPosts = [
            ['title' => 'Learn Quran Easily',              'image' => 'blog1.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Tajweed',         'excerpt' => 'Discover simple methods to learn Quran with correct Tajweed rules.',   'slug' => 'learn-quran-easily'],
            ['title' => 'Islamic Parenting Tips',           'image' => 'blog2.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Parenting',        'excerpt' => 'Practical tips every Muslim parent should know for raising kids.',     'slug' => 'islamic-parenting-tips'],
            ['title' => 'How Our Teachers Guide Students',  'image' => 'blog4.jpg', 'author' => 'Admin', 'date' => 'Jan 20, 2022', 'category' => 'Teaching',         'excerpt' => 'Our certified tutors guide every student step by step.',              'slug' => 'teacher-guidance'],
            ['title' => 'Benefits Of Sultana Quran Learning','image' => 'blog5.jpg', 'author' => 'Admin', 'date' => 'Feb 05, 2022', 'category' => 'Online Learning',  'excerpt' => 'Online Quran learning offers many advantages for busy families.',     'slug' => 'benefits-online-quran'],
            ['title' => 'Common Tajweed Mistakes',          'image' => 'blog6.jpg', 'author' => 'Admin', 'date' => 'Feb 12, 2022', 'category' => 'Tajweed',         'excerpt' => 'New students often repeat the same Tajweed mistakes.',                'slug' => 'tajweed-mistakes'],
            ['title' => 'Basic Masalah Every Muslim Needs', 'image' => 'blog7.jpg', 'author' => 'Admin', 'date' => 'Mar 10, 2022', 'category' => 'Basic Masalah',    'excerpt' => 'Essential everyday masalah every Muslim family should know.',         'slug' => 'basic-masalah-guide'],
        ];

        $post = collect($allPosts)->firstWhere('slug', $slug) ?? $allPosts[0];

        $related = collect($allPosts)
            ->where('category', $post['category'])
            ->where('slug', '!=', $post['slug'])
            ->take(3)->values();

        return view('blogs.show', compact('post', 'related', 'allPosts', 'slug'));
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $allPosts = []; // apna data yahan add karein ya Post::where('title', 'like', "%$q%")->get()

        return view('blogs.index', compact('allPosts'));
    }
}