<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    public function collection()
{
    return Application::select('id', 'name', 'email', 'phone', 'scholarship_name', 'status', 'created_at')->get();
}

public function headings(): array
{
    return ['ID', 'Student Name', 'Email', 'Phone', 'Scholarship', 'Status', 'Applied Date'];
}
}