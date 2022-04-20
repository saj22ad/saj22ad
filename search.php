<?php
error_reporting (~E_ALL);
$link = mysqli_connect('localhost:3306',"root","");
mysqli_select_db($link,'data');
$SQL = 'select * from project';

if ($resalt= mysqli_query($link,$SQL)){
    $user=mysqli_fetch_all($resalt);
    $s =$_GET['search'];

foreach ($user as $keys) {
    if (in_array($_POST['search'], $keys)) {
        header('location: /search.php?search=' . $s);

    } else {

    }
}
    if ($_POST['sort']=='sort'){
        sort($user);
        $number1 = 'selected';
    }else{
        rsort($user);
        $number ='selected';
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search For "<?=$s ?>"</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css.css">
</head>
<body>
<h2>Search For "<?=$s ?>"</h2>
<form action="search.php?search=<?=$s ?>" method="get">

    <input name="search" type="text" id="myInput" placeholder="Search for names..." title="Type in a name"><a href="index.php" style="margin-left: -31px;margin-right: 17px;text-decoration: none;color: rgba(79,79,79,0.93);font-size: 20px;font-weight: bold">&times;</a>
    <select name="sort" class="select">
        <option <?=$number1  ?> >sort</option>
        <option <?=$number  ?> >rsort</option>
    </select>
    <button class="btn">search</button>

        <a class="btn" style="color: aliceblue;font-weight: normal;text-decoration: none;padding: 13px 41px;" href="login.php">+New</a>


</form>

<table id="myTable">
    <tr class="header">
        <th style="width:10%;">Image</th>
        <th style="width:15%;">FirstName</th>
        <th style="width:15%;">LastName</th>
        <th style="width:15%;">Email</th>
        <th style="width:15%;">Phone</th>
        <th style="width:10%;">...</th>
    </tr>

    <?php for ( $i = 0 ; $i <= count($user)-1 ; $i++){
        if ($user[$i][0]==$s){

        ?>
        <tr>
            <td><img style="width: 30%" src="upload\<?=$user[$i][5] ?>"></td>
            <td><?= $user[$i][0] ?></td>
            <td><?= $user[$i][2] ?></td>
            <td><?= $user[$i][3] ?></td>
            <td><?= $user[$i][4] ?></td>
            <td><a style="margin-right: 10px" href="/edit.php?id=<?= $user[$i][1] ?>">&ange;</a><a href="/delete.php?id=<?=$user[$i][1]?>">&times;</a></td>
        </tr>


    <?php
        }else{
            ?>
    <?php
        }
    } ?>

</table>

</body>
</html>
