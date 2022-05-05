<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');

require 'conn.php';
require 'function.php';
$method = $_SERVER['REQUEST_METHOD'];
$q = $_GET['q'];
$params = explode('/',$q);
$type = $params[0];
if (isset($params[1]))
{
    $id = $params[1];
}

if($method === 'GET')
{
    if($type === 'posts')
    {
        if(isset($id))
        {
            getPost($connect, $id);
        }
        else
        {
            getPosts($connect);
        }

    }
}
elseif ($method === 'POST')
{
    if($type === 'posts')
    {
        Givepost($connect);
    }
}
elseif ($method === 'DELETE')
{
    if($type === 'posts')
    {
        DeletePost($connect, $id);
    }
}
elseif ($method === "PATCH")
{
    if($type === 'posts')
    {
        PatchPost($connect, $id);
    }
}
elseif ($method === "PUT")
{
    if($type === 'posts')
    {
        PutPost($connect, $id);
    }
}
