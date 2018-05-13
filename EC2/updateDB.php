<?php
    require_once("support.php");

    session_start();
    // $host = "localhost";
    // $user = "ljy1995";
    // $password = "goodbyeWorld";
    // $database = "matched";
    $host = "finalprojectdb.clwzmsqlbcep.us-east-1.rds.amazonaws.com";
    $user = "root";
    $password = "helloWorld";
    $database = "finalProjectdb";
    $db = connectToDB($host, $user, $password, $database);

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $phone = $_POST['phoneFirstPart'].'-'.$_POST['phoneSecondPart'].'-'.$_POST['phoneThirdPart'];
    $age = intval($_POST['age']);
    $gender = $_POST['gender'];
    $pet = $_POST['pet'];
    $noise = intval($_POST['noise']);
    $password = $_POST['password'];

    $sqlQuery = "update person set phone='{$phone}',";
    $sqlQuery .= "age='{$age}', gender='{$gender}', pet='{$pet}', noise = '{$noise}', ";
    $sqlQuery .= "password='{$password}' where email='{$email}';";
    $result = mysqli_query($db, $sqlQuery);
    if ($result) {
        $body = <<<EOBODY
                <h3>The following entry has been added to the database</h3>
                <p><strong>Name: </strong>$name</p>
                <p><strong>Email: </strong>$email</p>
                <p><strong>Phone: </strong>$phone</p>
                <p><strong>Age: </strong>$age</p>
                <p><strong>Gender: </strong>$gender</p>
                <p><strong>Pet: </strong>$pet</p>
                <p><strong>Noise: </strong>$noise</p>
                <form action="https://s3.amazonaws.com/cmsc389l-ljy1995-final-project/index.html">
                    <input id="return" type="submit" name="return" value="Return to main menu"/>
                </form>
EOBODY;
        echo generatePage($body, "Submit Success");
    } else {
        $body = "Update records failed.".mysqli_error($db);
        echo generatePage($body, "Submit Fail");
    }


    mysqli_close($db);

    function connectToDB($host, $user, $password, $database) {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n".mysqli_connect_error();
            exit();
        }
        return $db;
    }
?>