<?php

namespace VNCore\Horicon\Imports;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use VNCore\Horicon\Models\SosCompany;
use VNCore\Horicon\Models\SosUser;

class SosCompaniesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return SosUser
     */
    public function model(array $row)
    {
        $data = [
            'code' => $row['ma_cong_ty'],
            'name' => $row['ten_cong_ty'],
        ];

        $validator = Validator::make($data, [
            'code' => 'required|regex:/^[a-zA-Z0-9]+$/u|max:100|unique:sos_companies',
            'name' => 'required|max:255',
        ]);

        $validator->validate();

        return SosCompany::create([
            'code' => $data['code'],
            'name' => $data['name'],
        ]);
    }
}
