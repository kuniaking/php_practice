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

$post=sanitize($_POST);
$pro_code=$post['code'];
$pro_name=$post['name'];
$pro_price=$post['price'];
$pro_gazou_name_old=$post['gazou_name_old'];
$pro_gazou=$_FILES['gazou'];

// $pro_code=htmlspecialchars($pro_code);
// $pro_name=htmlspecialchars($pro_name);
// $pro_price=htmlspecialchars($pro_price);

if($pro_name=='')
{
    print'商品名が入力されてません。<br />';
}
else
{
    print'商品名:';
    print $pro_name;
    print'<br />';
}

if(preg_match('/^[0-9]+$/',$pro_price)==0)
{
    print'価格をきちんと入力してください。<br />';
}
else
{
    print'価格：';
    print $pro_price;
    print'円 <br />';
}

if($pro_gazou['size'] > 0)
{
    if($pro_gazou['size'] > 1000000)
    {
        print'画像サイズが大き過ぎます';
    }
    else
    {
        move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
        print'<img src="./gazou/'.$pro_gazou['name'].'">';
        print'<br />';
    }
}

if($pro_name=='' || preg_match('/^[0-9]+$/',$pro_price)==0||$pro_gazou['size'] > 1000000)
{
    print'<form>';
    print'<input type="button" onclick="history.back()" value="戻る">';
    print'</form>';
}
else
{
    print'上記のように変更します。<br />';
    print'<form method="post" action="pro_edit_done.php">';
    print'<input type="hidden" name="code" value="'.$pro_code.'">';
    print'<input type="hidden" name="name" value="'.$pro_name.'">';
    print'<input type="hidden" name="price" value="'.$pro_price.'">';
    print'<input type="gazou_name_old" value="'.$pro_gazou_name_old.'">';
    print'<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
    print'<br />';
    print'<input type="button" onclick="history.back()" value="戻る">';
    print'<input type="submit" value="OK">';
    print'</form>';
}

?>

</body>

</html>