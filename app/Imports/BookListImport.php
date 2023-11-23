<?php

namespace App\Imports;

use App\Models\booklist;
use App\Models\copies;
use App\Models\departmentList;
use App\Models\subjectList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;

class BookListImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        try {
            foreach ($rows as $row) {

                $existingSubject = null;
                $existingDepartment = null;


                if (!empty($row[6])) {
                    $existingSubject = SubjectList::where('subjectName', $row[6])->first();

                    if (!$existingSubject) {
                        $newSubject = SubjectList::create([
                            'subjectName' => $row[6]
                        ]);
                        $existingSubject = $newSubject->id;
                    } else {
                        $existingSubject = $existingSubject->id;
                    }
                }

                if (!empty($row[7])) {
                    $existingDepartment = DepartmentList::where('departmentName', $row[7])->first();

                    if (!$existingDepartment) {
                        $newDepartment = DepartmentList::create([
                            'departmentName' => $row[7] // Assuming department name is at index 7
                        ]);
                        $existingDepartment = $newDepartment->id; // Assigning the department ID, not departmentName
                    } else {
                        $existingDepartment = $existingDepartment->id;
                    }
                }

                // $subjectID = null;
                // $departmentID = null;

                // $existingSubject = SubjectList::where('subjectName', $row[6])->first();
                // if (!$existingSubject) {
                //     $newSubject = SubjectList::create([
                //         'subjectName' => $row[6]
                //     ]);
                //     $subjectID = $newSubject->id;
                // } else {
                //     $subjectID = $existingSubject->id;
                // }

                // $existingDepartment = DepartmentList::where('departmentName', $row[7])->first(); // Assuming department name is at index 7
                // if (!$existingDepartment) {
                //     $newDepartment = DepartmentList::create([
                //         'departmentName' => $row[7] // Assuming department name is at index 7
                //     ]);
                //     $departmentID = $newDepartment->id; // Assigning the department ID, not departmentName
                // } else {
                //     $departmentID = $existingDepartment->id;
                // }

                $bookData = [
                    'title' => $row[0],
                    'author' => $row[1],
                    'copyright' => $row[2],
                    'accession' => $row[3],
                    'callnumber' => $row[4],
                    'subject' => $existingSubject,
                    'department' => $existingDepartment,
                ];


                $book = Booklist::create($bookData);

                // Define copies value based on column 5
                $copies = is_null($row[5]) ? 1 : $row[5];

                // Create entry in Copies table
                Copies::create([
                    'bookid' => $book->id,
                    'action' => 'added',
                    'copies' => $copies,
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }



        // foreach ($rows as $row) {
        //     $booklist = booklist::create([
        //         'title'     => $row[0],
        //         'author'    => $row[1],
        //         'copyright' => $row[2],
        //         'accession' => $row[3],
        //         'callnumber' => $row[4],
        //         'subject' => $row[6] ?? '1',
        //         'department' => $row[7] ?? '1',
        //     ]);
        // if (!empty($row[6])) {
        //     subjectList::create([
        //         'subjectName' => $row[6],
        //     ]);
        // }
        // if (!empty($row[7])) {
        //     departmentList::create([
        //         'departmentName' => $row[7],
        //     ]);
        // }
        // $copies = is_null($row[5]) ? 1 : $row[5];

        // copies::create([
        //     'bookid' => $booklist->id,
        //     'action' => 'added', // Assuming you have a foreign key column in your 'copies' table named 'booklist_id'
        //     'copies' => $copies, // Use the $copies variable here
        // ]);
        // }
    }
}
