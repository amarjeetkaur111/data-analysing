<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Validator;

class Category extends Controller
{
	/*--------------Load All categories*/
    public function Categories()
	{
		$fetchCategory=CategoryModel::all();
		return view('Category.Categories',['categories'=>$fetchCategory]);
	}
	/*-------------Insert New Category-------------*/
	public function AddCategory(Request $req)
	{
		Validator::make($req->all(),[
			'CategoryName'=>'required',
		])->validateWithBag('AddCategory');
		//Check Category Already Exists
		$CheckCategoryExists=CategoryModel::where('CategoryName','=',$req->input('CategoryName'))->first();
		if($CheckCategoryExists==null)
		{
			$Category=new CategoryModel();
			$Category->CategoryName=$req->input('CategoryName');
			if($Category->save())
				$req->session()->flash('msg','New Category Added');
			else
				$req->session()->flash('errormsg','Something went Wrong! Record Not Added');
			return redirect('/category');
		}
		else
		{
			$req->session()->flash('errormsg','Category Already Exists!');
			return redirect('/category');
		}
	}
	/*--------------Load Category in Edit Form----------------*/
	public function EditCategory($id)
	{
        $id = decval($id);
        $data = CategoryModel::find($id);
        return  response()->json(['data' => $data]);		
	}

	/*----------------Update Category-----------------------*/	
	public function UpdateCategory(Request $req)
	{
		Validator::make($req->all(),[
           'EditCategoryName' => 'required',
        ])->validateWithBag('EditCategory');
		
		$Category=new CategoryModel();
		$CategoryID=decval($req->input('EditId'));
		$Category=CategoryModel::find($CategoryID);
		$Category->CategoryName=$req->input('EditCategoryName');
		if($Category->save())
			$req->session()->flash('msg','Category Updated Successfully!');
		else
			$req->session()->flash('errormsg','Something went Wrong! Record Not Updated');
		return redirect('/category');
	}
	
	/*---------------Update Category End-----------------------*/	
	
	/*----------------Delete Category------------------------*/
    public function DeleteCategory($id)
    {
        $id = decval($id);
        $pharmacy = new CategoryModel();
        $pharmacy = CategoryModel::find($id);
        $pharmacy->delete();
        echo "Category Deleted";
    }
	
}
