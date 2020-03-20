<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Login Page</h2>
        <a href="./index">Click here to go back</a><br/><br/>
        <?php 
        if($errorMessage) {
            echo '<span style="color:red">',$errorMessage,'</span>';
        }
        ?>
        <form action="<?php echo $loginurl?>" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> <br/>
           Enter password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Login"/>
        </form>
    </body>
</html>