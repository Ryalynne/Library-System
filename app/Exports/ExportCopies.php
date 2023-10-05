<?php

namespace App\Exports;

use App\Models\booklist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCopies implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return booklist::select("title", "author", 'department', 'copyright', 'accession', 'callnumber', 'subject')->where('ishide', 0)->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["TITLE", 'AUTHOR', 'DEPARTMENT', 'COPYRIGHT', 'ACCESSION NO.', 'CALL NO.', 'SUBJECT'];
    }
}
