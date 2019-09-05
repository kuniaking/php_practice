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

$dbh  = getdbh();
var_dump($dbh);

try
{


    $sql = 'SELECT code,name FROM mst_staff WHERE 1';
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

    $dbh = null;

    print'スタッフ一覧<br /><br />';

    print'<form method="post" action="staff_branch.php">';
    while(true)
    {
        $rec =  $stmt -> fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
        print'<input type="radio" name="staffcode" value="'.$rec['code'].'">';
        print $rec['name'];
        print'</br>';
    }
    print'<input type="submit" name="disp" value="参照">';
    print'<input type="submit" name="add" value="追加">';
    print'<input type="submit" name="edit" value="修正">';
    print'<input type="submit" name="delete" value="削除">';
    print'</form>';
}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

<br />
<a href="../staff_login/staff_top.php">トップメニューへ</a><br />

</body>

</html>