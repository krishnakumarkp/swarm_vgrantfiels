<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Admin Page</h2>

        <?php
            if(isset($homeUrl)) {
                echo '<a href="'.$homeUrl.'">Back</a><br/>';
            }
            if(isset($logoutUrl)) {
                echo '<a href="'.$logoutUrl.'">Logout</a><br/>';
            }
        ?>
        <br>
        <?php echo $content_for_layout; ?>
    </body>
</html>