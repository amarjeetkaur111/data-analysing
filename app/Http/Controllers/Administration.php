<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\PharmacyModel;
use Illuminate\Support\Facades\Hash;
use Validator;

class Administration extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	/*-----------------Admin Login---------------*/ 
    public function Login(Request $req)
    {
        $email=$req->input('email');
        $password=$req->input('password');
		
		$Authenticate=User::where('Email','=',$email)->first();
		
        if($Authenticate == null)
        {
          return back()->with('login_data','Incorrect Email');
        }
        else
        { 
            if(Hash::check($password,$Authenticate->Password))
               {
                   $req->session()->put('user',$email);
                   $req->session()->put('username',$Authenticate['FirstName']);
                   return redirect()->route('dashboard');
               }
               else
                    return back()->with('login_data','Incorrect Password');
        }
    }
	/*------------------------Load Dashboard on Login------------------*/
    public function dashboard()
    {
       return view('Administration.Home');
    }
	/*------------------------Logout----------------------------------*/
    public function Logout(Request $req)
    {
            $req->session()->flush();
            return  redirect()->route('login');
    }	
	/*-----------------------Load Admin Users-----------------------------*/
    public function Users()
    {
        $userdata = User::all();
        $pharmacies = PharmacyModel::all();
        return view('Administration.Users',['userdata'=>$userdata,'pharmacy'=>$pharmacies]);
    }
	/*----------------------Insert New Admin-----------------------------*/
    public function AddUser(Request $req)
    {
           Validator::make($req->all(),[
                'FirstName' => 'required',
                'LastName' => 'required',
                'Email' => 'required|email|unique:users,Email',
                'PhoneNumber' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
                'Password' => 'required',
            ])->validateWithBag('AddAdmin');

            $user = new User();
            $user->FirstName = $req->input('FirstName');
            $user->LastName = $req->input('LastName');
            $user->Email = $req->input('Email');
            $user->PhoneNumber = $req->input('PhoneNumber');
            $user->Password = Hash::make($req->input('Password'));
			$user->Role='admin';
            if($user->save())
                $req->session()->flash('msg','New Admin Added Successfully');
            else
                $req->session()->flash('errormsg','Something went Wrong! Admin Record Not Added');
            return redirect('/administration/users');

    }
	/*--------------------For Updating admin details Load data in edit form--------------------------------*/
    public function EditUser($id)
    {
        $id = decval($id);
        $data = User::find($id);
        return  response()->json(['data' => $data]);
    }
	/*---------------------------Update Admin---------------------------------------------*/
    public function UpdateUser(Request $req)
    {
            Validator::make($req->all(),[
                'EditAdminFirstName' => 'required',
                'EditAdminLastName' => 'required',
                'EditAdminEmail' => 'required|email',
                'EditAdminPhoneNumber' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
            ])->validateWithBag('EditAdmin');

            $flag = 0;
            $user = new User();
            $id = decval($req->input('EditId'));
            $user = User::find($id);
            $user->FirstName = $req->input('EditAdminFirstName');
            $user->LastName = $req->input('EditAdminLastName');
            $user->Email = $req->input('EditAdminEmail');
            $user->PhoneNumber = $req->input('EditAdminPhoneNumber');
            if($req->input('EditAdminPassword') == '')
            {
                if($user->push())
                    $flag=1;
                else
                    $flag=0;
            }
            else
            {
                $user->Password = Hash::make($req->input('EditAdminPassword'));
                if($user->push())
                    $flag=1;
                else
                    $flag=0;
            }

            if($flag==1)
                $req->session()->flash('successmsg','Admin Record Updated Successfully');
            else
                $req->session()->flash('errormsg','Something went Wrong! Admin Record Not Updated');
            return redirect('/administration/users');
    }
	/*-------------------------Delete Admin---------------------------------*/
    public function DeleteUser($id)
    {
        $id = decval($id);
        $user = new User();
        $user = User::find($id);
        $user->delete();
        echo "User Deleted";
    }	
	/*--------------------------Pharmacy------------------------------------*/
	
	//Insert new pharmacy
    public function AddPharmacy(Request $req)
    {
         Validator::make($req->all(),[
            'PharmacyName' => 'required',
            'PharmacyAddress' => 'required',
            'PharmacyManager' => 'required',
            'PharmacyPhone' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
        ])->validateWithBag('AddPharmacy');

        $pharmacy = new PharmacyModel();
        $pharmacy->PharmacyName = $req->input('PharmacyName');
        $pharmacy->PharmacyAddress = $req->input('PharmacyAddress');
        $pharmacy->PhoneNumber = $req->input('PharmacyPhone');
        $pharmacy->ManagerName = $req->input('PharmacyManager');
        if($pharmacy->save())
            $req->session()->flash('msg','New Pharmacy Added Successfully');
        else
            $req->session()->flash('errormsg','Something went Wrong! Pharmacy Record Not Added');
        return redirect('/administration/users');
    }
	/*------------------Load details in edit form------------------*/
    public function EditPharmacy($id)
    {
        $id = decval($id);
        $data = PharmacyModel::find($id);
        return  response()->json(['data' => $data]);
    }
	/*-------------------Update Pharmacy Details----------------------*/
    public function UpdatePharmacy(Request $req)
    {
        Validator::make($req->all(),[
            'EditPharmacyName' => 'required',
            'EditPharmacyAddress' => 'required',
            'EditPharmacyManager' => 'required',
            'EditPharmacyPhone' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
        ])->validateWithBag('EditPharmacy');
		$PharmacyID=decval($req->input('EditPharmacyId'));
        $pharmacy = new PharmacyModel();
        $pharmacy = PharmacyModel::find($PharmacyID);
        $pharmacy->PharmacyName = $req->input('EditPharmacyName');
        $pharmacy->PharmacyAddress = $req->input('EditPharmacyAddress');
        $pharmacy->PhoneNumber = $req->input('EditPharmacyPhone');
        $pharmacy->ManagerName = $req->input('EditPharmacyManager');
        if($pharmacy->save())
            $req->session()->flash('successmsg','Pharmacy Record Updated Successfully');
        else
            $req->session()->flash('errormsg','Something went Wrong! Pharmacy Record Not Updated');
        return redirect('/administration/users');
    }
	/*----------------Delete Pharmacy------------------------*/
    public function DeletePharmacy($id)
    {
        $id = decval($id);
        $pharmacy = new PharmacyModel();
        $pharmacy = PharmacyModel::find($id);
        $pharmacy->delete();
        echo "Pharmacy Deleted";
    }	


}
