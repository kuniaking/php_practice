<?php

function sanitize($before)
{
    foreach($before as $key => $value)
    {
        $after[$key] = htmlspecialchars($value);
    }
    return $after;
}

function getdbh()
{
    $dsn='mysql:dbname=shop;host=localhost';
    $user='root';
    $password='root';
    $dbh = new PDO($dsn,$user,$password);

    return $dbh;
}

function loginCheck($userType)
{
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
        {
            print'ログインされていません。<br />';
            if($userType=='staff')
            {
                print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
            }
            else
            {
                print'<a href="../member/member_login.html">ログイン画面へ</a>';
            }
            exit();
        }
    else
        {
            print $_SESSION['staff_name'];
            echo 'さんログイン中<br />';
            print'<br />';
        }
}

?>

