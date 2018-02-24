<?php
define('API_KEY','318982190:AAEGuwsofsI1PsouAfmqwoFuTkcPYSjyC28');
function makereq($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$result=json_decode($message,true);
//##############=--API_REQ
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return exec_curl_request($handle);
}
//----######------
//---------
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_chat_id = $forward_from_chat->id;
$from_id = $forward_from->id;
$forward_from = $update->message->forward_from;
$from_id = $update->message->from->id;
$up = $update->message->forward_from->id;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$t = isset($update->message->text)?$update->message->text:'';
$reply = $update->message->reply_to_message->forward_from->id;
$sticker = $update->message->sticker;
$forward = $update->message->forward_from;
$blocklist = file_get_contents("blocklist.txt");
$ids = file_get_contents("data/".$from_id."/save.txt");
$coin = file_get_contents("data/".$from_id."/coin.txt");
$member = file_get_contents("data/".$from_id."/member.txt");
$step = file_get_contents("data/".$from_id."/step.txt");
$users = file_get_contents("member.txt");
$start = file_get_contents("start.txt");
$idss = file_get_contents("ids");
$ted = file_get_contents("data/".$from_id."/ted.txt");
$admin = 258220821;
$admin = 12345;
$channel = -1001090685712;
$sticker_ID = $update->message->reply_to_message->sticker->file_id;
$boolean = file_get_contents('booleans.txt');
$booleans= explode("\n",$boolean);
//-------
function SendMessage($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}

function SendM($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"html"
]);
}
function SendSticker($ChatId, $sticker_ID)
{
 makereq('sendSticker',[
'chat_id'=>$ChatId,
'sticker'=>$sticker_ID
]);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
makereq('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}
function save($filename,$TXTdata)
  {
  $myfile = fopen($filename, "w") or die("Unable to open file!");
  fwrite($myfile, "$TXTdata");
  fclose($myfile);
  }
//==========
if (strpos($blocklist, "$from_id") !== false) {
SendMessage($chat_id,"شما بلاک هستید");}
elseif (strpos($t , "/block") !== false && $chat_id == $admin) {
$result = str_replace("/block ","",$t);
save("blocklist.txt",$blocklist."\n".$result);
SendMessage($chat_id,"$result* Blocked!*");
SendMessage($result,"*You Are Blocked From Admin.* ");
}
elseif (strpos($t , "/unblock") !== false && $chat_id == $admin) {
$result = str_replace("/unblock ","",$t);
$blist = str_replace($result,"",$blocklist);
save("blocklist.txt",$blist);
SendMessage($chat_id,"$result *unBlocked!*");
SendMessage($result,"You Are *unBlocked* From Admin. ");
}
elseif(preg_match('/^\/([Ss]tart)(.*)/s',$t)){
    preg_match('/^\/([Ss]tart)(.*)/s',$t,$match);
$match[2] = str_replace(' ','',$match[2]);
$match[2] = str_replace('\n','',$match[2]);
if (!file_exists("data/$from_id/id.txt")) {
    mkdir("data/$from_id");
    save("data/$from_id/step.txt","none");
    save("data/$from_id/member.txt","");
    save("data/$from_id/inv.txt","2");
}
if ($match[2] == ""){
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>$start,
  'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"راهنما"],['text'=>"تبلیغات"]
              ],
              [
                ['text'=>"موجودی"],['text'=>"خرید سکه"]
              ],
              [
                ['text'=>"سکه مفتی"],['text'=>"انتقال سکه"]
              ],
        [
                ['text'=>"پشتیبانی"],['text'=>"گرفتن سکه رایگان"]
              ]

            ],
'resize_keyboard'=>true
        ])
    ]));
   }
else
{
if ($from_id == $member && $from_id == $users) {
SendMessage($chat_id,"شما قبلا زیر مجموعه شدید!!!");
return;
}
}
if ($match[2] != $from_id){
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"❤️",
  'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"راهنما"],['text'=>"تبلیغات"]
              ],
              [
                ['text'=>"موجودی"],['text'=>"خرید سکه"]
              ],
              [
                ['text'=>"سکه مفتی"],['text'=>"انتقال سکه"]
              ],
        [
                ['text'=>"پشتیبانی"],['text'=>"گرفتن سکه رایگان"]
              ]
],
'resize_keyboard'=>true
        ])
    ]));

SendMessage($match[2],"یک نفر با لینک شما وارد ربات شده است");
save("data/$match[2]/member.txt","$from_id");
$ss = $coin + 10;
save("data/$match[2]/coin.txt","$ss");
   }
}
elseif($t == 'برگشت'){
save("data/$from_id/step.txt","none");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"شما به صفحه اصلی برگشتید",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"راهنما"],['text'=>"تبلیغات"]
              ],
              [
                ['text'=>"موجودی"],['text'=>"خرید سکه"]
              ],
              [
                ['text'=>"سکه مفتی"],['text'=>"انتقال سکه"]
              ],
        [
                ['text'=>"پشتیبانی"],['text'=>"گرفتن سکه رایگان"]
              ]
],
'resize_keyboard'=>true
        ])
    ]));
}
elseif($t == 'پشتیبانی'){
save("data/$from_id/step.txt","spm");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"متن خود را ارسال کنید:",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"برگشت"]
              ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}
elseif ($step == 'spm'){
$sd122ss = $t ;
SendMessage($chat_id,"ارسال شد");
SendM($admin,"پیام از طرف: \n $name\n@$username\n$from_id\nجواب دادن :\n /send$from_id \n پیام: $sd122ss");
save("data/$from_id/step.txt","none");
}
elseif ($t == "راهنما") {
  $help = file_get_contents("help.txt");
  SendM($chat_id,"$help");
}
elseif (strpos($t , "/sethelp") !== false && $from_id == $admin) {
$result = str_replace("/sethelp ","",$t);
save("help.txt",$result);
SendMessage($chat_id,"$result* ok*");
}
elseif ($t == "سکه مفتی") {
SendMessage($chat_id,"تو با این قابلیت میتونی سکه رایگان بگیری و ویو پستاتو افزایش بدی😄
برای این کار باید پیام زیری که میدمو به بقیه فوروارد کنی و بقیه با لینکی که تو پیام هست عضو ربات بشن😁
به ازای هر یک نفر 10 سکه ی شما افزایش پیدا میکنه😎
کسی که از قبل استارت کرد و لینک دعوت شما رو عضو شد هیچ سکه ای به شما تعلق نمیگیره😅💦
خب حالا پیام زیرو به گروه ها و دوستات فوروارد کن👇");
SendMessage($chat_id,"میخوای بازدید پیام های کانالتو ببری بالا😉
میخوای پیامت توی گروه ها پخش بشه و بازدیدش زیاد شه تا توی چالش ها برنده شی؟😍
میخوای پیامتو همه ببینن؟😊

پس رو لینک زیر بزن و عضو شو👇

https://telegram.me/upsinrobot?start=$from_id ");
}
elseif($t == 'خرید سکه'){
save("data/$from_id/step.txt","none");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"لطفا تعرفه مورد نظر خود را با کمک از لیست زیر انتخاب کنید👇

💰 1000 سکه: 10 هزار تومان
💰 2000 سکه: 18 هزار تومان
💰 3000 سکه: 25 هزار تومان
💰 5000 سکه: 40 هزار تومان
💰 8000 سکه: 50 هزار تومان
💰 10000 سکه: 55 هزار تومان",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"1000 سکه"],['text'=>"2000 سکه"]
              ],
              [
                ['text'=>"3000 سکه"],['text'=>"5000 سکه"]
              ],
              [
                ['text'=>"8000 سکه"],['text'=>"10000 سکه"]
              ],
        [
                ['text'=>"برگشت"]
              ]
],
'resize_keyboard'=>true
        ])
    ]));
}
elseif($t == "1000 سکه"){
  SendM
($chat_id,"https://www.payping.ir/TeleAvareh/10000?utm_source=bot&utm_medium=preamount");
}
elseif($t == "2000 سکه"){
  SendM
($chat_id,"https://www.payping.ir/TeleAvareh/15000?utm_source=bot&utm_medium=preamount");
}
elseif($t == "3000 سکه"){
  SendM
($chat_id,"https://www.payping.ir/TeleAvareh/17000?utm_source=bot&utm_medium=preamount");
}
elseif($t == "5000 سکه"){
  SendM
($chat_id,"https://www.payping.ir/TeleAvareh/18000?utm_source=bot&utm_medium=preamount");
}
elseif($t == "8000 سکه"){
  SendM
($chat_id,"https://www.payping.ir/TeleAvareh/19000?utm_source=bot&utm_medium=preamount");
}
elseif($t == "10000 سکه"){
  SendM
($chat_id,"https://www.payping.ir/TeleAvareh/20000?utm_source=bot&utm_medium=preamount");
}
elseif($t == 'تبلیغات'){
  if($coin <= 199){
    SendMessage($chat_id,"موجودی شما ناکافی است😃
شما به  سکه ی بیشتری برای تبلیغ کردن نیاز دارید🙄");
  }else{
save("data/$from_id/step.txt","channel");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"لطفا پیامی که میخواهید از کانال تان سین بخوره را فورارد کنید",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
        [
                ['text'=>"برگشت"]
              ]
],
'resize_keyboard'=>true
        ])
    ]));
}}
elseif($step == 'channel'){
$ch = $message_id ;
Forward($admin,$chat_id,$ch);
SendMessage($chat_id,"با موفقیت ارسال شد");
$sss = $coin - 200;
save("data/$from_id/coin.txt","$sss");
}
elseif($t == "موجودی"){
if($coin == ""){
$coin = "شما سکه ندارید";
}
   $mamebersss = file_get_contents('data/".$from_id."/member.txt');
  $membersidddd= explode("\n",$mamebersss);
  $number4 = count(scandir("data"))-1;
  $mmemcount2 = count($membersidddd) -1;
  SendMessage($chat_id,"مشخصات اکانت شما👇
💰موجودی: $coin
👥تعداد اعضای دعوت شده توسط شما: $mmemcount2 ");
}
elseif($t == "انتقال سکه"){
  save("data/$from_id/step.txt","move");
  var_dump(makereq('sendMessage',[
          'chat_id'=>$update->message->chat->id,
          'text'=>"لطفا پیامی از طرف فورارد کنید:",
          'parse_mode'=>'MarkDown',
          'reply_markup'=>json_encode([
              'keyboard'=>[
          [
                  ['text'=>"برگشت"]
                ]
  ],
  'resize_keyboard'=>true
  ])
]));
      }
elseif($step == 'move'){
  if($up != $users){
    SendMessage($chat_id,"متاسفانه کاربری که پیامشو دادین در ربات عضو نشده است‼️");
  }else{
      save("data/$from_id/step.txt","move2");
        save("data/$from_id/save.txt","$id");
        SendMessage($chat_id,"لطفا تعداد سکه ا ی  که میخواهید انتقال یابد را ارسال کنید:");
  }
  }
  elseif($step == 'move2'){
    $seke = $t ;
    if($coin <= $seke){
      SendMessage($chat_id,"سکه ی شما کمتر از مقدار سکه ی وارد شده است باید حداقل 1 سکه برای شما باقی بماند🙄");
    }
    else{
      $seke = $t ;
  $nowsaw = $coin - $seke;
          save("data/$from_id/coin.txt","$nowsaw");
              SendM($chat_id,"انجام شد");
  $nowsaww = $coin + $seke ;
              save("data/$ids/coin.txt","$nowsaww");
              SendM($ids,"$name\n به شما سکه اضافه کرد");
    }
  }
elseif($t == 'گرفتن سکه رایگان'){
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"لطفا یکی از روش های زیر را برای دریافت سکه رایگان انتخاب کنید",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"150 سکه رایگان هدیه ربات"]
              ],
              [
                ['text'=>"دیدن تبلیغات"]
              ],
        [
                ['text'=>"برگشت"]
              ]
],
'resize_keyboard'=>true
        ])
    ]));
}
elseif($t == "150 سکه رایگان هدیه ربات"){
  if($ted >= 1){
SendM($chat_id,"شما یک بار این هدیه را دریافت کرده اید");
}
else{
$ttt = $coin + 150 ;
save("data/$from_id/coin.txt","$ttt");
save("data/$from_id/ted.txt","1");
  SendM
($chat_id,"150 سکه از طرف ربات به شما اهدا شد");
}
}
elseif(preg_match('/^\/([Pp]anel)(.*)/s',$t)){
    preg_match('/^\/([Pp]anel)(.*)/s',$t,$match);
$match[2] = str_replace(' ','',$match[2]);
if($chat_id == $admin){
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"پنل مدیریت",
  'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"وضعیت"],['text'=>"سکه به کاربر"]
              ],
              [
                ['text'=>"تنظیم متن استارت"],['text'=>"تنظیم متن راهنما"]
              ],
              [
                ['text'=>"بلاک لیست"],['text'=>"ای دی کاربران"]
              ]

            ],
'resize_keyboard'=>true
        ])
    ]));
   }}
elseif($t == '👌برگشت'){
save("data/$from_id/step.txt","none");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"شما به صفحه اصلی برگشتید",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"وضعیت"],['text'=>"سکه به کاربر"]
              ],
              [
                ['text'=>"تنظیم متن استارت"],['text'=>"تنظیم متن راهنما"]
              ],
              [
                ['text'=>"بلاک لیست"],['text'=>"ای دی کاربران"]
              ]

            ],
'resize_keyboard'=>true
        ])
    ]));
}
elseif($t == 'سکه به کاربر' && $chat_id == $admin){
save("data/$from_id/step.txt","sd");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"`ای دی طرف را ارسال کنید`",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"👌برگشت"]
              ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}
elseif ($step == 'sd'){
save("data/$from_id/step.txt","sd2");
$sd1 = $t ;
save("sdn","$sd1");
SendMessage($admin,"
 تعداد سکه را وارد کنید");
}
elseif ($step == 'sd2'){
$sd11 = file_get_contents("sdn");
save("data/$from_id/step.txt","none");
$sd2 = $t ;
save("data/$sd11/coin.txt","$sd2");
SendMessage($sd11,"
سکه های شما  :
` $sd2`");
SendMessage($admin,"
تغییر یافت به :
 $sd2");
}
elseif($t == 'تنظیم متن راهنما' && $chat_id == $admin){
save("data/$from_id/step.txt","hsd");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"متن خود را ارسال کنید:",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"👌برگشت"]
              ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}
elseif ($step == 'hsd'){
$sd122 = $t ;
save("help.txt","$sd122");
SendMessage($admin,"
 تنظیم شد");
}
elseif($t == 'تنظیم متن استارت' && $chat_id == $admin){
save("data/$from_id/step.txt","shsd");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"متن خود را ارسال کنید:",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"👌برگشت"]
              ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}
elseif ($step == 'shsd'){
$sd122s = $t ;
save("start.txt","$sd122s");
SendMessage($admin,"
 تنظیم شد");
}
elseif (strpos($t , "/send") !== false && $chat_id == $admin)
{
$javab = str_replace('/send','',$t);
if ($javab != '')
{
save("data/$from_id/step.txt","pn");
save("idd","$javab");
SendMessage($chat_id,"  پیام خود را ارسال کنید ");
}
else
{
SendMessage($chat_id,"ای دی رو وارد کن خب :|");
}
}
elseif ($step == 'pn'){
save("data/$from_id/step.txt","none");
$pm22 = $t ;
    $ud = file_get_contents("idd");
SendMessage($chat_id,"`پیام شما ارسال شد`");
SendM($ud,"پیام ادمین: $pm22");
}
elseif($t == 'ای دی کاربران' && $chat_id == $admin){
SendM($chat_id,"ای دی کاربران:\n $idss");
}
elseif($t == 'بلاک لیست' && $chat_id == $admin){
if($blocklist == "")
{
$blocklist = "خالی است";}
SendM($chat_id,"ای دی کاربران بلاک ها:\n $blocklist");
}
elseif($t == 'وضعیت' && $chat_id == $admin){
    $user = file_get_contents("member.txt");
    $member_id = explode("\n",$users);
    $member_count = count($member_id) -1;
	$Block = file_get_contents("blocklist.txt");
    $Block_id = explode("\n",$Blocklist);
    $Block_count = count($Block_id) -1;
	SendMessage($chat_id , "تعداد کل اعضا: $member_count
	تعداد لیست سیاه: $Block_count" );
}
       $txxt = file_get_contents('member.txt');
$pmembersid= explode("\n",$txxt);
  if (!in_array($chat_id,$pmembersid)) {
    $aaddd = file_get_contents('member.txt');
    $aaddd .= $chat_id."
";
      file_put_contents('member.txt',$aaddd);
}
    $txxtt = file_get_contents('ids');
$pmembersidd= explode("\n",$txxtt);
  if (!in_array(@$username,$pmembersidd)) {
    $aadddd = file_get_contents('ids');
    $aadddd .= @$username."
";
      file_put_contents('ids',$aadddd);
}
?>
