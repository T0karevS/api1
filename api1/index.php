<?php
header("content-type: json/application");
require 'conn.php';
$posts = mysqli_query($connect, "SELECT * FROM `posts` ");
$postlist = [];
while($post = mysqli_fetch_assoc($posts))
{
    $postlist[] = $post;
}
$postlist1 = json_encode($postlist);
print_r($postlist1);