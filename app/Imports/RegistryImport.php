<?php

namespace App\Imports;

use App\Registry;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RegistryImport implements ToModel
{
    public $row = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($this->row <= 3){
            $this->row++;
            return null;
        }
        $registry_arr = [
            'when' => Date::excelToDateTimeObject($row[0]),
            'O3' => str_replace(" ","",$row[1]) ,
            'NO' => str_replace(" ","",$row[2]) ,
            'NO2' => str_replace(" ","",$row[3]) ,
            'NOx' => str_replace(" ","",$row[4]) ,
            'CO' => str_replace(" ","",$row[5]) ,
            'SO2' => str_replace(" ","",$row[6]) ,
            'PM25' => str_replace(" ","",$row[7]) 
        ];
        
        return new Registry($registry_arr);
    }
}
