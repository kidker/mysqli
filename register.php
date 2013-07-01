<? include 'init.php';?>
<?
    $login = "";
    $email = "";
    $name = "";
    $password = "";
    if (isset($_POST)){
        $login = $_POST['login'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $messError = "Заполните обязательные поля: ";
        $strError = "";

        if ($login == ''){ $strError .= "<strong>Логин</strong>"; }
        if ($email == ''){ $strError .= " <strong>E-mail</strong>"; }
        if ($name == '' ){ $strError .= " <strong>Имя</strong>";}
        if ($password == ''){ $strError .= " <strong>Пароль</strong>";}
        if (user_exist($login, $mysqli) === true){ $strError .= " Введите другой <strong>Логин</strong>";}

        if ($strError == ""){
            if (user_register($login, $email, $name, $password, $mysqli)){
                header('Location: login.php');
                exit();
            }
        }
    }
?>
<?$page="register"; include 'header.php';?>
<h1>Регистрация</h1>

<?if ($strError != ""){?>
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?=$messError.$strError;?>
    </div>
<?}?>

<div class="row">
    <div class="span3"></div>
    <div class="span6">
        <form class="form-horizontal" action="register.php" method="post">
            <div class="control-group">
                <label class="control-label" for="inputLogin">Логин<sup><span class="text-error">*</span></sup></label>
                <div class="controls">
                    <input type="text" id="inputLogin" name="login" value="<?=$login;?>" placeholder="Введите логин">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">E-mail<sup><span class="text-error">*</span></sup></label>
                <div class="controls">
                    <input type="text" id="inputEmail" name="email" value="<?=$email;?>" placeholder="Введите Email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputName">Имя<sup><span class="text-error">*</span></sup></label>
                <div class="controls">
                    <input type="text" id="inputName" name="name" value="<?=$name;?>" placeholder="Введите Имя">
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
                    <button type="submit" class="btn btn-primary">Зарегистрировать</button>
                </div>
            </div>
        </form>
    </div>
    <div class="span3"></div>
</div>

<? include 'footer.php';?>

