<?php
    session_start();
    session_regenerate_id(true);
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
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once($root .'/common/common.php');

try
{


$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

print $onamae.'様<br />';
print'ご注文ありがとうございました。<br />';
print $email.'にメールを送りましたのでご確認ください。<br />';
print'商品は以下の住所に発送させていただきます。<br />';
print $postal1.'-'.$postal2.'<br />';
print $address.'<br />';
print $tel.'<br /><br />';

$honbun='';
$honbun.=$onamae."様\n\n この度はご注文ありがとうございました。\n";
$honbun.="\n";
$honbun.="ご注文商品\n";
$honbun.="--------------------\n";

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);
var_dump($cart);
$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);

$dbh->query('SET NAME utf8');

for($i=0; $i<$max; $i++)
{
    $sql='SELECT name,price FROM mst_product WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[0]=$cart[$i];
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $name=$rec['name'];
    $price=$rec['price'];
    $kakaku[]=$price;
    $suryo=$kazu[$i];
    $shokei=$price*$suryo;

    $honbun.=$name.' ';
    $honbun.=$price.'円 x ';
    $honbun.=$suryo.'個 = ';
    $honbun.=$shokei."円\n";
}

$sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data=arrey();

$data[]=0;
$data[]=$onamae;
$data[]=$email;
$data[]=$postal1;
$data[]=$postal2;
$data[]=$address;
$data[]=$tel;

$stmt->execute($data);

$sql='SELECT LAST_INSERT_ID()';
var_dump($sql);
for($i=0; $i<$max; $i++)
{
    $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=$lastcode;
    $data[]=$cart[$i];
    $data[]=$kakaku[$i];
    $data[]=$kazu[$i];
    $stmt->execute($data);
}

$sql='SELECT LAST_INSERT_ID()';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];

$dbh=null;

$honbun.="送料は無料です。\n";
$honbun.="--------------------\n";
$honbun.="\n";
$honbun.="代金は以下の口座にお振り込みください。\n";
$honbun.="入金確認が取れ次第、梱包、発送させていただきます。\n";
$honbun.="ろくまる銀行 やさい支店 普通口座 １２３４５６７\n";
$honbun.="\n";
$honbun.="□□□□□□□□□□□□□□\n";
$honbun.="〜安心野菜のろくまる農園〜\n";
$honbun.="\n";
$honbun.="◯◯県六丸群六丸村123-4\n";
$honbun.="電話 090-6060-xxxx\n";
$honbun.="メール info@rokumarunouen.co.jp\n";
$honbun.="□□□□□□□□□□□□□□\n";
// print'<br />';
// print $honbun;
// print nl2br($honbun);

$title='ご注文ありがとうございます。';
$header='From:info@rokumarunouen.co.jp';
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email,$title,$honbun,$header);

$title='お客様からご注文がありました。';
$header='From:'.$email;
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('info@rokumarunouen.co.jp',$title,$honbun,$header);

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

</body>

</html>