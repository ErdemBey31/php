<?php
#==================[By Ghostbin01]===============#

$botToken = '5747283813:AAFE_aAB15PdBe7dIqDZZvMS3XkjboBqJGU'; ///Your token here
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
$chatId = $update["message"]["chat"]["id"];
$chatType = $update["message"]["chat"]["type"];
$userId = $update["message"]["from"]["id"];
$forward_from = $update["message"]["reply_to_message"]["forward_from"];
$firstname = $update["message"]["from"]["first_name"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];
$reply_to_message = $update["message"]["reply_to_message"];
$reply_id = $update["message"]["reply_to_message"]["forward_from"]["id"];

$send = '5333072972'; // ID of where the messages were sent
#===============[CMDS]================#

if($message == '/start' || $message == '!start' || $message == '.start'){
    sendMessage($chatId, "🎉 Merhaba $firstname , 📞 Ben, @uslanmazmurti Tarafından Yazılan Bir İletişim Botuyum.\n\nDaha Fazlası: @MurtiGram\nID: $userId", $message_id);
}

if($chatId == $send){
    if($reply_to_message){
        sendMessager($reply_id, $message);
    }
} else {
    forwardMessage($send, $chatId, $message_id);
}
#===================[FUNCIONES]=============#

function sendMessage($chatId, $message, $message_id){
	$text = urlencode($message);
	$url = $GLOBALS['website'].'/sendMessage?chat_id='.$chatId.'&text='.$text.'&reply_to_message_id='.$message_id.'&parse_mode=Html';
	echo file_get_contents($url);
}
function sendMessager($chatId, $message){
	$text = urlencode($message);
	$url = $GLOBALS['website'].'/sendMessage?chat_id='.$chatId.'&text='.$text.'&parse_mode=Html';
	echo file_get_contents($url);
}

function forwardMessage($send, $chatId , $message_id){
	$url = $GLOBALS['website'].'/forwardMessage?chat_id='.$send.'&from_chat_id='.$chatId.'&message_id='.$message_id.'&disable_notification=false';
	echo file_get_contents($url);
}
