<?php

namespace VNCore\Horicon\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use VNCore\Horicon\Models\SosSupport;
use VNCore\Horicon\Models\UserLocation;

class SosSupportsExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct($start, $end, $urgent)
    {
        $this->start = $start;
        $this->end = $end;
        $this->urgent = $urgent;
    }

    public function query()
    {
        $start = $this->start;
        $end = $this->end;

        $query = SosSupport::orderBy('created_at');

        $query->where('urgent', $this->urgent);
        $query->where('created_at', '>=', $start)->where('created_at', '<=', $end);

        return $query;
    }

    public function map($sosSupport): array
    {
        switch ($sosSupport) {
            case '0':
                $status = 'Mới';
                break;
            case '1':
                $status = 'Hoàn thành';
                break;
            default:
                $status = 'Đang xử lý';
                break;
        }
        return [
            $sosSupport->id,
            $sosSupport->location,
            $sosSupport->content,
            $sosSupport->phone,
            $sosSupport->urgent ? 'SOS' : 'Bình thường',
            $status,
            $sosSupport->created_at->toDateTimeString(),
            $sosSupport->lat . ', ' . $sosSupport->lng,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Vị trí',
            'Nội dung',
            'Điện thoại',
            'Loại hỗ trợ',
            'Trạng thái',
            'Ngày tạo',
            'Vị trí',
        ];
    }
}