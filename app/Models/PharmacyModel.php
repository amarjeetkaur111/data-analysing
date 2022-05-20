<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyModel extends Model
{
    use HasFactory;
    protected $table = 'pharmacies';
    protected $primaryKey = 'PharmacyID';
    public $timestamps = false;	

    public function DataEntry()
    {
        return $this->hasMany(DataEntryModel::class,'PharmacyID');
    }
}
