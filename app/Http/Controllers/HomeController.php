<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MarkSitko\LaravelUnsplash\Facades\Unsplash;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function dashboard()
    {
        $image = Unsplash::user('codioful')
            ->randomPhoto()
            ->orientation('landscape')
            ->term('pastel flowers')
            ->toJson();

        $image = $image->urls->small;
        return view('index', compact('image'));
    }

    public function link(User $user)
    {
        $image = Unsplash::user('codioful')
            ->randomPhoto()
            ->orientation('landscape')
            ->term('pastel flowers')
            ->toJson();

        $image = $image->urls->small;
        return view('index', compact('image', 'user'));
    }
}
