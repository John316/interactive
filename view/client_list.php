<span>Order by: </span><a href="index.php?url=view&order=id">ID</a> | <a href="index.php?url=view&order=login">Login</a>
 | <a href="index.php?url=view&order=email">Email</a> | <a href="index.php?url=view&order=group">Group</a>
<span>Фильтр</span>

    <?php
    $select_group = new Group();
    $groups = $select_group->SelectAllGroup('id');
    while($row = mysql_fetch_assoc($groups)){ ?>
    <a href="index.php?url=view&option=<? echo $row['id']; ?>"><? echo $row['Name']; ?></a>  
   <?php } ?>
    <a href="index.php?url=view&option=0">Снять фильтр</a>

<?php
//require ('controlers/edituser.php');
// Просмотр клиентов
    $order = strip_tags($_GET["order"]);
    if( $order == 'id'){
        $order = 'id';
    }elseif($order == 'login'){
        $order = 'Login';
    }elseif($order == 'email'){
        $order = 'Email';
    }elseif($order == 'group'){
        $order = 'id_group';
    }else{
        $order = 'id';
    }
    $select_list = new User();
    $list = $select_list->SelectAllUser($order);
    
        ?>
        <table>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Password</th>
            <th>Email</th>
            <th>Group</th>
            <th>Data</th>
            <th>Avatar</th>
            <th>Delete</th>
        </tr>
        <? 
 
$num = 5; // число абонентов на станице

$page = strip_tags($_GET['page']); 
$option_group = strip_tags($_GET["option"]);
if (!$page){
    $page = 0;
}
$post = new User();
$posts = $post->CountUser();
$total = intval(($posts[0] - 1) / $num) + 1; 
$page = intval($page); 
if(empty($page) or $page < 0) $page = 1; 
if($page > $total) $page = $total; 
$start = $page * $num - $num; 
$result1 = $post->NavigationUser($order, $start, $num, $option_group);

while($row1 = mysql_fetch_assoc($result1)){
        $id_user = $row1['id'];
        $group_id = $row1['id_group'];
        $group = $select_group->SelectGroup($group_id);
        $avatar = $row1['avatar_extension'];
        ?>
        
        <tr>
            <td><? echo $row1['id']; ?></td>
            <td><? echo "<a href='index.php?url=update&id=$id_user'>".$row1['Login'].'</a>'; ?></td>
            <td><? echo $row1['Password']; ?></td>
            <td><? echo $row1['Email']; ?></td>
            <td><? echo $group; ?></td>
            <td><? echo $row1['account_expired']; ?></td>
            <td><img src="<? echo $avatar;?>" width="50px"/></td>              
            <td><? echo "<a href='index.php?url=del&id=$id_user' onClick='window.location.reload( true );'>Del</a>"; ?></td>
        </tr>
        <?
        }
// Постраничный просмотр
if($page != 1) $pervpage = '<a href= ./index.php?url=view&page=1><<</a><a href= ./index.php?url=view&page='. ($page - 1) .'><</a> '; 
if($page != $total) $nextpage = ' <a href= ./index.php?url=view&page='. ($page + 1) .'>></a><a href= ./index.php?url=view&page=' .$total. '>>></a>'; 
if($page - 2 > 0) $page2left = ' <a href= ./index.php?url=view&page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; 
if($page - 1 > 0) $page1left = '<a href= ./index.php?url=view&page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
if($page + 2 <= $total) $page2right = ' | <a href= ./index.php?url=view&page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
if($page + 1 <= $total) $page1right = ' | <a href= ./index.php?url=view&page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

?>
        </table>
<? echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; ?>