<?php

namespace App\Imports;

use App\Models\ebooks;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Ebook_Import implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            ebooks::create([
                'title' => $row[0],
                'author' => $row[1],
                'copyright' => $row[2],
                'department' => $row[3],
                'links' => $row[4],
            ]);
        }
    }
}
