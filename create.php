<?php

$servername="localhost";
$username="root";
$passward="";
$database="myshop";

//create connection
$connection=new mysqli($servername,$username,$passward,$database);

$name='';
$email='';
$phone='';
$address='';

$errorMessage='';
$successMessage='';

//cheak data has been transmited using post mehod or not
if($_SERVER['REQUEST_METHOD']=='POST'){
    //initilise data from the from in variables
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];

    //cheak weather we don't have empty filds
    do{
        if(empty($name) ||empty($email) || empty($phone) || empty($address)){
            $errorMessage="All filds are require";
            break;
        }

        //add client to database

        $sql="INSERT INTO clients(name,email,phone,address)".
                  "VALUES ('$name','$email','$phone','$address')";
        $result=$connection->query($sql);
        
        if(!$result){
            $errorMessage="Invalid query: ". $connection->error;
            break;
        }

        $name='';
        $email='';
        $phone='';
        $address='';
        
        $successMessage="client added correctly";

        header("location:/phpwork/index.php");
        exit;
        
    } while(false);

}
print $errorMessage;
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