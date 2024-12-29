<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use App\Models\User;
use App\Http\Controllers\ConverterController;
use App\Models\childinfo;
use App\Models\personalinfo;
use App\Models\wifeinfo;
use App\Models\preferred111;
use App\Models\workingdetails;
use App\Models\workingnow;
use App\Models\workingbefore;
use App\Models\release111;
use App\Models\info11;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginfo;
use App\Mail\userinfo; 
use Illuminate\Support\Facades\View;
use Image;
use DB;
use Mpdf\Mpdf;
 use Toastr;
  use RealRashid\SweetAlert\Facades\Alert;
  use Dompdf\Dompdf;
  use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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
     
    public function chakuri(Request $request){
        $converter = new ConverterController();

        $grd=$converter->bn2en($request->gradation);
        $request->merge(['gradation' => $grd]);
        $validated = $request->validate([
            'serviceid' => 'required|string|max:255',
            'gradation' => 'required|numeric',
            'join'=> 'required|date_format:d-m-Y',
             
            

        ]);
        $JoinDate = Carbon::createFromFormat('d-m-Y', $validated['join'])->format('Y-m-d');
       // $RetiredDate = Carbon::createFromFormat('d-m-Y', $validated['retired'])->format('Y-m-d');
       
        personalinfo::where('userid', Auth::user()->userid)->update([
            
            'serviceid' => $validated['serviceid'],
            'gradation'=>$validated['gradation']  ,
            'join'=> $JoinDate ,
            
        ]);
        User::where('userid', Auth::user()->userid)->update([
            'serviceid' => $validated['serviceid']
        ]); 
       return redirect('profile')->withSuccess('Updated');
    }
    public function husband(Request $request){
        $validated = $request->validate([
            'wifename' => 'required|string',
            'profession' => 'required|string',
            'wifeworkplace'=> 'nullable|string',
            'designation'=>'nullable|string' ,
            'wifehomedistrict' => 'required|string',
            'kids_number' => 'required|string',

        ]);
        wifeinfo::where('userid', Auth::user()->userid)->update([
            'wifename' => $validated['wifename'],
            'profession' => trim($validated['profession']),
            'wifeworkplace'=>$validated['wifeworkplace']  ,
            'designation'=> $validated['designation'],
            'wifehomedistrict'=> $validated['wifehomedistrict'],
            'kids_number'=>$validated['kids_number']
        ]);
        return redirect('profile')->withSuccess('Updated');
         
    }
    public function child12(){
        $draft2  = childinfo::where('userid',Auth::user()->userid)->get();
        return view('User.child12',compact('draft2'));

    }
    public function workingbefore (Request $request){
        $validated = $request->validate([
            'district1' => 'required|string',
           /* 'designation1' => 'required|string',
            'office1'=> 'required|string',
            'join1'=>'required|date_format:d-m-Y' ,
            'go_date' => 'required|date_format:d-m-Y',
            'release1' => 'required|date_format:d-m-Y',
            'sarok' => 'required|string',  */

        ]);
     /*    $JoinDate = Carbon::createFromFormat('d-m-Y', $validated['join1'])->format('Y-m-d');
        $godate = Carbon::createFromFormat('d-m-Y', $validated['go_date'])->format('Y-m-d');
        $release = Carbon::createFromFormat('d-m-Y', $validated['release1'])->format('Y-m-d');  */
        workingbefore::create([
             'userid'=>Auth::user()->userid,
            'district' => $validated['district1'],
            'mobile'=>Auth::user()->mobile,
            /*   'designation' => trim($validated['designation1']),
            'office'=>$validated['office1']  ,
            'start'=> $JoinDate,
            'end'=>$release ,
           'GO_Date'=> $godate,
           'GO_Date2'=> '20-02-02',
            'sarok'=>$validated['sarok'],
            'sarok2'=>'kkk',
            'status'=>'empty',
            'situation'=>'before',
            'end'=>$release,
           
            'status2'=>'nolocked',*/
 

        ]);
        return redirect('distbefore')->withSuccess('Updated');
    }
     
    public function workingpresent (Request $request){
        $validated = $request->validate([
            'district' => 'required|string',
            'designation' => 'required|string',
            'office'=> 'required|string',
            'start'=>'required|date_format:d-m-Y' ,
            'GO_Date' => 'required|date_format:d-m-Y',
            'sarok' => 'nullable|string',

        ]);
        $StartDate = Carbon::createFromFormat('d-m-Y', $validated['start'])->format('Y-m-d');
        $GoDate = Carbon::createFromFormat('d-m-Y', $validated['GO_Date'])->format('Y-m-d');
        workingnow::where('userid', Auth::user()->userid)
              
             ->update([
            'district' => $validated['district'],
            'designation' => trim($validated['designation']),
            'office'=>$validated['office']  ,
            'start'=> $StartDate,
           'GO_Date'=> $GoDate,
            'sarok'=>$validated['sarok'],
            'status'=>'now',
            'situation'=>'present',
            'status2'=>'open'

        ]);
        return redirect('profile')->withSuccess('Updated');
    }
    public function distbefore(){
        $draft2  = workingbefore::where('userid',Auth::user()->userid)
        ->get();
        return view('User.workbefore',compact('draft2'));
    }
     public function release11(Request $request){
       
         $validated=$request->validate([
             'go_date'=>'required|date_format:d-m-Y',
             'sarok'=>'required|string',
         ]);
         $Date11 = Carbon::createFromFormat('d-m-Y', $validated['go_date'])->format('Y-m-d');
       $gg=workingnow::where('userid',Auth::user()->userid)->first();
       if($gg && $gg->status2 == 'open'){ 
       release111::create([
            'userid'=>Auth::user()->userid,
            'Go_date'=>$Date11,
            'sarok'=>$validated['sarok']
        ]);
       workingnow::where('userid',Auth::user()->userid)->update([
            'status2'=>'closed',
            
            
            
      ]);
      
 

       
      workingbefore::create([
        'userid' => Auth::user()->userid,
        'district'=>$gg->district,
        'designation'=>$gg->designation,
        'mobile'=>$gg->mobile,
        'status'=>'kk',
        'situation'=>'before',
        'start'=>$gg->start,
        'end'=>$Date11,
        'status2'=>'unlocked',
        'GO_Date'=>$gg->GO_Date,
        'sarok'=>$gg->sarok,
        'office'=>$gg->office,
        'GO_Date2'=>$Date11,
        'sarok2'=>$validated['sarok']
      ]);
  
      return redirect('profile')->withSuccess('Now you can edit your information of Present Working') ;
       } 
    } 
    public function releasefromcurrent(){
        return view('User.release');
    }
      public function child11(Request $request){
        $validated= $request->validate([
             
            'name' => 'required|string|max:255',
            'age' => 'required|string',
            'educationtype' => 'nullable|string|max:255',
            'educationlocation' => 'required|string|max:255',
            'educationname' => 'nullable|string|max:255',
        ]);
            childinfo::create([
                'userid'=>Auth::user()->userid,
                'name'=>$validated['name'],
                'age'=>$validated['age'],
                'educationtype'=>$validated['educationtype'],
                'educationlocation'=>$validated['educationlocation'],
                'educationname'=>$validated['educationname'],
            ]);
            return redirect('child12')->withSuccess('updated');
         


         
        }
    public function married(Request $request){
        $validated = $request->validate([
            'marital_status' => 'required|string'
        ]);
        personalinfo::where('userid', Auth::user()->userid)->update([
            'marital_status' => trim($validated['marital_status'])
        ]);
        return redirect('profile')->withSuccess('Updated');
    }
    public function jobinfo(){
        $draft = personalinfo::where('userid',Auth::user()->userid)->get();

  
    return view('User.user', compact('draft'));
         
    }
     public function section7(){
        if(Auth::check()){
            $count_user1 = DB::table('users')->where('role', 'user')->count();
            $count_user2 = DB::table('users')->where('role', 'verified1')->count();
            $count_accept = DB::table('users')->where('role', 'userone')->count();
            $user_number=$count_user1+$count_user2;
             
            return view('SR.dashboard',compact('count_accept','user_number' ));
           
 
           
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
            'code' => 999,
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
    public function contactinfo11(Request $request){

         $validated=$request->validate([
          'dob'=>'date|required',
          'name'=>'string|required|max:60',
          'mobile'=>'string|required|max:20',
          'marital_status'=>'string|required|max:15',
          'home_district'=>'string|required|max:25'
         ]);

        $StartDate = Carbon::createFromFormat('d-m-Y', $validated['dob'])->format('Y-m-d');
     
         User::where('userid',Auth::user()->userid)
            ->update([
                'name'=>$validated['name'],
                
                'mobile'=>$validated['mobile'],
                
            ]);
           personalinfo::where('userid',Auth::user()->userid)
            ->update([
                'name'=>$validated['name'],
                
                'mobile'=>$validated['mobile'],
                'home_district'=>$validated['home_district'],
                'marital_status'=>$validated['marital_status'],
                'dob'=>$StartDate
            ]);

       return redirect('profile')->withSuccess('Updated Personal Info Successfully');
       
       
  }
  public function reason111(Request $request){
    $validated = $request->validate([
        'reason' => 'required|string',
        'five' => 'required|string',
    ]);
           preferred111::where('userid',Auth::user()->userid)->update([
            'reason'=>$validated['reason'],
            'district'=>$validated['five'],
           ]);


           return redirect('profile')->withSuccess('Updated Successfully Transfer request');
  }
  public function profile(Request $request){
        $job_related_info=personalinfo::where('userid',Auth::user()->userid)->first();
        
        $wife=wifeinfo::where('userid',Auth::user()->userid)->get();
        $child11=childinfo::where('userid',Auth::user()->userid)->get();
        $working_present=workingnow::where('userid',Auth::user()->userid)
                     ->get();
        $working_before=workingbefore::where('userid',Auth::user()->userid)
                     ->get();  
         $transfer=preferred111::where('userid',Auth::user()->userid)->get();
        // $contact11=                   
    return view('User.profile',compact('job_related_info', 'wife','child11','working_present','working_before','transfer'));
  }
    public function contactinfo(Request $request){
          $home=personalinfo::where('userid', Auth::user()->userid)
          ->first();
          $name=Auth::user()->name;
          $email=Auth::user()->email;
          $mobile=Auth::user()->mobile; 

        
        return view('User.contactinfo',compact('name','email','mobile','home'));
         
    }
    public function transferme(){
        return view('User.transfer');
      
         }
    public function workplace(){
        $draft = DB::table('codetable')
        ->select('*')
        ->where('status','economy')
        ->get();
        $draft2  = workingbefore::where('userid',Auth::user()->userid)
        ->get();
      
    return view('User.workplace', compact('draft','draft2'));
    }
    
    public function editme(Request $request){
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
    public function delete111(Request $request){
        $id=decrypt($request->id);
        childinfo::where('id',$id)->delete();
        toastr('Successfully deleted   ');
        return redirect('child12');
    } 
    public function delete112(Request $request){
        $id=decrypt($request->id);
        workingbefore::where('id',$id)->delete();
        toastr('Successfully deleted   ');
        return redirect('distbefore');
    }
     
    public function spouse(){
         
        $draft = DB::table('codetable')
        ->select('*')
        ->where('status','economy')
        ->get();
        $draft2  = childinfo::where('userid',Auth::user()->userid)->get();
         
         
        $draft3=wifeinfo::where('userid',Auth::user()->userid)->get();
    return view('User.spouse', compact('draft','draft2','draft3'));
     
        
        
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
            try { 
                // Attempt to send the mail
                 Mail::to($user_mail->email)->send(new userinfo($request->id));
                // Show success toastr notification
               toastr()->success('Successfully sent mail');
           } catch (\Exception $e) {
                // Handle failure and show error toastr notification
               // toastr()->error('Mail Sent Error: ' . $e->getMessage());
            }
      
        
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
    public function all_info(){
        $personal = personalinfo::where('userid',Auth::user()->userid)->get();
        $wife= wifeinfo::where('userid', Auth::user()->userid)->get();  
        $child11= childinfo::where('userid',Auth::user()->userid)->get();  
        $office_now=workingnow::where('userid',Auth::user()->userid)->get();  
        $office_before=workingbefore::where('userid',Auth::user()->userid)->get(); 
        $transfer=preferred111::where('userid',Auth::user()->userid)->get(); 
        $html = View::make('PDF.all', [
            'personal' => $personal,
           'wife' => $wife,
           'child11'=>$child11,
           'office_now'=>$office_now,
            'office_before'=>$office_before,
            'transfer'=>$transfer,
          //  'working_before' => $working_before
        ])->render();
        
    $mpdf = new Mpdf([
        'format' => 'A4', // Letter page size
        'orientation' => 'P', // Landscape orientation
        'default_font' => 'nikosh', // বাংলা ফন্ট সাপোর্ট
        'default_font_size'=>'10',
        'margin_left' => 2.54,  // 0.1 inch = 2.54 mm
            'margin_right' => 2.54,
    ]);
    $mpdf->WriteHTML($html);
    return $mpdf->Output('posts.pdf', 'I');

 
    }
    public function newdash(){
      //  $connectedUsers = \DB::table('sessions')->count();

        return view('DR.newdashboard');
    }
    public function usermanagement(){
        $users = User::all(); 
    return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $deleteUrl = route('userdelete11', $user->userid);
            $changePasswordUrl = route('userchangepassword11', $user->userid);
            $changeEmailUrl = route('userchangeemail11', $user->userid);
            $userpdf = route('userpdf111', $user->userid);

            return '
            <button class="btn btn-sm btn-danger delete-user" data-id="' . $user->userid . '" data-url="' . $deleteUrl . '">Delete</button>
            <button class="btn btn-sm btn-warning change-password" data-id="' . $user->userid . '" data-url="' . $changePasswordUrl . '">Change Password</button>
            <button class="btn btn-sm btn-info change-email" data-id="' . $user->userid . '" data-url="' . $changeEmailUrl . '">Change Email</button>
    <button class="btn btn-sm btn-info view-pdf" data-id="' . $user->userid . '" data-url="' . route('userpdf111', $user->userid) . '">View PDF</button>        ';
        })
         
        ->rawColumns(['name','serviceid','action']) // Ensure HTML is rendered
        ->make(true);
    }
    public function userdelete11(Request $request, $userId)
    {
        try {
            $user = User::where('userid', $userId)->firstOrFail();
            $user->delete();
            $user = personalinfo::where('userid', $userId)->firstOrFail();
            $user->delete();
            $user = wifeinfo::where('userid', $userId)->firstOrFail();
            $user->delete();
            $user = workingnow::where('userid', $userId)->firstOrFail();
            $user->delete();
            $user = childinfo::where('userid', $userId)->delete();
            $user = workingbefore::where('userid', $userId)->delete();
            $user = preferred11::where('userid', $userId)->firstOrFail();
            $user->delete();
            info11::create([
                'name'=>Auth::user()->name,
                'email'=>Auth::user()->email,
                'userid'=>Auth::user()->userid,
                'type'=>'Admin',
                'action'=>'User Delete',
                'status'=>'ok'
            ]);
            return response()->json(['success' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Return the exception message
        }
    }
    public function userchangepassword11(Request $request, $userId){
        $user = User::where('userid', $userId)->firstOrFail();
        $user->password = Hash::make($request->password); // Ensure password is hashed
        $user->save();
        info11::create([
            'name'=>Auth::user()->name,
            'email'=>Auth::user()->email,
            'userid'=>Auth::user()->userid,
            'type'=>'Admin',
            'action'=>'Password Change',
            'status'=>'ok'
        ]);
        return response()->json(['success' => 'Password changed successfully.']);
    }
    public function userchangeemail11(Request $request,$userId){
        $user = User::where('userid', $userId)->firstOrFail();
        $user->email = $request->email; // Ensure password is hashed
        $user->save();
        $user = personalinfo::where('userid', $userId)->firstOrFail();
        $user->email = $request->email; // Ensure password is hashed
        $user->save();
        info11::create([
            'name'=>Auth::user()->name,
            'email'=>Auth::user()->email,
            'userid'=>Auth::user()->userid,
            'type'=>'Admin',
            'action'=>'Email Change',
            'status'=>'ok'
        ]);
        return response()->json(['success' => 'Email changed successfully.']);
   
    }
    public function userpdf111(Request $request,$userId){
        $personal = personalinfo::where('userid',$userId)->get();
        $wife= wifeinfo::where('userid', $userId)->get();  
        $child11= childinfo::where('userid',$userId)->get();  
        $office_now=workingnow::where('userid',$userId)->get();  
        $office_before=workingbefore::where('userid',$userId)->get(); 
        $transfer=preferred111::where('userid',$userId)->get(); 
        $html = View::make('PDF.all', [
            'personal' => $personal,
           'wife' => $wife,
           'child11'=>$child11,
           'office_now'=>$office_now,
            'office_before'=>$office_before,
            'transfer'=>$transfer,
          //  'working_before' => $working_before
        ])->render();
        
    $mpdf = new Mpdf([
        'format' => 'A4', // Letter page size
        'orientation' => 'P', // Landscape orientation
        'default_font' => 'nikosh', // বাংলা ফন্ট সাপোর্ট
        'default_font_size'=>'10',
        'margin_left' => 2.54,  // 0.1 inch = 2.54 mm
            'margin_right' => 2.54,
    ]);
    $mpdf->WriteHTML($html);
    return response()->streamDownload(
        fn() => $mpdf->Output(),
        "User_Report_$userId.pdf"
    );

    }
    public function dash2()
    {   
        if(Auth::check()){
            
               return view('DR.dash2');
               
                        }
        
        
         
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function result123(){
         
    // Execute the query
    $results = DB::table('personalinfo as p')
        ->join('childinfo as c', 'p.userid', '=', 'c.userid')
        ->join('preferred_five_districts as prf', 'p.userid', '=', 'prf.userid')
        ->join('release_details as rls', 'p.userid', '=', 'rls.userid')
        ->join('wifeinfo as w', 'p.userid', '=', 'w.userid')
        ->join('working_history_officer as whf_current', 'p.userid', '=', 'whf_current.userid')
        ->join('working_history_officer as whf_before', 'p.userid', '=', 'whf_before.userid')
        ->where('whf_current.situation', 'present')
        ->where('whf_before.situation', 'before')
        ->orderBy('whf_current.start')
        ->orderBy('whf_current.designation')
        ->orderBy('whf_current.district')
        ->select(
            'p.id as id',
            'p.name',
            'p.home_district',
            'p.serviceid',
            'p.gradation',
            'p.marital_status',
            'whf_current.district as current_district',
            'whf_current.designation as current_designation',
            'whf_current.office as current_office',
            'whf_current.start as current_start',
            'whf_before.district as before_district',
            'w.wifename as wife_name',
            'w.profession as wife_profession',
            'w.designation as wife_designation',
            'w.wifeworkplace',
            'w.wifehomedistrict',
            'c.name as child_name',
            'c.age as child_age',
            'c.educationtype as child_educationtype',
            'c.educationlocation as child_educationlocation',
            'prf.district as preferred_district',
            'prf.reason as preferred_reason'
        )
        ->get();

    // Dump the results and stop execution
    dd($results);
    $carbonDiff = $carbonNow->diff(Carbon::parse($$results->current_start));

    // Format the difference as "X years, Y months, Z days"
    $carbonDiffFormatted = $carbonDiff->y . ' years, ' . $carbonDiff->m . ' months, ' . $carbonDiff->d . ' days';
    dd($carbonDiffFormatted);
   
}
public  function get2data(){

    $converter = new ConverterController();

       
    $data = [];
   
   $results=workingnow::all();
    foreach ($results as $user) {
        
        $carbonNow = Carbon::now();

         $carbonDiff = $carbonNow->diff(Carbon::parse($user->start));

         $carbonDiffFormatted = $converter->en2bn($carbonDiff->y) . ' বছর , ' . $converter->en2bn($carbonDiff->m) . ' মাস , ' . $converter->en2bn($carbonDiff->d) . ' দিন';
         
        // Combine user details into the first column
        $user11=personalinfo::where('userid',$user->userid)->first();
       
        $username='<div>  ' .$user11->name . '</div>';
        $userhomedistrict='<div>  ' .$user11->home_district . '</div>';
        $userserviceid='<div>  ' .$converter->en2bn($user11->serviceid) . '</div>';
                 
        $Gradation = '
            <div> ' . $converter->en2bn($user11->gradation). '</div>';
        
            

        $userdesignation = ' <div>    ' . $user->designation. '</div>';
        $userworkdistrict ='<div>  ' . $user->district. '</div>';
        $useroffice='<div>  ' . $user->office.'</div>';


            $Join_office = '
            <div>  ' . $converter->en2bn(Carbon::parse($user->start)->format('d-m-y')) . '</div>';
              $user12=wifeinfo::where('userid',$user->userid)->first();
            
            
            
              $usermaritalstatus='<div>   ' . $user11->marital_status.'</div>';
              $userwifename='<div>   ' . $user12->wifename.'</div>';
              $userwifeprofession='<div>  ' . $user12->profession.'</div>';
              $userwifedesignation='<div>   ' . $user12->designation.'</div>';
              $userwifeworkplace='<div>   ' . $user12->wifeworkplace.'</div>';
              $userwifehomeplace='<div>  ' . $user12->wifehomedistrict.'</div>';

                 $Child_info = '<div><b>১৫.সন্তানাদি:</b></div>
            <table class="table">
                <thead>
                    <tr>
                        <th>নাম</th>
                        <th>বয়স</th>
                        <th>ধরন</th>
                        <th>জেলা</th>
                    </tr>
                </thead>
                <tbody>';
                
                $info11=childinfo::where('userid',$user->userid)->get();
            foreach ($info11  as $child) {
                $Child_info .= "
                    <tr>
                        <td>{$child->name}</td>
                        <td>{$child->age}</td>
                        <td>{$child->educationtype}</td>
                        <td>{$child->educationlocation}</td>
                    </tr>";
            }
        
            $Child_info .= '</tbody></table>';
          //  $ddd = implode(',', $user->before_district ?? []);
          $info12=workingbefore::where('userid',$user->userid)->get();
                     $before13='';
              foreach($info12 as $before12)
                              {
                                $before13=$before12->district.','.$before13;
                              }
           $PreviousDist = '<div><b>১৬.অফিসারের পূর্বের কর্মস্থল (জেলা):</b> ' . $before13 . '</div></div>
            <div><b>১৭. পছন্দকৃত জেলা  :</b> ' . $user->preferred_district . '</div>
            <div><b>১৮. কেন বদলি চান :</b> ' . $user->preferred_reason . '</div>';
         $Last='
            <div><b>১৯. মেয়াদ (বর্তমান কর্মস্থল )    :</b> ' . $carbonDiffFormatted. '</div>';
        // Add combined details and formatted carbon diff into the data array


//   $Designation  $Working_district  $Working_office   $Join_office   $Marriage $Last  $Child_info  $PreviousDist
 

        $data[] = [
            'id'=>$user->id,
            'username' => $username,
            'userhomedistrict'=>$userhomedistrict,
            'userserviceid'=>$userserviceid,
            'gradation'=>$Gradation ,
            
            'userdesignation'=>$userdesignation,
            'userworkdistrict'=>$userworkdistrict,
            'useroffice'=>$useroffice,
            
            'join_date'=>$Join_office,
             'usermaritalstatus'=>$usermaritalstatus,
            'userwifename'=>$userwifename,
            'userwifeprofession'=>$userwifeprofession,
             'userwifedesignation'=>$userwifedesignation,
             'userwifeworkplace'=>$userwifeworkplace,
             'userwifehomeplace'=>$userwifehomeplace,

            'last'=>$Last,
            'child_info'=>$Child_info,
            'previous'=>$PreviousDist,
            

            //'carbon_diff' => $carbonDiffFormatted,  // Display formatted carbon diff
            //'action' => '<button class="btn btn-sm btn-info">Details</button>',
        ];
    }

    return DataTables::of($data)
         
        ->rawColumns(['username','userhomedistrict','userserviceid', 'gradation','userdesignation','userworkdistrict','useroffice','join_date',
        
        'usermaritalstatus','userwifename','userwifeprofession','userwifedesignation','userwifeworkplace','userwifehomeplace','last','child_info','previous',]) // Allow HTML rendering
        ->make(true);







}
public function getData3(){
    return view('DR.usermanagement');
}
    public function getData()
    {  
        
        $converter = new ConverterController();

        // Call the en2bn method
       // $bengaliNumber = $converter->en2bn(12345);
    /*
        $results = DB::table('personalinfo as p')
        ->join('childinfo as c', 'p.userid', '=', 'c.userid')
        ->join('preferred_five_districts as prf', 'p.userid', '=', 'prf.userid')
        ->join('release_details as rls', 'p.userid', '=', 'rls.userid')
        ->join('wifeinfo as w', 'p.userid', '=', 'w.userid')
        ->join('working_history_officer as whf_current', 'p.userid', '=', 'whf_current.userid')
        ->join('working_history_officer as whf_before', 'p.userid', '=', 'whf_before.userid')
        ->where('whf_current.situation','present')
        ->where('whf_before.situation','before')
         
         ->distinct()
        ->select(
            'p.userid as userid11',
            'p.id as id',
            'p.name',
        'p.home_district',
        'p.serviceid',
        'p.gradation',
        'p.marital_status',
        'whf_current.district as current_district',
        'whf_current.designation as current_designation',
        'whf_current.office as current_office',
        'whf_current.start as current_start',
        'whf_before.district as before_district',
        'w.wifename as wife_name',
        'w.profession as wife_profession',
        'w.designation as wife_designation',
        'w.wifeworkplace',
        'w.wifehomedistrict',
        'c.name as child_name',
        'c.age as child_age',
        'c.educationtype as child_educationtype',
        'c.educationlocation as child_educationlocation',
        'prf.district as preferred_district',
        'prf.reason as preferred_reason'
        )
        ->get();
             */     
        $data = [];
       // $results = $results->unique('userid11');
       $results=workingnow::all();
        foreach ($results as $user) {
            // Carbon instance for current date
            $carbonNow = Carbon::now();

            // Calculate the difference between the current date and the created_at date
            $carbonDiff = $carbonNow->diff(Carbon::parse($user->start));

            // Format the difference as "X years, Y months, Z days"
            $carbonDiffFormatted = $converter->en2bn($carbonDiff->y) . ' বছর , ' . $converter->en2bn($carbonDiff->m) . ' মাস , ' . $converter->en2bn($carbonDiff->d) . ' দিন';
             
            // Combine user details into the first column
            $user11=personalinfo::where('userid',$user->userid)->first();

            $userDetails = '
                <div><b>১.নাম:</b> ' .$user11->name . '</div>
                <div><b>২.নিজ জেলা :</b> ' .$user11->home_district . '</div>
                <div><b>৩.সার্ভিস আইডি :</b> ' .$converter->en2bn($user11->serviceid) . '</div>';
           
             
            $Gradation = '
                <div><b>৪.গ্রেডেশন:</b> ' . $converter->en2bn($user11->gradation). '</div>';
                
                $working_present = ' <div><b>৫.পদবী:</b>   ' . $user->designation. '</div>
               <div><b> ৬. বর্তমান কর্মস্থল(জেলা)   :</b> ' . $user->district. '</div><div><b>
                ৭. আদালত/ প্রতিষ্ঠান    :</b>  ' . $user->office.'</div>';

 
                $Join_office = '
                <div><b>৮. যোগদানের তারিখ (বর্তমান কর্মস্থল )    :</b> ' . $converter->en2bn(Carbon::parse($user->start)->format('d-m-y')) . '</div>';
                  $user12=wifeinfo::where('userid',$user->userid)->first();
                $Marriage = '
                <div><b>৯.বৈবাহিক অবস্থা :</b> ' . $user11->marital_status . '</div>
                <div><b>১০.স্বামী/ স্ত্রীর নাম  :</b> ' . $user12->wifename . '</div>
                <div><b>১১.পেশা:</b> ' . $user12->profession . '</div>
                <div><b>১২.পদবী:</b> ' . $user12->designation . '</div>
                <div><b>১৩.কর্মস্থল(জেলা) :</b> ' . $user12->wifeworkplace. '</div>
                <div><b>১৪. নিজ জেলা ( স্বামী /স্ত্রী )  :</b> ' . $user12->wifehomedistrict . '</div>';
                $Child_info = '<div><b>১৫.সন্তানাদি:</b></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>নাম ও বয়স</th>
                             
                            <th>শ্রেণি</th>
                            <th>জেলা</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
                    $info11=childinfo::where('userid',$user->userid)->get();
                foreach ($info11  as $child) {
                    $Child_info .= "
                        <tr>
                            <td>{$child->name}({$child->age})</td>
                            
                            <td>{$child->educationtype}</td>
                            <td>{$child->educationlocation}</td>
                        </tr>";
                }
            
                $Child_info .= '</tbody></table>';
              //  $ddd = implode(',', $user->before_district ?? []);
              $info12=workingbefore::where('userid',$user->userid)->get();
                         $before13='';
                  foreach($info12 as $before12)
                                  {
                                    $before13=$before12->district.','.$before13;
                                  }
                            $prf_district=preferred111::where('userid',$user->userid)->first();
               $PreviousDist = '<div><b>১৬.অফিসারের পূর্বের কর্মস্থল (জেলা):</b> ' . $before13 . '</div></div>
                <div><b>১৭. পছন্দকৃত জেলা  :</b> ' .$prf_district->district . '</div>
                <div><b>১৮. কেন বদলি চান :</b> ' .$prf_district->reason . '</div> 
                  <div><b>১৯. মেয়াদ (বর্তমান কর্মস্থল )    :</b> ' . $carbonDiffFormatted. '</div>';
             
                
            // Add combined details and formatted carbon diff into the data array


//   $Designation  $Working_district  $Working_office   $Join_office   $Marriage $Last  $Child_info  $PreviousDist
        
            $data[] = [
                'id'=>$user->id,
                'user_details' => $userDetails,
                'gradation'=>$Gradation ,
                
                'working_present'=>$working_present,
                
                'join_date'=>$Join_office,
                'marriage'=>$Marriage,
                 
                'child_info'=>$Child_info,
                'previous'=>$PreviousDist,
                

                //'carbon_diff' => $carbonDiffFormatted,  // Display formatted carbon diff
                //'action' => '<button class="btn btn-sm btn-info">Details</button>',
            ];
        }

        return DataTables::of($data)
            
            ->rawColumns(['user_details','gradation','working_present', 'join_date','marriage', 'child_info','previous',]) // Allow HTML rendering
            ->make(true);
    }
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
