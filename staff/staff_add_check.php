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

$post=  sanitize( $_POST );
$staff_name=$post['name'];
$staff_pass=$post['pass'];
$staff_pass2=$post['pass2'];

if($staff_name=='')
{
    print'スタッフ名が入力されてません。<br />';
}
else
{
    print'スタッフ名:';
    print $staff_name;
    print'<br />';
}

if($staff_pass==''){
    print'パスワードが入力されていません。<br />';
}

if($staff_pass!=$staff_pass2)
{
    print'パスワードが一致しません。<br />';
}

if($staff_name==''|| $staff_pass==''|| $staff_pass!=$staff_pass2)
{
    print'<form>';
    print'<input type="button" onclick="history.back()" value="戻る">';
    print'</form>';
}
else
{
    $staff_pass=md5($staff_pass);
    print'<form method="post" action="staff_add_done 2.php">';
    print'<input type="hidden" name="name" value="'.$staff_name.'">';
    print'<input type="hidden" name="pass" value="'.$staff_pass.'">';
    print'<br />';
    print'<input type="button" onclick="history.back()" value="戻る">';
    print'<input type="submit" value="OK">';
    print'</form>';
}

?>

</body>

</html>