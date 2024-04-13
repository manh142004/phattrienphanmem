<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1>Already Logout</h1>
                <h3>Goodbye !!!</h3>
                <a class="btn btn-primary" href="/Asm2_SDLC/login.php">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if (isset($_SESSION[""]) && $_SESSION[""]) {
    session_destroy();
}