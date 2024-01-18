<?php

namespace App\Imports;

use App\Models\booklist;
use App\Models\departmentList;
use App\Models\ebooks;
use App\Models\subjectList;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new booklist([
            'title'     => $row['TITLE'],
            'author'    => $row['AUTHOR'],
            'copyright'    => $row['COPYRIGHT'],
            'accession'    => $row['ACCESSION'],
            'callnumber'    => $row['CALLNUMBER'],
            'copies'    => $row['COPIES'],
            'subject'    => $row['SUBJECT'],
            'department'    => $row['DEPARTMENT'],
        ]);
    }


    public function ebook_model(array $row)
    {
        return new ebooks([
            'title'     => $row['TITLE'],
            'author'    => $row['AUTHOR'],
            'copyright'    => $row['COPYRIGHT'],
            'department'    => $row['DEPARTMENT'],
            'links'    => $row['LINKS'],
        ]);
    }

    public function subject_import(array $row)
    {
        return new subjectList([
            'subjectName' => $row['Subject Name']
        ]);
    }

    public function department_import(array $row)
    {
        return new departmentList([
            'departmentName' => $row['Department Name']
        ]);
    }
}
