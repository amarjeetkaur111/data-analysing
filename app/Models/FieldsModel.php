<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldsModel extends Model
{
    use HasFactory;
    protected $table = 'fields';
    protected $primaryKey = 'FieldID';
    public $timestamps = false;		

    public function DataEntry()
    {
        return $this->hasMany(DataEntryModel::class,'FieldID');
    }

    public function Category()
    {
        return $this->belongsTo(CategoryModel::class,'CategoryID');
    }
}
