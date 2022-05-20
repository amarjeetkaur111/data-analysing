<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEntryModel extends Model
{
    use HasFactory;
    protected $table = 'dataentry';
    protected $primaryKey = 'DataId';
    public $timestamps = false;		

    public function Category()
    {
        return $this->belongsTo(CategoryModel::class,'CategoryID');
    }

    public function Field()
    {
        return $this->belongsTo(FieldsModel::class,'FieldID');
    }

    public function Pharmacy()
    {
        return $this->belongsTo(PharmacyModel::class,'PharmacyID');
    }

}
