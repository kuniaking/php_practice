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
ショップ管理トップメニュー<br />
<br />
<a href="../staff/staff_list.php">スタッフ管理</a><br />
<br />
<a href="../product/pro_list.php">商品管理</a><br />
<br />
<a href="staff_logout.php">ログアウト</a><br />

</body>

</html>