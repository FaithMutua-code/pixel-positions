<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $query = Job::with(['employer','tags']);

        if ($search = request('q')) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if (filled(request('salary_min'))) {
            $query->where('salary_max', '>=', request('salary_min'));
        }

        if (filled(request('salary_max'))) {
            $query->where('salary_min', '<=', request('salary_max'));
        }

        $jobs = $query->get();

        return view('results', ['jobs' => $jobs]);
    }
}
