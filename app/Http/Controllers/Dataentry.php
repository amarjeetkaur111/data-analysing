<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataentryModel;
use App\Models\PharmacyModel;
use App\Models\FieldsModel;
use App\Models\CategoryModel;
use Validator;

class Dataentry extends Controller
{
	/*----------Main Screen------------*/
    public function DataentryForm()
	{
        $pharmacies = PharmacyModel::all();
        return view('Dataentry.DataentryMain',['pharmacy'=>$pharmacies]);		
	}
	/*---------Dataentry Screen---------------*/
	public function DataEntryFormView(Request $req)
	{
		$validator=Validator::make($req->all(),[
			'pharmacy'=>'required',
			'SubmitDate'=>'required',
		])->validateWithBag('DataentryMain');
		$pharmacies = PharmacyModel::all();
		$PrescriptionFields=FieldsModel::where('CategoryID','=',1)->get();
		$CompoundFields=FieldsModel::where('CategoryID','=',2)->get();
		$ClinicalFields=FieldsModel::where('CategoryID','=',3)->get();
		$SalesLedgerFields=FieldsModel::where('CategoryID','=',4)->get();
		$PostedData=array('PharmacyID'=>$req->input('pharmacy'),'SubmitDate'=>$req->input('SubmitDate'));
		return view('Dataentry.DataentryForm',['PostedData'=>$PostedData,'pharmacy'=>$pharmacies,'Prescription'=>$PrescriptionFields,'Compound'=>$CompoundFields,'Clinicals'=>$ClinicalFields,'SalesLedger'=>$SalesLedgerFields]);
		
	}
	/*------------Submit DataEntry---------------*/
	public function SubmitDataEntry(Request $req)
	{
		// get_d($req->all());
		$GetCategories=CategoryModel::all();
		$PharmacyID=decval($req->input('PharmacyID'));
		$InsertFlag=0;
		//print_r($_POST);exit();
		foreach($GetCategories as $Category)
		{
			$CategoryID=$Category->CategoryID;
			//Fetch Fields Category Wise
			$GetFieldsCategoyWise=FieldsModel::where('CategoryID','=',$CategoryID)->get();
			//dd($GetFieldsCategoyWise);
			foreach($GetFieldsCategoyWise as $Fields)
			{
				$DataInsert=new DataentryModel();
				$DataInsert->PharmacyID=$PharmacyID;
				$DataInsert->CategoryID=$CategoryID;
				$InputName=$CategoryID.'_'.$Fields->FieldID;
				$DataInsert->FieldID=$Fields->FieldID;
				$DataInsert->SubmittedValue=$req->input($InputName);
				$DataInsert->InsertedDate=$req->input('CurrentDate');
				if($req->input($InputName)!='')
				{
					if($DataInsert->save())
					{
						$InsertFlag=1;
					}
				}
			}		
		}
        if($InsertFlag==1)
            $req->session()->flash('msg','Data Submitted Successfully');
        else
            $req->session()->flash('errormsg','Something went Wrong! Record Not Added');
        return redirect('/dataentry');			
	}
}
