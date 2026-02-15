<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequests\StoreRequest;
use App\Http\Requests\TestimonialRequests\updateRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.testimonials.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'position_ar' => 'required|string|max:255',
        //     'position_en' => 'required|string|max:255',
        //     'content_ar' => 'required|string',
        //     'content_en' => 'required|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $data = [
            'name' => $request->name,
            'position' => [
                'ar' => $request->position_ar,
                'en' => $request->position_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'status' => $request->has('status') ? true : false,
        ];

        // رفع الصورة إذا وجدت
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
            $data['image'] = $imagePath;
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم إضافة الشهادة بنجاح');
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
    public function edit(Testimonial $testimonial)
    {
        //
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRequest $request, Testimonial $testimonial)
    {
        //
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'position_ar' => 'required|string|max:255',
        //     'position_en' => 'required|string|max:255',
        //     'content_ar' => 'required|string',
        //     'content_en' => 'required|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $data = [
            'name' => $request->name,
            'position' => [
                'ar' => $request->position_ar,
                'en' => $request->position_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'status' => $request->has('status') ? true : false,
        ];

        // رفع صورة جديدة وحذف القديمة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            
            $imagePath = $request->file('image')->store('testimonials', 'public');
            $data['image'] = $imagePath;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم تحديث الشهادة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        //
        // حذف الصورة المرتبطة
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم حذف الشهادة بنجاح');
    }
}
