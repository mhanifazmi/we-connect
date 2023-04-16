<?php

namespace App\Http\Controllers;

use App\Services\TextService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function urlName(Request $request)
    {
        $name = $request->name;

        return TextService::slugify($name);
    }
}
