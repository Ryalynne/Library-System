<?php

namespace App\Imports;

use App\Models\booklist;
use App\Models\copies;
use App\Models\departmentList;
use App\Models\ebooks;
use App\Models\subjectList;
use Illuminate\Mail\Message;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BookListImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        // try {
        //     foreach ($rows as $row) {
        //         $books = Booklist::select('subject_lists.id as subjectID', 'department_lists.id as departmentID')
        //             ->join('borrowpages', 'booklists.id', '=', 'borrowpages.bookid')
        //             ->join('subject_lists', 'booklists.subject', '=', 'subject_lists.id')
        //             ->join('department_lists', 'booklists.department', '=', 'department_lists.id')
        //             ->where('subject', $row[5]) // Assuming subject is at index 5
        //             ->where('department', $row[6]) // Assuming department is at index 6
        //             ->get();

        //         foreach ($books as $book) {
        //             $subjectID = $book->subjectID;
        //             $departmentID = $book->departmentID;

        //             if (empty($subjectID)) {
        //                 $existingSubject = SubjectList::where('subjectName', $row[5])->first();

        //                 if (!$existingSubject) {
        //                     $newSubject = SubjectList::create([
        //                         'subjectName' => $row[5]
        //                     ]);
        //                     $subjectID = $newSubject->id;
        //                 } else {
        //                     $subjectID = $existingSubject->id;
        //                 }
        //             }

        //             if (empty($departmentID)) {
        //                 $existingDepartment = DepartmentList::where('departmentName', $row[6])->first();

        //                 if (!$existingDepartment) {
        //                     $newDepartment = DepartmentList::create([
        //                         'departmentName' => $row[6]
        //                     ]);
        //                     $departmentID = $newDepartment->id;
        //                 } else {
        //                     $departmentID = $existingDepartment->id;
        //                 }
        //             }

        //             Booklist::create([
        //                 'title' => $row[0],
        //                 'author' => $row[1],
        //                 'copyright' => $row[2],
        //                 'accession' => $row[3],
        //                 'callnumber' => $row[4],
        //                 'subject' => $subjectID,
        //                 'department' => $departmentID,
        //             ]);

        //             $copies = is_null($row[3]) ? 1 : $row[3];

        //             Copies::create([
        //                 'bookid' => $book->id,
        //                 'action' => 'added',
        //                 'copies' => $copies,
        //             ]);
        //         }
        //     }
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
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
