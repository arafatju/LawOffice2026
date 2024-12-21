<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConverterController extends Controller
{
  

	
		
	 public static  $bn = ["ঢাকা", "বাগেরহাট", "বান্দরবান", "বরগুনা", "বরিশাল", "বগুড়া", "ব্রাহ্মণবাড়িয়া", "চাঁদপুর", "চাঁপাইনবাবগঞ্জ", "চট্টগ্রাম","চুয়াডাঙ্গা","কুমিল্লা","কক্সবাজার",
		   "দিনাজপুর","ফরিদপুর","ফেনী","গাইবান্ধা","গাজীপুর", 
			 "গোপালগঞ্জ","হবিগঞ্জ","জামালপুর","যশোর","ঝালকাঠি","ঝিনাইদহ","জয়পুরহাট","খাগড়াছড়ি","খুলনা","কিশোরগঞ্জ","কুড়িগ্রাম","কুষ্টিয়া","লালমনিরহাট","লক্ষ্মীপুর","মাদারীপুর","মাগুরা","মানিকগঞ্জ","ময়মনসিংহ", 
		 "মেহেরপুর","মৌলভীবাজার","মুন্সিগঞ্জ","নওগাঁ","নারায়ণগঞ্জ","নাটোর","নেত্রকোণা", "নীলফামারী" ,"নোয়াখালী","নড়াইল","নরসিংদী","পাবনা","পঞ্চগড়","পিরোজপুর","পটুয়াখালী","রাজবাড়ী","রাজশাহী",
		 "রাঙ্গামাটি","রংপুর","সাতক্ষীরা","শরীয়তপুর","শেরপুর","সিরাজগঞ্জ","সুনামগঞ্জ","সিলেট","টাঙ্গাইল","ঠাকুরগাঁও","ভোলা"    
	 ];
	public static  $en = ["Dhaka", "bagerhat", "bandarban", "barguna", "barishal", "bogura", "brahmanbaria", "chadpur", "chapai", "chatogram","chuadanga",
	 "comilla","coxsbazar","dinajpur","faridpur","feni","gaibandha","gazipur","gopalgonj","hobigonj","jamalp","jessore","jhalkathi","jhenaidah","joypurhat",
		 "khagrachori","khulna","kishoreganj","kurigram","kushtia","lalmonirhat","lokhipur","madaripur","magura","manikgonj","maymensingh",
	   "meherpur","moulovibazar","munshigonj","naoga","narayanganj","natore","netroko","nilfamari","noakhali",
	   "norail",
	   "norsingdi",
	   "pabna",
	   "panchagar",
	   "pirojpur",
	   "potuakhali",
	   "rajbari",
	   "rajshahi",
	   "rangamati",
	   "rangpu",
	   "satkhira",
	   "shariatpur",
	   "sherpur",
	   "sirajgonj",
	   "sunamgonj",
	   "sylhet",
	   "tangail",
	   "thakurgao",
	   "vola"
	   ];

	   public static $bn1 = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
	   public static $en1 = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
	   public static function name2table($name)
	   { 
        return str_replace(self::$bn, self::$en, $name);
	   
	   }
	   public static function en2bn($number)
    {
        return str_replace(self::$en1, self::$bn1, $number);
    }
	public static function bn2en($number)
    {
        return str_replace(self::$bn1,self::$en1,$number);
    }
      public static function logdd($date11){
		$currentDate = date("l, F j, Y  , h:i:s A",strtotime($date11));
			
		$engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
			
		$bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' ); 
		
		
		$conv = str_replace($engDATE, $bangDATE, $currentDate); 
		return $conv;

	  }
      public static function bangladate11($date11){
      if(!empty($date11)){
		//$hh=session('jela');
	//	$dt = Carbon::parse($date11);$currentDate=$dt->format('l j  F Y ');  

		//$my_url = "সিলেট জয়পুরহাট হবিগঞ্জ ভোলা নরসিংদী বরগুনা বাগেরহাট সিরাজগঞ্জ মেহেরপুর শরীয়তপুর জামালপুর ফরিদপুর কক্সবাজার পটুয়াখালী রাজবাড়ী নেত্রকোণা  মাগুরা ঝিনাইদহ ";
		//if (preg_match("/".$hh."/", $my_url))
		//{
			return ConverterController::en2bn($date11);
		//}
		//else
		//{
		//	$currentDate = date("l, F j, Y",strtotime($date11));
			
		//$engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
			
		//$bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' ); 
		
		
		//$conv = str_replace($engDATE, $bangDATE, $currentDate); 
		//return $conv; 
		}








		
		
		 
	   


	  }
	  public static function bangladate12()
	  {

		
	  }

}
