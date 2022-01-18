<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'advantages' => 'required_with:disadvantages',
            'disadvantages' => 'required_with:advantages',
        ]);

        $review = Review::create([
            'user_id' => auth()->id(),
            'notify_on_reply' => request()->has('notify_on_reply'),
        ] + request(['product_id', 'rating', 'comment', 'advantages', 'disadvantages']));

        //Decode and save images
        foreach($request->all() as $key => $encoded_image) {
            if(str_contains($key, 'image'))  //filter through image fields only
                Photo::store($encoded_image, $review);
        }

        //save videos
        foreach($request->all() as $key => $video_url) {
            if(str_contains($key, 'video')) { //filter through video fields only
                $review->videos()->create([
                    'url' => $video_url
                ]);
            }
        }

        return back();
    }

    public function show(Review $review)
    {
        return view('product.specific_review', [
            'review' => $review,
            'product' => Product::find($review->product_id)
        ]);
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        //
    }
}
