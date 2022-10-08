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
     public function section7(){
        return view('SR.dashboard');
    }
    public function verifychange(){
        return view('DR.user');
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
        $person=DB::table($nametable)
                ->paginate(20);
        
        session(['tabledr' =>$nametable]);
        session(['districtdr' =>Auth::user()->District]);
        return view('DR.okchange',compact('person'));
     }




    public function changeme(Request $request){
           
        $kk=decrypt($request->id);
        $id2=$request->id2;
         
        $person=DB::table(session('tabledr'))
                ->select($kk)
                ->where('H','=',session('NID'))
                ->get();
          
        
        return view('DR.changeme', compact('person','kk','id2'));
    }

     public function editchange($id){
        $nametable = (new ConverterController)->name2table(Auth::user()->District);
        $person=DB::table($nametable)
                ->select('*')
                ->where('H','=',decrypt($id))
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
            'action'=>"Edit",
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
                ->paginate(20);
        
        session(['tabledr' =>$nametable]);
        session(['districtdr' =>Auth::user()->District]);
        return view('DR.okchange',compact('person'));
       
        
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
            Image::make($avatar)->resize(300,300)->save(public_path('/upload/SR/'.$filename));
            $user=Auth::user();
            $user->avatar=$filename;
            $user->save();
        }
        return view('SR.dashboard');
   }

   public function changepicture(Request $request){
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = session('NID').'.'.$request->avatar->extension();  
    $request->avatar->move(public_path('upload/kazi/picture/'), $imageName);
    DB::table('kazipicture')->insert([
        'district' => Auth::user()->District,
        'nid'=>session('NID'),
        'picture'=>$imageName,
        'father'=>'fff',
        'mother'=>'kkk',
        'name'=>'ppkk',
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
               ->where('H','=',decrypt($id))
               ->get();


               return view('DR.addlcharge',compact('draftdata'));


   }
   public function delsend($id){
    DB::table('activitydel')
    ->where('id','=',decrypt($id))
    ->update(['status' => 'Forwarded' ]);
    
    
    DB::table('action')->insert([
     'district' => Auth::user()->District,
     'mobile' => Auth::user()->mobile,
     'status'=> "Forwarded",
      'time'=>date("Y-m-d H:i:s", strtotime('now')),
     'action'=>"Delete",
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
        ->get();
          
        
 

$imageName = session('NID').'.'.$request->avatar->extension();  
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
        ->where('H','=',session('NID'))
        ->get()->pluck('D');

        $draftdata2=DB::table(session('tabledr'))
        ->select('*')
        ->where('H','=',session('NID'))
        ->get()->pluck('A');
           
        $imageName = "pp".time().session('NID').'.'.$request->avatar->extension();  
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
     
        DB::table('action')->insert([
         'district' => Auth::user()->District,
         'mobile' => Auth::user()->mobile,
         'status'=> "Forwarded",
          'time'=>date("Y-m-d H:i:s", strtotime('now')),
         'action'=>"Additionalcharge",
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
            'A' => $request->area  ,
            'B' => $request->upojela  ,
            'C'=> 'kk'   ,
             'D'=> $request->name  ,
            'E'=> $request->father   ,
            'F'=>  $request->mother ,
            'G'=>  $request->dob ,
            'H' => $request->nid  ,
            'I' =>   $request->education,
            'J'=>   $request->permanent ,
             'K'=>  $request->present ,
            'L'=>  $request->office  ,
            'M'=>   $request->mobile,
            'N'=>   $request->email,
            'O' =>   $request->dategot,
            'P' =>  $request->statuslicense ,
            'Q'=>   $request->Q ,
             'R'=>  $request->indent ,
            'S'=>   $request->gazetdate ,
            'T'=>   $request->religion,
            'U'=>  "draft",
            'V' => $request->expired,
            'W'=> $request->jobdo,
            'X'=> $request->jobname,
            'Y'=> $request->pourosova,
            'Z'=>$request->datelicense ,
             
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
            'action'=>"NewEntry",
            'id_user'=>$last->id,
            'id_admin'=> "New",
             
             
        ]);
        

        return redirect("notundashboard");
     }
     public function notundashboard(){
                     
            $draftdata=DB::table(session('tabledr'))
                        ->select('*')
                        ->where('U','=','Draft')
                        ->paginate();
                return view('DR.notundashboard',compact('draftdata'));
     }
     public function viewnotun($id){
        $draftdata=DB::table(session('tabledr'))
        ->select('*')
        ->where('H','=',decrypt($id))
        ->get();
 return view('DR.viewnotun',compact('draftdata'));

              

    }

    public function notun(){
          $upojela=DB::table(session('tabledr'))
                    ->select('B')
                     ->distinct()
                      ->get();
         $pourosova=DB::table(session('tabledr'))
                      ->select('Y')
                       ->distinct()
                        ->get();
          
        
     return view('DR.notun',compact('upojela','pourosova'));

    }
    public function sendnotun($id){
               DB::table(session('tabledr'))
               ->where('H','=',decrypt($id))
               ->update(['U' => 'Forwarded' ]);

               $draftdata=DB::table(session('tabledr'))
               ->select('*')
               ->where('U','=','Draft')
               ->paginate();
     return view('DR.notundashboard',compact('draftdata'));


    }
    public function delnotun($id){
               DB::table(session('tabledr'))
               ->where('H','=',decrypt($id))
               ->where('U','=','Draft')
               ->delete();
     $draftdata=DB::table(session('tabledr'))
               ->select('*')
               ->where('U','=','Draft')
               ->paginate();
     return view('DR.notundashboard',compact('draftdata'));

   

    }
    public function dashboard()
    {   
        if(Auth::check()){

                // ->orWhere('name', 'John')
               
               
               return view('DR.dashboard');
                        }
        
        
         
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
