<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>লগইন বিজ্ঞপ্তি</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f9; font-family: 'Segoe UI', Arial, sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:30px 0;">
    <tr>
      <td align="center">
        <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.08);">

          <!-- Header -->
          <tr>
            <td style="background-color:#1a56db; padding:24px 32px;">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
                    <span style="font-size:20px; color:#ffffff; font-weight:600;">🔐 লগইন সতর্কতা</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:32px;">
              <p style="margin:0 0 20px 0; font-size:16px; color:#1f2937; line-height:1.6;">
                জনাব <strong>{{ $user->name }}</strong>,<br>
                আপনার অ্যাকাউন্টে একটি সফল লগইন সনাক্ত করা হয়েছে। বিস্তারিত তথ্য নিচে দেওয়া হলো:
              </p>

              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <tr>
                  <td style="padding:12px 16px; background-color:#f9fafb; border-radius:8px 8px 0 0; font-size:14px; color:#6b7280; width:40%;">সময়</td>
                  <td style="padding:12px 16px; background-color:#f9fafb; border-radius:8px 8px 0 0; font-size:14px; color:#111827; font-weight:500;">
                    {{ App\Http\Controllers\ConverterController::logdd(now()->toDateTimeString()) }}
                  </td>
                </tr>
                <tr>
                  <td style="padding:12px 16px; background-color:#ffffff; font-size:14px; color:#6b7280; border-top:1px solid #eef0f3;">অপারেটিং সিস্টেম</td>
                  <td style="padding:12px 16px; background-color:#ffffff; font-size:14px; color:#111827; font-weight:500; border-top:1px solid #eef0f3;">
                    {{ $platform }} {{ $platformVersion }}
                  </td>
                </tr>
                <tr>
                  <td style="padding:12px 16px; background-color:#f9fafb; font-size:14px; color:#6b7280; border-top:1px solid #eef0f3;">ব্রাউজার</td>
                  <td style="padding:12px 16px; background-color:#f9fafb; font-size:14px; color:#111827; font-weight:500; border-top:1px solid #eef0f3;">
                    {{ $browser }} {{ $browserVersion }}
                  </td>
                </tr>
                <tr>
                  <td style="padding:12px 16px; background-color:#ffffff; font-size:14px; color:#6b7280; border-top:1px solid #eef0f3;">IP ঠিকানা</td>
                  <td style="padding:12px 16px; background-color:#ffffff; font-size:14px; color:#111827; font-weight:500; border-top:1px solid #eef0f3;">
                    {{ $ip }}
                  </td>
                </tr>
                <tr>
                  <td style="padding:12px 16px; background-color:#f9fafb; border-radius:0 0 8px 8px; font-size:14px; color:#6b7280; border-top:1px solid #eef0f3;">অবস্থান</td>
                  <td style="padding:12px 16px; background-color:#f9fafb; border-radius:0 0 8px 8px; font-size:14px; color:#111827; font-weight:500; border-top:1px solid #eef0f3;">
                    {{ $city }} {{ $region }} {{ $country }}
                  </td>
                </tr>
              </table>

              <p style="margin:24px 0 0 0; font-size:13px; color:#9ca3af; line-height:1.6;">
                যদি এই লগইনটি আপনি না করে থাকেন, দয়া করে অবিলম্বে আপনার পাসওয়ার্ড পরিবর্তন করুন এবং সিস্টেম প্রশাসকের সাথে যোগাযোগ করুন।
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background-color:#f9fafb; padding:18px 32px; text-align:center; border-top:1px solid #eef0f3;">
              <span style="font-size:12px; color:#9ca3af;">এটি একটি স্বয়ংক্রিয় বার্তা, দয়া করে এর জবাব দেবেন না।</span>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>