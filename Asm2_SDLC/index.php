<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>User List</title>
</head>
<?php
session_start();
if (isset($_SESSION[""]) && $_SESSION["IS_LOGINED"]){
    echo "<script>alert('Hello ".$_SESSION["FULL_NAME"]."')</script>";
}else{
    header("Location: login.php");
}
// Kết nối với CSDL
$db = new PDO("mysql:host=localhost;dbname=academic_management", "root");
?>

<body>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 pb-3 text-center">
                <h1 class="">Danh sách người dùng</h1>

                <table class="table table-bordered mt-5">
                    <tr>
                        <th>ID</th>
                        <th>fullname</th>
                        <th>username</th>
                        <th>password</th>
                        <th>email</th>
                        <th>created at</th>
                    </tr>

                    <?php
                    try {

                        // Khai báo câu query
                        $query = "SELECT * FROM users";
                        // Thực thi câu query
                        $res = $db->query($query, PDO::FETCH_ASSOC);
                        // In ra kết quả
                        foreach ($res as $row) {
                            echo "<tr>";
                            echo "<td> " . $row['user_id'] . "</td>";
                            echo "<td> " . $row['fullname'] . "</td>";
                            echo "<td> " . $row['username'] . "</td>";                           
                            echo "<td> " . $row['password'] . "</td>";
                            echo "<td> " . $row['email'] . "</td>";
                            echo "<td> " . date("Y/m/d H:i",strtotime($row['created_at'])) . "</td>";
                            echo "</tr>";
                        }
                    } catch (\Throwable $th) {
                        echo "Error: " . $th->getLine() . " " . $th->getMessage();
                    }
                    ?>
                </table>
            </div>
            <div class="col-sm-2 float-right mt-2">
                    <a href="/demo/logout.php" class="btn btn-danger"> Logout </a>
            </div>
        </div>
    </div>

</body>

</html>

<style>
    th {
        text-transform: uppercase;

    }
</style>