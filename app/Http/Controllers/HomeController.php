<?php

namespace App\Http\Controllers;

use App\Models\Connect;
use App\Models\Count;
use App\Models\Link;
use App\Models\User;
use App\Services\DateService;
use App\Services\LinkService;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use MarkSitko\LaravelUnsplash\Facades\Unsplash;

class HomeController extends Controller
{
    public function index(Connect $connect)
    {
        $user = $connect;
        $image = Unsplash::user('codioful')
            ->randomPhoto()
            ->orientation('landscape')
            ->term('pastel flowers')
            ->toJson();

        $image = $image->urls->small;
        return view('index', compact('image', 'user'));
    }

    public function cms()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $days = [
                [
                    'name' => 'Sunday',
                    'total' => 0,
                ],
                [
                    'name' => 'Monday',
                    'total' => 0,
                ],
                [
                    'name' => 'Tuesday',
                    'total' => 0,
                ],
                [
                    'name' => 'Wednesday',
                    'total' => 0,
                ],
                [
                    'name' => 'Thursday',
                    'total' => 0,
                ],
                [
                    'name' => 'Friday',
                    'total' => 0,
                ],
                [
                    'name' => 'Saturday',
                    'total' => 0,
                ]
            ];

            foreach ($user->links as $key => $link) {
                $ranges = DateService::dateRange(date('Y-m-01'), date('Y-m-' . cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))));

                $links = [];

                foreach ($ranges as $range) {
                    $day = date('w', strtotime($range));

                    $count = Count::select('id', DB::raw('count(*) as total'), 'date')
                        ->where('date', $range)
                        ->where('user_id', $user->id)
                        ->where('foreign_key_id', $link->id)
                        ->where('type', 'Link')
                        ->groupBy('date')
                        ->first();

                    $days[$day]['total'] = $days[$day]['total'] + ($count->total ?? 0);

                    $links[] = [
                        'date' => $range,
                        'total' => $count->total ?? 0
                    ];
                }

                $user->links[$key]['line_chart'] = $links;
            }

            $pie_chart = Count::select('id', DB::raw('count(*) as total'), 'foreign_key_id')
                ->where('date', '>=', date('Y-m-01'))
                ->where('date', '<=', date('Y-m-' . cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))))
                ->where('user_id', $user->id)
                ->where('type', 'Link')
                ->groupBy('foreign_key_id')
                ->get()
                ->append('link_name');

            $user['pie_chart'] = $pie_chart;
            $user['days'] = $days;

            return view('cms.index', compact('user', 'ranges'));
        } else {
            return redirect()->route('login');
        }
    }

    public function goTo(Request $request, $type, $foreign_key_id)
    {
        $value = Hashids::decode($foreign_key_id);
        $value = reset($value);
        $foreign_key_id = substr($value, 0, -2);

        $link = Link::find($foreign_key_id);

        LinkService::increment($link->user_id, $foreign_key_id, $request->ip(), $type);

        return redirect($link->url);
    }
}
