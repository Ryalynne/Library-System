<?php

namespace App\Exports;

use App\Models\booklist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return booklist::select(
            'booklists.title',
            'booklists.author',
            'department_lists.departmentName',
            'booklists.copyright',
            'booklists.accession',
            'booklists.callnumber',
            'subject_lists.subjectName'
        )
            ->leftJoin('borrowpages', 'booklists.id', '=', 'borrowpages.bookid')
            ->leftJoin('subject_lists', 'booklists.subject', '=', 'subject_lists.id')
            ->leftJoin('department_lists', 'booklists.department', '=', 'department_lists.id')
            ->get();
    }
    //subjct , department

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
