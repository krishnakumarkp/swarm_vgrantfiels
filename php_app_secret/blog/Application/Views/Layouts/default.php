<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./public/css/blog.css">
        <title>My first PHP Website</title>
    </head>
    <body>
        <div class="header">
            <h2>Blog Name</h2>
        </div>
        <div class="row">
            <div class="leftcolumn">
                <?php echo $content_for_layout; ?>
            </div>
            <div class="rightcolumn">
                <div class="card">
                    <h2>About Me</h2>
                    <div class="fakeimg" style="height:100px;">Image</div>
                    <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
                </div>
                <div class="card">
                    <h3>Popular Post</h3>
                    <div class="fakeimg">Image</div><br>
                    <div class="fakeimg">Image</div><br>
                    <div class="fakeimg">Image</div>
                </div>
                <div class="card">
                    <h3>Follow Me</h3>
                    <p>Some text..</p>
                </div>
            </div>
        </div>
        <div class="footer">
            <h2>Footer</h2>
            <a href="auth"> Click here to login </a>
            <br>
            <a href="auth/register"> Click here to register </a>
        </div>
    </body>
</html>