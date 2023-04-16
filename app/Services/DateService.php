<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\JobOrder;
use App\Models\Role;
use App\Models\User;
use App\Models\Handover;
use App\Models\Group;
use App\Models\Test\TestParameter;
use App\Models\Analysis\Analysis;
use App\Models\Analysis\AnalysisStatus;
use Illuminate\Support\Facades\Auth;

class DateService
{
    public static function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d')
    {
        $dates = [];
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
}
