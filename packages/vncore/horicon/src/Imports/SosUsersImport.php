<?php

namespace VNCore\Horicon\Imports;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use VNCore\Horicon\Models\SosCompany;
use VNCore\Horicon\Models\SosContract;
use VNCore\Horicon\Models\SosContractLocation;
use VNCore\Horicon\Models\SosUser;

class SosUsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return SosUser
     */
    public function model(array $row)
    {
        $birthday_ngay = $row['ngay_sinh_ngay'] ?? NULL;
        $birthday_thang = $row['ngay_sinh_thang'] ?? NULL;
        $birthday_nam = $row['ngay_sinh_nam'] ?? NULL;

        $departure_ngay = $row['ngay_xuat_canh_ngay'] ?? NULL;
        $departure_thang = $row['ngay_xuat_canh_thang'] ?? NULL;
        $departure_nam = $row['ngay_xuat_canh_nam'] ?? NULL;

        $data = [
            'social_id' => $row['ho_chieu'],
            'name' => $row['ho_ten'],
            'birthday' => "$birthday_nam-$birthday_thang-$birthday_ngay",
            'gender' => $row['gioi_tinh'] ?? 1,
            'phone' => $row['dien_thoai'] ?? NULL,
            'departure_date' => "$departure_nam-$departure_thang-$departure_ngay",
            'contract_code' => $row['ma_hop_dong'] ?? '',
            'location1' => $row['vi_tri_1'] ?? NULL,
            'location2' => $row['vi_tri_2'] ?? NULL,
            'location3' => $row['vi_tri_3'] ?? NULL,
            'company_name' => $row['ten_cong_ty'] ?? '',
            'company_desc' => $row['dia_chi_cong_ty'] ?? NULL,
        ];

        $time = strtotime($data['birthday']);
        $data['birthday'] = date('Y-m-d', $time);

        $time = strtotime($data['departure_date']);
        $data['departure_date'] = $departure_ngay ? date('Y-m-d', $time) : NULL;

        $validator = Validator::make($data, [
            'social_id' => 'required|regex:/^[a-zA-Z0-9]+$/u|max:255|unique:users,email|unique:sos_users',
            'name' => 'required|max:255',
            'birthday' => 'required|date',
            'departure_date' => 'nullable|date',
            'gender' => 'nullable',
            'phone' => 'nullable',
            'contract_code' => 'required|regex:/^[a-zA-Z0-9]+$/u|max:100',
            'company_name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return NULL;
        }

        $gender = $data['gender'] ?? 1;
        if ($gender == 'Nam' || $gender == 'Male') {
            $gender = 1;
        } else {
            $gender = 0;
        }
        $data['gender'] = $gender;

        $password = $data['social_id'];

        // Create contract
        $contractCode = $data['contract_code'];
        $contract = FALSE;
        if ($contractCode) {
            $contract = SosContract::firstOrCreate(['code' => $contractCode]);
            $password = $contractCode;
        }

        // Create company
        $companyName = $data['company_name'];
        $company = FALSE;
        if ($companyName) {
            $companyCode = uniqid();
            $company = SosCompany::firstOrCreate(
                ['name' => $companyName], ['code' => $companyCode, 'desc' => $data['company_desc']]
            );
        }

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['social_id'],
            'password' => Hash::make($password),
        ]);

        $sosUser = new SosUser();
        $sosUser->fill($data);
        $sosUser->save();
        $sosUser->user()->associate($user);

        // Bind contract into company
        if ($company && $contract) {
            $contract->company()->associate($company);
            $contract->save();
        }

        // Bind user into contract
        if ($contract) {
            $sosUser->contract()->associate($contract);
            $sosUser->save();

            $this->saveLocation($data['location1'], $contract);
            $this->saveLocation($data['location2'], $contract);
            $this->saveLocation($data['location3'], $contract);
        }

        return $sosUser;
    }

    /**
     * @param             $data
     * @param SosContract $contract
     */
    protected function saveLocation($data, SosContract $contract)
    {
        if ($data) {
            $position = explode(', ', $data);
            $location = new SosContractLocation();
            $location->lat = $position[0];
            $location->lng = $position[1];
            $contract->locations()->save($location);
        }
    }
}
