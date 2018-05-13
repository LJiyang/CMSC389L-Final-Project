<?php
    require_once("support.php");

    $body = <<<EOBODY
   
        <form action="{$_SERVER['PHP_SELF']}" method="post">
         <fieldset>
            <legend>Log In:</legend>
            <label for="email"><strong>Email:</strong></label>
            <input id="email" type="email" name="email" size="25" required />
            <br/><br/>

            <label for="password"><strong>Password: </strong></label>
            <input id="password" type="password" name="password" required/>
            <br/><br/>
            </fieldset>
            <input id="submitData" type="submit" name="updateInfo" value="Submit"/>
            <br/>
        </form>
        <form action="https://s3.amazonaws.com/cmsc389l-ljy1995-final-project/index.html">
            <input id="return" type="submit" name="return" value="Return to main menu"/>
        </form>

EOBODY;

    session_start();
    $host = "finalprojectdb.clwzmsqlbcep.us-east-1.rds.amazonaws.com";
    $user = "root";
    $password = "helloWorld";
    $database = "finalProjectdb";
    // $host = "localhost";
    // $user = "ljy1995";
    // $password = "goodbyeWorld";
    // $database = "matched";
    $db = connectToDB($host, $user, $password, $database);

    if(isset($_POST['updateInfo'])){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $sqlQuery = "select * from person where email='{$email}'";
        $result = mysqli_query($db, $sqlQuery);
        if ($result) {
            $numberOfRows = mysqli_num_rows($result);
            if ($numberOfRows == 0) {
                $body .= "<h2>Account Does Exist!</h2>";
            } else {
                if ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($password !== $recordArray['password']) {
                        $body .= "<h2>Password incorrect!</h2>";
                    } else {
                        $_SESSION["name"] = $recordArray['name'];
                        $_SESSION["email"] = $email;
                        $_SESSION["phone"] = $recordArray['phone'];
                        $_SESSION["password"] = $password;
                        $_SESSION["age"] = $recordArray['age'];
                        $_SESSION["gender"] = $recordArray['gender'];
                        $_SESSION["pet"] = $recordArray['pet'];
                        $_SESSION["noise"] = $recordArray['noise'];
                        header('Location: updateInfo.php');
                    }
                }
            }
            mysqli_free_result($result);
        }  else {
            $body = "Retrieving records failed.".mysqli_error($db);
        }

        /* Closing */
        mysqli_close($db);
    }

    $page = generatePage($body, "Login");
    echo $page;
    
    function connectToDB($host, $user, $password, $database) {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n".mysqli_connect_error();
            exit();
        }
        return $db;
    }

?>
