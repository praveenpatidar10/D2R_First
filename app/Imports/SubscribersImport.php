<?php

namespace App\Imports;

use App\Model\Subscriber;
use Maatwebsite\Excel\Concerns\ToModel;

class SubscribersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Subscriber([
            'name'     => $row[0],
            'email'    => $row[1],
            'status'   => $row[2],
            'source_type'=>'newslatter'
        ]);
    }
}
