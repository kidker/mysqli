<? include 'init.php';
$page = 'create';
include 'header.php';
?>
<h1>Создать</h1>

<form class="form-horizontal">
    <div class="control-group">
        <label class="control-label" for="inputSected">Категория</label>
        <div class="controls">
            <select id="inputSected" name="cat_id">
                <?
                //Выводим список категорий
                $query = mysql_query("SELECT * FROM `category`");
                while ($row = mysql_fetch_array($query)) {
                    echo "<option value='$row[0]'>$row[1]</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputName">Название</label>
        <div class="controls">
            <input type="text" id="inputName" name="name" placeholder="Название">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputDesc">Описание</label>
        <div class="controls">
            <textarea placeholder="Описание" name="desc" id="inputDesc" rows="3"></textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Войти</button>
        </div>
    </div>
</form>

<? include 'footer.php';?>

