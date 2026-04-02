<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{

   public function edit(User $user, Job $job): Response
{
    return optional($user->employer)->id === $job->employer_id
        ? Response::allow()
        : Response::deny('You do not own this job listing.');
}
}
