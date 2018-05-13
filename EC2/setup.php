<?php
    require_once("support.php");

    $body = <<<EOBODY
        <form action="submitDB.php" method="post">
            
            <fieldset>
                <legend>General Information:</legend>
                <p>
                    <label for="name"><strong>Name:</strong></label>
                    <input id="name" type="text" name="name" size="50" maxlength="50" required/>
                    <br/><br/>
                
                    <label for="email"><strong>Email:</strong></label>
                    <input id="email" type="email" name="email" size="25" maxlength="100"/ required>
                    <br/><br/>

                    <label for="phoneFirstPart"><strong>Phone:</strong></label>
                    <input id="phoneFirstPart" type="text" name="phoneFirstPart" size="3" maxlength="3" required/>
                    <label for="phoneSecondPart">-</label>
                    <input id="phoneSecondPart" type="text" name="phoneSecondPart" size="3" maxlength="3" required/>
                    <label for="phoneThirdPart">-</label>
                    <input id="phoneThirdPart" type="text" name="phoneThirdPart" size="4" maxlength="4" required/>
                    <br/><br/>
                
                    <label for="password"><strong>Password: </strong></label>
                    <input id="password" type="password" name="password" maxlength="20" size="25"/>
                    <br/><br/>

                    <label for="verifyPassword"><strong>Verify Password: </strong></label>
                    <input id="verifyPassword" type="password" name="verifyPassword" maxlength="20" size="25"/>
                    <br/><br/>
                </p>
            </fieldset>

            <fieldset>

                <legend>Personal Information:</legend>
                <p>
                    <label for="age">Age:</label>
                    <input id="age" type="number" name="age" min="1" max="125" required/>
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

                    <input type="radio" name="pet" id="no pet" value="no pet" />
                    <label for="no pet">No Pet</label>
                    <br/><br/>

                    <label><strong>Noise Level: (1 represents very quiet)</strong></label>
                    <input type="radio" name="noise" id="1" value="1" checked/>
                    <label for="1">1</label>

                    <input type="radio" name="noise" id="2" value="2" />
                    <label for="2">2</label>

                    <input type="radio" name="noise" id="3" value="3" />
                    <label for="3">3</label>
                </p>
            </fieldset>
            <br/>
            <input type="submit" id = "setup" value="Submit" onclick="return dataValidation()"/>
        </form>
        <br/>
        <form action="https://s3.amazonaws.com/cmsc389l-ljy1995-final-project/index.html">
            <input type="submit" id="Return" value="Return to main menu"/>
        </form>
EOBODY;

    $page = generateForm($body, "Application");
    echo $page;
?>