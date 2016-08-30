<?php 
//require_once('controlers/edituser.php');

    // Добавление абонента
    if($url == 'adduser'){ 
    $select_all_group = new Group();
    $groups = $select_all_group->SelectAllGroup('Name');
    
        ?>
        <form enctype="multipart/form-data" action="index.php?url=add" method="POST">
            
            <label for="login">Логин</label>
            <input type="text" name="login"/><br />
           
            <label for="password">Пароль</label>
            <input type="password" name="password" /><br />
            
            <label for="email">E-mail</label>
            <input type="email" name="email" /><br />
            
            <label for="date">Date</label>
            <input type="date" name="date" /><br />
            <br />
            <select name="id_group" size="1">
                <?php
                while($row = mysql_fetch_assoc($groups)){ ?>
                <option value="<? echo $row['id']; ?>"><? echo $row['Name']; ?></option>
               <?php } ?>
            </select>
            Отправить этот файл: <input name="myfile" type="file" /><br />
            <input type="submit" value="Добавить клиента" />
        </form>
        <?php 
    }
    
    // Обновление абонента
    if($url == 'update'){ 
        $select = new User;
        $user = $select->SelectUser($id);
        // get selected group
        $group_id = $user['id_group'];
        $selGroup = new Group;
        $user_group = $selGroup->SelectGroup($group_id);
        $allGroups = $selGroup->SelectAllGroup('id');
        ?>
    <img  src="<? echo $user['avatar_extension']; ?>" width="200px"/>
    <form enctype="multipart/form-data" action="index.php?url=up&id=<?echo $id;?>" method="POST">
        
        <label for="login">Логин update</label>
        <input type="text" name="login" value="<? echo $user['Login']; ?>" /><br />
       
        <label for="password">Пароль</label>
        <input type="password" name="password" value="<? echo $user['Password']; ?>" /><br />
        
        <label for="email">E-mail</label>
        <input type="email" name="email" value="<? echo $user['Email']; ?>" /><br />
        
        <label for="date">Date</label>
        <input type="date" name="date" value="<? echo $user['account_expired']; ?>" /><br />
        <br />
        <label for="id_group">Группа: </label>
        <select name="id_group" size="1">
            <option selected="selected" value="<? echo $group_id; ?>"><? echo $user_group; ?></option>
            <?php
            while($row_gr = mysql_fetch_assoc($allGroups)){ ?>
            <option value="<? echo $row_gr['id']; ?>"><? echo $row_gr['Name']; ?></option>
           <?php } ?>
        </select><br /><br />
        <input type="hidden" name="image" value="<? echo $user['avatar_extension']; ?>" />
        Отправить картинку файл: <input type='file' name='myfile' id='myfile' class='input'/><br />
        <input type="submit" value="Обновить клиента" />
    </form>
        
    <? } 
    
    // Добавление группы
    if($url == 'addgr'){ ?>
       
       <form enctype="multipart/form-data" action="index.php?url=addgroup" method="POST">
            <label for="name">Название групы</label>
            <input type="text" name="name"/><br />
            <input type="submit" value="Добавить группу" />
        </form>
 
    <? }
    
    // Обновление группы
    if($url == 'updategr'){
        $id = strip_tags($_GET['id']);
       $group1 = new Group;
       $grName = $group1->SelectGroup($id);
        ?>
       <form enctype="multipart/form-data" action="index.php?url=upgroup" method="POST">
            <label for="name">Название групы</label>
            <input type="text" name="name" value="<? echo $grName; ?>"/><br />
            <input type="hidden" name="id" value="<? echo $id; ?>"/>
            <input type="submit" value="Обновить группу" />
        </form>
 
    <? }
    
?>