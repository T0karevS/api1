<?php
function getPosts($connect)
{
    $posts = mysqli_query($connect, "SELECT * FROM `posts` ");
    $postlist = [];
    while($post = mysqli_fetch_assoc($posts))
    {
        $postlist[] = $post;
    }
    $postlist1 = json_encode($postlist);
    print_r($postlist1);
}
function getPost($connect,$id)
{
    $post = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$id' ");
    if(mysqli_num_rows($post)===0)
    {
        http_response_code(404);
        $res = [
          "status" => false,
          "message" => "Post not found "
        ];
        echo  json_encode($res);
    }
    else
    {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }

}
function Givepost($connect)
{
    $a = $_POST['title'];
    $b = $_POST['body'];
    $post = mysqli_query($connect, "INSERT INTO `posts` (`title`, `body`) VALUES ('$a', '$b')");
    http_response_code(201);
    $res = [
        "status" => true,
        "post_id" => mysqli_insert_id($connect),
        "post_title" => $a,
        "post_content" => $b
    ];
    echo json_encode($res);
}
function DeletePost($connect, $id)
{
    $post = mysqli_query($connect, "DELETE FROM `posts` WHERE `id`='$id'");
    $res = [
        "status" => true,
        "deleted_post_id" => $id
    ];
    echo json_encode($res);
}
function PatchPost($connect, $id, $data)
{
    
    $title = $data['title'];
    $body = $data['body'];
    $post = mysqli_query($connect, "UPDATE `posts` SET `title`='$title',`body`='$body' WHERE `posts`.`id` = '$id'");
    http_response_code(201);
    $res = [
        "status" => true,
        "post_id" => $id,
        "post_patched_title" => $title,
        "post_patched_content" => $body
    ];
    echo json_encode($res);
}
// function PatchPost($connect, $id)
// {

//     $json = file_get_contents('php://input');
//     $json = json_decode($json, true);
//     $a = $json['title'];
//     $b = $json['body'];
//     $id = $json['id'];
//     $idExisting = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `posts` where `id`='$id'"));
//     if($idExisting==1)
//     {
//         $post = mysqli_query($connect, "UPDATE `posts` SET `title`='$a',`body`='$b' WHERE `id` = '$id'");
//         http_response_code(201);
//         $res = [
//             "status" => true,
//             "post_id" => $id,
//             "post_patched_title" => $a,
//             "post_patched_content" => $b
//         ];
//     }
//     elseif($idExisting==0)
//     {
//         $post = mysqli_query($connect, "INSERT INTO `posts` (`id`, `title`, `body`) VALUES ('$id', '$a', '$b')");
//         http_response_code(201);
//         $res = [
//             "status" => true,
//             "post_id" => $id,
//             "post_patched_title" => $a,
//             "post_patched_content" => $b
//         ];
//     }
//     echo json_encode($res);
// }