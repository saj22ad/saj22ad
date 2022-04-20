<?php
error_reporting (~E_ALL);
if (!isset($_GET['id'])){
    header("location: /");
}else{
    $link = mysqli_connect('localhost:3306',"root","");
    mysqli_select_db($link,'data');
    $stmt = mysqli_prepare($link,'select * from project where id = ?');
    $id = (int) $_GET['id'];
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows ==0){
        header("location: /");
        exit;
    }
    $user = mysqli_fetch_assoc($result);
//    if ($resalt= mysqli_query($link,$SQL)){
//    }
    if ($_SERVER['REQUEST_METHOD']=='POST' && !is_null($user)){
        $stmt = mysqli_prepare($link,'update project set fname=? ,lastName=?,phone=?,email=? where id=?');
        mysqli_stmt_bind_param($stmt,'ssssi',$_POST['firstname'],$_POST['lastname'],$_POST['phone'],$_POST['email'],$user['id']);
        mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($link)){
            header("location: /");
            return;
        }else{
            echo "no";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Phone Book</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<h3>Edit Phone Book:</h3>

<div class="container">
    <form action="/edit.php?id=<?= $user['id'] ?>" method="post">
        <label for="fname">First Name</label>
        <input type="text" value="<?= $user['fname'] ?>" id="fname" name="firstname" placeholder="Your name.." required>
        <label for="lname">Last Name</label>
        <input type="text" value="<?= $user['lastName'] ?>" id="lname" name="lastname" placeholder="Your last name.." required>
        <label for="tel">Number Phone</label>
        <input type="text" value="<?= $user['phone'] ?>" id="tel" name="phone" placeholder="Your last name.." required>
        <label for="email">Email </label>
        <input type="text" value="<?= $user['email'] ?>" id="email" name="email" placeholder="Your last name.." required>

        <input type="submit" value="Submit" class="btn">
    </form>
</div>

</body>
</html>

