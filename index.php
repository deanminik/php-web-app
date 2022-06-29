<?php
session_start();

if ($_POST) { //Is there a sending? Yes, ok do this

    if ($_POST['user'] == 'admin' && $_POST['password'] == 'admin') {
        $_SESSION['user'] = $_POST['user'];
        echo "Login successful";
        header('Location: sections/index.php'); // redirect to this view 
    } else {
        $message = "Incorrect user";
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- <form action="sections/index.php" method="POST"> -->
                <form action="" method="POST">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Sign in
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($message)) {
                                    // Is message has something, then print this
                                    echo $message;
                                }

                                ?>
                                <br>
                                <div class="mb-3">
                                    <label for="" class="form-label">User</label>
                                    <input type="text" class="form-control" name="user" id="user" aria-describedby="helpId" placeholder="Add your user">

                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Add your password">

                                </div>
                                <button type="submit" class="btn btn-primary" href="#" role="button">Start session</button>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>