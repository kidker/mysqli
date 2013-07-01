<? include 'init.php';
include 'header.php';
?>
<h1>Главная</h1>

    <div class='containerForBlogs'>
        <ul class="containerPosts">
            <?
            if (isset($_GET['id'])){
                $result = new Result(
                    $mysqli,
                    array('i', sanitize($_GET['id'])),
                    array('id', 'cat_id', 'name', 'date', 'author_id', 'count', 'text'),
                    "SELECT * FROM `posts` WHERE `cat_id` = ?"
                );
            }else{
                $result = new Result(
                    $mysqli,
                    array(),
                    array('id', 'cat_id', 'name', 'date', 'author_id', 'count', 'text'),
                    "SELECT * FROM `posts`"
                );
            }

            $posts = $result->getResult();

            for ($i=0;$i < count($posts);$i++){ ?>

                <li class="itemPost border_box box_shadow box_round" id="<?=$posts[$i]['id'];?>">
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
                        <span class="c_grey"> <b id="<?=$userInfo[0]['id'];;?>"><?=$userInfo[0]['login'];?></b> </span>
                        <!-- user_query -->
                        <span class="c_grey"> <?=$posts[$i]['date'];?> </span>
                    </div>
                    <div class="text d_i border_box">
                        <p>
                            <?=$posts[$i]['text'];?>
                        </p>
                    </div>
                    <div class="voteInfo d_i border_box c_grey" id="<?=$posts[$i]['id'];?>" u_id="<?=$_SESSION['user_id'];?>">
                        <?
                            if (isset($_SESSION)){
                                //Сделаем проверку на голосование
                                $userResult = new Result(
                                    $mysqli,
                                    array('ii', $_SESSION['user_id'], $posts[$i]['id']),
                                    array('count'),
                                    "SELECT COUNT(`id`) FROM `votes` WHERE u_id = ? AND post_id = ?"
                                );
                                $voteInfo = $userResult->getResult();
                                if ($voteInfo[0]['count'] == 1){?>
                                    <i class="icon-thumbs-up" title="Вы уже голосовали!"></i> <b class="counterVote"><?=$posts[$i]['count'];?></b> <i title="Вы уже голосовали!" class="icon-thumbs-down"></i>
                                <?}else{?>
                                    <i class="icon-thumbs-up pointer" title="Голосовать!"></i> <b class="counterVote"><?=$posts[$i]['count'];?></b> <i title="Голосовать!" class="icon-thumbs-down pointer"></i>
                                <?}
                            }else{?>
                                <i class="icon-thumbs-up" title="Авторизуйтесь, чтобы голосовать"></i> <b class="counterVote"><?=$posts[$i]['count'];?></b> <i title="Авторизуйтесь, чтобы голосовать" class="icon-thumbs-down"></i>
                            <?}?>

                        <!-- comments_query -->
                        <?
                            $commentsResult = new Result(
                                $mysqli,
                                array('i', $posts[$i]['id']),
                                array('count'),
                                "SELECT COUNT(`id`) FROM `comments` WHERE post_id = ?"
                            );
                            $comments = $commentsResult->getResult();
                        ?>
                        <i class="icon-comment"></i> <b><?=$comments[0]['count'];?></b> комментариев
                        <!-- comments_query -->
                    </div>
                </li>


            <?}?>

        </ul>
    </div>

<? include 'footer.php';?>