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
    $pro_code = $_POST['code'];
    echo $pro_code;
    $pro_gazou_name=$_POST['gazou_name'];

    $dbh = getdbh();

    $sql = 'DELETE FROM mst_product WHERE code=?';
    $stmt = $dbh -> prepare($sql);
    $data[] = $pro_code;
    $stmt -> execute($data);

    $dbh = null;

    if($pro_gazou_name !=  '')
    {
        unlink('./gazou/'.$pro_gazou_name);
    }

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

削除しました。<br />
<br />
<a href="pro_list.php">戻る</a>

</body>

</html>