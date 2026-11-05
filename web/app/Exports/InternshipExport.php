<?php

namespace App\Exports;


use App\Models\Front\InternshipEnquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InternshipExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return InternshipEnquiry::select('name', 'email', 'mobile_no','position','about','goals', 'message', 'created_at')
            ->where('status', '!=', 'delete')
            ->get();
    }
  
    /**
     * Map each row to modify the data.
     *
     * @param mixed $intern
     * @return array
     */
    public function map($intern): array
    {
        static $index = 0; // Static variable to hold the index value
        $index++; // Increment index by 1

        return [
            $index,
            $intern->name,
            $intern->email,
            $intern->mobile_no,
            $intern->position,
            $intern->about,
            $intern->goals,
            $intern->message,
            $intern->created_at->format('d-M-Y h:i:s a'),
        ];
    }

    /**
     * Define the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Mobile No',
            'Position',
            'About',
            'Goals',
            'Message',
            'Created At',

        ];
    }
}