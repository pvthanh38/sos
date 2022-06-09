<?php

namespace VNCore\Horicon\Controllers\Cms\Sos;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Exports\SosUsersExport;
use VNCore\Horicon\Imports\SosUsersImport;
use VNCore\Horicon\Models\SosUser;
use VNCore\Horicon\Models\UserLocation;

class UserController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = SosUser::query();

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $users = $query->orderBy('updated_at', 'desc')->paginate(20);

        return view('horicon::sos.users.index', compact('users'));
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sosUser = SosUser::findOrFail($id);
        $user = $sosUser->user;

        $sosUser->delete();
        $user->delete();
        return back()->with('message', 'Deleted successfully!');
    }

    /**
     * @param SosUser $sosUser
     *
     * @return \Illuminate\Http\Response
     */
    public function location(SosUser $sosUser)
    {
        $locations = $sosUser->user->locations()->orderBy('created_at', 'desc')->paginate(20);
        return view('horicon::sos.users.location', compact('sosUser', 'locations'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('horicon::sos.users.import');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx',
        ]);

        Excel::import(new SosUsersImport, $request->file('file'));

        return back()->with('message', 'Imported successfully!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function export()
    {
        return view('horicon::sos.users.export');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exportStore(Request $request)
    {
        $circle_radius = 3959;
        $max_distance = $request->get('distance');
        $lat = $request->get('lat');
        $lng = $request->get('lng');

        $query = SosUser::query();

        if ($max_distance && $lat && $lng) {
            $locations = UserLocation::selectRaw('user_id, ( ' . $circle_radius . ' * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) 
                + sin( radians(' . $lat . ') ) * sin( radians( lat ) ) ) ) AS distance ')
                ->havingRaw('distance <= ' . $max_distance)
                ->groupBy('user_id')
                ->groupBy('distance')
                ->distinct('user_id')
                ->get();
            $userIds = array_pluck($locations, 'user_id');
            $query->whereIn('user_id', $userIds);
        }

        $country = $request->get('country');
        if ($country) {
            $query->whereHas('locations', function ($q) use ($country) {
                $q->where('country', $country);
            });
        }

        $city = $request->get('city');
        if ($city) {
            $query->whereHas('locations', function ($q) use ($city) {
                $q->where('city', $city);
            });
        }

        $users = $query->paginate(20);

        return view('horicon::sos.users.export_show', compact('users'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportDownload(Request $request)
    {
        $max_distance = $request->get('distance');
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $country = $request->get('country');
        $city = $request->get('city');

        return (new SosUsersExport($lat, $lng, $max_distance, $country, $city))->download('users.xlsx');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function wrongLocationDownload(Request $request)
    {
        return (new SosUsersExport(null, null, null, null, null, true))->download('users.xlsx');
    }
}
