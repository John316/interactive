<?php
//require_once('controlers/edituser.php');
function clear($info){
    $data = strip_tags(mysql_escape_string($info));
    return $data;
}

if($_POST){
    $login = clear($_POST['login']);
    $password = strip_tags($_POST['password']);
    $id_group = clear($_POST['id_group']);
    $name = clear($_POST['name']);
    $orgName = clear($_POST['org_name']);
    $email = clear($_POST['email']);
    $image = $_POST['image'];
    $name = $_POST['name'];

    if($image){
        //unlink($image);
    }
}
    $url = $_GET['url'];
    $status = $url;

    if($status == 'add'){
        $addNewUser = new User;
        $id_for_img = $addNewUser->getLastId() + 1;


        $img_name = $_FILES['myfile']['name'];
        $img_type = $_FILES['myfile']['type'];

        if($img_type == 'image/jpeg' or $img_type == 'image/jpg'){
            $img_type = '.jpg';
            $uploaddir = 'upload/consumer_avatar/';
            $apend=$id_for_img.$img_type;
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile);
        }else if($img_type == 'image/png'){
            $img_type = '.png';
            $uploaddir = 'upload/consumer_avatar/';
            $apend=$id_for_img.$img_type;
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile);

        }else{
            echo 'Not supported type.';
        }
        $avatar_extension = $uploadfile;
        $masid = $addNewUser->AddUser($id_group, $login, $password, $orgName, $email, $avatar_extension);
    }

    if($status == 'up'){
        $id = $_GET['id'];
        $UpdateUser = new User();

        $img_name = $_FILES['myfile']['name'];
        $img_type = $_FILES['myfile']['type'];
        $id_for_img = $id;
        if($img_name){
                if($img_type == 'image/jpeg' or $img_type == 'image/jpg'){
                $img_type = '.jpg';
                $uploaddir = 'upload/consumer_avatar/';
                $apend=$id_for_img.$img_type;
                $uploadfile = "$uploaddir$apend";
                move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile);
                $avatar_extension = $uploadfile;
            }else if($img_type == 'image/png'){
                $img_type = '.png';
                $uploaddir = 'upload/consumer_avatar/';
                $apend=$id_for_img.$img_type;
                $uploadfile = "$uploaddir$apend";
                move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile);
                $avatar_extension = $uploadfile;
            }else{
                echo 'Not supported type.';
            }
        }else{
            $avatar_extension = $image;
        }
        $UpdateUser->UpdateUser($id, $id_group, $login, $password, $orgName, $email, $avatar_extension);
    }
    if($status == 'del'){
        $deleteUser = new User();
        $ava_img = $deleteUser->DeleteUser($id);
        if($ava_img){
            unlink($ava_img);
        }
    }
    if($status == 'delgr'){
        $deleteUser = new Group();
        $massage = $deleteUser->DeleteGroup($id);
    }
    if($status == 'addgroup'){
        $addNewGroup = new Group();
        $massage = $addNewGroup->AddGroup($name);
    }
    if($status == 'upgroup'){
        $id = $_POST['id'];
        $upgr = new Group;
        $upgr->UpdateGroup($id, $name);
    }
?>
