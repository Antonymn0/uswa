<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Review\ValidateReviewRequest;
use App\Models\Review;
use App\Models\User;
use App\Events\Review\reviewCreated;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of reviews',
            'data'=>$reviews], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateReviewRequest $request)
    {
        $data = $request->validated(); 

        $reviewer = User::findOrFail($request->reviewer_id);  
        $review = Review::where('reviewer_id', $request->reviewer_id)
                        ->where('reviewee_id', $request->reviewee_id)
                        ->first();

        if(!empty($review)) return response()->json(['message'=> 'You have already reviewed this tutuor'], 422);

        $data['reviewer_name'] = $reviewer->first_name .' '. $reviewer->last_name;  
        $data['reviewer_image'] = $reviewer->image ? $reviewer->image : null;  

        $review= Review::create($data);
        event(new reviewCreated($review));

        return response()->json([
            'success'=> true,
            'message'=> 'Review created successfuly',
            'data' => $review,
            ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review= Review::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single review retrieved successfully', 
            'data'=>$review
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateReviewRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateReviewRequest $request, $id)
    {
        $data = $request->validated();  

        $review= Review::findOrFail($id);
        $review->update($data);

        return response()->json([
            'success'=> true, 
            'message'=>'Review updated successfuly', 
            'data'=>$review],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review= Review::findOrFail($id)->delete();
        return response()->json([
            'success'=> true, 
            'message'=> 'Review deleted successfuly', 
            'data'=>true
            ], 200);
    }
}
