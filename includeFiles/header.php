<head>
    <link rel="stylesheet" type="text/css" href="../CSS/main.css">
</head>
<header>
    <h1>Find My Bus</h1>
    <?php
        include_once "../includeFiles/connections.php";
        if(isset($_SESSION["SessUserID"])){
            $result = $pdo->query("SELECT * FROM admin WHERE Id = '{$_SESSION["SessUserID"]}'");
            $row = $result->fetch();
            if($result->rowCount()>0){
                if ($row['Roll']=='MAIN ADMIN' || $row['Roll']=='DEPO ADMIN'){
                    if ($row['Roll']=='MAIN ADMIN') {
                        $_SESSION["SessUserName"]=$row["FirstName"]." ".$row["LastName"];
                        ?>
                            <h3><?php echo("Nice to meet you! ". $_SESSION["SessUserName"])?></h3>
                        <?php
                        // print_r($_SESSION["SessUserName"]);
                    }
                    elseif ($row['Roll']=='DEPO ADMIN') {
                        $_SESSION["SessDepo"]=$row["FirstName"];
                        ?>
                            <h3><?php echo("HELLO! ".$_SESSION["SessDepo"])?></h3>
                        <?php
                        // print_r($_SESSION["SessDepo"]);
                    }
                    // header("Location: homepage.php");
                }
            }
        }
        else {
            ?>
            <nav>
                <ul>
                <li><a href="../Template/homepage.php">Home</a></li>
                <li><a href="../Template/routes.php">Routes</a></li>
                <li><a href="#">Tickets</a></li>
                <li><a href="#">About Us</a></li>
                </ul>
            </nav>
            <?php
            // header("Location: index.php");
        }
        
    ?>
    
</header>