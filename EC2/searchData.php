<?php
    require_once("support.php");

    $head = "<h1>Matched Persons</h1><br/><br/>";
    $host = "finalprojectdb.clwzmsqlbcep.us-east-1.rds.amazonaws.com";
    $user = "root";
    $password = "helloWorld";
    $database = "finalProjectdb";
    // $host = "localhost";
    // $user = "ljy1995";
    // $password = "goodbyeWorld";
    // $database = "matched";
    $db = connectToDB($host, $user, $password, $database);

    session_start();
    $email = trim($_SESSION['email']);
    $gender = $_SESSION['gender'];
    $age_floor = $_SESSION['age_floor'];
    $age_ceiling = $_SESSION['age_ceiling'];
    $pet = $_SESSION['pet'];
    $noise = intval($_SESSION['noise']);
    $sqlQuery = "select * from person where age >= '{$age_floor}' and age <='{$age_ceiling}' and pet = '{$pet}' and noise = '{$noise}' and email != '{$email}';";

    $result = mysqli_query($db, $sqlQuery);
    $fields = array('name', 'email', 'phone', 'age');
    if ($result) {
        $numberOfRows = mysqli_num_rows($result);
        if ($numberOfRows == 0) {
            $body = "<h2>People does not matched</h2>";
        } else {
            $table = '<table border="1"><thead><tr>';
            foreach($fields as $field){
                $table .= '<th>'.$field.'</th>';
            }
            $table .= '</tr></thead>';
            $table .= '<tbody>';
            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $table .= '<tr>';
                foreach($fields as $field){
                    if ($field === 'email'){
                        $email = $recordArray[$field];
                        $table .= '<td><a href="mailto:'.$email.'">'.$email.'</a></td>';
                    } else {
                        $table .= '<td>'.$recordArray[$field].'</td>';
                    }
                }
                $table .= '</tr>';
            }
            $table .= '</tbody></table><br/><br/>';
            mysqli_free_result($result);
            
            $body = $head.$table;
        }
    }  else {
        $body = "Retrieving records failed.".mysqli_error($db);
    }
    $return = <<<EOBODY
                      <form action="search.php">
                        <input id="return" type="submit" name="return" value="Do another search"/>
                      </form>
EOBODY;
    mysqli_close($db);
    $body = $body.$return;
    $page = generatePage($body, "Matched People");
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