    <h1>Groups list</h1>
    <!-- Сортировка -->
    <span>Order by: </span><a href="admin.php?url=viewgr&order=id">ID</a> | <a href="index.php?url=viewgr&order=name">Name</a>
    <?php
    //require_once ('controlers/edituser.php');
    // Просмотр групп
        $order = strip_tags($_GET["order"]);
        if (empty($order)){
            $order = 'id';
        }
        $select_group = new Group();
        $list = $select_group->SelectAllGroup($order);
        ?>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Delete</th>
            </tr>
            <?php
            $num = 3; // число групп на станице

            $page = strip_tags($_GET['page']);
            if (!$page){
                $page = 0;
            }
            $post = new Group();
            $posts = $post->CountGroup();
            $total = intval(($posts[0] - 1) / $num) + 1;
            $page = intval($page);
            if(empty($page) or $page < 0) $page = 1;
              if($page > $total) $page = $total;
            $start = $page * $num - $num;
            $result1 = $post->NavigationGroup($order, $start, $num);
            while($row1 = mysql_fetch_assoc($result1)){
                    $id_group = $row1['id'];
                    $name = $row1['Name'];
                    ?>
                    <tr>
                        <td><? echo $row1['id']; ?></td>
                        <td><? echo "<a href='admin.php?url=updategr&id=$id_group'>".$name.'</a>'; ?></td>
                        <td><? echo "<a href='admin.php?url=delgr&id=$id_group'>Del</a>"; ?></td>
                    </tr>
                    <?  } ?>
        </table>
      <? // Постраничный просмотр
      if($page != 1) $pervpage = '<a href= ./admin.php?url=viewgr&page=1><<</a><a href= ./index.php?url=viewgr&page='. ($page - 1) .'><</a> ';
      if($page != $total) $nextpage = ' <a href= ./admin.php?url=viewgr&page='. ($page + 1) .'>></a><a href= ./index.php?url=viewgr&page=' .$total. '>>></a>';
      if($page - 2 > 0) $page2left = ' <a href= ./admin.php?url=viewgr&page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
      if($page - 1 > 0) $page1left = '<a href= ./admin.php?url=view&page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
      if($page + 2 <= $total) $page2right = ' | <a href= ./admin.php?url=viewgr&page='. ($page + 2) .'>'. ($page + 2) .'</a>';
      if($page + 1 <= $total) $page1right = ' | <a href= ./admin.php?url=viewgr&page='. ($page + 1) .'>'. ($page + 1) .'</a>';

      ?>
              </table>
      <? echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; ?>
