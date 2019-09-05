<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root .'/common/common.php');
loginCheck('member');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ろくまる農園</title>
</head>

<body>

<?php

try
{


    $post= sanitize( $_POST );
    $staff_name = $post['name'];
    $staff_pass = $post['pass'];

    // $staff_name = htmlspecialchars($staff_name);
    // $staff_pass = htmlspecialchars($staff_pass);

    $dbh = getdbh();
    $sql = 'INSERT INTO mst_staff(name,password) VALUES (?,?)';
    $stmt = $dbh -> prepare($sql);
    $data[] = $staff_name;
    $data[] = $staff_pass;

    $stmt->execute($data);

    $dbh = null;

    print $staff_name;
    print  'さんを追加しました。<br />';

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    echo $e->getMessage();
    exit();
}

?>

<a href="staff_list.php">戻る</a>

</body>

</html>