<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmacyModel;
use App\Models\FieldsModel;
use App\Models\DataEntryModel;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Http\Controllers\BaseController;

class Reports extends Controller
{
	/*-----------------Load View----------------*/
    public function DataEntryReports(BaseController $baseclass)
    {
       
		$Pharmacies=PharmacyModel::all();
		$PrescriptionFields=FieldsModel::where('CategoryID','=',1)->get();
		$CompoundFields=FieldsModel::where('CategoryID','=',2)->get();
		$ClinicalFields=FieldsModel::where('CategoryID','=',3)->get();
		$SalesLedgerFields=FieldsModel::where('CategoryID','=',4)->get();

		$fulldata = $baseclass->details();
		$dates = array();
		if($fulldata){
			$datearray = array_column($fulldata,'StartDate');
			$dates['start'] = date('d-My',strtotime(min($datearray)));
			$dates['end'] = date('d-My',strtotime(max($datearray)));
		}
		return view('Reports.Reports',['pharmacy'=>$Pharmacies,'PrescriptionFields'=>$PrescriptionFields,'CompoundFields'=>$CompoundFields,'ClinicalFields'=>$ClinicalFields,'SalesLedgerFields'=>$SalesLedgerFields,'dates'=>$dates]);
	}
	
	/*--------------Load Report--------------------*/
	public function DataEntryReport(Request $req,BaseController $baseclass)
	{
		$fulldata = $baseclass->details();
		$dates = array();
		if($fulldata){
			$datearray = array_column($fulldata,'StartDate');
			$dates['start'] = date('d-My',strtotime(min($datearray)));
			$dates['end'] = date('d-My',strtotime(max($datearray)));
		}
		// get_d($req->all());

		$validator=Validator::make($req->all(),[
			'pharmacy1' => 'required',
		])->validateWithBag('PharmacyValidation');	

		$begin = microtime(true);
		$result = array();		

		$result['StartDate']=$StartDate1=date('Y-m-d',strtotime($req->input('startdate1')));
		if($req->input('startdate2') !== null)
			$result['StartDate2']=$StartDate2=date('Y-m-d',strtotime($req->input('startdate2')));
		else 
			$result['StartDate2']=$StartDate2=null;

		$result['EndDate']=$EndDate1=date('Y-m-d',strtotime($req->input('enddate1')));
		$result['EndDate2']=$EndDate2=date('Y-m-d',strtotime($req->input('enddate2')));

		$result['Prescription']=$req->input('Prescription');
		$result['Compound']=$req->input('Compound');
		$result['Clinical']=$req->input('Clinicals');
		$result['Sales']=$req->input('Sales');
		$result['pharmacy']=PharmacyModel::all();
		$result['PrescriptionFields']=FieldsModel::where('CategoryID','=',1)->get();
		$result['CompoundFields']=FieldsModel::where('CategoryID','=',2)->get();
		$result['ClinicalFields']=FieldsModel::where('CategoryID','=',3)->get();
		$result['SalesLedgerFields']=FieldsModel::where('CategoryID','=',4)->get();

		$PharmacyID1=$req->input('pharmacy1');
		$PharmacyID2=$req->input('pharmacy2');
		$result['Pharmacy']['SetA'] = PharmacyModel::select('PharmacyID','PhoneNumber','PharmacyName')->whereIn('PharmacyID',$PharmacyID1)->get()->toArray();
		if($PharmacyID2) $result['Pharmacy']['SetB'] = PharmacyModel::select('PharmacyID','PhoneNumber','PharmacyName')->whereIn('PharmacyID',$PharmacyID2)->get()->toArray();

		$set = array();
		$set[0] = array_column($result['Pharmacy']['SetA'],'PharmacyName');
		if($PharmacyID2)
			$set[1] = array_column($result['Pharmacy']['SetB'],'PharmacyName');
		
		$setArray = array();
		$result['AvailablePharmacy'] = array();
		foreach($set as $key => $value)
		{
			$x = 0;
			foreach($value as $pharmacyname)
			{
				$filterArray = array();
				if(isset($StartDate2))
				{
					if($key > 0)
						$filterArray = array_filter($fulldata, function ($var) use($StartDate2,$EndDate2,$pharmacyname){
							return ($var['StartDate'] >= $StartDate2 && $var['EndDate'] <= $EndDate2 && $var['Pharmacy']== $pharmacyname);
						});		
					else
						$filterArray = array_filter($fulldata, function ($var) use($StartDate1,$EndDate1,$pharmacyname){
							return ($var['StartDate'] >= $StartDate1 && $var['EndDate'] <= $EndDate1 && $var['Pharmacy']== $pharmacyname);
						});	
				}
				else
					$filterArray = array_filter($fulldata, function ($var) use($StartDate1,$EndDate1,$pharmacyname){
						return ($var['StartDate'] >= $StartDate1 && $var['EndDate'] <= $EndDate1 && $var['Pharmacy']== $pharmacyname);
					});	
					
				if(!empty($filterArray))
				{
					$setArray[$key][$x] = $filterArray;
					$result['AvailablePharmacy'][$key][$x] = $pharmacyname;
					$x++;
				}
			}
		}
		
	$FinalArray=array();
	$setindex = 0;
	foreach($setArray as $key => $innerkey)
	{
		$p = 0;
		foreach($innerkey as $num)
		{
			foreach($num as $value)
			{
				$KeyName=str_replace(' ','_',$value['Description']).'_'.str_replace(' ','_',$value['Analysistype']);
				if(isset($FinalArray[$key][$p]) && array_key_exists($KeyName,$FinalArray[$key][$p]) && isset($FinalArray[$key][$p][$KeyName]['TotalRxs']))
				{
					$FinalArray[$key][$p][$KeyName]['TotalRxs']+=$value['TotalRxs'];
				}
				else
				{
					$FinalArray[$key][$p][$KeyName]['Description']=$value['Description'];
					$FinalArray[$key][$p][$KeyName]['TotalRxs']=$value['TotalRxs'];
				}
				
				if(array_key_exists($KeyName,$FinalArray[$key][$p]) && isset($FinalArray[$key][$p][$KeyName]['TotalDollars']))
				{
					$FinalArray[$key][$p][$KeyName]['TotalDollars']+=$value['TotalDollars'];
				}
				else
				{
					$FinalArray[$key][$p][$KeyName]['TotalDollars']=$value['TotalDollars'];
				}
				
				if(array_key_exists($KeyName,$FinalArray[$key][$p]) && isset($FinalArray[$key][$p][$KeyName]['DistinctPatients']))
				{
					$FinalArray[$key][$p][$KeyName]['DistinctPatients']+=$value['DistinctPatients'];
				}
				else
				{
					$FinalArray[$key][$p][$KeyName]['DistinctPatients']=$value['DistinctPatients'];
				}
			}
			$p++;
		}
		if($PharmacyID2 && isset($FinalArray[$key])) {
			$innertitle = array();
			$InnerArray = array();				
			$setmergedata = call_user_func_array("array_merge", $FinalArray[$key]);
			foreach($setmergedata as $k => $v) $innertitle[] = $k;
			for($i = 0; $i < count($innertitle); $i++){
				foreach($FinalArray[$key] as $k => $v){
					foreach($v as $title => $details){							
						if($innertitle[$i] == $title){
							if(isset($InnerArray[$key][$title]['Description']))
							{
								$InnerArray[$key][$title]['TotalRxs'] += $details['TotalRxs'];
								$InnerArray[$key][$title]['TotalDollars'] += $details['TotalDollars'];
								$InnerArray[$key][$title]['DistinctPatients'] += $details['DistinctPatients'];

							}else{					
								$InnerArray[$key][$title]['Description'] = $details['Description'];
								$InnerArray[$key][$title]['TotalRxs'] = $details['TotalRxs'];
								$InnerArray[$key][$title]['TotalDollars'] = $details['TotalDollars'];
								$InnerArray[$key][$title]['DistinctPatients'] = $details['DistinctPatients'];
							}
						}
					}
					$FinalInnerArray[$key] = $InnerArray[$key];
				}
			}
		}
		$setindex++;
	}
	// get_d($FinalArray);

	$mergechart = array();
	if(!empty($FinalArray)){
		if($PharmacyID2){
			if(isset($FinalInnerArray[0]) && !empty($FinalInnerArray[0]) && isset($FinalInnerArray[1]) && !empty($FinalInnerArray[1])){
				$FinalArray = $FinalInnerArray;	
				$result['AvailablePharmacy'][0] = implode(",",$result['AvailablePharmacy'][0]);
				$result['AvailablePharmacy'][1] = implode(",",$result['AvailablePharmacy'][1]);
				$mergechart = call_user_func_array("array_merge", $FinalArray);
			}elseif(isset($FinalInnerArray[0]) && !empty($FinalInnerArray[0])){
				$FinalArray[0] = $FinalInnerArray[0];
				$result['AvailablePharmacy'][0] = implode(",",$result['AvailablePharmacy'][0]);
				$mergechart = $FinalArray[0]; 	
			}elseif(isset($FinalInnerArray[1]) && !empty($FinalInnerArray[1])){
				$FinalArray = array();
				$FinalArray[0] = $FinalInnerArray[1];
				$pharmacyset= implode(",",$result['AvailablePharmacy'][1]);
				$result['AvailablePharmacy'] = array();
				$result['AvailablePharmacy'][0] = $pharmacyset;
				$mergechart = $FinalArray[0]; 						
			}
		}
		else {
		 $FinalArray = $FinalArray[0];	
		 $result['AvailablePharmacy'] = $result['AvailablePharmacy'][0];
		 $mergechart = call_user_func_array("array_merge", $FinalArray);
		}
		
		// get($result['AvailablePharmacy']);
		// get_d($FinalArray);
	}
		$title=array();
		$titleData = $FinalArray;		            			
		$GChartData = $FinalArray;	
		// get_d($GChartData);
		// $mergechart = call_user_func_array("array_merge", $titleData);
		$title = array_column($mergechart, 'Description');
		$title = array_unique($title,SORT_REGULAR);	
		$title = array_values($title);
		$firstrow[0] = ["'Fields'"];
		for($t = 0;$t < count($result['AvailablePharmacy']); $t++)
		{	
			array_push($firstrow[0],"'".$result['AvailablePharmacy'][$t]."'");
		}
		for($i = 0; $i < count($title); $i++)
		{
			$rowtest1 = [];
			$toparray = [];
			array_push($rowtest1,"'".$title[$i]."'");
			for($k = 0; $k < count($GChartData); $k++)
			{
				$rowvalue = '';
				if($GChartData[$k] !== ''){
					foreach($GChartData[$k] as $row)
					{ 
					if($title[$i] == $row['Description'])
						$rowvalue = $row['TotalRxs'];
					}
				}
				if($rowvalue == '')	{array_push($rowtest1,0); array_push($toparray,0);}
				else {array_push($rowtest1,$rowvalue);array_push($toparray,$rowvalue);}
			}
				$title[$i]=array('field'=>$title[$i],'topvalue' => max($toparray),'Pharmacy'=>array_keys($toparray, max($toparray)));
			array_push($firstrow,$rowtest1);
		}	
		for($i = 0; $i < count($firstrow); $i++)
		{
			$firstrow[$i] =  "[" . implode(", ", $firstrow[$i]) . "]";
		}
		$firstrow = "[" . implode(", ", $firstrow) . "]";
		$result['title'] = $title;
		$result['ChartData'] = $FinalArray;
		$result['rows'] = $firstrow;
		$result['end'] = microtime(true) - $begin;
	// get_d($result['ChartData']);
	return view('Reports.Reports',['data'=>$result,'dates'=>$dates]);		
	}
}
