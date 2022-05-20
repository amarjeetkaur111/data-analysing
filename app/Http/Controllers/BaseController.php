<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmacyModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class BaseController extends Controller
{
    protected $AllPharmacyData;
    public function __construct() 
    {
        $files = array_diff(Storage::disk('local')->files(),array('..', '.','.gitignore'));
		$GetPharmacyPhone = PharmacyModel::select('PhoneNumber','PharmacyName')->get()->toArray();
        $Pharmacy = array_column($GetPharmacyPhone,'PhoneNumber','PharmacyName');
        $Pharmacy=str_replace('-','',$Pharmacy);		
        $p = 0;
        $FinalArray = array();
        foreach($files as $info)
		{
           foreach($Pharmacy as $key => $value)
			{
                if(strpos($info,$value)!== false)
				{
                    $path = Storage::path($info);
                    $file=fopen($path,'r');
                    // $dataString = fread($file, 50000);
                    $dataString ='';
                    // $file = file($path);
                    // foreach ($file as $line_num => $line) {
                    //     $dataString .= $line;
                    // }
                    while(!feof($file)) {
                        $dataString .= trim(fgets($file));
                    }
                    // get_d($dataString);
                    $readString = json_decode($dataString,true);	        
                    $arrmerge = $readString['NazStatRecord']['row'];
                    $arrmerge = array_map(function($arrmerge) use ($key){
                        return $arrmerge + ['Pharmacy' => $key];
                    }, $arrmerge);
                    array_push($FinalArray,$arrmerge);
                }
            }
        }
        $FinalArray = Arr::collapse($FinalArray); 
        $this->AllPharmacyData = $FinalArray;
    }
    public function details()
    {
        
        return $this->AllPharmacyData;
    }
}
