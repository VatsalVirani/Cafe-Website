<?php

$pdo = new PDO('mysql:host=localhost;port=3308;dbname=cafe2', 'root', 'jymn@123');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM coffe_products ');
$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC); //fetch as an associative array

$checked = "";
$contact = "";
$total = 0;

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checked = $_POST['check_list'];
    $contact = $_POST['contact'];




    if (!$checked) {
        $errors[] = 'You dont have any product in the cart';
    }
    if (!$contact) {
        $errors[] = 'Contact is required for making a purchase';
    }

    if (empty($errors)) {

        foreach ($checked as $order) {
            $statement2 = $pdo->prepare("INSERT INTO coffeorders (phno,orderid) VALUES ('$contact','$order') ");
            $statement2->execute();
        }
        echo "<script> alert('successfully added to the cart')</script>";
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
    <title>Order a coffe</title>
</head>



<body>

    <div class="container header">
        <div class="row">
            <div class="col-8">
                <h1>Order Your favourite Coffe</h1>
            </div>

            <div class="col-4 text-center">
                <form action="cart.php" method="GET">
                  
                        <input type="text" name="phno" style="margin-left: 1rem;">

                        <button type="submit" class="btn btn-warning my-3 ">CheckOut</button>

                  



                </form>

            </div>
        </div>



        <div class="container header">
            <form action="" method="post">
                <div class="row">
                    <?php foreach ($products as $product) : ?>
                        <?php $total = $total + $product['price'];?>
                        <div class="col-sm">
                            <div class="thumbnail" style="margin-top: 40px;">
                                <img src="../<?php echo $product['img'] ?>" alt="" width="100%">
                            </div>
                            <div class="container header">
                                <h2><?php echo $product['name'] ?></h2>
                                <h2 style="color: green;"><?php echo $product['price'] ?> Rs.</h2>
                            </div>
                            <div class="container header">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="check_list[]" value="<?php echo $product['id'] ?>">
                                    <label class="form-check-label">
                                        <h4>Add to cart</h4>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-sm">
                        <div class="container header">


                            <label>
                                <h4>Contact:</h4>
                            </label>
                            <input type="text" name="contact">
                            <input type="submit" style="margin-top:20px;" class="btn btn-success" name="submit" value="Order" />

                        </div>
                    </div>
            </form>
        </div>






        <!-- INSERT INTO `coffe_products` (`id`, `name`, `price`, `img`) VALUES (NULL, 'decafe', '500', 'images/item1.jpg'), (NULL, 'capachino', '100', 'images/item2.jpg'), (NULL, 'la casa', '80', 'images/item3.jpg'); -->

        

</body>

</html>