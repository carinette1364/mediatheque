<?php
include 'config/config.php';

if (isConnect()) {
    header('location:index.php');
    die;
}


?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <h1 class="text-center">Connection</h1>
    <!-- <?php
            //  echo password_hash('azerty', PASSWORD_DEFAULT);
            ?> -->
    <div class="container">
        <form action="<?= URL_ADMIN ?>action.php" method="POST">
            <div class="mb-3">
                <label for="mail" class="form-label">Email :</label>
                <input type="email" class="form-control" name='mail' id="mail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Password</label>
                <input type="password" class="form-control" name='mot_de_passe' id="mot_de_passe">
            </div>
            <div class="mb-3 text-center">
                <input type="submit" name="btn_connect" class="btn btn-primary" value="connection">
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>