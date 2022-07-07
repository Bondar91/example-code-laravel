<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DiscountCouponsExport implements FromArray, WithMapping, WithHeadings, WithColumnWidths
{
    /**
     * @var array
     */
    protected $discountCoupons;

    /**
     * OrdersExport constructor.
     * @param $discountCoupons
     */
    public function __construct($discountCoupons)
    {
        $this->discountCoupons = $discountCoupons;
    }

    public function array(): array
    {
        return $this->discountCoupons;
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->code,
        ];
    }

    public function headings(): array
    {
        return [
            'Code',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
        ];
    }
}
