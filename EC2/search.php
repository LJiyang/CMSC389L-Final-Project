<?php
    require_once("support.php");

    $body = <<<EOBODY
        <h1>Search</h1>
        <form action="{$_SERVER['PHP_SELF']}" method="post">
            <fieldset>
                <legend>Account:</legend>
                <h3>Please provide your account information for search</h3>
                <label for="email"><strong>Email:</strong></label>
                <input id="email" type="email" name="email" size="25" maxlength="100"/ required>
                <br/><br/>
                <label for="password"><strong>Password: </strong></label>
                <input id="password" type="password" name="password" maxlength="20" size="25"/>
                <br/><br/>
            </legend>
            </fieldset>
                

            <fieldset>
                <legend>Conditions:</legend>
                <label ><strong>Age:</strong></label>
                <input id="age_floor" type="text" name="floor" size="2" / required>
                <label> - </label>
                <input id="age_ceil" type="text" name="ceiling" size="2" / required>
                <br/><br/>

                <label><strong>Gender:</strong></label>
                <input type="radio" name="gender" id="M" value="M" checked/>
                <label for="M">M</label>

                <input type="radio" name="gender" id="F" value="F" />
                <label for="F">F</label>
                <br/><br/>

                <label><strong>With Pet:</strong></label>
                <input type="radio" name="pet" id="dog" value="dog" checked/>
                <label for="dog">dog</label>

                <input type="radio" name="pet" id="cat" value="cat" />
                <label for="cat">cat</label>

                <input type="radio" name="pet" id="no" value="no pet" />
                <label for="no">No Pet</label>
                <br/><br/>

                <label><strong>Noise Level: (1 represents very quiet)</strong></label>
                <input type="radio" name="noise" id="1" value="1" checked/>
                <label for="1">1</label>

                <input type="radio" name="noise" id="2" value="2" />
                <label for="2">2</label>

                <input type="radio" name="noise" id="3" value="3" />
                <label for="3">3</label>
                <br/><br/>
            </legend>
            </fieldset>

            <input id="submitData" type="submit" name="search" value="Submit Data"/>
            <br/><br/>
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

    if(isset($_POST['search'])){

        $email = trim($_POST['email']);
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
                        $_SESSION["email"] = $email;
                        $_SESSION["gender"] = $_POST['gender'];
                        $_SESSION["age_floor"] = $_POST['floor'];
                        $_SESSION["age_ceiling"] = $_POST['ceiling'];
                        $_SESSION["pet"] = $_POST['pet'];
                        $_SESSION["noise"] = $_POST['noise'];
                        header('Location: searchData.php');
                    }
                }
            }
        }  else {
            $body = "Retrieving records failed.".mysqli_error($db);
        }
        mysqli_close($db);
    }

    $page = generatePage($body, "Search");
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