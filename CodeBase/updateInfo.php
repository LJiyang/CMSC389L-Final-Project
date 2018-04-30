<?php
    require_once("support.php");

    session_start();
    $first_name = $_SESSION["first_name"];
    $last_name = $_SESSION["last_name"];
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];
    $age = $_SESSION["age"];
    $major = $_SESSION["major"];
    $gender = $_SESSION["gender"];
    $language = $_SESSION["language"];
    $county = $_SESSION["county"];
    $hobby = $_SESSION["hobby"];
    $approval = $_SESSION["approval_rating"];
    
    \\\\\\\\\\\\
    $body = <<<EOBODY
            <form action="{$_SERVER['PHP_SELF']}" method="post">
                <label for="name"><strong>Name:</strong></label>
                <input id="name" type="text" name="name" size="25" value=$name required/>
                <br/><br/>
                <label for="email"><strong>Email:</strong></label>
                <input id="email" type="email" name="email" value=$email size="25"/ required>
                <br/><br/>
                <label for="GPA"><strong>GPA:</strong></label>
                <input id="gpa" type="text" name="gpa" value=$gpa size="25"/ required>
                <br/><br/>
EOBODY;

    $body .= "<label><strong>Year:</strong></label>";
    $years = array(10, 11, 12);
    foreach ($years as $i) {
        if ($i === $year){
            $body .= <<<EOBODY
            <input type="radio" name="year" id=$i value=$i checked/>
            <label for=$i>$i</label>
EOBODY;
        } else {
            $body .= <<<EOBODY
            <input type="radio" name="year" id=$i value=$i/>
            <label for=$i>$i</label>
EOBODY;
        }
    }
    $body .= "<br/><br/><label><strong>Gender:</strong></label>";

    if ($gender === 'M') {
        $body .=<<<EOBODY
                <input type="radio" name="gender" id="M" value="M" checked/>
                <label for="M">M</label>

                <input type="radio" name="gender" id="F" value="F" />
                <label for="F">F</label>
                <br/><br/>
EOBODY;
    } else {
        $body .=<<<EOBODY
            <input type="radio" name="gender" id="M" value="M"/>
            <label for="M">M</label>

            <input type="radio" name="gender" id="F" value="F" checked/>
            <label for="F">F</label>
            <br/><br/>
EOBODY;
    }

    $body .= <<<EOBODY
        <label for="password"><strong>Password: </strong></label>
        <input id="password" type="password" value=$password name="password"/>
        <br/><br/>
        <label for="verifyPassword"><strong>Verify Password: </strong></label>
        <input id="verifyPassword" type="password" value=$password name="verifyPassword"/>
        <br/><br/>
        <input id="submitData" type="submit" name="submitData" value="Submit Data"/>
            <br/><br/>
        </form>
        <form action="main.html">
            <input id="return" type="submit" name="return" value="Return to main menu"/>
        </form>
EOBODY;

    if (isset($_POST["submitData"])) {
        if(isset($_POST["gender"]) and isset($_POST["year"])){
            $password = trim($_POST["password"]);
            $verifyPassword = trim($_POST["verifyPassword"]);
            $gpa = floatval($_POST['gpa']);
            if ($gpa !== $_POST['gpa'] and ($gpa > 4 or $gpa < 0)) {
                $body .="GPA is not correct!";
            }
        	else if ($password === $verifyPassword){
        	    $_SESSION["name"] = trim($_POST['name']);
        	    $_SESSION["email"] = trim($_POST['email']);
        	    $_SESSION["gpa"] = trim($_POST['gpa']);
        	    $_SESSION["year"] = $_POST['year'];
        	    $_SESSION["gender"] = $_POST['gender'];
        	    $_SESSION["password"] = $password;
        	    header("Location: updateDB.php");
            } else{
                $body .= "<br/><strong>password is not correct!</strong><br />";
            }
        }
    }
    $page = generatePage($body, "Submit Application");
    echo $page;

?>
