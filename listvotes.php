<? include 'init.php';
$page = 'votes';include 'header.php';

$result = new Result(
    $mysqli,
    array(),
    array('id', 'u_id', 'vote', 'post_id'),
    "SELECT * FROM `votes`"
);
$posts = $result->getResult();
?>
<h1>Список голосовавших</h1>

    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>u_id</th>
            <th>vote</th>
            <th>post_id</th>
        </tr>
        </thead>
        <tbody>

            <? for ($i=0;$i < count($posts);$i++){?>
            <tr>
                <td><?=$posts[$i]['id']?></td>
                <td><?=$posts[$i]['u_id']?></td>
                <td><?=$posts[$i]['vote']?></td>
                <td><?=$posts[$i]['post_id']?></td>
            </tr>
            <?}?>

        </tbody>


    </table>

<? include 'footer.php';?>