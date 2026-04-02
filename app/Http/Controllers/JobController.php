<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Validation\Rule;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

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
    $attributes = $request->validate([
        
    ]);
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
     return view('jobs.show',['job'=>$job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Job $job)
{

    $employer = Auth::user()->employer;

    if (! $employer) {
        abort(403, 'Employer account required to edit jobs.'); // Changed from 'post' to 'edit'
    }
    
    // Add ownership check here too!
    if ($job->employer_id !== $employer->id) {
        abort(403, 'You can only edit your own jobs.');
    }
    
    return view('jobs.edit', ['job' => $job]);
}

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Job $job)
{
    $employer = Auth::user()->employer;

    // Fix: Use $job->employer_id instead of $job->employer->id
    if (! $employer || $job->employer_id !== $employer->id) {
        abort(403, 'You can only edit your own jobs.');
    }
    
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'salary' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'schedule' => ['required', Rule::in(['full-time', 'part-time', 'contract'])],
        'url' => ['required', 'url'],
        'featured' => ['nullable', 'boolean'],
        'tags' => ['nullable', 'string'],
    ]);

    // Update job basic info
    $job->update(Arr::except($validated, 'tags'));

    // Handle tags - Remove old tags and add new ones
    // First, detach all existing tags
    $job->tags()->detach();
    
    // Then add new tags if provided
    if (!empty($validated['tags'])) {
        foreach (explode(',', $validated['tags']) as $tagName) {
            $job->tag(trim($tagName));
        }
    }
    
    // Redirect with success message (moved outside the if statement)
    return redirect('/jobs/' . $job->id)->with('success', 'Job updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}