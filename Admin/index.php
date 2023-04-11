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
                <input type="text" name="id" id="id" placeholder="Enter ID" value="MA113666" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" value="MA113666VEDANT" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!(empty($_POST["id"]) && empty($_POST["password"]))) {
            require "../includeFiles/connections.php";
            $id = $_POST['id'];
            $password = $_POST['password'];
            $result = $pdo->query("SELECT * FROM admin WHERE Id = '$id'");
            if($result->rowCount()==1){
                $row = $result->fetch();
                if ($row['Password']==$password) {
                    if ($row['Roll']=='MAIN ADMIN') {
                        $_SESSION["SessUserID"]=$row["Id"];
                        $_SESSION["SessRoll"]='ADMIN';
                    }
                    elseif ($row['Roll']=='DEPO ADMIN') {
                        $_SESSION["SessUserID"]=$row["Id"];
                        $_SESSION["SessRoll"]='ADMIN';
                    }
                    // header("Location: homepage.php");
                    header("Location: ../Admin/adminHomepage.php");
                } else {
                    header("Location: login.php");
                }
            } else {
                echo "User not found.";
            }
            unset($pdo);
        }
    }
?>