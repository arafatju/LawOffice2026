<!DOCTYPE html>
<html>
<head>
    <title>User Login Info</title>
</head>
<body>
    <p>
        জনাব {{ $user->name }}, আপনি সফলভাবে  লগ ইন করেছেন   <br>

        আপনার অপারেটিং সিস্টেম: {{ $os }} {{ $osVersion }} <br>

        আপনি যে ব্রাউজার দিয়ে লগ ইন করেছেন: {{ $browser }} {{ $browserVersion }} <br>

         <br>
    </p>
</body>
</html>
