<?php
    require_once("support.php");

    session_start();
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $phoneFirstPart = substr($_SESSION['phone'], 0, -9);
    $phoneSecondPart = substr($_SESSION['phone'], 4, -5);
    $phoneThirdPart = substr($_SESSION['phone'], 8, 12);
    $password = $_SESSION['password'];
    $age = intval($_SESSION['age']);
    $gender = $_SESSION['gender'];
    $pet = $_SESSION['pet'];
    $noise = intval($_SESSION['noise']);
    $body = <<<EOBODY
            <h1>Update</h1>
            <form action="updateDB.php" method="post">
            <fieldset>
            <legend>General Information:</legend>
                <label for="name"><strong>Name:</strong><p id="name" value=$name> $name</p></label>
                <label for="email"><strong>Email:</strong><p id="email" value=$email> $email</p></label>

                <label for="phoneFirstPart"><strong>Phone:</strong></label>
                <input id="phoneFirstPart" type="text" name="phoneFirstPart" value=$phoneFirstPart size="3" maxlength="3" required/>
                <label for="phoneSecondPart">-</label>
                <input id="phoneSecondPart" type="text" name="phoneSecondPart" value=$phoneSecondPart size="3" maxlength="3" required/>
                <label for="phoneThirdPart">-</label>
                <input id="phoneThirdPart" type="text" name="phoneThirdPart" value=$phoneThirdPart size="4" maxlength="4" required/>
                <br/><br/>
EOBODY;

    $body .= <<<EOBODY
        <label for="password"><strong>Password: </strong></label>
        <input id="password" type="password" value=$password name="password"/>
        <br/><br/>
        <label for="verifyPassword"><strong>Verify Password: </strong></label>
        <input id="verifyPassword" type="password" value=$password name="verifyPassword"/>
        <br/><br/>

        </fieldset>
EOBODY;

    $body .= "<fieldset>
            <legend>Personal Information:</legend>
            <label for='age'><strong>Age:</strong></label>
                <input id='age' type='number' name='age' min='1' max='125'  value=$age required/>
                <br/><br/><label><strong>Gender:</strong></label>";
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
EOBODY;
    }

    $body .= "<label><strong>With Pet:</strong></label>";
    $pets = array('dog', 'cat', 'noPet');
    foreach ($pets as $i) {
        if ($i === $pet){
            $body .= <<<EOBODY
            <input type="radio" name="pet" id=$i value=$i checked/>
            <label for=$i>$i</label>
EOBODY;
        } else {
            $body .= <<<EOBODY
            <input type="radio" name="pet" id=$i value=$i />
            <label for=$i>$i</label>
EOBODY;
        }
    }

    $body .= "<br/><br/><label><strong>Noise Level: (1 represents very quiet)</strong></label>";
    $noises = array(1, 2, 3);
    foreach ($noises as $i) {
        if ($i === $noise){
            $body .= <<<EOBODY
            <input type="radio" name="noise" id=$i value=$i checked/>
            <label for=$i>$i</label>
EOBODY;
        } else {
            $body .= <<<EOBODY
            <input type="radio" name="noise" id=$i value=$i />
            <label for=$i>$i</label>
            
EOBODY;
        }
    }
    $body .= <<<EOBODY
    </fieldset>
    <br/><br/>
            <input id="setup" type="submit" name="submitData" value="Submit" onclick="return dataValidation()"/>
            <br/><br/>
        </form>
        <form action="https://s3.amazonaws.com/cmsc389l-ljy1995-final-project/index.html">
            <input id="Return" type="submit" name="return" value="Return to main menu"/>
        </form>
EOBODY;

    $page = generateForm($body, "Update Personal Information");
    echo $page;

?>