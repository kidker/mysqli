<? include 'init.php';


    //1.Вывести пост
    //2.Вывести комментарии
    //3.Настроить форму отправки комментов через $.post


include 'header.php';?>
<h1>Пост</h1>
<?if (!isset($_GET["id"])){?>
    Упс!Проверьте привильность введеного вами адреса!
<?}else{?>

    <div class='containerForBlogs'>
        <ul class="containerPostsOnly">
            <?
            $result = new Result(
                $mysqli,
                array('i', sanitize($_GET['id'])),
                array('id', 'cat_id', 'name', 'date', 'author_id', 'count', 'text'),
                "SELECT * FROM `posts` WHERE `id` = ?"
            );
            $posts = $result->getResult();

            for ($i=0;$i < count($posts);$i++){ ?>

                <li class="itemPost border_box">
                    <div class="title d_i border_box ">
                        <a href="post.php?id=<?=$posts[$i]['id'];?>" class="a_under box_transition c_grey"><span><?=$posts[$i]['name'];?></span></a>
                    </div>
                    <div class="info d_i border_box">
                        <!-- user_query -->
                        <?
                            $userResult = new Result(
                                $mysqli,
                                array('i', $posts[$i]['author_id']),
                                array('login', 'id', 'name'),
                                "SELECT `login`, `id`, `name` FROM `users` WHERE id = ?"
                            );
                            $userInfo = $userResult->getResult();
                        ?>
                        <img alt="<?=$userInfo[0]['name'];?>" title="<?=$userInfo[0]['name'];?>" src="http://lurkmore.so/images/8/8a/Smile.svg" width="30" height="30"/>
                        <span class="c_grey"> <b id="<?=$userInfo[0]['id'];?>"><?=$userInfo[0]['login'];?></b> </span>
                        <!-- user_query -->
                        <span class="c_grey"> <?=$posts[$i]['date'];?> </span>  <i class="icon-thumbs-up"></i> <b><?=$posts[$i]['count'];?></b> <i class="icon-thumbs-down"></i>
                    </div>
                    <div class="text d_i border_box">
                        <p>
                            <?=$posts[$i]['text'];?>
                        </p>
                    </div>


                </li>

            <?}?>

        </ul>
    </div>



    <div class="wrapComments">
        <span>Комментарии:</span>
        <ul class="containerPostsOnly">
            <?
            //$post_id = $_GET['id'];
            $result = new Result(
                $mysqli,
                array('i', sanitize($_GET['id'])),
                array('id', 'author_id', 'text', 'date', 'count', 'post_id'),
                "SELECT * FROM `comments` WHERE `post_id` = ?"
            );
            $comments = $result->getResult();

            //$query = mysql_query("SELECT * FROM `comments` WHERE post_id = '$post_id'");
            //while ($row = mysql_fetch_array($query)) {
            for ($i=0, $j=count($comments);$i < $j;$i++){ ?>

                <li class="itemPost border_box commentsLi">

                    <div class="info d_i border_box">
                        <!-- user_query -->
                        <?
                            //$userQuery = mysql_query("SELECT login, id name FROM `users` WHERE id = '$row[1]'");
                            //$user = mysql_fetch_array($userQuery);
                            $userResult = new Result(
                                $mysqli,
                                array('i', $comments[$i]['author_id']),
                                array('login', 'id', 'name'),
                                "SELECT `login`, `id`, `name` FROM `users` WHERE id = ?"
                            );
                            $userInfo = $userResult->getResult();

                        ?>
                        <img alt="<?=$userInfo[0]['name'];?>" title="<?=$userInfo[0]['name'];?>" src="http://lurkmore.so/images/8/8a/Smile.svg" width="30" height="30"/>
                        <span class="c_grey"> <b id="<?=$userInfo[0]['id'];?>"><?=$userInfo[0]['login'];?></b> </span>
                        <!-- user_query -->
                        <span class="c_grey"> <?=$comments[$i]['date']?> </span>  <i class="icon-thumbs-up"></i> <b><?=$comments[$i]['count']?></b> <i class="icon-thumbs-down"></i>
                    </div>
                    <div class="text d_i border_box">
                        <p>
                            <?=$comments[$i]['text']?>
                        </p>
                    </div>
                    <div class="voteInfo d_i border_box c_grey">
                        <i class="icon-thumbs-up"></i> <b><?//=$row[5]?>007</b> <i class="icon-thumbs-down"></i>
                    </div>

                </li>

            <?}?>

        </ul>
        <form class="sendComment commentsLi border_box" action="#" method="POST">
            <textarea class="textareaStyle border_box" rows="" cols="" placeholder="Введите текст...."></textarea>
            <button class="sendButton" id=<?=$posts[0]['id'];?> u_id=<?=$_SESSION['user_id'];?>>Добавить комментарий</button>
        </form>
    </div>

<?}?>
<? include 'footer.php';?>
