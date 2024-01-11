<?php
require_once('db_connect.php');
include 'Telegram.php';
$telegram = new Telegram('6552612983:AAHCXtHSQZqmv515XrMDz6JNlcBga66ByLs');
$filePath = 'users/step.txt';
$data = $telegram->getData();
// $telegram->sendMessage([
// 'chat_id'=>$telegram->chatID(),
// 'text'=> json_encode($data, JSON_PRETTY_PRINT)
// ]);
$text= $data['message']['text'];
$chat_id=$data['message']['chat']['id'];
$telcontact=$data['message']['contact']['phone_number'];


$chat_id = $telegram->ChatID();
$text=$telegram->Text();

// $telegram->sendMessage([
//     'chat_id'=>$telegram->chat_ID();
//     'text'=>json_encode($data, options:JSON_PRETTY_PRINT)
// ])
// file_put_contents(filename:'users/step.txt', data:'1');
// $stepFile=file_get_contents(filename:'users/step.txt');

 
 if($text == "/start")
 {
    $option = array( 
    //First row
    array($telegram->buildKeyboardButton("🔊 Tanlovda ishtirok etish")), 
    //Second row 
   
    array($telegram->buildKeyboardButton("👨‍💼 Ballarim"), $telegram->buildKeyboardButton("🎁 Sovg’alar")), 
    //Third row   
    array($telegram->buildKeyboardButton("📊 Reyting"), $telegram->buildKeyboardButton("🗒 Tanlov shartlari")),
    //forth row  
    array($telegram->buildKeyboardButton("👨‍ Admin bilan bog’lanish")) 
    
     );
    $keyb = $telegram->buildKeyBoard($option, $onetime=true, $resize=true);

$content = array('chat_id' => $chat_id, 'text' => "Assalom alaykum botimizga xush kelibsiz");
$telegram->sendMessage($content);
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "knopkalar orasidan xoxlaganingizni bosib sovringa ega bo'ling!");
$telegram->sendMessage($content);


 }
 
  

 switch($text){

case "🔊 Tanlovda ishtirok etish";
showParticipation();
break;
case "👨‍💼 Ballarim";
showScore();
break;
case "🎁 Sovg’alar";
showGift();
break;
case "📊 Reyting";
showDegree();
break;
case "🗒 Tanlov shartlari";
showConditions();
break;
case "👨‍ Admin bilan bog’lanish";
showAdmin();
break;
case "siz bilan bog'lanishimiz uchun telefon raqamingizni yuboring!";
showAdmin();
break;
case "name";
showName();
break;



 }

 function showDegree(){
 global  $telegram, $chat_id, $text, $telcontact;
 file_put_contents(filename:'users/stepcopys.txt', data:$telcontact);
$content = array('chat_id' => $chat_id, 'text' => "Reyting !");

$telegram->sendMessage($content);

 }

 function showGift(){
    global $telegram, $chat_id;
$content = array('chat_id' => $chat_id, 'text' => "sovg'alar.<a href='https://telegra.ph/Tanlov-shartlari-va-yutuqlar-12-02'>havola</a>","parse_mode"=>"html");

$telegram->sendMessage($content);

 }
 function showScore(){
global $telegram, $chat_id;
$content = array('chat_id' => $chat_id, 'text' => "ballarim!");
$telegram->sendMessage($content);

 }
function showConditions(){
global $telegram, $chat_id;
$content = array('chat_id' => $chat_id, 'text' => "Tanlov shartlari!");
$telegram->sendMessage($content);


}
function showParticipation(){
global $telegram,$chat_id;
$content = array('chat_id' => $chat_id, 'text' => "aqilli gap!");
$telegram->sendMessage($content);


}
function showAdmin(){
global $telegram, $chat_id, $text, $telcontact;

 $option = array( 
    //First row
    array($telegram->buildKeyboardButton("raqamni yuborish",$request_contact=true))
   
     );
     file_put_contents(filename:'users/stepcopyks.txt', data:$telcontact);
    $keyb = $telegram->buildKeyBoard($option, $onetime=true, $resize=true);

$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "siz bilan bog'lanishimiz uchun telefon raqamingizni yuboring!");
  
$telegram->sendMessage($content);


}
function showContact(){
global $telcontact;
file_put_contents(filename:'users/stepcopyks.txt', data:$telcontact);
$content = array('chat_id' => $chat_id, 'text' => "Reyting !");

}

//printAllData();

function showName(){
global $chat_id, $telegram, $text,  $dbConnect;
$result = $dbConnect->query("SELECT * FROM  user  ORDER BY  ID DESC LIMIT 1 ");

while($arr = $result->fetch_assoc()){
   
    if(isset($arr['name']))
    $name=$arr['name'];
    $content = array('chat_id' => $chat_id, 'text' => $name);
    $telegram->sendMessage($content);

}




}
  
?>