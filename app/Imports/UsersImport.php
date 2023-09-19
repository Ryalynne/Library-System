<?php

namespace App\Imports;

use App\Models\booklist;
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
}