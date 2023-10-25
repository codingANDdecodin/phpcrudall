<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
</head>
<body>
    <div class='container'>
          <h1>list of clients</h1>
          <a href='/PHPWORK/create.php' role='button' >new client</a>
          </br>
          <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                 </tr>
            </thead>
            <tbody>
                <?php
                $servername="localhost";
                $username="root";
                $password="";
                $database="myshop";
                
                //create connection

                $connection=new mysqli($servername,$username,$password,$database);

                //cheak connection
                if($connection->connect_error){
                    die("connection faild: ".$connection->connect_error);
                }

                //read all row from database table
                $sql="SELECT * FROM clients";
                $result=$connection->query($sql);

                //cheak query successfully exicute or not
                if(!$result){
                    die("Invalid query: ".$connection->error);
                }

                //read data from each row
                while($row=$result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                          <a href='/phpwork/edit.php?id=$row[id]'>edit</a>
                          <a href='/phpwork/delete.php?id=$row[id]'>delete</a>
                        </td>
                    </tr>                        
                    ";

                }
                ?>
               
            </tbody>
          </table>
    </div>
</body>
</html>