

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="{{asset('gov.png')}}">    
  <title>  বিবাহ নিবন্ধক গণের তথ্য  </title>
   

  
  
    <link href="{{ asset('smart.css') }}" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

     <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

 
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <script>
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var divContents2 = document.getElementById("GFG2").innerHTML;

            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body > ');
            a.document.write(divContents);
            a.document.write(divContents2);

            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>

  
  
</head>
 
     
<style>
            body {
                font-family: 'Nikosh';
                font-size:20px;
            }
        </style>

     <div id="GFG">
    <div class="greet">
<h5 align="center" style="margin:0;"><img src=" {{asset('gov.png')}}"  style="width:20px;height:20px;"/> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4> <h5 align="center" style="margin:0;"> আইন,বিচার ও সংসদ বিষয়ক মন্ত্রণালয়  </h5> 
    <h5 align="center" style="margin:0;"> আইন ও বিচার বিভাগ  </h5>
    <h5 align="center" style="margin:0;"> সারাদেশের বিবাহ নিবন্ধকগণের ডিজিটাল ডাটাবেইস  </h5>  
    <h5 align="center" style="margin:0;"> জেলার নাম :{{session('jela') }} </h5>  
    <h5 align="center" style="margin:0;"> @foreach($person as $gg)  {!! QrCode::size(150)->generate(utf8_encode('১।নামঃ'.$gg->Name.'  '.'২।পিতার নাম-'.$gg->Father .'৩।মাতার নাম:-'.$gg->Mother .'৪।মোবাইল:-'.$gg->Mobile .'৫।অধিক্ষেত্র:-:'.$gg->Union_Ward))!!} @endforeach
  
          </h5>
</div> </div>
<body style="margin-bottom:5%;">
<div class="scrollmenu">
<a href="{{route('hhome')}}">বিবাহ নিবন্ধকগণের তথ্য</a>
  <a href="{{route('onu')}}">তথ্য অনুসন্ধান</a>
  <a href="{{route('stat')}}">এক নজরে সারা দেশ</a>
  <a href="{{route('motamot')}}">মতামত এবং পরামর্শ</a>
  <a href="#" onclick="printDiv()"> প্রিন্ট 
    
    
  </a>
</div>


<div class="container"   >
<div id="GFG2">
@yield('content')
        </div>
      
    </body>
    <div class="footer  "style="position:fixed;bottom:0px">
  <p style="font-size:15px;">কপিরাইট &copy;আইসিটি সেল , আইন  ও বিচার বিভাগ  কতৃক সর্বস্বত্ব সংরক্ষিত ,     
  কারিগরি সহায়তায় আরাফাত উর রহমান , সহকারী প্রোগ্রামার আইন ও বিচার বিভাগ  </p>
</div>
</html>
