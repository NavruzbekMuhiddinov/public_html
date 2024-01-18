<?php
require_once('Telegram.php');
 require_once('user.php');
$telegram = new Telegram('6552612983:AAHCXtHSQZqmv515XrMDz6JNlcBga66ByLs');
$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$chat_id = $message['chat']['id'];
 $contact = $message['contact'];
 $telcontact= $contact['phone_number'];
 $first_name = $message['from']['first_name']; 
$last_name = $message['from']['last_name'];

$ADMIN_CHAT_ID = "5555337423";

// $telegram->sendMessage([
// 'chat_id'=>$telegram->chatID(),
// 'text'=> json_encode($data, JSON_PRETTY_PRINT)
// ]);


 if($text=="/start")  {//if starting programm
showMain();
// joinchat();
   

                      }
                      if($text=="👨‍ Admin bilan bog’lanish"){
                         $telcontact= $message['contact']['phone_number'];
   global  $chat_id;
 setContact($chat_id, contact:$telcontact);
  }
                   

switch(getPage($chat_id))
{
  case "main";
  if($text == "👨‍ Admin bilan bog’lanish"){
    showAdmin();
                                          }
//   else{
//   chooseButton();
//       }
  break;
  case "contact";
if($text=="orqaga"){
    showMain();
}
else
{
    chooseButton();
}

  break;
  case "siz bilan bog'lanishimiz uchun telefon raqamingizni yuboring!";
  if($text=="siz bilan bog'lanishimiz uchun telefon raqamingizni yuboring!"){
   showContact();
  }
  break;

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


}
                        
 function showMain()
 {
    global  $telegram, $chat_id, $text, $first_name, $last_name;
    

 setPage($chat_id, page:"main");

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

$content = array('chat_id' => $chat_id, 'text' => "Assalom alaykum botimizga xush kelibsiz!, {$first_name} {$last_name} ");
$telegram->sendMessage($content);
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "knopkalar orasidan xoxlaganingizni bosib sovringa ega bo'ling!");
$telegram->sendMessage($content);




 }
function chooseButton(){
global $telegram, $chat_id;
$content = array('chat_id' => $chat_id,'reply_markup' => $keyb,'text' => "raqamingizni knopkani bosish orqali yuboring!");
$telegram->sendMessage($content);

}

function showAdmin(){
global $telegram, $chat_id, $text;
setPage($chat_id,page:'contact');
 $option = array( 
    //First row
    array($telegram->buildKeyboardButton("raqamni yuborish",$request_contact=true)),
    array($telegram->buildKeyboardButton("orqaga"))
   
     );
    //  file_put_contents(filename:'users/stepcopyks.txt', data:$telcontact);
    $keyb = $telegram->buildKeyBoard($option, $onetime=true, $resize=true);

$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "siz bilan bog'lanishimiz uchun telefon raqamingizni yuboring!");
  
$telegram->sendMessage($content);


}
function showDegree(){
 global  $telegram, $chat_id, $text, $telcontact, $ADMIN_CHAT_ID;
 file_put_contents(filename:'users/stepcopys.txt', data:$telcontact);
 $content = array('chat_id' => $chat_id, 'text' => "Reyting !");
 $telegram->sendMessage($content);

 // send admin 
 $text ="yangi buyruq keldi";
 $text.="\n";
 $text.="bosgan knopkasi:".getPage($chat_id);
 $content = array('chat_id'=>$ADMIN_CHAT_ID,'reply_markup'=>$keyb,'text'=>$text);
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
function showContact(){
 global $telcontact;
 setContact($chat_id, contact:$telcontact);
//  file_put_contents(filename:'users/stepcopyks.txt', data:$telcontact);
 //$content = array('chat_id' => $chat_id, 'text' => $telcontact);

}
function joinchat($chat_id){
    
    $result = bot('getChatMember',[
    'chat_id'=>"-1001671977181",
    'user_id'=>$chatid
    ])->result->status;
    if($result == "creator" or $result == "administrator" or $result == "member"){
        return true;
    } else {
        bot('deleteMessage',[
        'chat_id'=>"-1001555853739",        'message_id'=>$cmid
        ]); 
        bot('sendMessage',[
        'chat_id'=>$chatid,
        'text'=>"❌Kechirasiz  siz bizning kanalimizga a'zo bo'lmasangiz botdan foydalana olmaysiz!
         A'zo bo'lib tekshirish tugmasini bosing!",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [['text'=>"➕ A'zo bo'lish",'url'=>"https://t.me/uz_foydali_kanal_uz"]],
        [['text'=>"➕ A'zo bo'lish",'url'=>"https://t.me/Tgraph_uz_news"]],
        [['text'=>"✅ Tekshirish",'callback_data'=>"tekshir"]]
        ]
        ])
        ]);
        return false;
    }
}

?>