<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root .'/common/common.php');
loginCheck('staff');
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
    $staff_code = $_POST['code'];

    $dbh = getdbh();

    $sql = 'DELETE FROM mst_staff WHERE code=?';
    $stmt = $dbh -> prepare($sql);
    $data[] = $staff_code;
    $stmt -> execute($data);

    $dbh = null;

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

削除しました。<br />
<br />
<a href="staff_list.php">戻る</a>

</body>

</html>