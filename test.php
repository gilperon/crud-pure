<?php

//Conection do Database --------------
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "task_db"; //Set the database_name here

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
//END Conection do Database



//INSERT New Customers  --------------
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $address = $_POST['address'];

        $sql = "INSERT INTO customers (firstName) values ('$name')";
        $result = $conn->query($sql);
        $userId = $conn->insert_id;
        $sql = "INSERT INTO addresses (address,customerId) values ('$address','$userId')";
        $result = $conn->query($sql);
    }
//END New Customers


//Delete customers  --------------
    if(isset($_GET['del'])){
        $sql = "DELETE FROM customers WHERE id = '".$_GET['del']."'";
        $result = $conn->query($sql);
    }
//END Delete Customers


//LIST all Customers with Address  --------------
    $sql = "SELECT cs.id,firstName,address FROM customers as cs INNER JOIN addresses as ad WHERE cs.id = ad.customerId";
    $result = $conn->query($sql);
    $output = "";
    if($result){
        if ($result->num_rows > 0) {
        
            while($row = $result->fetch_assoc()) {
                //echo $row["name"]. " " . $row["address"]. "<br>";
                $output .= "<tr><td>Name: ".$row["firstName"]."</td><td>Address: ".$row["address"]."</td><td><a href='?del=".$row["id"]."'>(delete this)</a></td></tr>";
            }
            $output = "<table>".$output."</table>";
            
        }
    }

    if(!$output){ $output = "There are no customers!"; }
//END List all Customers

//Close Database Connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP Pure</title>
</head>
<body>


    <h1>Start CRUD</h1>

    <hr>
    <h4>Retrieve customers and their addresses from the database<br>
    List customers and their addresses in an HTML table:</h4>  
    <span style="color:purple;font-weight:bold;"><h3><?php echo $output; ?></h3></span>
    <br>
    <hr>
    <br>
    <h4>Create New Customers and Address</h4>  
    <form  method="POST">
        <input type="text" name="name" id="name" placeholder="Customer's name" required>
        <input type="text" name="address"  id="address" placeholder="Customer's address">
        <input type="submit" value="SAVE">
    </form>
    <br><br>

    <hr>

    <h4>Create Tables</h4>  
    
    <br><br>

    <style>
    code{padding:5px;background:#F4F5F7;display:table;}
    .codigo{-webkit-box-flex:1;flex-grow:1;tab-size:4;cursor:text;font-size:.875rem;line-height:1.5rem;color:#172b4d;border-radius:3px;margin:8px;white-space:pre;}
    </style>

<code style="margin-top:10px;border-top:3px solid red;">
<div class="codigo">

    CREATE TABLE `customers` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `firstName` varchar(100) NOT NULL ,
    `lastName` varchar(100) NOT NULL ,
    `phone` varchar(10) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

    CREATE TABLE `addresses` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `customerId` INT(10) UNSIGNED ,
    `address` varchar(255) NOT NULL ,
    FOREIGN KEY (customerId) REFERENCES customers(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

    </div>
</code>
    
</body>
</html>
