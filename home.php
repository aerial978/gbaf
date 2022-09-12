<?php

require('actions/signupAction.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Page home</h1>

<?php

if (isset($_SESSION['auth'])) {
    echo $_SESSION['firstname'];
    echo $_SESSION['lastname'];
}

?>
</body>
</html>
