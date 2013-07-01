<? include 'init.php';

if (isset($_POST['id']) && isset($_POST['u_id'])){
    //$post_id = $_POST['id'];
    //$query = mysql_query(" UPDATE `posts` SET `count` = `count` + 1 WHERE id = '$post_id' ") or die(mysql_error());

    //Можно будет использовать multy_query
    new Result(
        $mysqli,
        array('i', sanitize($_POST['id'])),
        array(),
        "UPDATE `posts` SET `count` = `count` - 1 WHERE id = ?"
    );
    new Result(
        $mysqli,
        array('isi', sanitize($_POST['u_id']), '-', sanitize($_POST['id'])),
        array(),
        "INSERT INTO `votes` (`u_id`, `vote`, `post_id`) VALUES (?, ?, ?)"
    );


    return true;
}else{
    return false;
}

?>