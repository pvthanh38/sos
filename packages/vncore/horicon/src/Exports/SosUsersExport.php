<?php

namespace VNCore\Horicon\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use VNCore\Horicon\Models\SosUser;
use VNCore\Horicon\Models\UserLocation;

class SosUsersExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct($lat, $lng, $distance, $country, $city, $wrongLocation = FALSE)
    {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->distance = $distance;
        $this->country = $country;
        $this->city = $city;
        $this->wrongLocation = $wrongLocation;
    }

    public function query()
    {
        $circle_radius = 3959;
        $max_distance = $this->distance;
        $lat = $this->lat;
        $lng = $this->lng;

        $query = SosUser::orderBy('created_at');

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

        $country = $this->country;
        if ($country) {
            $query->whereHas('locations', function ($q) use ($country) {
                $q->where('country', $country);
            });
        }

        $city = $this->city;
        if ($city) {
            $query->whereHas('locations', function ($q) use ($city) {
                $q->where('city', $city);
            });
        }

        if ($this->wrongLocation) {
            $query->where('match_location', 0);
        }

        return $query;
    }

    public function map($sosUser): array
    {
        $locations = $sosUser->user->locations()->orderBy('created_at', 'desc')->limit(3)->get();

        $data = [
            $sosUser->id,
            $sosUser->social_id,
            $sosUser->name,
            $sosUser->birthday,
            $sosUser->gender ? 'Nam' : 'Nữ',
            $sosUser->phone,
            $sosUser->departure_date,
            $sosUser->created_at->toDateTimeString(),
        ];

        foreach ($locations as $location) {
            $data[] = $location->lat . ', ' . $location->lng;
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            '#',
            'Hộ chiếu',
            'Họ tên',
            'Ngày sinh',
            'Giới tính',
            'Điện thoại',
            'Ngày xuất cảnh',
            'Ngày tạo',
            'Vị trí 1',
            'Vị trí 2',
            'Vị trí 3',
        ];
    }
}