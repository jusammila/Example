<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\ExtraImage;
use App\Models\Post;
use Auth;
class Welcome extends Controller
{
    public function index()
    {
       
        return view('index');
    }
    public function  reg(Request $request)
    {
$role=$request->role;
if($role==1)
{
    $user=new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password=bcrypt($request->pwd);
    $user->phone=$request->phone;
    $userSave=$user->save();
        if($userSave)
        {
            return redirect()->back()->with('status','Registered successfully');
        }
}
else{
    $user=new Customer();
$user->name=$request->name;
$user->email=$request->email;
$user->password=bcrypt($request->pwd);
$user->phone=$request->phone;
$userSave=$user->save();
if($userSave)
        {
            return redirect()->back()->with('status','Registered successfully');
        }
}
    }
    public function login(Request $request)
    {
       // print_r($_POST);exit();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        // print_r( $credentials);
        // exit();

        if (Auth::attempt($credentials))
         {


            // var_dump($user);
            $user = auth()->user();

           

                // echo"h1jh";exit();

                return redirect()->intended('dashboard')
                    ->withSuccess('Signed in');
            
    }
    // else if (Auth::guard('customer')->attempt($credentials)) 
    //     {
    //     // if (auth()->guard('admin')->attempt($credentials)) {
    //        //echo"ddd";exit();
    //         $user = auth()->guard('customer')->user();
    //      //  print_r($user);die;
    //      $customer = Customer::select('*')
    //      ->join('posts', 'posts.customer_id', '=', 'customers.id')
        
    //      ->where('posts.customer_id',auth()->guard('customer')->user()->id)
    //      ->paginate(25);      
    //      $extra=ExtraImage::get();
    //         return view('customer',compact('customer','extra'));
            
    //     }
         else
        {
            return back()->with('status', 'Invalid user name or password-outside');
        }
}
public function  customerlogin(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::guard('customer')->attempt($credentials)) 
        {
        // if (auth()->guard('admin')->attempt($credentials)) {
           //echo"ddd";exit();
            $user = auth()->guard('customer')->user();
         //  print_r($user);die;
         
         return redirect()->intended('customer_dashboard')
         ->withSuccess('Signed in');
            
        }
         else
        {
            return back()->with('status', 'Invalid user name or password-outside');
        }

}
    public function dashboard()
    {
          
 $customer = Customer::select('*','posts.post_id as post_id')
                ->join('posts', 'posts.customer_id', '=', 'customers.id')
                ->paginate(25);      
                $extra=ExtraImage::get();
return view('dashboard',compact('customer','extra'));
    }
    public function customer_dashboard()
    {
          
        $customer = Customer::select('*')
        ->join('posts', 'posts.customer_id', '=', 'customers.id')
       
        ->where('posts.customer_id',auth()->guard('customer')->user()->id)
        ->paginate(25);      
        $extra=ExtraImage::get();
        return view('customer',compact('customer','extra'));
    }
    public function admin_logout()
    {
       
        Auth::logout();

        return Redirect('index');
    }
    public function customer_logout()
    {
       
        Auth::guard('customer')->logout();
        return Redirect('index');
    }
    public function add_post(Request $request)
    {
       // print_r($request->extra);exit();
        $post=new Post();
        $post->title=$request->title;
        $post->description=$request->description;
        $post->customer_id=auth()->guard('customer')->user()->id;
        $postSave=$post->save();
        
        if($postSave)
        {
        
        
        $extraimages=array();
       // print_r($_POST['extra']);exit();
        $extraimages=$request->extra;
      //  print_r($extraimages);exit();
        // for($i=0;$i<count($extraimages);$i++)
        // {
                
                

        //             $file= $request->file($extraimages[$i]);
        //             $filename= date('YmdHi').$file->getClientOriginalName();
        //             $file->move(('public/extraimages'),$filename);
            
        if($files=$request->file('extra'))
        {
            foreach($files as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move('images',$name);
                $images=$name;
                $extraImage=new ExtraImage();
                $extraImage->image=$name;
                $extraImage->post_id=$post->post_id;
                $extraImage->save();
            }
            
        }
        
    
           
          //  return back()->with('status', 'Post Added Successfully');
        }
        
        
        return Redirect('customer_dashboard');;
        
    }
}
