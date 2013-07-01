<? include 'init.php';
include 'header.php';
?>
    <h1>Главная</h1>


    <div class='containerForBlogs'>
        <ul class="containerPosts">
            <?
            $query = mysql_query("SELECT * FROM `posts`");
            while ($row = mysql_fetch_array($query)) {?>

                <li class="itemPost border_box box_shadow box_round" id="<?=$row[0];?>">
                    <div class="title d_i border_box ">
                        <a href="post.php?id=<?=$row[0];?>" class="a_under box_transition c_grey"><span><?=$row[2]?></span></a>
                    </div>
                    <div class="info d_i border_box">
                        <!-- user_query -->
                        <?
                        $userQuery = mysql_query("SELECT login, id, name FROM `users` WHERE id = '$row[4]'");
                        $user = mysql_fetch_array($userQuery);
                        ?>
                        <img alt="<?=$user[2];?>" title="<?=$user[2];?>" src="http://lurkmore.so/images/8/8a/Smile.svg" width="30" height="30"/>
                        <span class="c_grey"> <b id="<?=$user[1];?>"><?=$user[0]?></b> </span>
                        <!-- user_query -->
                        <span class="c_grey"> <?=$row[3]?> </span>
                    </div>
                    <div class="text d_i border_box">
                        <p>
                            <?=$row[6]?>
                        </p>
                    </div>
                    <div class="voteInfo d_i border_box c_grey">
                        <i class="icon-thumbs-up pointer" id="<?=$row[0];?>"></i> <b class="counterVote pointer"><?=$row[5]?></b> <i id="<?=$row[0];?>" class="icon-thumbs-down"></i>
                        <!-- comments_query -->
                        <?
                        $commentsQuery = mysql_query("SELECT COUNT(`id`) FROM `comments` WHERE post_id = '$row[0]'");
                        $comments = mysql_fetch_array($commentsQuery);
                        ?>
                        <i class="icon-comment"></i> <b><?=$comments[0];?></b> комментариев
                        <!-- comments_query -->
                    </div>
                </li>

            <?}?>

        </ul>
    </div>

<? include 'footer.php';?>