<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>লেনদেন বিজ্ঞপ্তি</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:'Segoe UI', Arial, sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:30px 0;">
    <tr>
      <td align="center">
        <table role="presentation" width="520" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.08);">

          <!-- Header -->
          <tr>
            <td style="background-color:#1a56db; padding:24px 32px;">
              <span style="font-size:20px; color:#ffffff; font-weight:600;">🧾 লেনদেন বিজ্ঞপ্তি</span>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:32px;">
              <p style="margin:0 0 20px 0; font-size:16px; color:#1f2937; line-height:1.6;">
                জনাব <strong>{{ $user->name ?? 'কাস্টমার' }}</strong>,<br>
                আপনার লেনদেন সফলভাবে সম্পন্ন হয়েছে। পণ্যের বিবরণ নিচে দেওয়া হলো:
              </p>

              <!-- Transaction info -->
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-bottom:20px;">
                <tr>
                  <td style="padding:10px 16px; background-color:#f9fafb; font-size:14px; color:#6b7280; width:40%;">লেনদেন আইডি</td>
                  <td style="padding:10px 16px; background-color:#f9fafb; font-size:14px; color:#111827; font-weight:600;">{{ $transaction->trid }}</td>
                </tr>
                <tr>
                  <td style="padding:10px 16px; font-size:14px; color:#6b7280; border-top:1px solid #eef0f3;">আবেদনের তারিখ</td>
                  <td style="padding:10px 16px; font-size:14px; color:#111827; border-top:1px solid #eef0f3;">
                    {{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i') }}
                  </td>
                </tr>
                <tr>
                  <td style="padding:10px 16px; background-color:#f9fafb; font-size:14px; color:#6b7280; border-top:1px solid #eef0f3;">মোট পণ্য</td>
                  <td style="padding:10px 16px; background-color:#f9fafb; font-size:14px; color:#111827; border-top:1px solid #eef0f3;">
                  {{ $transaction12->sum('number') }}   টি
                  </td>
                </tr>
              </table>

              <!-- ✅ Product list — loops over 1 or many -->
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <tr style="background-color:#1a56db;">
                  <th style="padding:10px 12px; font-size:13px; color:#ffffff; text-align:left;">পণ্য</th>
                  <th style="padding:10px 12px; font-size:13px; color:#ffffff; text-align:center;">কোড</th>
                  <th style="padding:10px 12px; font-size:13px; color:#ffffff; text-align:center;">পরিমাণ</th>
                   
                </tr>
@forelse($transaction12 as $item)
    <tr style="background-color:{{ $loop->odd ? '#ffffff' : '#f9fafb' }};">
      <td style="padding:10px 12px; font-size:14px; color:#111827; border-top:1px solid #eef0f3;">
        {{ $item->product->name ??  '—' }}
      </td>
      <td style="padding:10px 12px; font-size:14px; color:#111827; border-top:1px solid #eef0f3; text-align:center;">
        {{ $item->prcode }}
      </td>
      <td style="padding:10px 12px; font-size:14px; color:#111827; border-top:1px solid #eef0f3; text-align:center;">
        {{ $item->number ?? 1 }}
      </td>
    </tr>
@empty
    <tr>
      <td colspan="3" style="padding:16px; font-size:14px; color:#9ca3af; text-align:center; border-top:1px solid #eef0f3;">
        কোনো পণ্য পাওয়া যায়নি।
      </td>
    </tr>
@endforelse

                <!-- Total -->
               <tr>
  <td colspan="2" style="padding:10px 12px; font-size:14px; font-weight:bold; text-align:right; border-top:2px solid #111827;">
    মোট:
  </td>
  <td style="padding:10px 12px; font-size:14px; font-weight:bold; text-align:center; border-top:2px solid #111827;">
    {{ $transaction12->sum('number') }}
  </td>
</tr>
              </table>

               
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