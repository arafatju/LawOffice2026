<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginfo;
use App\Mail\userinfo; 
use Image;
use DB;
 use Toastr;
  use RealRashid\SweetAlert\Facades\Alert;

class infoimp extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
    public function index(){

        return view('auth.login');
    }
     public function user(){
         return view('DR.user');
     }
     public function usersr(){
        return view('SR.user');
    }
    public function userone11(){
        $draft = DB::table('codetable')
        ->select('*')
        ->where('status','economy')
        ->get();
  
    return view('User.user', compact('draft'));
         
    }
     public function section7(){
        if(Auth::check()){
            $count_user1 = DB::table('users')->where('role', 'user')->count();
            $count_user2 = DB::table('users')->where('role', 'verified1')->count();
            $count_accept = DB::table('users')->where('role', 'userone')->count();
            $user_number=$count_user1+$count_user2;
                           
            $application_number1 = DB::table('user_budget')->where('status', 'Accepted')->count();
            $application_number2 = DB::table('user_budget')->where('status', 'Forwarded')->count();
            $application_number3 = DB::table('user_budget')->where('status', 'Waiting')->count();
         
            $total=$application_number1+$application_number2+$application_number3;
            $waiting=$application_number2+$application_number3;
            $accepted=$application_number1;
            return view('SR.dashboard',compact('count_accept','user_number','total','accepted','waiting'));
           
 
           
                     }
    
    
     

    return redirect("login")->withSuccess('You are not allowed to access');
       
    }
    public function budgetcode(Request $request){
        $validated = $request->validate([
            'code_status' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);
        if($validated['code_status']=='economy'){
        DB::table('codetable')->insert([
            'code' => $request->code1,
            'name' => $validated['name'],
            'status'=>'economy',
             
             
             
        ]);       toastr('Successfully Added');                 }
        else if( $validated['code_status']=='designation'){
            DB::table('codetable')->insert([
                'code' => '1111',
                'name' => $validated['name'],
                'status'=>'designation',
                 
                 
                 
            ]);  toastr('Successfully Added');
        }
        else if( $validated['code_status']=='district'){
            DB::table('codetable')->insert([
                'code' =>  '2222',
                'name' => $validated['name'],
                'status'=>'district',
                 
                 
                 
            ]);  toastr('Successfully Added');
        }

        $draft = DB::table('codetable')
        ->select('*')
        ->get(); 
               
               
      
    return view('SR.code11', compact('draft'));
        
    }
    public function userbudgetdel(Request $request){
       
        $rrt=DB::table('user_budget')
              ->select('status')
               ->where('applicationid','=',decrypt($request->id))
       ->first();
       if($rrt && $rrt->status=='pending'){ 
           
       
        DB::table('user_budget')
        ->where('status','=','pending')
        ->where('applicationid','=',decrypt($request->id))
        ->delete();
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('Designation','=',Auth::user()->Designation)
        ->where('District','=',Auth::user()->District)
        ->paginate();
        toastr('Successfully Deleted');
    return view('User.userdraft', compact('draftdata'));}
        else {
            $draftdata = DB::table('user_budget')
            ->select('*')
            ->where('Designation','=',Auth::user()->Designation)
            ->where('District','=',Auth::user()->District)
            ->paginate();
            
        return view('User.userdraft', compact('draftdata'));

        }
    }
    public function budgetstatus(Request $request){
       
       $rrt=DB::table('user_budget')
              ->select('status')
               ->where('applicationid','=',$request->id)
       ->first();
       if($rrt && $rrt->status=='pending'){ 
        DB::table('user_budget')
        ->where('status','=','pending')
        ->where('applicationid','=',$request->id)
        ->update(['status' => "Forwarded"]);

         $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('Designation','=',Auth::user()->Designation)
        ->where('District','=',Auth::user()->District)
        ->paginate();
        toastr('Successfully Sent to Admin Section');
    return view('User.userdraft', compact('draftdata'));}

    else {
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('Designation','=',Auth::user()->Designation)
        ->where('District','=',Auth::user()->District)
        ->paginate();
         
    return view('User.userdraft', compact('draftdata'));

    }
    }
    public function budgetform(Request $request){
        $validated = $request->validate([
            'code11' => 'required|string|max:255',
            'financial2324' => 'required|string|max:255',
            'allotment' => 'required|integer|min:1|max:9223372036854775807', // For signed BIGINT
            'financial2425' => 'required|string|max:255',
             'allotment3' => 'required|integer|min:1|max:9223372036854775807',
            'allotment2' => 'required|integer|min:1|max:9223372036854775807', // For signed BIGINT
            'opinion' => 'required|string|max:255',

        ]);
        $lastId = DB::table('user_budget')->latest('id')->value('id');
        DB::table('user_budget')->insert([
            'code11' => $validated['code11'],
            'username' => Auth::user()->name,
            'email'=> Auth::user()->email,
            'mobile'=> Auth::user()->mobile,
            'Designation'=> Auth::user()->Designation,
            'District'=> Auth::user()->District,
            'status'=>'pending',
            'financial2324'=>$validated['financial2324'],
            'allotment'=>$validated['allotment'],
            'allotment2'=>$validated['allotment2'],
            'allotment3'=>$validated['allotment3'],
            'opinion'=>$validated['opinion'],
            'financial2425'=>$validated['financial2425'],
            'applicationid'=>Auth::user()->mobile.$lastId,

             
             
             
        ]);
        toastr('Successfully Saved Draft data');
        $draft = DB::table('codetable')
        ->select('*')
        ->get();

    return view('User.user', compact('draft'));
        
    }
    public function finacialcode(){
        $draft = DB::table('codetable')
        ->select('*')
        ->get();

    return view('SR.code11', compact('draft'));
    }
     
    public function userdraftbudget(){
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('Designation','=',Auth::user()->Designation)
        ->where('District','=',Auth::user()->District)
        ->paginate();

    return view('User.userdraft', compact('draftdata'));
        
        
                             }
      
      
    
    
    
    public function verificationinfo(){
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Forwarded')
        ->paginate();

    return view('SR.verificationinfo', compact('draftdata'));

        

    }
    public function budgetstatusfinal1(Request $request){
        DB::table('user_budget')
        ->where('status','=','Forwarded')
        ->where('applicationid','=',$request->id)
        ->update(['status' => "Waiting"]);
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Forwarded')
        ->paginate();
        toastr('Successfully Sent to Admin Approval ');

    return view('SR.verificationinfo', compact('draftdata')); 

    } 
    
    public function inactiveuserlist(Request $request){
        DB::table('users')
         
        ->where('email','=',$request->id)
        ->update(['role' => "inactive"]);
       return redirect()->route('showinactive');
    }
       public function showinactive(){
        $draftdata=DB::table('users')
        ->select('*')
        ->where('role','=','inactive')
        ->paginate();
       return view('DR.inactive1122',compact('draftdata'));

    }
    
    public function finalstage(){
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Waiting')
        
        ->paginate();

    return view('DR.finalstage', compact('draftdata'));
    }

    public function userlist1122(){
        $draftdata=DB::table('users')
        ->select('*')
        ->where('role','=','userone')
        ->paginate();
       return view('DR.userlist1122',compact('draftdata'));
    }
    public function finalstage1123(Request $request){
        
       
        
        
        $draftdata = DB::table('user_budget')
        ->select('*')
         ->where('District','like','%'.$request->district.'%')
         ->where('Designation','like','%'.$request->designation.'%')
         ->where('code11','like', '%'.$request->code.'%')
        ->where('status','Accepted')
        ->paginate();
        $draft1 = DB::table('codetable')
        ->select('*')->where('status','designation')
        ->get(); 
        $draft2 = DB::table('codetable')
        ->select('*')->where('status','district')
        ->get();       
        $draft3 = DB::table('codetable')
        ->select('*')->where('status','economy')
        ->get();      
      
     

    return view('DR.final11', compact('draftdata','draft1','draft2','draft3'));
  

    }
    public function finalstage1122(){
        $draftdata = DB::table('user_budget')
        ->select('*')
         
        ->where('status','=','Accepted')
        ->paginate();
        $draft1 = DB::table('codetable')
        ->select('*')->where('status','designation')
        ->get(); 
        $draft2 = DB::table('codetable')
        ->select('*')->where('status','district')
        ->get();       
        $draft3 = DB::table('codetable')
        ->select('*')->where('status','economy')
        ->get();      
      
     

    return view('DR.final11', compact('draftdata','draft1','draft2','draft3'));
    }
    public function acceptfinal(Request $request){
       
        
       
        DB::table('user_budget')
        ->where('status','=','Waiting')
        ->where('applicationid','=',$request->id)
        ->update(['status' => "Accepted"]);

        $user_mail=DB::table('user_budget')
            ->select('email')
            ->where('applicationid','=',$request->id)
            ->first();
  
        Mail::to($user_mail->email)->send(new userinfo($request->id));
        
        return redirect()->route('finalstage');
            

    }
    public function budgetback11(Request $request){
      
        $rrt=DB::table('user_budget')
        ->select('status')
        ->where('applicationid','=',decrypt($request->id))
        ->first();
        if($rrt->status=='Waiting'){ 
      
      
        DB::table('user_budget')
        ->where('status','=','Waiting')
        ->where('applicationid','=',decrypt($request->id))
        ->update(['status' => "Forwarded"]);

        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Waiting')
        ->orwhere('status','=','Accepted')
        ->paginate();
        toastr('Successfully sent back  ');
    return view('DR.finalstage', compact('draftdata'));
        }
           else {
            return redirect()->back();
           }

    }
    public function budgetback(Request $request){
        DB::table('user_budget')
        ->where('status','=','Forwarded')
        ->where('applicationid','=',decrypt($request->id))
        ->update(['status' => "pending"]);

        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Forwarded')
        ->paginate();
        toastr('Successfully Sent back  ');
    return view('SR.verificationinfo', compact('draftdata'));

         
    }
    public function sendtoict(){
        $draftdata=DB::table('users')
        ->select('*')
        ->where('role','=','user')
        ->paginate(3);
       return view('SR.sendtoict',compact('draftdata'));

         
    }
    public function finaluser(){
        $draftdata=DB::table('users')
        ->select('*')
        ->where('role','=','verified1')
        ->paginate();
       return view('DR.finaluser',compact('draftdata'));

         
    }
    public function userstatus22(Request $request){
        DB::table('users')
      ->where('email','=',$request->id)
      ->update(['role' => 'userone' ]);
      $draftdata=DB::table('users')
      ->select('*')
      ->where('role','=','verified1')
      ->paginate(3);
      toastr('Successfully Accepted User ');
     return view('DR.finaluser',compact('draftdata'));
    }
    public function userstatus11(Request $request){
         
      DB::table('users')
      ->where('id','=',$request->id)
      ->update(['role' => 'verified1' ]);
      $draftdata=DB::table('users')
      ->select('*')
      ->where('role','=','user')
      ->paginate(3);
      toastr('Successfully Sent for final Acceptance ');


      return view('SR.sendtoict',compact('draftdata')) ;
       
    }
    public function overalldel11(Request $request){
        $tablenn=$request->name;
        $id= $request->id;
      DB::table($tablenn)
      ->where('id','=',$id)
      ->delete();
      $draftdata=DB::table('users')
        ->select('*')
        ->where('role','=','verified1')
        ->paginate();
        toastr('Successfully Deleted  ');
       return view('DR.finaluser',compact('draftdata'));




  }  
    public function overalldel(Request $request){
          $tablenn=$request->name;
          $id= $request->id;
        DB::table($tablenn)
        ->where('id','=',$id)
        ->delete();
        $draftdata=DB::table('users')
        ->select('*')
        ->where('role','=','user')
        ->paginate(3);
        toastr('Successfully deleted ');
       return view('SR.sendtoict',compact('draftdata'));



    }
    public function srdel(Request $request){
         
        
        $tablenn=$request->name;
        $id=decrypt($request->id);
      DB::table($tablenn)
      ->where('id','=',$id)
      ->delete();
      $draft = DB::table('codetable')
      ->select('*')
      ->get();
      toastr('Successfully Deleted');
  return view('SR.code11', compact('draft'));



  }

     
    

     
 
    public function overallverification(Request $request){
        $tablenn=$request->name;
        $id=decrypt($request->id);
      DB::table($tablenn)
      ->where('id','=',$id)
      ->update(['status' => 'ok' ]);
      return view('SR.verificationinfo');



  }
  
 
 
 
public function admin(){
    return view('AR.user');
}
public function admindash(){
    return view('AR.dashboard');
}
public function Newuser(){
    
    return view('Newok.Newuser');
}
  
public function dashboard()
    {   
        if(Auth::check()){

                // ->orWhere('name', 'John')
               
               
               return view('DR.dashboard');
                        }
        
        
         
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function dash2()
    {   
        if(Auth::check()){
            
                // ->orWhere('name', 'John')
                $count_user1 = DB::table('users')->where('role', 'user')->count();
                $count_user2 = DB::table('users')->where('role', 'verified1')->count();
                $count_accept = DB::table('users')->where('role', 'userone')->count();
                $user_number=$count_user1+$count_user2;
                
                
                $application_number1 = DB::table('user_budget')->where('status', 'Accepted')->count();
                $application_number2 = DB::table('user_budget')->where('status', 'Forwarded')->count();
                $application_number3 = DB::table('user_budget')->where('status', 'Waiting')->count();
             
                $total=$application_number1+$application_number2+$application_number3;
               $waiting=$application_number2+$application_number3;
                $accepted=$application_number1;
                return view('DR.dash2',compact('count_accept','user_number','total','accepted','waiting'));
               
               
                        }
        
        
         
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
