<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        /**
         * data review of product
         */
        $reviews = $product->reviews;

        /**
         * data response
         */
        $resp['data']= ReviewResource::collection($reviews);

        /**
         * response
         */
        return response()->json($resp,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request,Product $product)
    {
        /**
         * save the review to database
         */
        $request['product_id'] = $product->id;
        $review = Review::create($request->all());

        /**
         * data single resource review
         */
        $resp['data']= new ReviewResource($review);
        /**
         * response
         */
        return response($resp,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product ,Review $review)
    {
        /**
         * validate
         */
        if($review->product_id !== $product->id) 
        return response()->json(['Review Not belongs to Product'],404);

        /**
         * update data review
         */
        $review->update($request->all());

        /**
         * data single resource review
         */
        $resp['data']= new ReviewResource($review);
        /**
         * response
         */
        return response($resp,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,Review $review)
    {
        /**
         * validate
         */
        if($review->product_id !== $product->id) 
        return response()->json(['Review Not belongs to Product'],404);

        /**
         * delete review
         */
        $review->delete();

        /**
         * response
         */
        return response()->json([],204);
    }
}
