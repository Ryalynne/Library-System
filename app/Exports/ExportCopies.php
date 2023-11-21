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
        return Booklist::select(
            'booklists.title',
            'booklists.author',
            'department_lists.departmentName',
            'booklists.copyright',
            'booklists.accession',
            'booklists.callnumber',
            'subject_lists.subjectName'
        )
            ->join('borrowpages', 'booklists.id', '=', 'borrowpages.bookid')
            ->join('subject_lists', 'booklists.subject', '=', 'subject_lists.id')
            ->join('department_lists', 'booklists.department', '=', 'department_lists.id')
            ->get();;
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
