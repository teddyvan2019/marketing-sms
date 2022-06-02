<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         //'nom','prenom','date_naissance','telephone','profession','email','date_relance','repertoire_id','ville_id','religion_id','sexe_id'
        return new Contact([
            //
            'nom'  =>  $row["nom"],
            'prenom'      =>  $row["prenom"],
            'date_naissance' =>  $row["date_naissance"],
            'telephone'  =>  $row["telephone"],
            'profession'  =>  $row["profession"],
            'email'      =>  $row["email"],
            'date_relance'  =>  $row["date_relance"],
            
            'repertoire_id'  =>  $row["repertoire_id"],
            'ville_id'      =>  $row["ville_id"],
            'religion_id'      =>  $row["religion_id"],
            'sexe_id'      =>  $row["sexe_id"]

        ]);
    }
}
