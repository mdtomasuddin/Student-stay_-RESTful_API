<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 10px;
        }

        .header {
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .credentials {
            background: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #4CAF50;
            margin: 20px 0;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to StudentStay!</h1>
        </div>
        <p>Hi {{ $agent->full_name }},</p>
        <p>Congratulations! Your agent account has been approved. You can now log in using the credentials below:</p>

        <div class="credentials">
            <strong>Email:</strong> {{ $email }}<br>
            <strong>Password:</strong> {{ $password }}
        </div>

        <p>For security reasons, we recommend changing your password after your first login.</p>

        <p class="footer">Best Regards,<br>The StudentStay Team</p>
    </div>
</body>

</html>
