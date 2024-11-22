<!DOCTYPE html>
<html>
<head>
 
 <title>Laravel 9 Send Email Example</title>
</head>
<body>
 @php 
 $kk=(new Jenssegers\Agent\Agent)->platform();
 $kk2=(new Jenssegers\Agent\Agent)->version($kk);
 $kk3=(new Jenssegers\Agent\Agent)->browser();
 $kk4=(new Jenssegers\Agent\Agent)->version($kk3);
  
 @endphp
 <h1>Log info  </h1>
 <p>জনাব {{Auth::user()->name}} আপনি লগ ইন করেছেন সময় {{  App\Http\Controllers\ConverterController::logdd(now()->toDateTimeString())
 }}</br>
     
 আপনার OS :{{$kk}} ভার্সন {{$kk2}} </br>
  আপনি যে ব্রাওসার দিয়ে লগ ইন করেছেন সেটি হচ্ছে {{$kk3}} ভার্সন {{$kk4}} region {{session('user_data_city')}}</br>
 </p>
 
</body>
</html> 