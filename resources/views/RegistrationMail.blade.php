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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }
        th {
            background-color: #007bff;
            color: #ffffff;
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
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <tr>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['email'] }}</td>
                <td>{{ $data['password'] }}</td>
            </tr>
        </table>

        <div class="email-body">
            <p><a href="{{ $data['url'] }}">Click here to log in to your account.</a></p>
        </div>

        <div class="email-footer">
            <p>Thank you!</p>
        </div>
    </div>
</body>
</html>
