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
    $staff_code=$_GET['staffcode'];

    $dbh = getdbh();
    $sql = 'SELECT name FROM mst_staff WHERE code=?';
    $stmt  = $dbh->prepare($sql);
    $data[]=$staff_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $staff_name=$rec['name'];

    $dbh = null;

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>
スタッフ削除<br />
<br />
スタッフコード<br />
<?php print $staff_code; ?>
<br />
<?php print $staff_name; ?>
<br />
このスタッフを削除してよろしいですか？<br />
<br />
<form method="post" action="staff_delete_done.php">
<input type="hidden" name="code" value="<?php print $staff_code; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>

</html>