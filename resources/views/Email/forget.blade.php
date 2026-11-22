<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Recovery</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f5f9; font-family:Arial, Helvetica, sans-serif;">

<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f3f5f9; padding:24px 0;">
  <tr>
    <td align="center">

      <table role="presentation" width="560" cellspacing="0" cellpadding="0" border="0"
             style="max-width:560px; width:100%; background-color:#ffffff; border-radius:8px; overflow:hidden; border:1px solid #e1e5ee;">

        <!-- Header -->
        <tr>
          <td align="center" style="background-color:#0b5d3b; padding:22px 24px;">
            <div style="color:#ffffff; font-size:18px; font-weight:bold;">Law and Justice Division</div>
            <div style="color:#cfe8dc; font-size:13px; margin-top:4px;">Ministry of Law, Justice and Parliamentary Affairs</div>
          </td>
        </tr>

        <!-- Body -->
        <tr>
          <td style="padding:30px 32px 10px 32px; color:#2b2f38; font-size:15px; line-height:1.6;">
            <p style="margin:0 0 14px 0; font-size:17px; font-weight:bold;">Password Recovery</p>
            <p style="margin:0 0 18px 0;">Dear Sir/Madam,</p>
            <p style="margin:0 0 18px 0;">
              We received a request to reset your account password. Use the one-time password (OTP) below to continue:
            </p>
          </td>
        </tr>

        <!-- OTP box -->
        <tr>
          <td align="center" style="padding:4px 32px 18px 32px;">
            <div style="display:inline-block; background-color:#eef6f1; border:2px dashed #0b5d3b; border-radius:8px; padding:16px 34px;">
              <span style="font-size:34px; font-weight:bold; letter-spacing:10px; color:#0b5d3b; font-family:'Courier New', Courier, monospace;">{{ $id }}</span>
            </div>
          </td>
        </tr>

        <!-- Expiry + security -->
        <tr>
          <td style="padding:0 32px 26px 32px; color:#2b2f38; font-size:14px; line-height:1.6;">
            <p style="margin:0 0 14px 0; text-align:center;">
              This OTP is valid for <strong>5 minutes</strong>. Please enter it on the password recovery page.
            </p>
            <div style="background-color:#fff8e6; border-left:4px solid #f0ad00; padding:12px 14px; border-radius:4px; font-size:13px;">
              <strong>Security notice:</strong> Never share this OTP with anyone. Our staff will never ask for it.
              If you did not request a password reset, you can safely ignore this email and your password will stay unchanged.
            </div>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td align="center" style="background-color:#f7f8fb; border-top:1px solid #e1e5ee; padding:16px 24px; color:#8a90a0; font-size:12px; line-height:1.5;">
            This is a system-generated email. Please do not reply to this message.<br>
            &copy; {{ date('Y') }} Law and Justice Division
          </td>
        </tr>

      </table>

    </td>
  </tr>
</table>

</body>
</html>