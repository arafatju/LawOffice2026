<!DOCTYPE html>
<html>
<head>
    <title>User Login Info</title>
</head>
<body>
    <p>
        জনাব {{ $user->name }}, আপনি লগ ইন করেছেন সময়:  
        {{ $loginTime }} <br>

        আপনার অপারেটিং সিস্টেম: {{ $os }} {{ $osVersion }} <br>

        আপনি যে ব্রাউজার দিয়ে লগ ইন করেছেন: {{ $browser }} {{ $browserVersion }} <br>

        আপনার যে এলাকা থেকে লগ ইন করেছেন(সম্ভাব্য স্থান): 
        {{ $location['city'] ?? '' }} {{ $location['region'] ?? '' }} {{ $location['country'] ?? '' }} <br>
    </p>
</body>
</html>
