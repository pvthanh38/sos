<?php

namespace VNCore\Horicon\Controllers\Common;

use Carbon\Carbon;
use Illuminate\Http\Request;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\Faq;
use VNCore\Horicon\Models\SosInstall;
use VNCore\Horicon\Models\SosSupport;
use VNCore\Horicon\Models\SosUser;
use VNCore\Horicon\Models\UserLocation;

class DashboardController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $startDate = $now->firstOfMonth()->toDateString();

        $now = Carbon::now();
        $endDate = $now->addDay()->toDateString();

        $daterange = $request->get('daterange');
        if ($daterange) {
            $dates = explode(' - ', $daterange);
            $startDate = Carbon::parse($dates[0])->toDateString();
            $endDate = Carbon::parse($dates[1])->toDateString();
        }

        $mathLocationsCount = SosUser::where('match_location', 0)
            ->count();

        $sosUsersCount = SosUser::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->count();

        $supportsCount = SosSupport::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('urgent', 1)
            ->count();

        $supportsCount2 = SosSupport::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('urgent', 0)
            ->count();

        $installsCount = SosInstall::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->count();

        return view('horicon::dashboard.index', compact('startDate', 'endDate', 'mathLocationsCount', 'sosUsersCount', 'supportsCount', 'supportsCount2', 'installsCount'));
    }
}
