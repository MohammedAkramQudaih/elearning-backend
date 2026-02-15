<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Http\Resources\TestimonialResource;
use App\Models\News;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $latestNews = News::where('status', true)
            ->latest()
            ->limit(6)
            ->get();

        $testimonials = Testimonial::where('status', true)
            ->latest()
            ->limit(6)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'news' => NewsResource::collection($latestNews),
                'testimonials' => TestimonialResource::collection($testimonials),
                'hero' => [
                    'title' => [
                        'en' => 'Welcome to E-Learning Platform',
                        'ar' => 'مرحباً بكم في منصة التعليم الإلكتروني'
                    ],
                    'subtitle' => [
                        'en' => 'Learn anywhere, anytime',
                        'ar' => 'تعلم في أي وقت ومن أي مكان'
                    ]
                ]
            ],
            'message' => 'Home data retrieved successfully'
        ]);
    }
    public function news()
    {
        $news = News::where('status', true)
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => NewsResource::collection($news),
            'meta' => [
                'total' => $news->total(),
                'per_page' => $news->perPage(),
                'current_page' => $news->currentPage(),
                'last_page' => $news->lastPage(),
            ],
            'message' => 'News retrieved successfully'
        ]);
    }
    public function testimonials()
    {
        $testimonials = Testimonial::where('status', true)
            ->latest()
            ->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => TestimonialResource::collection($testimonials),
            'message' => 'Testimonials retrieved successfully'
        ]);
    }
}
