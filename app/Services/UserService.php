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

class UserService {
    public static function notifyUser($user, $notification) {
        $user->notify($notification, $user);
    }

    public static function notifyUsers($users, $notification) {
        foreach($users as $user) {
            $user->notify($notification, $user);
        }
    }

    public static function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, strlen($alphabet) - 1);
            $pass[$i] = $alphabet[$n];
        }
        return join($pass);
    }
}
