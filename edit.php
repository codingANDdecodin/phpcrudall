<?php
$servername="localhost";
$username="root";
$passward="";
$database="myshop";

//create connection
$connection=new mysqli($servername,$username,$passward,$database);

$id='';
$name='';
$email='';
$phone='';
$address='';

$errorMessage='';
$successMessage='';

if($_SERVER['REQUEST_METHOD']=='GET'){
    
    if(!isset($_GET['id'])){
        header('location:/PHPWORK/index.php');
        exit;
    }

    $id=$_GET['id'];

    $sql=" SELECT * FROM clients WHERE id=$id";

    $result=$connection->query($sql);
    $row=$result->fetch_assoc();

    if(!$row){
        header('location:/PHPWORK/index.php');
        exit;
    }

    $name=$row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $address=$row["address"];

}else{
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];

    do{
          if(empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage='All filds are required';
            break;
          }

          $sql= "UPDATE clients".
          "SET name='$name', email='$email', phone='$phone', address='$address' ".
          "WHERE id= $id";

          $result=$connection->query($sql);

          if(!$result){
            $errorMessage="invalid query: ".$connection->error;
            break;
          }
          $successMessage='clients updated successfully';
          header("location:/PHPWORK/index.php");
          exit;
    }while(true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
</head>
<body>
    <div class="container"> 
        <h2>new client </h2>

        <?php
           if(!empty($errorMessage)){
               echo "
                  <div role='alert'>
                     <strong>$errorMessage</strong>
                     <button type='button' ></button>
                  </div>
               ";
           }
        ?>
        <form method='POST'>
            <input type='hidden' name='id' value='<?php echo $id?>'/>
            <div>
                <label for="name">Name</label>
                <div>
                    <input type='text' name="name" value='<?php echo $name; ?>'/>
                </div>
            </div>
            <div>
                <label for="email">Email</label>
                <div>
                    <input type='text' name="email" value='<?php echo $email; ?>'/>
                </div>
            </div>
            <div>
                <label for="phone">Phone</label>
                <div>
                    <input type='text' name="phone" value='<?php echo $phone; ?>'/>
                </div>
            </div>
            <div>
                <label for="address">Address</label>
                <div>
                    <input type='text' name="address" value='<?php echo $address; ?>'/>
                </div>
            </div>

               <?php
                     if(!empty($successMessage)){
                        echo "
                           <div role='alert'>
                           <strong>$successMessage</strong>
                           <button type='button' ></button>
                           </div>
                        ";

                     }
               ?>

            <div>
                <div>
                    <button type='submit'>Submit</button>
                </div>
                <div>
                    <a href='/phpwork/index.php' role='button'>Cancel</a>
                </div>
            </div>
         </form>
    </div>
</body>
</html>