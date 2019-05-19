<?php

namespace App\Imports;

use App\Registry;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as IlluminateValidator;

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

 
        $when_datetime = Date::excelToDateTimeObject($row[0]);
        // ->format('d/m/y H:i');
   

        \DB::enableQueryLog();

        // $exist = \DB::select('select * from registries where `when` = ?', [$when_datetime]);
        $exist = Registry::where('when', $when_datetime)->exists();

        if ($exist) {
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

    // public function rules(): array
    // {
    //     // $data['when'] = Carbon::createFromFormat("d/m/y H:i", $data['when'])->toDateTimeString();

    //     // $validator = Validator::make($data, [
    //     //     'when' => 'unique:registries,when'
    //     // ]);


    //     return [
            
    //          // Can also use callback validation rules
    //          '0' => function($attribute, $value, $onFailure) {
    //               $when = Carbon::createFromFormat("d/n/y H:i", $value)->toDateTimeString();
    //               $exist =  DB::select('select * from registries where when = ?', [$value])->exists();
    //               if($exist) {
    //                    $onFailure("Value $value exists in when column");
    //               }
    //           }
    //     ];
    // }
}
