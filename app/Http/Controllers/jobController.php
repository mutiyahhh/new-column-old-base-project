<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Level;
use App\Models\Cabang;
use App\Models\LogSession;
use App\Models\RelatedJobs;
use App\Models\ReviewJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class jobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // status_review: 1 (like)
        // status_review: 2 (dislike)
        $userLevelId = auth()->user()->level_id;

        if ($userLevelId == 1) {
            $jobs = Job::with(['level', 'relatedJobs.level', 'user'])
                    ->get();

            $levelNames = [];
            if ($jobs != null && count($jobs) > 0) {
                $jobTemp = 0;
                $indexJob = 0;
                foreach($jobs as $j){
                    if ($jobTemp == 0){
                        $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                        ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                        ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                        ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                        ->select("l.level")
                                        ->get();
                        $listLevelName = [];
                        foreach($relatedJobs as $r) {
                            array_push($listLevelName, $r->level);
                        }
                        $levelNames[$indexJob]["job_id"] = $j->id;
                        $levelNames[$indexJob]["level"] = $listLevelName;
                        $jobTemp = $j->id;
                        $indexJob++;
                    } else if ($jobTemp != $j->id){
                        $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                        ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                        ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                        ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                        ->select("l.level")
                                        ->get();
                       $listLevelName = [];
                        foreach($relatedJobs as $r) {
                            array_push($listLevelName, $r->level);
                        }
                        $levelNames[$indexJob]["job_id"] = $j->id;
                        $levelNames[$indexJob]["level"] = $listLevelName;
                        $jobTemp = $j->id;
                        $indexJob++;
                    }
                }
            }
        } else {

            $jobs = Job::with(['level', 'relatedJobs.level', 'user'])
                ->where('jobs.level_id', $userLevelId)
                ->get();

            $levelNames = [];
            if ($jobs != null && count($jobs) > 0) {
                $jobTemp = 0;
                $indexJob = 0;
                foreach($jobs as $j){
                    if ($jobTemp == 0){
                        $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                        ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                        ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                        ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                        ->select("l.level")
                                        ->get();
                        $listLevelName = [];
                        foreach($relatedJobs as $r) {
                            array_push($listLevelName, $r->level);
                        }
                        $levelNames[$indexJob]["job_id"] = $j->id;
                        $levelNames[$indexJob]["level"] = $listLevelName;
                        $jobTemp = $j->id;
                        $indexJob++;
                    } else if ($jobTemp != $j->id){
                        $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                        ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                        ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                        ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                        ->select("l.level")
                                        ->get();
                       $listLevelName = [];
                        foreach($relatedJobs as $r) {
                            array_push($listLevelName, $r->level);
                        }
                        $levelNames[$indexJob]["job_id"] = $j->id;
                        $levelNames[$indexJob]["level"] = $listLevelName;
                        $jobTemp = $j->id;
                        $indexJob++;
                    }
                }
            }

        } // end if

        foreach($jobs as $index => $value){
            $totalLike = ReviewJobs::where([
                'job_id' => $value->id,
                'status_review' => 1,
            ])->count();
            $totalDislike = ReviewJobs::where([
                'job_id' => $value->id,
                'status_review' => 2,
            ])->count();
            $jobs[$index]['total_like'] = $totalLike;
            $jobs[$index]['total_dislike'] = $totalDislike;
        }
        return view('pages.jobs.index', compact('jobs', 'levelNames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if($user->level_id != 1) {
            $level = Level::findOrFail($user->level_id);
            $levels[] = $level;
            $cabangs = Cabang::all();
            $related_job = Level::all();
        }else{
            $levels = Level::all();
            $cabangs = Cabang::all();
            $related_job = Level::all();
        }
        return view('pages.jobs.create', compact('levels', 'cabangs', 'related_job'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $request->validate([
                'tugas' => 'required|string',
                'detail_tugas' => 'required|string',
                'type' => 'required|string',
                'level_id' => 'required|integer',
                'related_level_id' => 'required|array',
                'cabang_id' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'created_by' => 'integer',
            ]);

            $data = $request->all();
            $data['created_by'] = auth()->user()->name;

            // Save image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/assets/img/job');
                $data['image'] = str_replace('public/', '', $imagePath);
            }

            $data['created_by'] = auth()->id();
            if ($user->id != 1) {
                $data['status_approval'] = 'processed';
            } else {
                $data['status_approval'] = 'approved';
            }

            $job = Job::create($data);

            // Save related jobs
            foreach ($data['related_level_id'] as $levelId) {
                RelatedJobs::create([
                    'job_id' => $job->id,
                    'related_job_id' => $job->id,
                    'related_level_id' => $levelId
                ]);
            }

            if ($job) {
                toast('Data berhasil ditambah', 'success');
            } else {
                toast('Data Gagal Ditambahkan', 'error');
            }
            return redirect()->route('job.index');
        } catch (\Exception $e) {
            toast('Terjadi Kesalahan', 'error');
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Temukan pekerjaan berdasarkan ID
        $job = Job::findOrFail($id);
        $reviewJob = ReviewJobs::where([
            'job_id' => $job->id,
            'user_id' => auth()->user()->id,
        ])->get();
        $review_like = null;
        if (count($reviewJob) > 0) {
            $review_like = $reviewJob[0]->status_review;
        }
        $job['status_review'] = $review_like;

        LogSession::create([
            'description' => auth()->user()->name . ' mengakses ' . $job->tugas . ' pada tanggal ' . now(),
        ]);

        // Kirim detail pekerjaan ke tampilan
        return view('pages.jobs.detail', compact('job'));
    }

    /**
     * Display the job detail page.
     */
    public function showDetail($id)
    {
        try {
            // Find the job by ID
            $job = Job::findOrFail($id);
            $jabatanByJob = Level::where('id', $job['level_id'])->first();

            if ($job['image'] !== null) {
                $job['image'] = url(Storage::url($job['image']));
            } else {
                $job['image'] = null;
            }

            $relatedJobs = RelatedJobs::where('related_job_id', $id)->get();
            $listRelatedJob = RelatedJobs::where('related_job_id', $id)
                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                ->get();

            $newListNameRelatedJob = [];
            foreach ($listRelatedJob as $l) {
                array_push($newListNameRelatedJob, $l->level);
            }

            $jabatan = $jabatanByJob;
            // save to log session
            LogSession::create([
                'description' => auth()->user()->name . ' mengakses ' . $job->tugas . ' pada tanggal ' . now(),
            ]);

            return view('pages.jobs.detail', compact('job', 'relatedJobs', 'newListNameRelatedJob', 'jabatan'));
        } catch (Exception $error) {
            // Handle the exception here
            // You can redirect to an error page or show an error message
            return redirect()->back()->withErrors($error->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan pekerjaan berdasarkan ID
        $job = Job::findOrFail($id);

        // Periksa jika pengguna adalah admin
        if (auth()->user()->level_id != 1) {
            // Redirect pengguna ke halaman detail jika bukan admin
            return redirect()->route('job.show', $job->id)->with('error', 'Anda tidak memiliki izin untuk mengedit pekerjaan.');
        }
        // Jika pengguna adalah admin, lanjutkan ke halaman edit
        $levels = Level::all();
        $cabangs = Cabang::all();
        $jobs = Job::with('level', 'relatedJobs.level')->findOrFail($id);
        $levelId = [];
        $relatedJobs = RelatedJobs::where('related_job_id', $id)->get();
        foreach ($relatedJobs as $relatedJob) {
            $levelId[] = $relatedJob->related_level_id;
        }
        return view('pages.jobs.edit', compact('levels', 'cabangs', 'jobs', 'levelId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $userLevelId = auth()->user()->level_id; // Mendapatkan level_id dari pengguna yang sedang login

        if ($userLevelId == 1) {
            $request->validate([
                'tugas' => 'required|string',
                'detail_tugas' => 'required|string',
                'type' => 'required|string',
                'file_laporan' => 'nullable|mimes:pdf',
                'level_id' => 'required|integer',
                'cabang_id' => 'required|integer',
                'created_by' => 'nullable',
            ]);

            $job = Job::findOrFail($id);
            $dataId = $job->find($job->id);
            $data = $request->all();
            $data['created_by'] = auth()->id();

            if ($request->file_laporan) {
                Storage::delete('public/' . $dataId->file_laporan);
                $data['file_laporan'] = $request->file('file_laporan')->store('asset/file_laporan', 'public');
            }

            $dataId->update($data);

            $relatedJobs = RelatedJobs::where('job_id', $id)
                ->get();

            $relatedJobs = RelatedJobs::where('job_id', $id)->get();
            foreach ($relatedJobs as $relatedJob) {
                $relatedJob->delete();
            }

            foreach ($data['related_level_id'] as $levelId) {
                RelatedJobs::create([
                    'job_id' => $job->id,
                    'related_job_id' => $job->id,
                    'related_level_id' => $levelId
                ]);
            }

            if ($data) {
                toast('Data berhasil diupdate', 'success');
            } else {
                toast('Data Gagal Diupdate', 'error');
            }
        } else {

            $request->validate([

                'file_laporan' => 'nullable|mimes:pdf',

            ]);

            $job = Job::findOrFail($id);
            $dataId = $job->find($job->id);
            $data = $request->all();
            if ($request->file_laporan) {
                Storage::delete('public/' . $dataId->file_laporan);
                $data['file_laporan'] = $request->file('file_laporan')->store('asset/file_laporan', 'public');
            }

            $dataId->update( );

            $relatedJobs = RelatedJobs::where('job_id', $id)
                ->get();

            $relatedJobs = RelatedJobs::where('job_id', $id)->get();
            foreach ($relatedJobs as $relatedJob) {
                $relatedJob->delete();
            }

            foreach ($data['related_level_id'] as $levelId) {
                RelatedJobs::create([
                    'job_id' => $job->id,
                    'related_job_id' => $job->id,
                    'related_level_id' => $levelId
                ]);
            }

            if ($data) {
                toast('Data berhasil diupdate', 'success');
            } else {
                toast('Data Gagal Diupdate', 'error');
            }
        }
        return redirect()->route('job.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);
        if (auth()->user()->level_id != 1) {
            return redirect()->route('job.show', $job->id)->with('error', 'Anda tidak memiliki izin untuk menghapus pekerjaan.');
        }
        Storage::delete('public/' . $job->file_laporan);
        $job->delete();
        if ($job) {
            toast('Data berhasil dihapus', 'success');
        } else {
            toast('Terjadi Kesalahan', 'error');
        }
        return redirect()->route('job.index');
    }

    public function approvalByJobIDREST($id, Request $request) {
        try {
            if($request->ajax()) {
                $approve = $request->input('approval');
                $current_timestamp = Carbon::now()->toDateTimeString();
                $data["status_approval"] = $approve;
                $data["updated_at"] = $current_timestamp;
                Job::where('id', $id)->update($data);
                return response()->json([
                    'status' => 1,
                    'status_code' => 200,
                    'message' => "success for updated the data",
                    'data' => null,
                ]);
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

    public function getJobByAdmin() {
        try {
            $userLevelId = auth()->user()->level_id;
            if ($userLevelId == 1) {
                $jobs = Job::with(['level', 'relatedJobs.level', 'user'])
                    ->where('jobs.status_approval', '=', 'approved')
                    ->where('jobs.created_by', '=', 1)
                    ->get();
            } else {
                $jobs = Job::with(['level', 'relatedJobs.level', 'user'])
                    ->where('jobs.status_approval', '=', 'approved')
                    ->where('jobs.level_id', $userLevelId)
                    ->where('jobs.created_by', '=', 1)
                    ->get();
            }

            $levelNames = [];
            if ($jobs != null && count($jobs) > 0) {
                $jobTemp = 0;
                $indexJob = 0;
                foreach($jobs as $j){
                    if ($jobTemp == 0){
                        $relatedJobs = RelatedJobs::where('job_id', $j->id)
                            ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                            ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                            ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                            ->select("l.level")
                            ->get();
                        $listLevelName = [];
                        foreach($relatedJobs as $r) {
                            array_push($listLevelName, $r->level);
                        }
                        $levelNames[$indexJob]["job_id"] = $j->id;
                        $levelNames[$indexJob]["level"] = $listLevelName;
                        $jobTemp = $j->id;
                        $indexJob++;
                    } else if ($jobTemp != $j->id){
                        $relatedJobs = RelatedJobs::where('job_id', $j->id)
                            ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                            ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                            ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                            ->select("l.level")
                            ->get();
                        $listLevelName = [];
                        foreach($relatedJobs as $r) {
                            array_push($listLevelName, $r->level);
                        }
                        $levelNames[$indexJob]["job_id"] = $j->id;
                        $levelNames[$indexJob]["level"] = $listLevelName;
                        $jobTemp = $j->id;
                        $indexJob++;
                    }
                }
            }
            return view('pages.article.admin.index', compact('jobs', 'levelNames'));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function getJobDetailIDByAdmin(string $id) {
        try {
            // Temukan pekerjaan berdasarkan ID
            $job = Job::findOrFail($id);
            $reviewJob = ReviewJobs::where([
                'job_id' => $job->id,
                'user_id' => auth()->user()->id,
            ])->get();
            $review_like = null;
            if (count($reviewJob) > 0) {
                $review_like = $reviewJob[0]->status_review;
            }
            $job['status_review'] = $review_like;
            LogSession::create([
                'description' => auth()->user()->name . ' mengakses ' . $job->tugas . ' pada tanggal ' . now(),
            ]);
            // Kirim detail pekerjaan ke tampilan
            return view('pages.article.admin.detail', compact('job'));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function
    getJobByPosition() {
        try {
            $userLevelId = auth()->user()->level_id;

            if ($userLevelId == 1) {
                $jobs = Job::with(['level'])
                    ->join('users', 'jobs.created_by', '=', 'users.id')
                    ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                    ->where('jobs.status_approval', '=', 'approved')
                    ->where('users.level_id', '!=', 1)
                    ->select(
                        'jobs.id as id',
                        'jobs.status_approval',
                        'jobs.type',
                        'jobs.tugas',
                        'jobs.image',
                        'jobs.detail_tugas',
                        'jobs.created_at',
                        'l.level as job_level',
                        'users.name as username'
                    )
                    ->get();
                $levelNames = [];
                if ($jobs != null && count($jobs) > 0) {
                    $jobTemp = 0;
                    $indexJob = 0;
                    foreach($jobs as $j){
                        if ($jobTemp == 0){
                            $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                ->select("l.level")
                                ->get();
                            $listLevelName = [];
                            foreach($relatedJobs as $r) {
                                array_push($listLevelName, $r->level);
                            }
                            $levelNames[$indexJob]["job_id"] = $j->id;
                            $levelNames[$indexJob]["level"] = $listLevelName;
                            $jobTemp = $j->id;
                            $indexJob++;
                        } else if ($jobTemp != $j->id){
                            $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                ->select("l.level")
                                ->get();
                            $listLevelName = [];
                            foreach($relatedJobs as $r) {
                                array_push($listLevelName, $r->level);
                            }
                            $levelNames[$indexJob]["job_id"] = $j->id;
                            $levelNames[$indexJob]["level"] = $listLevelName;
                            $jobTemp = $j->id;
                            $indexJob++;
                        }
                    }
                }
            } else {
                $jobs = Job::with(['level'])
                    ->join('users', 'jobs.created_by', '=', 'users.id')
                    ->join('levels as l', 'l.id', '=', 'jobs.level_id')
                    ->where('jobs.status_approval', '=', 'approved')
                    ->where('users.level_id', '=', $userLevelId)
                    ->select(
                        'jobs.id as id',
                        'jobs.status_approval',
                        'jobs.type',
                        'jobs.tugas',
                        'jobs.image',
                        'jobs.detail_tugas',
                        'jobs.created_at',
                        'l.level as job_level',
                        'users.name as username'
                    )
                    ->get();

                $levelNames = [];
                if ($jobs != null && count($jobs) > 0) {
                    $jobTemp = 0;
                    $indexJob = 0;
                    foreach($jobs as $j){
                        if ($jobTemp == 0){
                            $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                ->select("l.level")
                                ->get();
                            $listLevelName = [];
                            foreach($relatedJobs as $r) {
                                array_push($listLevelName, $r->level);
                            }
                            $levelNames[$indexJob]["job_id"] = $j->id;
                            $levelNames[$indexJob]["level"] = $listLevelName;
                            $jobTemp = $j->id;
                            $indexJob++;
                        } else if ($jobTemp != $j->id){
                            $relatedJobs = RelatedJobs::where('job_id', $j->id)
                                ->join('jobs', 'related_jobs.job_id', '=', 'jobs.id')
                                ->join('jobs as j2', 'related_jobs.related_job_id', '=', 'j2.id')
                                ->join('levels as l', 'related_jobs.related_level_id', '=', 'l.id')
                                ->select("l.level")
                                ->get();
                            $listLevelName = [];
                            foreach($relatedJobs as $r) {
                                array_push($listLevelName, $r->level);
                            }
                            $levelNames[$indexJob]["job_id"] = $j->id;
                            $levelNames[$indexJob]["level"] = $listLevelName;
                            $jobTemp = $j->id;
                            $indexJob++;
                        }
                    }
                }

            } // end if
            foreach($jobs as $index => $value){
                $totalLike = ReviewJobs::where([
                    'job_id' => $value->id,
                    'status_review' => 1,
                ])->count();
                $totalDislike = ReviewJobs::where([
                    'job_id' => $value->id,
                    'status_review' => 2,
                ])->count();
                $jobs[$index]['total_like'] = $totalLike;
                $jobs[$index]['total_dislike'] = $totalDislike;
            }
            $jobs = collect($jobs)->sortBy([
                ['total_like', 'desc']
            ]);
            $jobs->values()->all();
            return view('pages.article.position.index', compact('jobs', 'levelNames'));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function getJobIDByPosition(string $id) {
        try {
            // Temukan pekerjaan berdasarkan ID
            $job = Job::findOrFail($id);
            $reviewJob = ReviewJobs::where([
                'job_id' => $job->id,
                'user_id' => auth()->user()->id,
            ])->get();
            $review_like = null;
            if (count($reviewJob) > 0) {
                $review_like = $reviewJob[0]->status_review;
            }
            $job['status_review'] = $review_like;

            LogSession::create([
                'description' => auth()->user()->name . ' mengakses ' . $job->tugas . ' pada tanggal ' . now(),
            ]);

            // Kirim detail pekerjaan ke tampilan
            return view('pages.article.position.detail', compact('job'));
        }catch(Exception $e){
            dd($e);
        }
    }
}
