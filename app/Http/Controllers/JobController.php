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
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'salary_min' => ['required', 'integer', 'min:0'],
            'salary_max' => ['nullable', 'integer', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
            'schedule' => ['required', Rule::in(['full-time', 'part-time', 'contract'])],
            'url' => ['required', 'url'],
            'featured' => ['nullable', 'boolean'],
            'tags' => ['nullable', 'string'],
        ]);

        $attributes['salary_max'] = $attributes['salary_max'] ?? $attributes['salary_min'];
        $attributes['salary'] = $attributes['salary_min'] === $attributes['salary_max']
            ? 'Ksh ' . number_format($attributes['salary_min'])
            : 'Ksh ' . number_format($attributes['salary_min']) . ' - ' . number_format($attributes['salary_max']);

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
        try {
            $employer = Auth::user()->employer;

            if (! $employer || $job->employer_id !== $employer->id) {
                abort(403, 'You can only edit your own jobs.');
            }
            
            $validated = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'salary_min' => ['required', 'integer', 'min:0'],
                'salary_max' => ['nullable', 'integer', 'min:0'],
                'location' => ['required', 'string', 'max:255'],
                'schedule' => ['required', Rule::in(['full-time', 'part-time', 'contract'])],
                'url' => ['required', 'url'],
                'featured' => ['nullable', 'boolean'],
                'tags' => ['nullable', 'string'],
            ]);

            $validated['salary_max'] = $validated['salary_max'] ?? $validated['salary_min'];
            $validated['salary'] = $validated['salary_min'] === $validated['salary_max']
                ? 'Ksh ' . number_format($validated['salary_min'])
                : 'Ksh ' . number_format($validated['salary_min']) . ' - ' . number_format($validated['salary_max']);

            // Handle featured checkbox - set to false if not present
            $validated['featured'] = $request->boolean('featured');
            // Check if user can create featured jobs
            if ($validated['featured'] && !$this->canCreateFeaturedJobs()) {
                return redirect()->back()->withErrors(['featured' => 'Featured jobs require a premium subscription.']);
            }

            // Update job with all fields including tags
            $job->update(Arr::except($validated, 'tags'));

            // Handle tags - Remove old tags and add new ones
            $job->tags()->detach();
            
            if (!empty($validated['tags'])) {
                foreach (explode(',', $validated['tags']) as $tag) {
                    $job->tag(trim($tag));
                }
            }

            return redirect()->route('jobs.show', $job)->with('success', 'Job updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
         $employer = Auth::user()->employer;

            if (! $employer || $job->employer_id !== $employer->id) {
                abort(403, 'You can only delete your own jobs.');

            } 
            
                $job->delete();

                return redirect('/')->with('success', 'Job deleted successfully!');
    }

    private function canCreateFeaturedJobs()
    {
        $user = Auth::user();
        
        // Check if user has premium subscription
        // This could be a field on the user model or employer model
        // For now, we'll check if employer has a 'premium' field
        $employer = $user->employer;
        
        return $employer && $employer->premium;
    }
}