<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequests\StoreRequest;
use App\Http\Requests\NewsRequests\updateRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
        // $request->validate([
        //     'title_ar' => 'required|string|max:255',
        //     'title_en' => 'required|string|max:255',
        //     'content_ar' => 'required|string',
        //     'content_en' => 'required|string',
        //     'date' => 'required|date',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $data = [
            'title' => [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'date' => $request->date,
            'status' => $request->has('status') ? true : false,
        ];

        // رفع الصورة إذا وجدت
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'تم إضافة الخبر بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRequest $request, News $news)
    {
        //
        // $request->validate([
        //     'title_ar' => 'required|string|max:255',
        //     'title_en' => 'required|string|max:255',
        //     'content_ar' => 'required|string',
        //     'content_en' => 'required|string',
        //     'date' => 'required|date',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $data = [
            'title' => [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'date' => $request->date,
            'status' => $request->has('status') ? true : false,
        ];

        // رفع صورة جديدة وحذف القديمة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'تم تحديث الخبر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
        // حذف الصورة المرتبطة
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'تم حذف الخبر بنجاح');
    }
}
