<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role as SpatieRole;

class UserController extends Controller
{
    public function __construct()
    {
        $this->title = "User";
    }

    public function index(Request $request)
    {
        $users = User::all();
        $page = [
            'title' => $this->title,
            'subtitle' => $this->title . 's Listing',
        ];

        return view('cms.users.index', compact('users', 'page'));
    }

    public function create()
    {
        $page = [
            'title' => $this->title,
            'subtitle' => $this->title . ' Listing',
        ];

        $roles = Role::all();

        return view('cms.users.create', compact('page', 'roles'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->full_name = $request->full_name;
        $user->url = $request->url;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);

        if ($request->file('image')) {
            $image = $request->image;
            $file = $image->getClientOriginalName();
            $filename = pathinfo($image, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $image_upload_name = time() . '-' . $request->name . '.' . $extension;
            $destinationFolder = "/images/" . $image_upload_name;
            Storage::disk('public')->put($destinationFolder, file_get_contents($image));
        }

        if ($request->file('background')) {
            $background = $request->background;
            $file = $background->getClientOriginalName();
            $filename = pathinfo($background, PATHINFO_FILENAME);
            $extension = $background->getClientOriginalExtension();
            $background_upload_name = time() . '-' . $request->name . '.' . $extension;
            $destinationFolder = "/backgrounds/" . $background_upload_name;
            Storage::disk('public')->put($destinationFolder, file_get_contents($background));
        }

        $user->image = $image_upload_name;
        $user->background = $background_upload_name;
        $user->save();

        $user->assignRole(SpatieRole::find($request->role_id));

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        $page = [
            'title' => $this->title,
            'subtitle' => $this->title . ' Listing',
        ];

        return view('cms.users.edit', compact('user', 'roles', 'page'));
    }

    public function update(Request $request, User $user)
    {
        $role = Role::find($user->role_id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->full_name = $request->full_name;
        $user->url = $request->url;
        $user->role_id = $request->role_id;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($request->file('image')) {
            $image = $request->image;
            $file = $image->getClientOriginalName();
            $filename = pathinfo($image, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $image_upload_name = time() . '-' . $request->name . '.' . $extension;
            $destinationFolder = "/images/" . $image_upload_name;
            Storage::disk('public')->put($destinationFolder, file_get_contents($image));
            $user->image = $image_upload_name;
        }

        if ($request->file('background')) {
            $background = $request->background;
            $file = $background->getClientOriginalName();
            $filename = pathinfo($background, PATHINFO_FILENAME);
            $extension = $background->getClientOriginalExtension();
            $background_upload_name = time() . '-' . $request->name . '.' . $extension;
            $destinationFolder = "/backgrounds/" . $background_upload_name;
            Storage::disk('public')->put($destinationFolder, file_get_contents($background));
            $user->background = $background_upload_name;
        }

        $user->save();

        $p_all = Permission::all();
        if (isset($p_all) && !empty($p_all) && count($p_all) > 0) {
            foreach ($p_all as $p) {
                $role->revokePermissionTo($p);
            }
        }

        $user->assignRole(SpatieRole::find($request->role_id));

        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        $page = [
            'title' => $this->title,
            'subtitle' => $this->title . " Details",
        ];

        return view('cms.users.show', compact('user', 'page'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }
}
