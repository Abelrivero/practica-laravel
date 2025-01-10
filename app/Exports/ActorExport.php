<?php

namespace App\Exports;

use App\Models\Actor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $actores = Actor::select('id', 'name', 'dateBirth')->get();

        return $actores;
    }
}
