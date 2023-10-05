<?php

namespace App\Imports;

use App\Models\booklist;
use App\Models\copies;
use App\Models\departmentList;
use App\Models\ebooks;
use App\Models\subjectList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BookListImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $booklist = booklist::create([
                'title'     => $row[0],
                'author'    => $row[1],
                'copyright' => $row[2],
                'accession' => $row[3],
                'callnumber' => $row[4],
                'subject' => $row[6],
                'department' => $row[7],
            ]);
            if (!empty($row[6])) {
                subjectList::create([
                    'subjectName' => $row[6],
                ]);
            }
            if (!empty($row[7])) {
                departmentList::create([
                    'departmentName' => $row[7],
                ]);
            }
            $copies = is_null($row[5]) ? 1 : $row[5];

            copies::create([
                'bookid' => $booklist->id,
                'action' => 'added', // Assuming you have a foreign key column in your 'copies' table named 'booklist_id'
                'copies' => $copies, // Use the $copies variable here
            ]);
        }
    }
}
