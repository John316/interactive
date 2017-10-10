    <?php
    // Добавление абонента
    if($url == 'adduser'){
    $select_all_group = new Group();
    $groups = $select_all_group->SelectAllGroup('Name'); ?>
    <h1>Регистрация</h1>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Регистрация нового администратора</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">
            <form enctype="multipart/form-data" action="index.php?url=add" method="POST">
              <div class="form-group">
                <label for="login">Login*</label>
                <input class="form-control" type="text" name="login"/>
              </div>
              <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" class="form-control" name="password" />
              </div>
              <div class="form-group">
                <label for="org_name">Название организации</label>
                <input class="form-control" type="text" name="org_name"/>
              </div>
              <div class="form-group">
                <label for="email">E-mail*</label>
                <input type="email" class="form-control" name="email" />
              </div>
              <div class="form-group">
                <label for="id_group">Select group*</label>
                <select name="id_group" class="form-control" id="id_group" size="1">
                    <?php
                    while($row = mysql_fetch_assoc($groups)){ ?>
                    <option value="<? echo $row['id']; ?>"><? echo $row['Name']; ?></option>
                   <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="file">Logo / Avatar:</label>
                 <input name="myfile" type="file" id="file" />
              </div>
              <input type="submit" class="btn btn-sm btn-default" value="Submit" />
            </form>
          </div>
        </div>
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
        <h1>Update</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Update user</h3>
            </div>
            <div class="panel-body">
              <img class="img-rounded" src="<? echo $user['avatar_extension']; ?>" width="200px"/>
              <br />
              <br />
              <form enctype="multipart/form-data" action="index.php?url=up&id=<?echo $id;?>" method="POST">
                <div class="form-group">
                  <label for="login">Login update</label>
                  <input type="text" class="form-control" name="login" value="<? echo $user['Login']; ?>" />
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" value="<? echo $user['Password']; ?>" />
                </div>
                <div class="form-group">
                  <label for="org_name">Название организации</label>
                  <input type="text" class="form-control" name="org_name" value="<? echo $user['org_name']; ?>" />
                </div>
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control" name="email" value="<? echo $user['Email']; ?>" />
                </div>
                <div class="form-group">
                  <label for="date">Date</label>
                  <input type="date" class="form-control" name="date" value="<? echo $user['account_expired']; ?>" />
                </div>
                <div class="form-group">
                  <label for="id_group">Group: </label>
                  <select class="form-control" name="id_group" size="1">
                      <option selected="selected" value="<? echo $group_id; ?>"><? echo $user_group; ?></option>
                      <?php
                      while($row_gr = mysql_fetch_assoc($allGroups)){ ?>
                      <option value="<? echo $row_gr['id']; ?>"><? echo $row_gr['Name']; ?></option>
                     <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="myfile">Attach avatar:</label>
                  <input type='file' name='myfile' id='myfile' class='input'/>
                  <input type="hidden" name="image" value="<? echo $user['avatar_extension']; ?>" />
                </div>
                  <input class="btn btn-sm btn-default" type="submit" value="Update" />
              </form>
            </div>
          </div>
    <? }

    // Добавление группы
    if($url == 'addgr'){ ?>
      <h1>Add</h1>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add group</h3>
        </div>
        <div class="panel-body">
          <p>
            Please enter name of group.
          </p>
          <form class="form-inline" enctype="multipart/form-data" action="index.php?url=addgroup" method="POST">
            <div class="form-group">
               <label for="name">Group name</label>
               <input class="form-control" type="text" name="name"/>
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
              <form class="form-inline" enctype="multipart/form-data" action="index.php?url=upgroup" method="POST">
                <div class="form-group">
                   <label for="name">Group name</label>
                   <input class="form-control" type="text" name="name" value="<? echo $grName; ?>"/><br />
                   <input type="hidden" name="id" value="<? echo $id; ?>"/>
                   <input type="submit" class="btn btn-sm btn-default" value="Update" />
                 </div>
               </form>
            </div>
          </div>
    <?php } ?>
  </div>
</div>
