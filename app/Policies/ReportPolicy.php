<?php

namespace App\Policies;

use App\User;
use App\Report;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        if($user->isAdmin()) {
            return true;
        }
    }

    public function view_all(User $user) {
        return $user->isAdmin();
    }
    /**
     * Determine whether the user can view the report.
     *
     * @param  \App\User  $user
     * @param  \App\Report  $report
     * @return mixed
     */
    public function view(User $user, Report $report)
    {
        return $user->id == $report->reporter_id;
    }

    /**
     * Determine whether the user can create reports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the report.
     *
     * @param  \App\User  $user
     * @param  \App\Report  $report
     * @return mixed
     */
    public function update(User $user, Report $report)
    {
        return $user->id == $report->reporter_id;
    }

    /**
     * Determine whether the user can delete the report.
     *
     * @param  \App\User  $user
     * @param  \App\Report  $report
     * @return mixed
     */
    public function delete(User $user, Report $report)
    {
        return $user->id == $report->reporter_id;
    }

    /**
     * Determine whether the user can restore the report.
     *
     * @param  \App\User  $user
     * @param  \App\Report  $report
     * @return mixed
     */
    public function restore(User $user, Report $report)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the report.
     *
     * @param  \App\User  $user
     * @param  \App\Report  $report
     * @return mixed
     */
    public function forceDelete(User $user, Report $report)
    {
        return false;
    }
}
