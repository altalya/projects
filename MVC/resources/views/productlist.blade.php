<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1{
            margin-top: 2%;
            text-align: center;
        }

        table,td,th{
            border: 2px solid black;
            border-collapse: collapse;
        }

        table{
            width: 60%;
            margin-left: 20%;
            margin-top: 2%;
        }
        th,td{
            width: 12%;
            height: 35px;
            text-align: center;
        }
        .button{
            width: 40%;
            margin-left: 5%;
            height: 25px;
            border-radius: 5px;
            background-color: lightgrey;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>PRODUCT LIST</h1>
    <table>
        <tr>
            <th>Product_Id</th>
            <th>Product_Name</th>
            <th>Product_Type</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        @foreach($product as $products)
            <tr>
                <td>{{$products->id}}</td>
                <td>{{$products->Product_name}}</td>
                <td>{{$products->Product_type}}</td>
                <td>{{$products->Price}}</td>
                <td><a href="{{url('delete',$products->id)}}"><button class="button">DELETE</button></a><a href="{{url('update',$products->id)}}"><button class="button">UPDATE</button></a></td>
            </tr>
        @endforeach
    </table>
</body>
</html>