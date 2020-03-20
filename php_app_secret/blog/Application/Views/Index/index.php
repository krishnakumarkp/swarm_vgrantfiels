<?php
if(count($blogs) > 0) {
    foreach ($blogs as $blog) {
        echo '<div class="card">';
        echo '<h2>',$blog->title,'</h2>';
        echo '<h5>', $blog->description,', ', $blog->date_posted,'</h5>';
        //<div class="fakeimg" style="height:200px;">Image</div> 
        echo '<p>', $blog->details,'</p>';
        echo '</div>';
    } 
}
else {
    echo '<div class="card">';
    echo '<h5>', 'No blog posts found!','</h5>';
    echo '</div>'; 
}
?>