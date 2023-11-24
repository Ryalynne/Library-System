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
                            'departmentName' => $row[7]
                        ]);
                        $existingDepartment = $newDepartment->id;
                    } else {
                        $existingDepartment = $existingDepartment->id;
                    }
                }
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
                $copies = is_null($row[5]) ? 1 : $row[5];
                Copies::create([
                    'bookid' => $book->id,
                    'action' => 'added',
                    'copies' => $copies,
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
