<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FieldsModel;
use App\Models\CategoryModel;
use Validator;

class Fields extends Controller
{
	/*-----------------List Fields-------------*/
	public function FieldsList()
	{
		$GetCategories=CategoryModel::all();
		return view('Fields.FieldsList',['categories'=>$GetCategories]);
	}
	
	/*--------------Insert New Field Category Wise--------------*/
	public function InsertField(Request $req)
	{
		Validator::make($req->all(),[
			'Category'=>'required',
			'FieldName'=>'required'
		])->validateWithBag('AddField');
		
		$Field=new FieldsModel();
		$Field->CategoryID=$req->input('Category');
		$Field->FieldTitle=$req->input('FieldName');
		if($Field->save())
			$req->session()->flash('msg','New Field Added');
		else
			$req->session()->flash('errormsg','Something went Wrong! Record Not Added');
		return redirect('category/fields');	
	}
	/*-------------Fetch Fields Category Wise--------------*/
	public function FetchFieldsCategoryWise($CategoryID)
	{
		$data=FieldsModel::where('CategoryID','=',$CategoryID)->get()->toArray();
		foreach($data as $key=>$value)
		{
			$data[$key]['id']=encval($value['FieldID']);
			$data[$key]['CategoryID']=encval($value['CategoryID']);
		}
        return  response()->json(['data' => $data]);		
	}
	/*------------Load field details in editable form---------*/
	public function EditField($FieldID)
	{
        $FieldID = decval($FieldID);
        $data = FieldsModel::find($FieldID);
        return  response()->json(['data' => $data]);		
	}
	/*-----------Update Field----------------*/
	public function UpdateField(Request $req)
	{
		Validator::make($req->all(),[
           'EditCategoryName' => 'required',
           'EditFieldName' => 'required',
        ])->validateWithBag('EditField');
		
		$Field=new FieldsModel();
		$FieldID=decval($req->input('editfield_id'));
		$Field=FieldsModel::find($FieldID);
		$Field->CategoryID=$req->input('EditCategoryName');
		$Field->FieldTitle=$req->input('EditFieldName');
		if($Field->save())
			$req->session()->flash('msg','Field Updated Successfully!');
		else
			$req->session()->flash('errormsg','Something went Wrong! Record Not Updated');
		return redirect('/category/fields');		
	}
	/*---------------------Delete Field-------------------*/
	public function DeleteField($id)
	{
        $id = decval($id);
        $Field = new FieldsModel();
        $Field = FieldsModel::find($id);
        $Field->delete();
        echo "Field Deleted";		
	}
}
