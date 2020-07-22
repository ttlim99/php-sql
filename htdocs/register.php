<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <?php 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require('../mysqli_connect.php');

            $errors = array(); 

            if (empty($_POST['first_name'])) {
                $errors[] = 'No first name entered'; 
            } else { 
                $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
            }

            if (empty($_POST['last_name'])) {
                $errors[] = 'No last name entered'; 
            } else {
                $ln =  mysqli_real_escape_string($dbc, trim($_POST['last_name'])); 
            }

            if (empty($_POST['email'])) {
                $errors[] = 'No email entered'; 
            } else {
                $e =  mysqli_real_escape_string($dbc, trim($_POST['email'])); 
            }
            
            if (empty($_POST['pass1'])) {
                $errors[] = 'No pass entered';
            } else {
                if ($_POST['pass1'] == $_POST['pass2']) {
                    $pass =  mysqli_real_escape_string($dbc, trim($_POST['pass']));
                } else {
                    $errors[] = 'Password does not match'; 
                }
            }





            if (empty($errors)) {
                $q = "INSERT INTO people (first_name, last_name, email, pass) VALUES ('$fn', '$ln', '$email', SHA1('$pass'));";
                $r = @mysqli_query($dbc, $q); 

                if ($r) {
                    echo "You have registed successfully";
                } else {
                    echo mysqli_error($dbc);
                
                }

                mysqli_close($dbc);
                exit(); 

            
            } else {
                echo "<h1>Error</h1> 
                <p> The following error(s) occurred:<br>";

                foreach ($errors as $error) {
                    echo " - $error<br>\n"; 
                }
            }


        }



    

    



    ?>

    <form action="register.php" method="POST"> 

        <p>First name: <input type="text" name="first_name" maxlength="20" value="<?php 
            if (isset($_POST['first_name'])) echo $_POST['first_name']
        ?>"></p>
        <p>Last name: <input type="text" name="last_name" value="<?php 
            if (isset($_POST['last_name'])) echo $_POST['last_name']
        ?>"></p>
        <p>Email: <input type="text" name="email" value="<?php
            if (isset($_POST['email'])) echo $_POST['email']
        ?>"></p>

         <p>Password: <input type="password" name="pass1" value="<?php
            if (isset($_POST['pass1'])) echo $_POST['pass1'];
         ?>"></p>

         <p>Confirm password: <input type="password" name="pass2" value="<?php
            if (isset($_POST['pass2'])) echo $_POST['pass2']; 
        ?>"></p>

        <p><input type="submit" name="submit" value="Register"></p>
</form>  
</body>
</html>

