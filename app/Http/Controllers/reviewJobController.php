<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewJobs;

class reviewJobController extends Controller
{
    //
    public function saveReviewByJobIDREST($id, Request $request) {
        try {
            if($request->ajax()) {
                // status_review: 1 (like)
                // status_review: 2 (dislike)
                $review_like = $request->input('review_like');
                $user_id = auth()->user()->id;
                if ($review_like == null) {
                    $result = ReviewJobs::where([
                        'job_id' => $id,
                        'user_id'=> $user_id,
                    ])->delete();
                    return response()->json([
                        'status' => 1,
                        'status_code' => 200,
                        'message' => 'success',
                        'data' => null,
                    ]);
                }else{
                    $result = ReviewJobs::updateOrCreate([
                        'job_id' => $id,
                        'user_id'=> $user_id,
                        'related_job_id' => null,
                        'status_review' => $review_like,
                    ]);

                    return response()->json([
                        'status' => 1,
                        'status_code' => 200,
                        'message' => 'success',
                        'data' => $result,
                    ]);
                }
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 0,
                'status_code' => 500,
                'message' => $e->getMessage(),
                'data' => null,
            ]);
        }
    }

    public function saveReviewByRelatedJobIDREST($id, Request $request) {
        try {
            if($request->ajax()) {
                // status_review: 1 (like)
                // status_review: 2 (dislike)
                $review_like = $request->input('review_like');
                $user_id = auth()->user()->id;
                if ($review_like == null) {
                    $result = ReviewJobs::where([
                        'related_job_id' => $id,
                        'user_id'=> $user_id,
                    ])->delete();
                    return response()->json([
                        'status' => 1,
                        'status_code' => 200,
                        'message' => 'success',
                        'data' => null,
                    ]);
                }else{
                    $result = ReviewJobs::updateOrCreate([
                        'job_id' => null,
                        'user_id'=> $user_id,
                        'related_job_id' => $id,
                        'status_review' => $review_like,
                    ]);

                    return response()->json([
                        'status' => 1,
                        'status_code' => 200,
                        'message' => 'success',
                        'data' => $result,
                    ]);
                }
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 0,
                'status_code' => 500,
                'message' => $e->getMessage(),
                'data' => null,
            ]);
        }
    }
}
