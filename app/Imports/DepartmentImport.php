<?php

namespace App\Imports;

use App\Models\departmentList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DepartmentImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            departmentList::create([
                'departmentName' => $row[0],
            ]);
        }
    }
}
