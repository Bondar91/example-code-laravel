<?php

namespace App\Exports;

use App\Enums\OrderTypeEnum;
use App\Enums\PaymentMethodTypeEnum;
use App\Enums\PaymentStatusTypeEnum;
use App\Enums\ReturnShipmentStatusTypeEnum;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths
{
    /**
     * @var array
     */
    protected $orders;

    /**
     * OrdersExport constructor.
     * @param $orders
     */
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        
        $productsName = [];
        $productsQuantity = [];
        foreach ($row->products as $product)
        {
            $productsName[] = $product->name;
            $productsQuantity[] = $product->pivot->quantity;
        }
        return [
            $row->user_ip,
            $row->id,
            $row->user->name,
            $row->user->last_name,
            $row->user->email,
            $row->user->phone,
            $row->user->address->getExportAddress(),
            $row->user->billing !== null ? $row->user->billing->getExportBilling() : 'Brak',
            $row->user->address->country,
            convertToTotalPrice($row->products->first()->pivot->price),
            $row->currency,
        ];
        
    }

    public function headings(): array
    {
        return [
            'IP',
            'Numer',
            'Imię',
            'Nazwisko',
            'Email',
            'Telefon',
            'Adres',
            'Firma',
            'Kraj',
            'Cena',
            'Waluta'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 35,
            'H' => 35,
            'O' => 15,
            'P' => 15,
            'Q' => 15,
            'S' => 15,
        ];
    }
}
