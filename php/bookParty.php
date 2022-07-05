<?php

$pdo = new PDO('mysql:host=localhost;port=3308;dbname=cafe2', 'root', 'jymn@123');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$phno  = "";
$notb = "";
$date = "";


$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phno = $_POST['phno'];
    $notb = $_POST['notb'];
    $date = $_POST['date'];
    $cakeChecker = $_POST['cakeChecker'];
    $cake = 0;
    if ($cakeChecker === 'on') {
        $cake = 1;
    }



    if (!$phno) {
        $errors[] = 'phone no. is required';
    }
    if (!$notb) {
        $errors[] = 'no tb is required';
    }
    if (!$date) {
        $errors[] = 'date is required';
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO partybooking (id, phno, notb, cake, date) VALUES (NULL, :phno, :notb, :cake, :date)");
        $statement->bindValue(':phno', $phno);
        $statement->bindValue(':notb', $notb);
        $statement->bindValue(':cake', $cake);
        $statement->bindValue(':date', $date);
        $statement->execute();
    }
}
?>
<!-- 
INSERT INTO `partybooking` (`id`, `phno`, `notb`, `cake`, `date`) VALUES (NULL, '9329393293', '20', '0', '2021-04-19'); -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/style.css">
    <title>party booked</title>
</head>

<body>

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
        <?php exit; ?>
    <?php endif; ?>

    <div class="container header">
        <h1>Your Reservation Status</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <h2>#</h2>
                    </th>
                    <th scope="col">
                        <h2>phno
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
                <tr>
                    <th scope="row">
                        <h4>1</h4>
                    </th>
                    <td>
                        <h4><?php echo $phno; ?></h4>
                    </td>
                    <td>
                        <h4><?php echo $notb; ?></h4>
                    </td>
                    <td>
                        <h4><?php echo $date; ?></h4>
                    </td>
                    <td>
                        <h4><?php echo $cake ? 'yes' : 'No' ?></h4>
                    </td>
                </tr>



            </tbody>
        </table>
    </div>


    <div class="container header">
        <h1>Successfully reserved!!</h1>
    </div>

</body>

</html>