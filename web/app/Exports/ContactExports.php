<?php

namespace App\Exports;

use App\Models\Front\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactExports implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Contact::select('name', 'email', 'mobile_no', 'message', 'created_at')
            ->where('status', '!=', 'delete')
            ->get();
    }

    /**
     * Map each row to modify the data.
     *
     * @param mixed $contact
     * @return array
     */
    public function map($contact): array
    {
        static $index = 0; // Static variable to hold the index value
        $index++; // Increment index by 1

        return [
            $index,
            $contact->name,
            $contact->email,
            $contact->mobile_no,
            $contact->message,
            $contact->created_at->format('d-M-Y h:i:s a'),
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
            'Message',
            'Created At',
        ];
    }
}