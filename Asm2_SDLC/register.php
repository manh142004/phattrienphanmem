<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4 border border-warning bg-warning-subtle text-warning-emphasis shadow p-3 mb-5 bg-body-tertiary rounded" style="margin: 50px 20px;">
                <h1 class="text-center">Register</h1>
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <ion-icon name="person-add-outline"></ion-icon>
                        <input required type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <ion-icon name="key-outline"></ion-icon>
                        <input required type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <ion-icon name="mail-outline"></ion-icon>
                        <input required type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name:</label>
                        <ion-icon name="people-outline"></ion-icon>
                        <input required type="text" class="form-control" id="fullname" name="fullname">
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Register</button>
                    <div class="login-link ">
                    <p>Do you already have an account?<a class="link-warning" href="/Asm2_SDLC/login.php">Login</a></p>
                    </div>
                </form>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>

<script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" > </script> 
<script  nomodule  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" > </script>
</body>

</html>
<?php
try {
//Starts a session to store user information.
    session_start();
//Connect to the MySQL database
    $db = new PDO("mysql:host=localhost;dbname=academic_management", "root");
//Check if the user has entered a username
if (isset($_POST['username']) && $_POST['username']) {
    $username = $_POST['username'];
//Execute an SQL query
    $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';
    $statement = $db->prepare($sql);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo "<script>alert('Account $username has been already existed!!')</script>";
    }else{
        try {
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $sql = 'INSERT INTO users (username, password, email, fullname) VALUES (:username, :password, :email, :fullname)';
            $statement = $db->prepare($sql);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $statement->execute();
            $_SESSION["IS_LOGINED"] = true;
            $_SESSION[""] = "";
            $_SESSION["USERNAME"] = $username;
            $_SESSION["EMAIL"] = $email;
            $_SESSION["FULL_NAME"] = $fullname;
            echo "<script>alert('Register successfully!!')</script>";
            header("Location: index.php");
        } catch (Exception $th) {
            $err = $th->getMessage();
            echo "<script>alert('Register failed!! $err')</script>";
        }
        
    }

}
} catch (PDOException $e) {
    echo $e->getMessage();
}