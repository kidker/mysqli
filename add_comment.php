<? include 'init.php';

if (isset($_POST['id']) && isset($_POST['text']) && isset($_POST['author_id']) ){
    /*
        $post_id = $_POST['id'];
        $query = mysql_query(" UPDATE `posts` SET `count` = `count` + 1 WHERE id = '$post_id' ") or die(mysql_error());
    */
    $id = sanitize($_POST['id']);
    $text = sanitize($_POST['text']);
    $author_id = sanitize($_POST['author_id']);
    $date = date('Y-m-d H:i:s');

    new Result(
        $mysqli,
        array('issi', $author_id, $text, $date, $id),
        array(''),
        "INSERT INTO `comments` (`author_id`, `text`, `date`, `post_id`) VALUES (?, ?, ?, ?)"
    );

    return true;
}else{
    return false;
}

?>