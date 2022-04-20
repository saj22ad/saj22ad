<?php

error_reporting (~E_ALL);
if (isset($_POST)){
    if (is_null($_POST['firstname'])||is_null($_POST['lastname'])||is_null($_POST['phone'])||is_null($_POST['email'])){

    }else{
        $path='upload/';
        $path .= $_FILES['file']['name'];
        if (move_uploaded_file($_FILES['file']['tmp_name'],$path)){

        }
        $link = mysqli_connect('localhost:3306',"root","");
        mysqli_select_db($link,'data');
        $name =$_POST['firstname'];
        $last =$_POST['lastname'];
        $phone =$_POST['phone'];
        $email =$_POST['email'];
        $file = $_FILES['file']['name'];
        $SQL = "insert into project (fname,lastName,phone,email,img) value ('{$name}','{$last}','{$phone}','{$email}','{$file}')";
        if ($result = mysqli_query($link,$SQL)){
            echo "send to server:)";
            ?><a href="index.php">Back To Home Page</a>
<?php
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Phone Book</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<h3>Add Phone Book:</h3>

<div class="container">
    <form action="/Add.php" method="post"enctype="multipart/form-data">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your name.." required>
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
        <label for="tel">Number Phone</label>
        <input type="text" id="tel" name="phone" placeholder="Your last name.." required>
        <label for="email">Email </label>
        <input type="text" id="email" name="email" placeholder="Your last name.." required>
        <label for="file">File</label>
        <input type="file" id="file" name="file" accept=".image/jpeg,.jpg,.png" required>

        <input type="submit" value="Submit" class="btn">
    </form>
</div>

</body>
</html>
<?php
header('localhost: /');
?>
