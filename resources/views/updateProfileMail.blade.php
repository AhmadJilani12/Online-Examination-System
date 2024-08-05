<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$data['title']}}</title>
</head>
<body>
    
    <table>
         <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
         </tr>

         <tr>

            <td>{{$data['name']}}</td>
            
            <td>{{$data['email']}}</td>
            
         </tr>
    </table>
    <p><b>Note:- </b>You can use Your old Password. </p>
   <a href="{{$data['url']}}">Click here to login your account.</a>
    <p>Thank you !</p>
</body>
</html>