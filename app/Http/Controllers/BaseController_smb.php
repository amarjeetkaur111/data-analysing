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
        $host = env('SMB_HOST');
        $user = env('SMB_USER');
        $workgroup = env('SMB_WORKGROUP');
        $password = env('SMB_PASS');
        $sharePath = env('SMB_SHARE');

        $auth = new \Icewind\SMB\BasicAuth($user, $workgroup, $password);
        $serverFactory = new \Icewind\SMB\ServerFactory();

        $server = $serverFactory->createServer($host, $auth);

        $share = $server->getShare($sharePath);

        $shares = $server->listShares();

        $files = $share->dir('/');

        //$files = array_diff(Storage::disk('local')->files(),array('..', '.','.gitignore'));
        //echo '<pre>'; print_r($files);exit;
		$GetPharmacyPhone = PharmacyModel::select('PhoneNumber','PharmacyName')->get()->toArray();
        $Pharmacy = array_column($GetPharmacyPhone,'PhoneNumber','PharmacyName');
        $Pharmacy=str_replace('-','',$Pharmacy);		
        $p = 0;
        $FinalArray = array();
        foreach($files as $info)
		{
           $filename = $info->getName();

           foreach($Pharmacy as $key => $value)
			{
                if(strpos($filename,$value)!== false)
				{

				    //$path = '/var/www/websites/pharmacydata-web1.dev.wellpharmacy.com/html/jsontest/remote/'.$filename;
				   // $path = $_SERVER['DOCUMENT_ROOT'].'/'.$sharePath.'/remote/'.$filename;
                    //$fr = $share->read($filename);
                    //print_r($path);exit;
                    //$dataString = fread($fr, 2);
                   // $dataString = file_get_contents($path);
                   // print_r($dataString);exit;
                   // $readString = json_decode($dataString,true);

                    $fr = $share->read($filename);

                    $dataString = fread($fr, 99999);

                    $readString = json_decode($dataString,true);
                   // echo '<pre>'; print_r($readString);exit;

                    //$arrmerge = $readString['NazStatRecord']['row'];
                    $arrmerge = $readString['StatRecord']['row'];

                    $arrmerge = array_map(function($arrmerge) use ($key){
                        return $arrmerge + ['Pharmacy' => $key];
                    }, $arrmerge);

                    //print_r($arrmerge);exit;

                    array_push($FinalArray,$arrmerge);

//                    $path = Storage::path($info);
//                    $file=fopen($path,'r');
//                    $dataString = fread($file, 50000);
//                    $readString = json_decode($dataString,true);
//                    $arrmerge = $readString['NazStatRecord']['row'];
//                    $arrmerge = array_map(function($arrmerge) use ($key){
//                        return $arrmerge + ['Pharmacy' => $key];
//                    }, $arrmerge);
//                    array_push($FinalArray,$arrmerge);
                }
            }
        }
        //print_r($FinalArray);exit;
        $FinalArray = Arr::collapse($FinalArray); 
        $this->AllPharmacyData = $FinalArray;
    }
    public function details()
    {
        
        return $this->AllPharmacyData;
    }
}
