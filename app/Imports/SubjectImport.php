<?php

namespace App\Imports;

use App\Models\subjectList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubjectImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            subjectList::create([
                'subjectName' => $row[0],
            ]);
        }
    }
}
