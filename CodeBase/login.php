<?php
    require_once("support.php");

    $body = <<<EOBODY
        <form action="{$_SERVER['PHP_SELF']}" method="post">
            <label for="email"><strong>Email associated with application:</strong></label>
            <input id="email" type="email" name="email" size="25"/ required>
            <br/><br/>

            <label for="password"><strong>Password associated with application: </strong></label>
            <input id="password" type="password" name="password"/>
            <br/><br/>

            <input id="submitData" type="submit" name="updateInfo" value="Submit"/>
            <br/><br/>
        </form>
        <form action="main.html">
            <input id="return" type="submit" name="return" value="Return to main menu"/>
        </form>
EOBODY;

    session_start();
    $table = "Person";
    $db = connectToDB();

    if(isset($_POST['updateInfo'])){

        $pdo = new PDO($dsn, $username, $password);

        $email = $_POST['email'];
        $password = $_POST['password'];
        $sqlQuery = "select * from $table where email='{$email}' and password='{$password}'";
        $result = pg_query($db, $sqlQuery);
        if ($result) {
            $numberOfRows = pg_num_rows($result);
            if ($numberOfRows == 0) {
                $body .= "<h2>Account Does Exist!</h2>";
            } else {
                while ($recordArray = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
                  $_SESSION["first_name"] = $recordArray['first_name'];
                  $_SESSION["last_name"] = $recordArray['last_name'];
                  $_SESSION["email"] = $recordArray['email'];
                  $_SESSION["password"] = $recordArray['password'];
                  $_SESSION["age"] = $recordArray['age'];
                  $_SESSION["major"] = $recordArray['major'];
                  $_SESSION["gender"] = $recordArray['gender'];
                  $_SESSION["language"] = $recordArray['language'];
                  $_SESSION["county"] = $recordArray['county'];
                  $_SESSION["hobby"] = $recordArray['hobby'];
                  $_SESSION["approval_rating"] = $recordArray['approval_rating'];
                  header('Location: updateInfo.php');
                }
            }
            mysqli_free_result($result);
        }  else {
            $body = "Retrieving records failed.".mysqli_error($db);
        }

        /* Closing */
        mysqli_close($db);
    }

    $page = generatePage($body, "Review Application");
    echo $page;

    function connectToDB() {
      // need change
        $connection_string = "host=sheep port=5432 dbname=test user=lamb password=bar";
        $db = mysqli_connect($host, $user, $password, $database);
        if ($db == FALSE) {
            echo "Connect failed.\n";
            exit();
        }
        return $db;
    }

?>
