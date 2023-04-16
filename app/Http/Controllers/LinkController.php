<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->title = "Links";
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $user = User::find($auth->id);
        $page = [
            'title' => $this->title,
            'subtitle' => $this->title . ' Listing',
        ];

        return view('cms.links.index', compact('user', 'page'));
    }

    public function create()
    {
        $page = [
            'title' => $this->title,
            'subtitle' => "Create " . $this->title,
        ];

        return view('cms.links.create', compact('page'));
    }

    public function store(Request $request)
    {
        $order = Link::orderBy('order', 'desc')->first();

        if (!empty($order)) {
            $sequence = $order->order + 1;
        } else {
            $sequence = 1;
        }

        $link = new Link();
        $link->user_id = Auth::user()->id;
        $link->name = $request->name;
        $link->description = $request->description;
        $link->icon = $request->icon;
        $link->order = $sequence;
        $link->url = $request->url;
        $link->save();

        return redirect()->route('link.index');
    }

    public function edit(Link $link)
    {
        $page = [
            'title' => $this->title,
            'subtitle' => "Edit " . $this->title,
        ];

        return view('cms.links.edit', compact('link', 'page'));
    }

    public function show(Link $link)
    {
        $page = [
            'title' => $this->title,
            'subtitle' => $this->title . " Details",
        ];

        return view('cms.links.show', compact('link', 'page'));
    }

    public function update(Request $request, Link $link)
    {
        $link->name = $request->name;
        $link->description = $request->description;
        $link->icon = $request->icon;
        $link->order = $request->order;
        $link->url = $request->url;
        $link->save();

        return redirect()->route('link.index');
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('link.index');
    }
}
