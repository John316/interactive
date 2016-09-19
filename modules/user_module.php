<?php
require_once 'db/connectmysql.php';
class User{
		private $id;
		private $login;
		private $password;
		private $group_id;
		private $email;
		private $group_name;
		private $org_name;
		private $avatar_extension;

    function __construct(){
        $connect = new ConnectMysql();
        $connect->Connect();
    }
    function getLastId(){
        $last = mysql_query("SELECT MAX(`id`) FROM `user` ") or die(mysql_error());
        $lastId = mysql_fetch_row($last);
        $resolt = $lastId[0];
        return $resolt;
    }
    function AddUser($id_group, $login, $password, $orgName, $email, $avatar_extension){
		$query = mysql_query("INSERT INTO `user` (id_group, Login, Password, org_name, Email, avatar_extension, status) VALUES ( $id_group, '$login', '$password', '$orgName', '$email', '$avatar_extension', 0)")
        or die(mysql_error());
        $queryid = mysql_insert_id();
        return $queryid;
        header('Location: ?url=view');
	}
	function UpdateUser($id, $id_group, $login, $password, $orgName, $email, $avatar_extension){
		$userupdate = "UPDATE user SET id_group = $id_group, Login = '$login', Password = '$password', org_name='$orgName', Email = '$email', avatar_extension = '$avatar_extension' WHERE id=$id ";
		mysql_query($userupdate) or die(mysql_error());
        header('Location: ?url=view');
	}
  function SelectUser ($id){
		$selectuser = "SELECT * FROM user WHERE id=$id ";
        //$selectuser = "SELECT consumer.id_group, consumer.Login, cconsumer.Password, cconsumer.Email, consumerc.account_expired, consumer.avatar_extension group.Name AS group_name FROM consumer WHERE consumer.id=$id INNER JOIN group ON group.id = consumer.group_id ";
		$user_row = mysql_query($selectuser) or die(mysql_error());
		$row = mysql_fetch_assoc($user_row);
		return $row;
    header("Refresh: 3");
	}
	function IsUserAvailable ($login, $password){
		$selectuser = "SELECT id FROM user WHERE Login='$login' AND  Password = '$password' AND status = 1";
        //$selectuser = "SELECT consumer.id_group, consumer.Login, cconsumer.Password, cconsumer.Email, consumerc.account_expired, consumer.avatar_extension group.Name AS group_name FROM consumer WHERE consumer.id=$id INNER JOIN group ON group.id = consumer.group_id ";
		$user_row = mysql_query($selectuser) or die(mysql_error());
		return mysql_fetch_assoc($user_row);
	}
  function SelectAllUser ($order){
		$selectuser = "SELECT * FROM user ORDER BY `$order` ASC LIMIT 0 , 30";
		$user_row = mysql_query($selectuser) or die(mysql_error());
		return $user_row;

	}
    function CountUser (){
		$selectuser = "SELECT COUNT(*) FROM user";
		$user_row = mysql_query($selectuser) or die(mysql_error());
		$result = mysql_fetch_row($user_row);
		return $result;
	}
    function NavigationUser ($order, $start, $num, $group){
		if($group < 1){
		  $selectuser = "SELECT * FROM user ORDER BY `$order` ASC LIMIT $start, $num";
		}else{
		  $selectuser = "SELECT * FROM user WHERE id_group = $group ORDER BY `$order` ASC LIMIT $start, $num";
		}
		$user_row = mysql_query($selectuser) or die(mysql_error());
		return $user_row;
        header("Refresh: 3");
	}
    function DeleteUser ($id){
        $selectuser = "SELECT avatar_extension FROM `user` WHERE id = $id";
		$user_row = mysql_query($selectuser) or die(mysql_error());
        $row = mysql_fetch_assoc($user_row);
		$ava = $row['avatar_extension'];

        $deluser = "DELETE FROM user WHERE id = $id";
		$user_del = mysql_query($deluser) or die(mysql_error());
		return $ava;
        //header('Location: index.php?url=view');
        //exit;
	}
	function getUserInfo($id){
		$getUser = new User();
		$UserInfo = $getUser->SelectUser($id);
		$id = $this->id;
		$login = $this->login;
		$orgName = $this->org_name;
		$password = $this->password;
		$group_id = $this->group_id;
		$group_name = $this->group_name;
		$avatar_extension = $this->avatar_extension;
	}
}
class Group {
    function __construct(){
        $connect = new ConnectMysql();
        $connect->Connect();
    }
    function AddGroup($name){
		$query = mysql_query("INSERT INTO `group` (`Name`) VALUES ('$name');")
        or die(mysql_error());
    $massege = $query;
    return $massege;
	}
  function SelectGroup ($id){
		$selectuser = "SELECT Name FROM `group` WHERE id=$id ";
		$user_row = mysql_query($selectuser) or die(mysql_error());
		$row = mysql_fetch_assoc($user_row);
		$GName = $row['Name'];
    return $GName;
    header("Refresh: 3");
	}
    function SelectAllGroup ($order){
		$selectuser = "SELECT * FROM  `group` ORDER BY `$order` ASC LIMIT 0 , 30";
		$user_row = mysql_query($selectuser) or die(mysql_error());
		return $user_row;
    header("Refresh: 3");
	}
    function CountGroup (){
		$selectuser = "SELECT COUNT(*) FROM `group`";
		$user_row = mysql_query($selectuser) or die(mysql_error());
		$result = mysql_fetch_row($user_row);
		return $result;
	}
  function NavigationGroup ($order, $start, $num){
    $selectuser = "SELECT * FROM `group` ORDER BY `$order` ASC LIMIT $start, $num";
		$user_row = mysql_query($selectuser) or die(mysql_error());
    return $user_row;
	}
  function DeleteGroup ($id){
		$deluser = "DELETE FROM `group` WHERE id = $id";
		$user_del = mysql_query($deluser) or die(mysql_error());
    header('Location: ?url=viewgr');
    return $user_del;
	}
  function UpdateGroup($id, $name){
		$userupdate = "UPDATE `group` SET Name = '$name' WHERE id=$id ";
		mysql_query($userupdate) or die(mysql_error());
    header('Location: ?url=viewgr');
    exit;
	}
}
?>
