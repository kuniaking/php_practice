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

    $post=sanitize($_POST);
    $pro_name = $post['name'];
    $pro_price = $post['price'];
    $pro_gazou_name = $post['gazou_name'];

    // $pro_name = htmlspecialchars($pro_name);
    // $pro_price = htmlspecialchars($pro_price);

    
    $dbh = getdbh();

    $sql = 'INSERT INTO mst_product(name,price,gazou) VALUES (?,?,?)';
    $stmt = $dbh -> prepare($sql);
    $data[] = $pro_name;
    $data[] = $pro_price;
    $data[] = $pro_gazou_name;

    $stmt -> execute($data);

    $dbh = null;

    print $pro_name;
    print  'を追加しました。<br />';

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

<a href="pro_list.php">戻る</a>

</body>

</html>