<? include 'init.php';

$login = $password = "";

if (isset($_POST)){
    $login = $_POST['login'];
    $password = $_POST['password'];

    $messError = "Заполните обязательные поля: ";
    $strError = "";
    if ($login == ''){ $strError .= "<strong>Логин</strong>"; }
    if ($password == ''){ $strError .= " <strong>Пароль</strong>";}

    if ($strError == ""){

        $checkLogin = login($login, $password, $mysqli);

        //print_r($checkLogin);

        if ($checkLogin === false){
            $strError = "<b>Логин Пароль</b>";
            $messError = "Проверьте правильность: ";
        }else{

            $_SESSION['login'] = $login;
            $_SESSION['user_id'] = $checkLogin;
            header('Location: main.php');
            exit();
        }
    }
}

?>
<? $page="login"; include 'header.php';?>

<h1>Войти на сайт</h1>
    <?if ($strError != ""){?>
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=$messError.$strError;?>
        </div>
    <?}?>
<div class="row">
    <div class="span3"></div>
    <div class="span6">
        <form class="form-horizontal" action="login.php" method="POST">
            <div class="control-group">
                <label class="control-label" for="inputLogin">Логин<sup><span class="text-error">*</span></sup></label>
                <div class="controls">
                    <input type="text" id="inputLogin" name="login" value="<?=$login;?>" placeholder="Введите логин">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Пароль<sup><span class="text-error">*</span></sup></label>
                <div class="controls">
                    <input type="password" id="inputPassword" name="password" value="<?=$password;?>" placeholder="Введите Пароль">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </div>
        </form>
    </div>
    <div class="span3"></div>
</div>

<? include 'footer.php';?>


