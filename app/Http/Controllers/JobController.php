<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Validation\Rule;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all()->groupBy('featured');
      return view('jobs.index',[
        'featuredJobs'=>$jobs->get(0, collect()),
        'jobs'=>$jobs->get(1, collect()),
        'tags'=>Tag::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('jobs.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreJobRequest $request)
{
    $attributes = $request->validated();
    $attributes['featured'] = $request->boolean('featured');

    $employer = Auth::user()->employer;

    if (! $employer) {
        abort(403, 'Employer account required to post jobs.');
    }

    $job = $employer->jobs()->create(
        Arr::except($attributes, 'tags')
    );

    if (!empty($attributes['tags'])) {
        foreach (explode(',', $attributes['tags']) as $tag) {
            $job->tag(trim($tag));
        }
    }

    return redirect('/');
}

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}