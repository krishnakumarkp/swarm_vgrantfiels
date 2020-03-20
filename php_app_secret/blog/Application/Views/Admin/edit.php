<form action="../update" method="POST">
    Title: <input type="text" name="title" value="<?php echo $blog->title;?>"/> <br/>
    Description: <input type="text" name="description" value="<?php echo  $blog->description;?>"/> <br/>
    Details:  
    <textarea rows="4" cols="50" name="details">
<?php echo $blog->details;?>
    </textarea>
    <br/>
    Public post? <input type="checkbox" name="public[]" value="yes" <?php echo ( $blog->public=="yes" ? 'checked' : '');?>/> <br/>
    <input type="submit" value="Update Blog"/>
</form>
<h2 align="center">My list</h2>
<table border="1px" width="100%">
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date Posted</th>
        <th>Time Posted</th>
        <th>Date Edited</th>
        <th>Time Edited</th>
        <th>Public</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
<?php

if(is_array($blogs) && count($blogs) > 0) {
    foreach ($blogs as $row) {
            echo "<tr>";
            echo "<td>",$row->id,"</td>";
            echo "<td>",$row->title,"</td>";
            echo "<td>",$row->description,"</td>";
            echo "<td>",$row->date_posted,"</td>";
            echo "<td>",$row->time_posted,"</td>";
            echo "<td>",$row->date_edited,"</td>";
            echo "<td>",$row->time_edited,"</td>";
            echo "<td>",$row->public,"</td>";
            echo "<td>",'<a href="../edit/'.$row->id.'">Edit</a>',"</td>";
            echo "<td>",'<a href="../delete/'.$row->id.'">Delete</a>',"</td>";
            echo "</tr>";
    } 
}
?>
</table>