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
            'code1' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);
        DB::table('codetable')->insert([
            'code' => $validated['code1'],
            'name' => $validated['name'],
             
             
             
        ]);

        $draft = DB::table('codetable')
        ->select('*')
        ->get();

    return view('SR.code11', compact('draft'));
        
    }
    public function userbudgetdel(Request $request){
        DB::table('user_budget')
        ->where('status','=','pending')
        ->where('applicationid','=',decrypt($request->id))
        ->delete();
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('Designation','=',Auth::user()->Designation)
        ->where('District','=',Auth::user()->District)
        ->paginate();

    return view('User.userdraft', compact('draftdata'));
    }
    public function budgetstatus(Request $request){
        DB::table('user_budget')
        ->where('status','=','pending')
        ->where('applicationid','=',$request->id)
        ->update(['status' => "Forwarded"]);

         $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('Designation','=',Auth::user()->Designation)
        ->where('District','=',Auth::user()->District)
        ->paginate();

    return view('User.userdraft', compact('draftdata'));
    }
    public function budgetform(Request $request){
        $validated = $request->validate([
            'code11' => 'required|string|max:255',
            'financial2324' => 'required|string|max:255',
            'allotment' => 'required|integer|min:1|max:9223372036854775807', // For signed BIGINT

            'financial2425' => 'required|string|max:255',
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
            'opinion'=>$validated['opinion'],
            'financial2425'=>$validated['financial2425'],
            'applicationid'=>Auth::user()->mobile.$lastId,

             
             
             
        ]);

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
    public function verifychange(){
        return view('DR.user');
    }
    public function userdraftbudget(){
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('Designation','=',Auth::user()->Designation)
        ->where('District','=',Auth::user()->District)
        ->paginate();

    return view('User.userdraft', compact('draftdata'));
        
        
                             }
     public function draftdetails(Request $request){
         $colname=$request->colname;
         $changed=$request->changed;
         $heading=$request->colheading;
         $bortoman=$request->bortoman;

         DB::table('activityedit')->insert([
            'district' => Auth::user()->District,
            'mobile' => Auth::user()->mobile,
            'status'=>'Draft',
            'colname'=>$colname,
            'after'=>$changed,
            'time'=>date("Y-m-d H:i:s", strtotime('now')),
            'nid'=>session('NID'),
            'trname'=>session('tabledr'),
            'heading'=>$heading,
            'bortoman'=>$bortoman,
        ]);
        $last = DB::table('activityedit')->latest('id','desc')->first();

        DB::table('action')->insert([
            'district' => Auth::user()->District,
            'mobile' => Auth::user()->mobile,
            'status'=> "Draft",
             'time'=>date("Y-m-d H:i:s", strtotime('now')),
            'action'=>"Edit",
            'id_user'=>$last->id,
            'id_admin'=>"New",
             
             
        ]);

        $nametable = (new ConverterController)->name2table(Auth::user()->District);
        //$person=DB::table($nametable)
              //  ->paginate(20);
        
        session(['tabledr' =>$nametable]);
        session(['districtdr' =>Auth::user()->District]);
        //return view('DR.okchange',compact('person'));
        return redirect("dataone");
     }




    public function changeme(Request $request){
           
        $kk=decrypt($request->id);
        $id2=$request->id2;
         
        $person=DB::table(session('tabledr'))
                ->select($kk)
                ->where('NID','=',session('NID'))
                ->get();
          
        
        return view('DR.changeme', compact('person','kk','id2'));
    }

     public function editchange($id){
        $nametable = (new ConverterController)->name2table(Auth::user()->District);
        $person=DB::table($nametable)
                ->select('*')
                ->where('NID','=',decrypt($id))
                ->get();
         
         session(['NID' =>decrypt($id)]);
     
         return view('DR.editchange',compact('person'));
        
     }
     public function deleteme($id){
         
        DB::table('activityedit')
                ->where('id','=',decrypt($id))
                ->delete();
        $draftdata=DB::table('activityedit')
                ->select('*')
                ->where('status','=','Draft')
                ->where('district','=',Auth::user()->District)
                ->paginate(20);

        return view('DR.dataone',compact('draftdata'));
     }
     public function finalchange(){
        DB::table('activityedit')
        ->where('status','=','Draft')
        ->where('district','=',Auth::user()->District)
        ->update(['status' => "Forwarded"]);
    $draftdata=DB::table('activityedit')
        ->select('*')
        ->where('status','=','Draft')
        ->where('district','=',Auth::user()->District)
        ->paginate(20);
       
        $test=DB::table('activityedit')
        ->select('*')
        ->where('status','=','Forwarded')
        ->where('district','=',Auth::user()->District)
        ->get();
        foreach($test as $test3){
        DB::table('action')->insert([
            'district' => Auth::user()->District,
            'mobile' => Auth::user()->mobile,
            'status'=> "Forwarded",
             'time'=>date("Y-m-d H:i:s", strtotime('now')),
            'action'=>"তথ্য সংশোধন (ফিল্ডঃ-".$test3->heading.","."তথ্য-".$test3->after.")",
            'id_user'=>$test3->id,
            'id_admin'=> $test3->id,
             
             
        ]);
    }
    return view('DR.dataone',compact('draftdata'));

     }
     public function dataone(){
               $draftdata=DB::table('activityedit')
                        ->select('*')
                        ->where('status','=','Draft')
                        ->where('district','=',Auth::user()->District)
                        ->paginate(20);

                return view('DR.dataone',compact('draftdata'));
     }
     
     public function okchange(){
        $nametable = (new ConverterController)->name2table(Auth::user()->District);
        $person=DB::table($nametable)
                 ->orderBy('Union_Ward', 'asc')

                ->paginate(20);
        $upojela=DB::table($nametable)
                ->select('Thana')
                ->where('District','=',Auth::user()->District)
                ->where('Pourosova_City_Corporation','=',NULL)
                ->distinct()
                ->get();


        $pourosova=DB::table($nametable)
                ->select('Pourosova_City_Corporation')
                ->where('District','=',Auth::user()->District)
                ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                ->distinct()
                ->get();

        $citycorporation=DB::table($nametable)
                            ->select('Pourosova_City_Corporation')
                            ->where('District','=',Auth::user()->District)
                            ->where('Pourosova_City_Corporation','regexp','কর্পোরেশন')
                            ->distinct()
                            ->get();
        
        session(['tabledr' =>$nametable]);
        session(['districtdr' =>Auth::user()->District]);
        return view('DR.okchange',compact('person','upojela','pourosova','citycorporation'));
       
        
     }

    public function thanakoi(Request $request){
        $nametable = (new ConverterController)->name2table(Auth::user()->District);

      if($request->category=='upojela'){
         $person=DB::table($nametable)
                ->select('*')
                ->where('District','=',Auth::user()->District)
                ->where('Thana','=',$request->sector)
                ->orderBy('Union_Ward', 'asc')

                ->paginate(100);
      }
      else if($request->category=='pourosova'){
        $person=DB::table($nametable)
        ->select('*')
        ->where('District','=',Auth::user()->District)
        ->where('Pourosova_City_Corporation','=',$request->sector)
        ->orderBy('Union_Ward', 'asc')
        ->paginate(100);
      }
      else if($request->category=='citycorporation'){
        $person=DB::table($nametable)
                ->select('*')
                ->where('District','=',Auth::user()->District)
                ->where('Pourosova_City_Corporation','=',$request->sector)
                ->orderBy('Union_Ward', 'asc')

                ->paginate(100);
      }
      $upojela=DB::table($nametable)
      ->select('Thana')
      ->where('District','=',Auth::user()->District)
      ->where('Pourosova_City_Corporation','=',NULL)
      ->distinct()
      ->get();


$pourosova=DB::table($nametable)
      ->select('Pourosova_City_Corporation')
      ->where('District','=',Auth::user()->District)
      ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
      ->distinct()
      ->get();

$citycorporation=DB::table($nametable)
                  ->select('Pourosova_City_Corporation')
                  ->where('District','=',Auth::user()->District)
                  ->where('Pourosova_City_Corporation','regexp','কর্পোরেশন')
                  ->distinct()
                  ->get();

                  return view('DR.okchange',compact('person','upojela','pourosova','citycorporation'));

    }
     public function picturekazi($id){

$path = public_path('upload/kazi/picture/');

       
    session(['NID' =>decrypt($id)]);

    return view('DR.picturekazi');

     }
     public function profile(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        //$imageName = time().'.'.$request->image->extension();  
     
 

          if ($request->hasFile('avatar')){
              $avatar=$request->file('avatar');
              $filename=time().'.'.$avatar->getClientOriginalExtension();
              Image::make($avatar)->resize(300,300)->save(public_path('/upload/DR/'.$filename));
              $user=Auth::user();
              $user->avatar=$filename;
              $user->save();
          }
          return view('DR.dashboard');
     }
      
     public function profilesr(Request $request){

        if ($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/upload/DR/'.$filename));
            $user=Auth::user();
            $user->avatar=$filename;
            $user->save();
        }
        return view('SR.dashboard');
   }

   public function changepicture(Request $request){
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100',
    ]);
    $fft=DB::table(session('tabledr'))
          ->where('NID','=',session('NID'))
          ->first();
    $imageName = 'kazipic'.session('NID').'.'.$request->avatar->extension();  
    $request->avatar->move(public_path('upload/kazi/picture/'), $imageName);
    DB::table('kazipicture')->insert([
        'district' => Auth::user()->District,
        'nid'=>session('NID'),
        'picture'=>$imageName,
        'father'=>$fft->Father,
        'mother'=>$fft->Mother,
        'name'=>$fft->Name,
    ]);
        return redirect("showkazi");

   }
   public function showkazi(){
       
           $draftdata=DB::table('kazipicture')
           ->select('*')
            ->where('district','=',Auth::user()->District)
           ->paginate(20);

   return view('DR.showkazi',compact('draftdata'));

   }
   public function  changepicturekazi($id){
    session(['NID' =>decrypt($id)]);

    return view('DR.changepicturekazi');


   }
      public function delchange($id){
       
        session(['NID' =>decrypt($id)]);

       return view('DR.statusdel');
      }

   public function statusdel(Request $request){

    $request->validate([
        'avatar' => 'required|mimes:pdf|max:1024',
    ]);
    $imageName = "dl".time().session('NID').'.'.$request->avatar->extension();  
$request->avatar->move(public_path('upload/kazi/papers/'), $imageName);
     

    DB::table('activitydel')->insert([
       'district' => Auth::user()->District,
       'mobile' => Auth::user()->mobile,
       'status'=>'Draft',
        'time'=>date("Y-m-d H:i:s", strtotime('now')),
       'nid'=>session('NID'),
       'trname'=>session('tabledr'),
       'avatar'=>$imageName,
        
   ]);
   $last = DB::table('activitydel')->latest('id','desc')->first();
    
   DB::table('action')->insert([
    'district' => Auth::user()->District,
    'mobile' => Auth::user()->mobile,
    'status'=> "Draft",
     'time'=>date("Y-m-d H:i:s", strtotime('now')),
    'action'=>"Delete",
    'id_user'=>$last->id,
    'id_admin'=> "New",
     
     
]);
   
   
   
   
   return redirect("deldashboard");

   }
   
   public function deldashboard(){
    $draftdata=DB::table('activitydel')
               ->where('status','=','Draft')
               ->paginate(20);
          return view('DR.deldashboard',compact('draftdata'));


   }
   public function deliddr($id){
    DB::table('activitydel')
    ->where('id','=',decrypt($id))
    ->delete();

    $draftdata=DB::table('activitydel')
               ->where('status','=','Draft')
               ->paginate(20);
          return view('DR.deldashboard',compact('draftdata'));
   }
   public function addlcharge($id){
               session(['NID' =>decrypt($id)]);
               $draftdata=DB::table(session('tabledr'))
               ->select('*')
               ->where('NID','=',decrypt($id))
               ->get();


               return view('DR.addlcharge',compact('draftdata'));


   }
   public function delsend($id){
    DB::table('activitydel')
    ->where('id','=',decrypt($id))
    ->update(['status' => 'Forwarded' ]);
    $kkt= DB::table('activitydel')
        ->where('id','=',decrypt($id))
        ->first();
    
    DB::table('action')->insert([
     'district' => Auth::user()->District,
     'mobile' => Auth::user()->mobile,
     'status'=> "Forwarded",
      'time'=>date("Y-m-d H:i:s", strtotime('now')),
     'action'=>"তথ্য মুছা ফেলুন (".$kkt->nid.")",
     'id_user'=>decrypt($id),
     'id_admin'=> decrypt($id),
      
      
 ]);
    $draftdata=DB::table('activitydel')
    ->where('status','=','Draft')
    ->paginate(20);
return view('DR.deldashboard',compact('draftdata'));

   }
   
   public function updatepicturekazi(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100',
        ]);

        $draftdata=DB::table('kazipicture')
        ->select('picture')
        ->where('nid','=',session('NID'))
        ->first();
          
       unlink("upload/kazi/picture/".$draftdata->picture);
 

$imageName = 'kazipic'.session('NID').'.'.$request->avatar->extension();  
$request->avatar->move(public_path('upload/kazi/picture/'), $imageName);
            DB::table('kazipicture')
                ->where('nid','=',session('NID'))
                ->update(['picture' => $imageName ]);

                return redirect("showkazi");



    }

    public function addlduty(Request $request){
        $request->validate([
            'avatar' => 'required|mimes:pdf|max:1024',
            'charge' => 'required|string',
            'name' =>  'required|string' ,
            'bortoman' => 'required|string' ,
        ]);
        $draftdata=DB::table(session('tabledr'))
        ->select('*')
        ->where('NID','=',session('NID'))
        ->get()->pluck('Name');

        $draftdata2=DB::table(session('tabledr'))
        ->select('*')
        ->where('NID','=',session('NID'))
        ->get()->pluck('Union_Ward');
           
        $imageName = "adlpapers".time().session('NID').'.'.$request->avatar->extension();  
        $request->avatar->move(public_path('upload/kazi/papers/'), $imageName);
             
        
            DB::table('activitycharge')->insert([
               'district' => Auth::user()->District,
               'mobile' => Auth::user()->mobile,
               'status'=>'Draft',
                'time'=>date("Y-m-d H:i:s", strtotime('now')),
               'nid'=>session('NID'),
               'trname'=>session('tabledr'),
               'avatar'=>$imageName,
               'name'=>$request->name,
               'bortoman'=>$request->bortoman,
               'sector'=>$request->charge,
                
           ]);
           $last = DB::table('activitycharge')-> latest('id','desc')->first();
    
   DB::table('action')->insert([
    'district' => Auth::user()->District,
    'mobile' => Auth::user()->mobile,
    'status'=> "Draft",
     'time'=>date("Y-m-d H:i:s", strtotime('now')),
    'action'=>"Additionalcharge",
    'id_user'=>$last->id,
    'id_admin'=> "New",
     
     
]);
           
          return redirect("chargedash");
    }

    public function chargedash(){
              $draftdata=DB::table('activitycharge')
              ->where('status','=','Draft')
              ->paginate(20);

              return view('DR.chargedash',compact('draftdata'));


    }
      
    public function delicharge($id){
        DB::table('activitycharge')
        ->where('id','=',decrypt($id))
        ->delete();
    
        $draftdata=DB::table('activitycharge')
                   ->where('status','=','Draft')
                   ->paginate(20);
              return view('DR.chargedash',compact('draftdata'));

    }

    public function chargesend($id){
        DB::table('activitycharge')
        ->where('id','=',decrypt($id))
        ->update(['status' => 'Forwarded' ]);
        $rrt=DB::table('activitycharge')
        ->where('id','=',decrypt($id))
        ->first();


        DB::table('action')->insert([
         'district' => Auth::user()->District,
         'mobile' => Auth::user()->mobile,
         'status'=> "Forwarded",
          'time'=>date("Y-m-d H:i:s", strtotime('now')),
         'action'=>"অতিরিক্ত দায়িত্ব (".$rrt->name.",".$rrt->sector.")",
         'id_user'=>decrypt($id),
         'id_admin'=> decrypt($id),
          
          
     ]);
        $draftdata=DB::table('activitycharge')
        ->where('status','=','Draft')
        ->paginate(20);
    return view('DR.chargedash',compact('draftdata'));

    }
     public function beforedata(){
        return view('DR.beforedata');
     }
     public function notuninfo(Request $request){
        $request->validate([
            'name' => 'required|string',
            'father' => 'required|string',
            'mother' =>  'required|string' ,
            'area' => 'required|string' ,
            'mobile' => 'required|string',
            'nid' =>  'required|string' ,
            'dob' => 'required|string' ,
            'education' => 'required|string',
            'email' =>  'required|string' ,
            'dategot' => 'required|string' ,
            'datelicense' => 'required|string',
            'statuslicense' =>  'required|string' ,
            'join' => 'required|string' ,
            'indent' => 'required|string' ,
            'gazetdate' => 'required|string',
            'expired' =>  'required|string' ,
            'jobdo' => 'required|string' ,
            'permanent' => 'required|string' ,
            'office' => 'required|string',
            'present' =>  'required|string' ,
            'religion' => 'required|string' ,
            'jobname' => 'required|string' ,
            
        ]);
          DB::table(session('tabledr'))->insert([
            'Union_Ward' => $request->area  ,
            'Thana' => $request->upojela  ,
            'Bivag'=> 'kk'   ,
             'Name'=> $request->name  ,
            'Father'=> $request->father   ,
            'Mother'=>  $request->mother ,
            'DOB'=>  $request->dob ,
            'NID' => $request->nid  ,
            'Education' =>   $request->education,
            'Permanent'=>   $request->permanent ,
             'Present'=>  $request->present ,
            'Office'=>  $request->office  ,
            'Mobile'=>   $request->mobile,
            'Email'=>   $request->email,
            'License_Sarok' =>   $request->dategot,
            'License_Status' =>  $request->statuslicense ,
            'Joining_Date'=>   $request->Q ,
             'Indent_Date'=>  $request->indent ,
            'License_Gazet_Date'=>   $request->gazetdate ,
            'Report_Sent_By'=>   $request->religion,
            'District'=>  "draft",
            'Resign_Date' => $request->expired,
            'Job'=> $request->jobdo,
            'Job_Status'=> $request->jobname,
            'Pourosova_City_Corporation'=> $request->pourosova,
            'License_Achieved_Date'=>$request->datelicense ,
             
        ]);


        DB::table('activitynew')->insert([
            'district' => Auth::user()->District,
            'mobile' => Auth::user()->mobile,
            'status'=> "Draft",
             'time'=>date("Y-m-d H:i:s", strtotime('now')),
            'name'=>$request->name,
            'area'=>$request->area,
            'nid'=>$request->nid,
              'avatar'=>'kkll',
             
        ]);
        
        $last = DB::table('activitynew')-> latest('id','desc')->first();

        DB::table('action')->insert([
            'district' => Auth::user()->District,
            'mobile' => Auth::user()->mobile,
            'status'=> "Draft",
             'time'=>date("Y-m-d H:i:s", strtotime('now')),
            'action'=>"নতুন  তথ্য(".$request->name.")" ,
            'id_user'=>$last->id,
            'id_admin'=> "New",
             
             
        ]);
        

        return redirect("DR.notundashboard");
     }
     public function mamla(){
        $upojela=DB::table(session('tabledr'))
        ->select('Thana')
         ->distinct()
          ->get();
$pourosova=DB::table(session('tabledr'))
          ->select('Pourosova_City_Corporation')
          ->whereNotNull('Pourosova_City_Corporation')
           ->distinct()
            ->get();


return view('DR.mamla',compact('upojela','pourosova'));
        
      }
     public function mamladashboard(){
                       
        $draftdata=DB::table('mamla')
        ->select('*')
        ->where('district','=',Auth::user()->District)
        ->paginate();
return view('DR.mamladashboard',compact('draftdata'));

     }
     public function mamlainfo(Request $request){
        $request->validate([
            'name' => 'required|string',
            'father' => 'required|string',
            'mother' =>  'required|string' ,
            'area' => 'required|string' ,
            'mobile' => 'required|string',
            'nid' =>  'required|string' ,
            'dob' => 'required|string' ,
             'dategot' => 'required|string' ,
             'permanent' => 'required|string' ,
             'religion' => 'required|string' ,
             
        ]);
          DB::table('mamla')->insert([
            'area' => $request->area  ,
            'upojela' => $request->upojela  ,
              'name'=> $request->name  ,
            'father'=> $request->father   ,
            'mother'=>  $request->mother ,
            'dob'=>  $request->dob ,
            'nid' => $request->nid  ,
             'address'=>   $request->permanent ,
             'mobile'=>   $request->mobile,
             'license' =>   $request->dategot,
             'religion'=>   $request->religion,
             'pourosova'=> $request->pourosova,
            'district'=>Auth::user()->District,
             'status'=>'Draft',
             'mamla'=> $request->mamla  ,
        ]);

        return redirect("mamladashboard");
     }
     public function delmamla($id){
        DB::table('mamla')
        ->where('nid','=',decrypt($id))
         ->delete();

         return redirect("mamladashboard");

     }
     public function notundashboard(){
                     
            $draftdata=DB::table(session('tabledr'))
                        ->select('*')
                        ->where('District','=','Draft')
                        ->paginate();
                return view('DR.notundashboard',compact('draftdata'));
     }
     public function viewnotun($id){
        $draftdata=DB::table(session('tabledr'))
        ->select('*')
        ->where('NID','=',decrypt($id))
        ->get();
 return view('DR.viewnotun',compact('draftdata'));

              

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

    return view('SR.verificationinfo', compact('draftdata')); 

    } 
    public function finalstage(){
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Waiting')
        ->orwhere('status','=','Accepted')
        ->paginate();

    return view('DR.finalstage', compact('draftdata'));
    }
     
    public function acceptfinal(Request $request){
        DB::table('user_budget')
        ->where('status','=','Waiting')
        ->where('applicationid','=',$request->id)
        ->update(['status' => "Accepted"]);
        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Waiting')
        ->orwhere('status','=','Accepted')
        ->paginate();

    return view('DR.finalstage', compact('draftdata'));


    }
    public function budgetback11(Request $request){
        DB::table('user_budget')
        ->where('status','=','Waiting')
        ->where('applicationid','=',decrypt($request->id))
        ->update(['status' => "Forwarded"]);

        $draftdata = DB::table('user_budget')
        ->select('*')
        ->where('status','=', 'Waiting')
        ->orwhere('status','=','Accepted')
        ->paginate();

    return view('DR.finalstage', compact('draftdata'));

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
      ->where('id','=',$request->id)
      ->update(['role' => 'userone' ]);
      $draftdata=DB::table('users')
      ->select('*')
      ->where('role','=','verified1')
      ->paginate(3);
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
      session()->flash('success', 'Your message here!');

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

  return view('SR.code11', compact('draft'));



  }

     
    

     

    public function deletesr(){
        $draftdata=DB::table('activitydel')
                  ->select('*')
                  ->where('status','=','Forwarded')
                  ->paginate();
    return view('SR.deleteme',compact('draftdata'));


    }
    public function newentry(){
        $draftdata=DB::table('activitynew')
                  ->select('*')
                  ->where('status','=','Forwarded')
                  ->paginate();
    return view('SR.newentry',compact('draftdata'));


    }

    
    public function notunview(Request $request){
        $tablenn=$request->name;
        $id=decrypt($request->id);
        $ggth=DB::table($tablenn)
        ->where('nid','=',$id)
        ->first();
        $nametable = (new ConverterController)->name2table($ggth->district);
      $draftdata=DB::table($nametable)
        ->where('NID','=',$id)
        ->get();
    return view('SR.notunview',compact('draftdata'));

    }
 public function adminnotunview(Request $request){

    $tablenn=$request->name;
    $id=decrypt($request->id);
    $ggth=DB::table($tablenn)
    ->where('nid','=',$id)
    ->first();
    $nametable = (new ConverterController)->name2table($ggth->district);
  $draftdata=DB::table($nametable)
    ->where('NID','=',$id)
    ->get();
return view('AR.adminnotunview',compact('draftdata'));

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
    notify()->success('আপনার নিবন্ধন সফলভাবে সম্পন্ন হয়েছে ', 'Notice');
    return view('Newok.Newuser');
}
public function profilear(Request $request){
    if ($request->hasFile('avatar')){
        $avatar=$request->file('avatar');
        $filename=time().'.'.$avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300,300)->save(public_path('/upload/DR/'.$filename));
        $user=Auth::user();
        $user->avatar=$filename;
        $user->save();
    }
    return view('AR.dashboard');
}
public function lastentry(){

    $draftdata=DB::table('activitynew')
    ->where('status','=','ok')
    ->paginate();
    return view('AR.lastentry',compact('draftdata'));

}

public function publish(Request $request){
    $name=$request->name;
    $id=decrypt($request->id);
     $district=DB::table($name)
              ->where('id','=',$id)
              ->first();
    if($name=='activityedit'&& $district->status=='ok'){
        $nametable = (new ConverterController)->name2table($district->district);
           DB::table($nametable)->where('NID','=',$district->nid)->update([$district->colname => $district->after ]);
           DB::table('activityedit')->where('id','=',$id)->update(['status' => 'published' ]);

    }

    else if($name=='activitydel'&& $district->status=='ok'){
        $nametable = (new ConverterController)->name2table($district->district);
           DB::table($nametable)->where('NID','=',$district->nid)->delete();
           DB::table('activitydel')->where('id','=',$id)->update(['status' => 'published' ]);


    }
    else if($name=='activitycharge'&& $district->status=='ok'){
        $nametable = (new ConverterController)->name2table($district->district);
         $ready=$district->bortoman.' এবং '.$district->sector.'অতিরিক্ত দায়িত্ব ';  
        DB::table($nametable)->where('NID','=',$district->nid)->update(['A' => $ready ]);
        DB::table('activitycharge')->where('id','=',$id)->update(['status' => 'published' ]);


    }
    else if($name=='activitynew'&& $district->status=='ok'){
        $nametable = (new ConverterController)->name2table($district->district);
         DB::table($nametable)->where('NID','=',$district->nid)->update(['U' => $district->district]);
         DB::table('activitynew')->where('id','=',$id)->update(['status' => 'published' ]);


    }

  return view('AR.dashboard');
}
public function admindel(Request $request){
    $tablenn=$request->name;
    $id=decrypt($request->id);
  DB::table($tablenn)
  ->where('id','=',$id)
  ->delete();
  return view('AR.dashboard');



}
public function loguser(){
    $draftdata=DB::table('loginfo')->select('*')
    ->where('mobile','=',Auth::user()->mobile)
    ->orderby('time','DESC')->paginate();
    return view('AR.loguser',compact('draftdata'));
}
public function srloguser(){
    $draftdata=DB::table('loginfo')->select('*')
    ->where('mobile','=',Auth::user()->mobile)
    ->orderby('time','DESC')->paginate(5);
    return view('SR.srloguser',compact('draftdata'));
}
public function drloguser(){
    $draftdata=DB::table('loginfo')->select('*')
    ->where('mobile','=',Auth::user()->mobile)
    ->orderby('time','DESC')->paginate();
    return view('DR.loguser',compact('draftdata'));
}

public function userinfo(){
    $draftdata= DB::table('users')->select('*')->where('role','=','user')->paginate();
    return view('AR.userinfo',compact('draftdata'));
}
public function pendinguser(){
    $draftdata= DB::table('users')->select('*')->where('role','=','userdr')
    ->orwhere('role','=','useradmin')
    ->orwhere('role','=','usersr')
     ->paginate();
    return view('AR.pendinguser',compact('draftdata'));
}
public function deluser($id){

    DB::table('users')->where('mobile','=',$id)->delete();
    return view('AR.dashboard');
}
public function picinfo($id){
    $draftdata= DB::table('kazipicture')->select('*')->where('district','=',$id)->paginate();
    return view('AR.picinfo',compact('draftdata'));

}

public function rolechange(Request $request){

    $jela=$request->district;
    $mail=$request->email;
    $mobile=$request->mobile;

    DB::table('users')->where('District','=',$jela)
    ->where('email','=',$mail)
    ->where('mobile','=',$mobile)
    ->update(['role' => "userdr"]);
    $draftdata= DB::table('users')->select('*')->where('role','=','userdr')
    ->orwhere('role','=','useradmin')
    ->orwhere('role','=','usersr')
     ->paginate();
    return view('AR.pendinguser',compact('draftdata'));
}
public function userstatus(){
      $draftdata=DB::table('action')->select('*')->where('district','=',Auth::user()->District)
               ->where('status','=','Forwarded')
               ->orwhere('status','=','ok')
                ->orderby('time','DESC')->paginate();
       return view('DR.userstatus',compact('draftdata'));
}
public function adminstatus(){
    $draftdata=DB::table('action')->select('*')
                ->where('status','=','ok')
                  ->orwhere('status','=','updated')     
              ->orderby('time','DESC')->paginate();
     return view('SR.userstatus',compact('draftdata'));
}
public function admin2status(){
    $draftdata=DB::table('action')->select('*')
                    
              ->orderby('time','DESC')->paginate();
     return view('AR.userstatus',compact('draftdata'));
}
 public function allpic(){
         
          $draftdata=DB::table('kazipicture')
                      ->select('district')
                      ->distinct()
                      ->paginate();
    return view('AR.allpic',compact('draftdata'));
 }
 public function srallpic(){
         
    $draftdata=DB::table('kazipicture')
                ->select('district')
                ->distinct()
                ->paginate();
return view('SR.allpic',compact('draftdata'));
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
