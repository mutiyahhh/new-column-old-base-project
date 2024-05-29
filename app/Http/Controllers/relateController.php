<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Level;
use App\Models\RelatedJobs;
use Illuminate\Http\Request;
use App\Models\ReviewJobs;

class relateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userLevelId = auth()->user()->level_id; // Mendapatkan level_id dari pengguna yang sedang login

        if ($userLevelId == 1) {
            $relates = RelatedJobs::with('job')
                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                ->join('cabangs', 'cabangs.id', '=', 'jobs.cabang_id')
                ->join('users', 'jobs.created_by', '=', 'users.id')
                ->select(
                    'jobs.id as job_id',
                    'jobs.type as job_type',
                    'jobs.tugas as job_tugas',
                    'jobs.image as job_image',
                    'jobs.detail_tugas as job_detail_tugas',
                    'l.level as job_level',
                    'cabangs.cabang as cabang_name',
                    'jobs.status_approval as status_approval',
                    'users.name as username',
                )
                ->groupBy(
                    'jobs.id',
                    'jobs.type',
                    'jobs.tugas',
                    'jobs.image',
                    'jobs.detail_tugas',
                    'l.level',
                    'cabangs.cabang',
                    'jobs.status_approval',
                    'users.name'
                )
                ->get();
        } else {
            $relates = RelatedJobs::with('job')
                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                ->join('cabangs', 'cabangs.id', '=', 'jobs.cabang_id')
                ->join('users', 'jobs.created_by', '=', 'users.id')
                ->where('related_jobs.related_level_id', $userLevelId)
                ->select(
                    'jobs.id as job_id',
                    'jobs.type as job_type',
                    'jobs.tugas as job_tugas',
                    'jobs.image as job_image',
                    'jobs.detail_tugas as job_detail_tugas',
                    'l.level as job_level',
                    'cabangs.cabang as cabang_name',
                    'jobs.status_approval as status_approval',
                    'users.name as username',
                )
                ->groupBy(
                    'jobs.id',
                    'jobs.type',
                    'jobs.tugas',
                    'jobs.image',
                    'jobs.detail_tugas',
                    'l.level',
                    'cabangs.cabang',
                    'jobs.status_approval',
                    'users.name'
                )
                ->get();
        }
//        dd($relates);
        $levelNames = [];
        foreach ($relates as $relate) {
            $relateByJobID = RelatedJobs::with('job')
                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                ->where('jobs.id', $relate->job_id)
                ->get();
            foreach ($relateByJobID as $r) {
                $levelNames[$relate->job_id][] = $r->level->level;
            }
        }
        return view('pages.relate.index', compact('relates', 'levelNames'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobs = RelatedJobs::with('level', 'job.cabang')
            ->findOrFail($id);
        $levelNames = [];
        if ($jobs != null) {
            $relatedJobs = RelatedJobs::where('related_job_id', $jobs->related_job_id)->get();
            foreach ($relatedJobs as $relatedJob) {
                $relatedLevel = Level::find($relatedJob->related_level_id);
                $levelNames[] = $relatedLevel->level;
            }
        }

        return view('pages.relate.show', compact('jobs', 'levelNames'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPositionRelatedJobIDArticle() {
        try {
            $userLevelId = auth()->user()->level_id; // Mendapatkan level_id dari pengguna yang sedang login

            if ($userLevelId == 1) {
                $relates = RelatedJobs::with('job')
                    ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                    ->join('users', 'jobs.created_by', '=', 'users.id')
                    ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                    ->join('cabangs', 'cabangs.id', '=', 'jobs.cabang_id')
                    ->where('jobs.status_approval', 'approved')
                    ->where('users.level_id', '!=', 1)
                    ->select(
                        'jobs.id as job_id',
                        'jobs.type as job_type',
                        'jobs.tugas as job_tugas',
                        'jobs.image as job_image',
                        'jobs.detail_tugas as job_detail_tugas',
                        'l.level as job_level',
                        'cabangs.cabang as cabang_name',
                        'users.name as username',
                        'jobs.status_approval as status_approval',
                    )
                    ->groupBy(
                        'jobs.id',
                        'jobs.type',
                        'jobs.tugas',
                        'jobs.image',
                        'jobs.detail_tugas',
                        'l.level',
                        'cabangs.cabang',
                        'users.name',
                        'jobs.status_approval',
                    )
                    ->get();
            } else {
                $relates = RelatedJobs::with('job')
                    ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                    ->join('users', 'jobs.created_by', '=', 'users.id')
                    ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                    ->join('cabangs', 'cabangs.id', '=', 'jobs.cabang_id')
                    ->where('related_jobs.related_level_id', $userLevelId)
                    ->where('jobs.status_approval', 'approved')
                    ->select(
                        'jobs.id as job_id',
                        'jobs.type as job_type',
                        'jobs.tugas as job_tugas',
                        'jobs.image as job_image',
                        'jobs.detail_tugas as job_detail_tugas',
                        'l.level as job_level',
                        'cabangs.cabang as cabang_name',
                        'users.name as username',
                        'jobs.status_approval as status_approval',
                    )
                    ->groupBy(
                        'jobs.id',
                        'jobs.type',
                        'jobs.tugas',
                        'jobs.image',
                        'jobs.detail_tugas',
                        'l.level',
                        'cabangs.cabang',
                        'users.name',
                        'jobs.status_approval',
                    )
                    ->get();
            }

            $levelNames = [];
            foreach ($relates as $relate) {
                $relateByJobID = RelatedJobs::with('job')
                    ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                    ->where('jobs.id', $relate->job_id)
                    ->get();
                foreach ($relateByJobID as $r) {
                    $levelNames[$relate->job_id][] = $r->level->level;
                }
            }

            foreach ($relates as $index => $value) {
                $totalLike = ReviewJobs::where([
                    'related_job_id' => $value->id,
                    'status_review' => 1,
                ])->count();
                $totalDislike = ReviewJobs::where([
                    'related_job_id' => $value->id,
                    'status_review' => 2,
                ])->count();
                $relates[$index]['total_like'] = $totalLike;
                $relates[$index]['total_dislike'] = $totalDislike;
            }
            $relates = collect($relates)->sortBy([
                ['total_like', 'desc']
            ]);
            $relates->values()->all();
            return view('pages.article.position.relate.index', compact('relates', 'levelNames'));
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function getDetailPositionRelatedJobIDArticle(string $id) {
        try {
            $jobs = RelatedJobs::with('level', 'job.cabang')
                ->findOrFail($id);
            $levelNames = [];
            if ($jobs != null) {
                $relatedJobs = RelatedJobs::where('related_job_id', $jobs->related_job_id)->get();
                foreach ($relatedJobs as $relatedJob) {
                    $relatedLevel = Level::find($relatedJob->related_level_id);
                    $levelNames[] = $relatedLevel->level;
                }
            }
            $related_job_id = $id;
            $reviewJob = ReviewJobs::where([
                'related_job_id' => $related_job_id,
                'user_id' => auth()->user()->id,
            ])->get();
            $review_like = null;
            if (count($reviewJob) > 0) {
                $review_like = $reviewJob[0]->status_review;
            }
            $jobs['status_review'] = $review_like;
            return view('pages.article.position.relate.detail', compact('jobs', 'levelNames', 'related_job_id'));
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function getAdminRelatedJobIdArticle(){
        try {
            $userLevelId = auth()->user()->level_id; // Mendapatkan level_id dari pengguna yang sedang login

            if ($userLevelId == 1) {
                $relates = RelatedJobs::with('job')
                    ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                    ->join('users', 'jobs.created_by', '=', 'users.id')
                    ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                    ->where('users.level_id', '=', 1)
                    ->select(
                        'related_jobs.job_id as job_id',
                        'related_jobs.related_job_id as related_job_id',
                        'l.level as job_level',
                        'users.name as username',
                    )
                    ->groupBy(
                        'related_jobs.job_id',
                        'related_jobs.related_job_id',
                        'l.level',
                        'users.name',
                    )
                    ->get();
            } else {
                $relates = RelatedJobs::with('job')
                    ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                    ->join('users', 'jobs.created_by', '=', 'users.id')
                    ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                    ->where('related_jobs.related_level_id', '=', $userLevelId)
                    ->where('users.level_id', '=', 1)
                    ->select(
                        'related_jobs.job_id as job_id',
                        'related_jobs.related_job_id as related_job_id',
                        'l.level as job_level',
                        'users.name as username',
                    )
                    ->groupBy(
                        'related_jobs.job_id',
                        'related_jobs.related_job_id',
                        'l.level',
                        'users.name',
                    )
                    ->get();
            }
            $levelNames = [];
            foreach ($relates as $relate) {
                $relateByJobID = RelatedJobs::with('job')
                    ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                    ->where('jobs.id', $relate->job_id)
                    ->get();
                foreach ($relateByJobID as $r) {
                    $levelNames[$relate->job_id][] = $r->level->level;
                }
            }
            return view('pages.article.admin.relate.index', compact('relates', 'levelNames'));
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function getDetailRelatedJobIDArticle(string $id) {
        try {
            // Temukan pekerjaan berdasarkan ID
            $jobs = Job::findOrFail($id);
            $reviewJob = ReviewJobs::where([
                'job_id' => $jobs->id,
                'user_id' => auth()->user()->id,
            ])->get();
            $review_like = null;
            if (count($reviewJob) > 0) {
                $review_like = $reviewJob[0]->status_review;
            }
            $jobs['status_review'] = $review_like;
            return view('pages.article.admin.relate.detail', compact('jobs'));
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
