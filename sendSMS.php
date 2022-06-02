<?php
/*
$senderId : alphanumérique ne depassant pas 12 caracteres. ex: Ibrahprest
$id=Id unique pour l'envois . Exemple: 69434E5E491FED8E89679B91FA13E00F
$dnr: la liste des numeros de telephones en format international et séparé par des virgules. ex: 22678378417,22672276296
$msg: le message à envoyer.
*/
function sendSmsbusGet($senderId,$phoneNumber,$msg){
    echo $senderId;
    echo $phoneNumbe;
    echo $msg;
$id="69434E5E491FED8E89679B91FA13E00F";
$smsbus='https://www.lesmsbus.com:7170/ines.smsbus/smsbusMt?'.$senderId.'&id='.$id.'&msg='.urlencode($msg).'&dnr='.$phoneNumber;
$response=@file_get_contents($smsbus);
echo $id;
echo $smsbus;
echo $response;
return $response;
}


/*
$senderId : alphanumérique ne depassant pas 12 caracteres. ex: Ibrahprest
$id=Id unique pour l'envois . Exemple: 69434E5E491FED8E89679B91FA13E00F
$dnr: la liste des numeros de telephones en format international et séparé par des virgules. ex: 22678378417,22672276296
$msg: le message à envoyer.
*/
function sendSmsbusPOST($senderId,$phoneNumber,$msg){
$id="69434E5E491FED8E89679B91FA13E00F";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"https://www.lesmsbus.com:7170/ines.smsbus/smsbusMt?");
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$senderId."&id=".$id."&msg=".urlencode($msg)."&dnr=".$phoneNumber);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);
curl_setopt($ch,CURLOPT_TIMEOUT,5);//5 seconds
$response=curl_exec($ch);
curl_close($ch);
echo $response;
return $response;
}


sendSmsbusGet("SMARPREST","22671325496","rtest online");
?>