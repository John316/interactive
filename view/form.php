<div class="row">
  <div class="col-md-12">
    <?php
    // Добавление абонента
    if($url == 'adduser'){
    $select_all_group = new Group();
    $groups = $select_all_group->SelectAllGroup('Name'); ?>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Add user</h3>
      </div>
      <div class="panel-body">
        <form enctype="multipart/form-data" action="index.php?url=add" method="POST">

            <label for="login">Login</label>
            <input type="text" name="login"/><br />

            <label for="password">Password</label>
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
            Attach avatar: <input name="myfile" type="file" /><br />
            <input type="submit" class="btn btn-sm btn-default" value="Submit" />
        </form>
      </div>
    </div>
<?php }

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
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Update user</h3>
            </div>
            <div class="panel-body">
              <img  src="<? echo $user['avatar_extension']; ?>" width="200px"/>
              <form enctype="multipart/form-data" action="index.php?url=up&id=<?echo $id;?>" method="POST">
                  <label for="login">Login update</label>
                  <input type="text" name="login" value="<? echo $user['Login']; ?>" /><br />

                  <label for="password">Password</label>
                  <input type="password" name="password" value="<? echo $user['Password']; ?>" /><br />

                  <label for="email">E-mail</label>
                  <input type="email" name="email" value="<? echo $user['Email']; ?>" /><br />

                  <label for="date">Date</label>
                  <input type="date" name="date" value="<? echo $user['account_expired']; ?>" /><br />
                  <br />
                  <label for="id_group">Group: </label>
                  <select name="id_group" size="1">
                      <option selected="selected" value="<? echo $group_id; ?>"><? echo $user_group; ?></option>
                      <?php
                      while($row_gr = mysql_fetch_assoc($allGroups)){ ?>
                      <option value="<? echo $row_gr['id']; ?>"><? echo $row_gr['Name']; ?></option>
                     <?php } ?>
                  </select><br /><br />
                  <input type="hidden" name="image" value="<? echo $user['avatar_extension']; ?>" />
                  Attach avatar: <input type='file' name='myfile' id='myfile' class='input'/><br />
                  <input type="submit" value="Update" />
              </form>
            </div>
          </div>
    <? }

    // Добавление группы
    if($url == 'addgr'){ ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add group</h3>
        </div>
        <div class="panel-body">
          <p>
            Please enter name of group.
          </p>
          <form enctype="multipart/form-data" action="index.php?url=addgroup" method="POST">
               <label for="name">Group name</label>
               <input type="text" name="name"/>
               <input type="submit" class="btn btn-sm btn-default" value="Add group" />
           </form>
        </div>
      </div>
    <? }

    // Обновление группы
    if($url == 'updategr'){
        $id = strip_tags($_GET['id']);
       $group1 = new Group;
       $grName = $group1->SelectGroup($id);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Update group</h3>
            </div>
            <div class="panel-body">
              <form enctype="multipart/form-data" action="index.php?url=upgroup" method="POST">
                   <label for="name">Group name</label>
                   <input type="text" name="name" value="<? echo $grName; ?>"/><br />
                   <input type="hidden" name="id" value="<? echo $id; ?>"/>
                   <input type="submit" value="Update" />
               </form>
            </div>
          </div>
    <?php } ?>
  </div>
</div>
