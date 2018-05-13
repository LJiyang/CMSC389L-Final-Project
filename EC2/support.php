<?php

function generatePage($body, $title) {
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://s3.amazonaws.com/cmsc389l-ljy1995-final-project/background.css" />
        <title>$title</title>   
    </head>
            
    <body>
            $body
    </body>
</html>
EOPAGE;

    return $page;
}

function generateForm($body, $title){
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>$title</title>
        <script src="https://s3.amazonaws.com/cmsc389l-ljy1995-final-project/application.js"></script>
        <link rel="stylesheet" href="https://s3.amazonaws.com/cmsc389l-ljy1995-final-project/background.css" />
    </head>
            
    <body>
        $body
    </body>
</html>
EOPAGE;

    return $page;
}
?>
