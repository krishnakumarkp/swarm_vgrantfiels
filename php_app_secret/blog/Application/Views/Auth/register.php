<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="<?php echo $indexurl?>">Click here to go back</a><br/><br/>
        <?php 
            if(isset($errorMessage) && $errorMessage) {
                echo '<span style="color:red">',$errorMessage,'</span>';
            }
            if(isset($successMessage) && $successMessage) {
                echo '<span style="color:green">',$successMessage,'</span>';
            }
        ?>
        <form action="<?php echo $registerSave ?>" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> <br/>
           Enter password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>