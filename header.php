<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите ваш браузер</a> или расширьте возможности вашего <a href="http://www.google.com/chromeframe/?redirect=true">браузера</a></p>
<![endif]-->

<!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="main.php">Блоги</a>
            <div class="nav-collapse collapse">
                <ul class="nav">

                    <?if (!isset($_SESSION['login'])){?>
                        <li <?if($page == 'login'){?>class="active"<?}?>><a href="login.php">Авторизация</a></li>
                        <li <?if($page == 'register'){?>class="active"<?}?>><a href="register.php">Регистрация</a></li>
                    <?}else{?>
                        <li <?if($page == 'create'){?>class="active"<?}?>><a href="createPost.php">Создать</a></li>
                        <li <?if($page == 'votes'){?>class="active"<?}?>><a href="listvotes.php">Голосовавшие</a></li>
                    <?}?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?
                                //Выводим список категорий
                            $resultCat = new Result(
                                $mysqli,
                                array(),
                                array('id', 'name'),
                                "SELECT * FROM `category`"
                            );
                            $category = $resultCat->getResult();

                            for($i=0;$i<count($category);$i++){?>
                                <li><a href='main.php?id=<?=$category[$i]['id'];?>'><?=$category[$i]['name'];?></a></li>
                            <?}?>

                        </ul>
                    </li>
                </ul>
                <?if (isset($_SESSION['login'])){?>
                    <ul class="nav pull-right">
                        <li><a>Вы вошли как: <b><?=$_SESSION['login']?></b></a></li>
                        <li><a href="logout.php">Выйти</a></li>
                    </ul>
                <?}?>

            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">