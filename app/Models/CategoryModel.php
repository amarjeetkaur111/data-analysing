<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;	

    public function DataEntry()
    {
        return $this->hasMany(DataEntryModel::class,'CategoryID');
    }	

    public function Field()
    {
        return $this->hasMany(FieldsModel::class,'FieldID');
    }   
}
