<?php

$pdo = new PDO('mysql:host=localhost;port=3308;dbname=cafe2', 'root', 'jymn@123');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM partybooking ORDER BY date DESC');
$statement->execute();
// $statement2 = $pdo->prepare('SELECT * FROM ');
// $statement2->execute();
// $orders = $statement2->fetchAll(PDO::FETCH_ASSOC); 
$bookings = $statement->fetchAll(PDO::FETCH_ASSOC); //fetch as an associative array

$checker = 0;


$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['adminemail'];
    $password = $_POST['adminpassword'];





    if (!$email) {
        $errors[] = 'You have not entered the email';
    }
    if (!$password) {
        $errors[] = 'you have not entered the password';
    }

    if (empty($errors)) {
        $sql =  $pdo->prepare("SELECT * FROM admin WHERE email='$email' AND password='$password'");
        $sql->execute();
        $admin = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (count($admin)) {
            $checker = 1;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>admin view</title>
</head>

<body>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger text-center pt-5">
            <?php foreach ($errors as $error) : ?>
                <div>
                    <h2><?php echo $error ?></h2>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <?php if ($checker) : ?>
        <div class="container header">
            <div class="row">
                <div class="col-6"> <h1>Here's the Reservations</h1></div>
                <div class="col-6"><h2>admin : <?php echo $email ?></h2></div>
            </div>
           
            <table class="table my-3">
                <thead>
                    <tr>
                        <th scope="col">
                            <h2>#</h2>
                        </th>
                        <th scope="col">
                            <h2>phno</h2>
                        </th>
                        <th scope="col">
                            <h2>notb</h2>
                        </th>
                        <th scope="col">
                            <h2>date</h2>
                        </th>
                        <th scope="col">
                            <h2>cake included</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
            foreach ($bookings as $i => $booking) { ?>
                <tr>
                    <th scope="row"><h4><?php echo $i + 1 ?></h4></th>
                    
                    <td><h4><?php echo $booking['phno'] ?></h4></td>
                    <td><h4><?php echo $booking['notb'] ?></h4></td>
                    <td><h4><?php echo $booking['date'] ?></h4></td>
                    <td>
                        <h4><?php echo $booking['cake'] ? 'yes' : 'No' ?></h4>
                    </td>
                </tr>
            <?php  } ?>

                </tbody>
            </table>
        </div>

        <div class="header container text-center">
            
            <a href="index.html" class="btn btn-warning">Log out</a>
            <a href="receiveCoffe.php" class="btn btn-warning">See coffe orders</a>
        </div>
    <?php endif; ?>

    <?php if (!$checker and empty($errors)) : ?>
        <div class="header container">
            <h1>admin not detected</h1>
        </div>
    <?php endif; ?>

</body>

</html>