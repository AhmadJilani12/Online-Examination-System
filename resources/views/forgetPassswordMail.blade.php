<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        .email-header {
            text-align: center;
            border-bottom: 1px solid #dddddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .email-header h1 {
            color: #007bff;
            font-size: 24px;
            margin: 0;
        }
        .email-body {
            font-size: 16px;
            line-height: 1.6;
        }
        .email-body a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .email-body a:hover {
            text-decoration: underline;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
        }
        .email-footer p {
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $data['title'] }}</h1>
        </div>

        <div class="email-body">
            <p>{{ $data['body'] }}</p>
            <p><a href="{{ $data['url'] }}">Click here to reset your password</a></p>
        </div>

        <div class="email-footer">
            <p>Thank you!</p>
        </div>
    </div>
</body>
</html>
