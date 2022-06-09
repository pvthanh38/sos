<?php

namespace VNCore\Horicon\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\SosContract;
use VNCore\Horicon\Models\SosContractLocation;
use VNCore\Horicon\Models\SosInstall;
use VNCore\Horicon\Models\SosUser;
use VNCore\Horicon\Models\UserLocation;
use VNCore\Horicon\Rules\Password;

class UserController extends HoriconController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'passport' => 'required|max:255|unique:users,email',
            'name' => 'required|max:255',
            //'email' => 'required|string|email|max:255|unique:users',
            'birthday' => 'required|date',
            'departure_date' => 'required|date',
            'password' => 'required|string|min:6|max:20',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['passport'],
            'password' => Hash::make($data['password']),
        ]);

        $data['social_id'] = $data['passport'];
        $sosUser = new SosUser();
        $sosUser->fill($data);
        $sosUser->user_id = $user->id;
        $sosUser->save();

        return Response::json([
            'status' => 0,
            'password' => $data['password'],
        ]);
    }

    public function changePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'old_password' => ['bail', 'required', new Password()],
            'password' => 'required|min:6|max:20|different:old_password',
        ]);

        // Set data for user
        $user->password = bcrypt($data['password']);
        $user->save();

        return Response::json([
            'status' => 0,
            'password' => $data['password'],
        ]);
    }

    public function changeSecurity(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'password' => ['bail', 'required', new Password()],
            'question_id' => 'required|exists:sos_questions,id',
            'answer' => 'required|max:255',
            'phone' => 'sometimes|required|max:255',
        ]);

        // Set data for user
        $sosUser = $user->sosUser;
        $sosUser->question_id = $data['question_id'];
        $sosUser->security_answer = $data['answer'];
        $sosUser->save();

        return Response::json(['status' => 0]);
    }

    public function editUser(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
//            'name' => 'required|max:255',
//            'social_id' => 'required|max:255|unique:users,email,' . $user->id,
//            'birthday' => 'required|date',
//            'gender' => 'required|boolean',
            'phone' => 'required|max:255',
            'question_id' => 'required|exists:sos_questions,id',
            'security_answer' => 'required|max:255',
            'password' => 'sometimes|required|min:6',
        ]);

        // Set data for user
        $sosUser = $user->sosUser;
        $sosUser->fill($data);
        $sosUser->question_id = $data['question_id'];
        $sosUser->save();

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        //$user->name = $data['name'];
        //$user->email = $data['social_id'];
        $user->save();

        return Response::json(['status' => 0]);
    }

    public function editUserLocation(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'location' => 'required|max:255',
            'lat' => ['required', 'regex:/([0-9.-]+).+?([0-9.-]+)/'],
            'lng' => ['required', 'regex:/([0-9.-]+).+?([0-9.-]+)/'],
            'country' => 'nullable|max:255',
            'city' => 'nullable|max:255',
        ]);

        $location = new UserLocation();
        $location->fill($data);
        $user->locations()->save($location);

        if ($user->sosUser && $user->sosUser->contract && $user->sosUser->contract->id) {
            $circle_radius = 3959;
            $lat = $data['lat'];
            $lng = $data['lng'];
            $max_distance = env('LOCATION_DISTANCE', 100);

            // Insert new locations of contract if not exists
            $maxDate = env('LOCATION_DATE', 30);
            /** @var SosContract $contract */
            $contract = $user->sosUser->contract;
            $now = now()->subDays($maxDate);
            if ($contract->created_at->lte($now)) {
                $totalLocations = $contract->locations()->count();
                if (!$totalLocations) {
                    $userLocations = $user->locations()->orderBy('id', 'DESC')->take(3)->get();
                    foreach ($userLocations as $location) {
                        $sosContractLocation = new SosContractLocation();
                        $sosContractLocation->lat = $location->lat;
                        $sosContractLocation->lng = $location->lng;
                        $sosContractLocation->contract_id = $location->lng;
                        $contract->locations()->save($sosContractLocation);
                    }
                }
            }

            // Check math locations
            $mathLocations = DB::select(
                'SELECT * FROM 
                    (SELECT lat, lng, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(lat)) * 
                    cos(radians(lng) - radians(' . $lng . ')) + 
                    sin(radians(' . $lat . ')) * sin(radians(lat)))) 
                    AS distance 
                    FROM sos_contract_locations WHERE contract_id = ' . $user->sosUser->contract->id . ' ) AS distances 
                WHERE distance < ' . $max_distance . '  
                LIMIT 1;
            ');

            $mathLocation = count($mathLocations) ? TRUE : FALSE;
            $user->sosUser->match_location = $mathLocation;
            $user->sosUser->save();
        }
        
        return Response::json(['status' => 0]);
    }

    public function editUserFCM(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'fcm_token' => 'required',
        ]);

        // Set data for user
        $user->fcm_token = $data['fcm_token'];
        $user->save();

        return Response::json(['status' => 0]);
    }

    public function editAvatar(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'avatar' => 'file|image',
        ]);

        $user->addImageFromRequest();

        return Response::json(['status' => 0]);
    }

    public function forgetPassword(Request $request)
    {


        $data = $request->validate([
            'passport' => 'required|max:255',
            'birthday' => 'required|date',
            //'departure_date' => 'required|date',
            'question_id' => 'required|exists:sos_questions,id',
        ]);

        $sosUser = SosUser::where('social_id', $data['passport'])
            ->where('birthday', $data['birthday'])
            //->where('departure_date', $data['departure_date'])
            ->where('question_id', $data['question_id'])
            ->first();

        if (!$sosUser) {
            return Response::json(['status' => -1, 'message' => 'Cannot find User']);
        }

        /** @var User $user */
        $user = $sosUser->user;

        $password = rand(1, 999999);
        $user->password = bcrypt($password);
        $user->save();

        return Response::json(['status' => 0, 'password' => $password]);
    }

    public function getInfo()
    {
        /** @var User $user */
        $user = Auth::user();

        return new \VNCore\Horicon\Http\Resources\User($user);
    }

    public function countInstall(Request $request)
    {
        $data = $request->validate([
            'device' => 'nullable|max:255',
        ]);

        $install = new SosInstall();
        $install->fill($data);
        $install->save();

        return Response::json(['status' => 0]);
    }
}