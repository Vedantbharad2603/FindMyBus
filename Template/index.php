<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="../CSS/main.css">
        <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    </head>
    <body>
        <div class="login-box">
            <h1>Login</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" placeholder="Enter ID">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!(empty($_POST["id"]) && empty($_POST["password"]))) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "findmybus";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $id = $_POST['id'];
                $password = $_POST['password'];
                $query = "SELECT * FROM admin WHERE Id = '$id'";
                $result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $hashed_password = $row['Password'];
                    if (password_verify($password, $hashed_password)) {
                        header("Location: homepage.php");
                    } else {
                        header("Location: index.php");
                    }
                } else {
                    echo "User not found.";
                }
                $mysqli->close();
            }
        }
    }
?>