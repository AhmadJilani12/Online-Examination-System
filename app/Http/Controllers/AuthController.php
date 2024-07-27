<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\URL;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function loadRegister()
    {





        if(Auth::user() &&  Auth::user()->is_admin == 1)
        {
    return redirect('/admin/dashboard');
        }
        else if(Auth::user() &&  Auth::user()->is_admin == 0)
        {
            return redirect('/dashboard');
    
        }
    
    else{
    
        return view('register');
    }


    }


public function loadLogin(){

    if(Auth::user() &&  Auth::user()->is_admin == 1)
    {
return redirect('/admin/dashboard');
    }
    else if(Auth::user() &&  Auth::user()->is_admin == 0)
    {
        return redirect('/dashboard');

    }

else{

    return view('login');
}


}



public function userLogin(Request $request){

    $request->validate([
'email'=>'string|required|email',
'password'=>'string|required'
    ]);

  $userCredential=  $request->only('email','password');
  if(Auth::attempt($userCredential))
  {

if(Auth::user()->is_admin == 1)
{

    return redirect('/admin/dashboard');

}

else{

return redirect('/dashboard');

}

  }
  else{

return back()->with('error','Username and password is incorrect');

}


}



public function loadDashboard(){

    return view('Student.dashboard');
}

public function logout(Request $request){
$request->session()->flush();

Auth::logout();

return redirect('/');
    
}


public function forgetPasswordLoad(){

return view('forget-password');

}



public function   adminDashboard(){

    return view('admin.dashboard');
}


    public function studentRegister(Request $request)

    {

$request->validate([
'name'  =>'string | required |min:2',

'email' =>'string |email|required |max:100|unique:users',
'password'=>'string |required| confirmed|min:6'

]);


$user=new User();

$user->name=$request->name;
$user->email=$request->email;
$user->password= Hash::make($request->password);

$user->save();

return back()->with('success','your registration has been successfull');




    }


public function forgetPassword(Request $request){

try{

$user=    User::where('email',$request->email)->get();

if(count($user)>0)
{

 $token= Str::random(40);
$domain=URL::to('/');

  $url=  $domain.'/reset-password?token='.$token;
  $data['url']=$url;
  $data['email']=$request->email;
  $data['title']='Password Reset';
  $data['body']='Please Click on below link to reset your Password.';


  Mail::send('forgetPassswordMail',['data'=>$data] ,function ($message) use ($data){

    $message->to($data['email'])->subject($data['title']);


  });
   
$date=Carbon::now()->format('Y-m-d H:i:s');


  PasswordReset::updateOrCreate(['email'=>$request->email],[

    'email'=>$request->email,
    'token'=>$token,
    'created_at'=>$date
  ]);



    
  return back()->with('success','Please Check your Mail to Reset your Password');



}
else{

    
return back()->with('error','Email is not Exist');
}

}catch(\Exception $e){
return back()->with('error',$e->getMessage());
}


}


public function resetPasswordLoad(Request $request){

  $resetData=  PasswordReset::Where('token',$request->token)->get();


if(isset($request->token) && count($resetData)>0 )
{

 $user=  User::where('email',$resetData[0]['email'])->get();


return view('resetPassword',compact('user'));



}
else{
    return view('404');
}

}

public function resetPassword(Request $request){

    $request->validate([
'password'=> 'required|string|min:6|confirmed'

    ]);

  $user=User::find($request->id);

  $user->password=Hash::make($request->password);
  $user->save();

  PasswordReset::where('email',$user->email)->delete();

  
  return redirect()->route('userLogin')->with('success', 'Your password is updated successfully.');

}

}