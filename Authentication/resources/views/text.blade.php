<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border: 2px solid black;
            width: 50%;
            margin-left: 25%;
            font-size: 20px;
        }
        td{
            border: 2px solid black;
            width: 50%;
            padding-left: 5%;
        }

        table,td{
            border-collapse : collapse;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Hello Admin {{Auth::user()->name}} - welcome to your page</h1>
    <h2 style="text-align: center">Your Details</h2>
    <table>
        <tr>
            <td>ID</td>
            <td>{{Auth::user()->id}}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{Auth::user()->name}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{Auth::user()->email}}</td>
           
        </tr>
        <tr>
            <td>User-Type</td>
            <td>{{Auth::user()->user_type}}</td>
        </tr>
    </table>
</body>
</html>