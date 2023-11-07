<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        #form{
            border: 2px solid black;
            width: 36%;
            margin-left: 32%;
            margin-top: 2%;
        }

        label{
            font-size: 20px;
            margin-left: 25%;
            margin-top: 1%;
            margin-bottom: 1%;
        }

        input{
            width: 50%;
            height:30px;
            margin-left: 25%;
            margin-top: 1%;
            margin-bottom: 1%;
            font-size: 18px;
            padding: 1.5%;
            border-radius: 5px;
        }
        #button{
            border-radius: 10px;
            background-color: lightgreen;
            width: 40%;
            margin-left: 30%;
            height: 30px;
            padding: 1%;
        }
    </style>
</head>
<body>
    <h1>ADD PRODUCTS</h1>
    <form action="add" method="post" id="form">
        @csrf
        <label for="product_name">Product Name :</label> <br>
        <input type="text" name="Product_name" id="name"><br>
        <label for="product_type">Product Type :</label> <br>
        <input type="text" name="Product_type" id="type"><br>
        <label for="price">Price :</label> <br>
        <input type="number" name="Price" id="price"><br>
        <input type="submit" value="Submit" id="button">
    </form>
</body>
</html>