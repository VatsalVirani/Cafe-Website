<?php

$phno = "";
$pdo = new PDO('mysql:host=localhost;port=3308;dbname=cafe2', 'root', 'jymn@123');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$total = 0;
$checker = 0;


if (isset($_POST['todelete'])) {
    $orderTodelete = $_POST['todelete'];
    $statement = $pdo->prepare("DELETE  FROM coffeorders  WHERE phno = '$orderTodelete' ");
    $statement->execute();
}

$errors = [];

if (empty($errors)) {
    $statement = $pdo->prepare("SELECT * FROM coffeorders JOIN coffe_products WHERE orderid = id ");
    $statement->execute();

    $orders = $statement->fetchAll(PDO::FETCH_ASSOC); //fetch as an associative array

    if (count($orders)) {
        $checker = 1;
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
    <link rel="stylesheet" href="./style.css">
    <title>Your order</title>
</head>

<body>
    <div class="container header">
        <h1>Your Coffe Orders</h1>
    </div>



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
                <div class="col-6">
                    <h1>Here's Your orders</h1>
                </div>
                <div class="col-6">
                    <h2>Contact : <?php echo $phno ?></h2>
                </div>
            </div>

            <table class="table my-3">
                <thead>
                    <tr>
                        <th scope="col">
                            <h2>#</h2>
                        </th>
                        <th scope="col">
                            <h2>Contact</h2>
                        </th>
                        <th scope="col">
                            <h2>name</h2>
                        </th>
                        <th scope="col">
                            <h2>price</h2>
                        </th>
                        <th scope="col">
                            <h2>action</h2>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $i => $order) { ?>

                        <tr>
                            <th scope="row">
                                <h4><?php echo $i + 1 ?></h4>
                            </th>
                            <td>
                                <h4><?php echo $order['phno'] ?></h4>
                            </td>
                            <td>
                                <h4><?php echo $order['name'] ?></h4>
                            </td>
                            <td>
                                <h4><?php echo $order['price'] ?></h4>
                            </td>
                            <td>
                                <form action="" method="POST">
                                    <button class="btn btn-warning" name="todelete" value="<?php echo $order['phno'] ?>">Served</button>
                                </form>
                            </td>

                        </tr>
                    <?php  } ?>


                </tbody>
            </table>
        </div>

        <div class="header container text-center">

            <a href="index.html" class="btn btn-warning">Confirm</a>
        </div>
    <?php endif; ?>

    <?php if (!$checker) : ?>
        <div class="header container text-center">
            <h4>You Have no orders :   ( try later</h4>
        </div>
    <?php endif; ?>

</body>

</html>