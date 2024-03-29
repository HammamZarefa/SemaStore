<?php

use App\Models\Admin;
use App\Models\EmailTemplate;
use App\Models\Extension;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\SmsTemplate;
use App\Notifications\TelegramNotification;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\Notification;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Carbon\Carbon;


function sidebarVariation()
{
    /// for sidebar
    $variation['sidebar'] = '';

    //for selector
    $variation['selector'] = 'capsule--rounded';

    //for overlay
    $variation['overlay'] = 'bg--white';

    return $variation;

}

function systemDetails()
{
    $system['name'] = 'SyriaCards';
    $system['version'] = '1.0';
    return $system;
}

function getLatestVersion()
{
   $result = null;
    if ($result) {
        return $result;
    } else {
        return null;
    }
}


function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}


function shortDescription($string, $length = 120)
{
    return Illuminate\Support\Str::limit($string, $length);
}


function shortCodeReplacer($shortCode, $replace_with, $template_string)
{
    return str_replace($shortCode, $replace_with, $template_string);
}


function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}

function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}

//moveable
function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if (!empty($size)) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {

        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($location . '/thumb_' . $filename);
    }
    return $filename;
}

function uploadFile($file, $location, $size = null, $old = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $file->move($location, $filename);
    return $filename;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}


function activeTemplate($asset = false)
{
    $template = 'basic';
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function activeTemplateName()
{
//    $gs = GeneralSetting::first(['active_template']);
//    $template = $gs->active_template;
//    $sess = session()->get('template');
//    if (trim($sess) != null) {
//        $template = $sess;
//    }
    $template = 'basic';
    return $template;
}


function loadReCaptcha()
{
//    $reCaptcha = Extension::where('act', 'google-recaptcha2')->where('status', 1)->first();
//    return $reCaptcha ? $reCaptcha->generateScript() : '';
    return '';
}


function loadAnalytics()
{
//    $analytics = Extension::where('act', 'google-analytics')->where('status', 1)->first();
//    return $analytics ? $analytics->generateScript() : '';
    return '';
}

function loadTawkto()
{
//    $tawkto = Extension::where('act', 'tawk-chat')->where('status', 1)->first();
//    return $tawkto ? $tawkto->generateScript() : '';
    return ' ';
}


function loadFbComment()
{
//    $comment = Extension::where('act', 'fb-comment')->where('status', 1)->first();
//    return $comment ? $comment->generateScript() : '';
    return '';
}

function getCustomCaptcha($height = 46, $width = '300px', $bgcolor = '#003', $textcolor = '#abc')
{
//    $textcolor = '#' . GeneralSetting::first()->base_color;
//    $captcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
//    if (!$captcha) {
//        return 0;
//    }
//    $code = rand(100000, 999999);
//    $char = str_split($code);
//    $ret = '<link href="https://fonts.googleapis.com/css?family=Henny+Penny&display=swap" rel="stylesheet">';
//    $ret .= '<div style="height: ' . $height . 'px; line-height: ' . $height . 'px; width:' . $width . '; text-align: center; background-color: ' . $bgcolor . '; color: ' . $textcolor . '; font-size: ' . ($height - 20) . 'px; font-weight: bold; letter-spacing: 20px; font-family: \'Henny Penny\', cursive;  -webkit-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;  display: flex; justify-content: center;">';
//    foreach ($char as $value) {
//        $ret .= '<span style="    float:left;     -webkit-transform: rotate(' . rand(-60, 60) . 'deg);">' . $value . '</span>';
//    }
//    $ret .= '</div>';
//    $captchaSecret = hash_hmac('sha256', $code, $captcha->shortcode->random_key->value);
//    $ret .= '<input type="hidden" name="captcha_secret" value="' . $captchaSecret . '">';
//    return $ret;
    return '';
}


function captchaVerify($code, $secret)
{
//    $captcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
//    $captchaSecret = hash_hmac('sha256', $code, $captcha->shortcode->random_key->value);
//    if ($captchaSecret == $secret) {
//        return true;
//    }
    return false;
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getAmount($amount, $length = 0)
{
    if (0 < $length) {
        return round($amount + 0, $length);
    }
    return $amount + 0;
}

function removeElement($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet, $amount, $crypto = null)
{

    $varb = $wallet . "?amount=" . $amount;
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
}

//moveable
function curlContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//moveable
function curlPostContent($url, $arr = null, $header = null)
{
    if ($arr && !$header) {
        $params = http_build_query($arr);
    } else {
        $params = $arr;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($header)
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


function inputTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}


function str_slug($title = null)
{
    return \Illuminate\Support\Str::slug($title);
}

function str_limit($title = null, $length = 10)
{
    return \Illuminate\Support\Str::limit($title, $length);
}

//moveable
function getIpInfo()
{
    $ip = null;
    $deep_detect = TRUE;

    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }


    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);


    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');


    return [];
}

//moveable
function osBrowser()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $os_platform;
    $data['browser'] = $browser;

    return [];
}

function siteName()
{
//    $general = GeneralSetting::first();
//    $sitname = str_word_count($general->sitename);
//    $sitnameArr = explode(' ', $general->sitename);
//    if ($sitname > 1) {
//        $title = "<span>$sitnameArr[0] </span> " . str_replace($sitnameArr[0], '', $general->sitename);
//    } else {
//        $title = "<span>$general->sitename</span>";
//    }

    return 'Sema Store';
}

function getSettings()
{
    $general = GeneralSetting::first();

    return $general;
}

function getBalance()
{
    return $widget['balance'] = auth()->user()->balance;

}

//moveable
function getTemplates()
{
//    $param['purchasecode'] = env("PURCHASECODE");
//    $param['website'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'] . ' - ' . env("APP_URL");
//    $url = 'https://license.viserlab.com/updates/templates/' . systemDetails()['name'];
//    $result = curlPostContent($url, $param);
//    if ($result) {
//        return $result;
//    } else {
//        return null;
//    }
    return null;
}


function getPageSections($arr = false)
{

    $jsonUrl = resource_path('views/') . str_replace('.', '/', activeTemplate()) . 'sections.json';
    $sections = json_decode(file_get_contents($jsonUrl));
    if ($arr) {
        $sections = json_decode(file_get_contents($jsonUrl), true);
        ksort($sections);
    }
    return $sections;
}


function getImage($image, $size = null)
{
    $clean = '';
    $size = $size ? $size : 'undefined';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    } else {
        return route('placeholderImage', $size);
    }
}

function notify($user, $type, $shortCodes = null)
{

    sendEmail($user, $type, $shortCodes);
    sendSms($user, $type, $shortCodes);
}


/*SMS EMIL moveable*/

function sendSms($user, $type, $shortCodes = [])
{
    $general = GeneralSetting::first(['sn', 'sms_api']);
    $sms_template = SmsTemplate::where('act', $type)->where('sms_status', 1)->first();
    if ($general->sn == 1 && $sms_template) {

        $template = $sms_template->sms_body;

        foreach ($shortCodes as $code => $value) {
            $template = shortCodeReplacer('{{' . $code . '}}', $value, $template);
        }
        $template = urlencode($template);

        $message = shortCodeReplacer("{{number}}", $user->mobile, $general->sms_api);
        $message = shortCodeReplacer("{{message}}", $template, $message);
        $result = @file_get_contents($message);
    }
}

function sendEmail($user, $type = null, $shortCodes = [])
{
    $general = GeneralSetting::first();

    $email_template = EmailTemplate::where('act', $type)->where('email_status', 1)->first();
    if ($general->en != 1 || !$email_template) {
        return;
    }


    $message = shortCodeReplacer("{{name}}", $user->username, $general->email_template);
    $message = shortCodeReplacer("{{message}}", $email_template->email_body, $message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }

    foreach ($shortCodes as $code => $value) {
        $message = shortCodeReplacer('{{' . $code . '}}', $value, $message);
    }
    $config = $general->mail_config;

    if ($config->name == 'php') {
        sendPhpMail($user->email, $user->username, $email_template->subj, $message);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $user->email, $user->username, $email_template->subj, $message, $general);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $user->email, $user->username, $email_template->subj, $message, $general);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $user->email, $user->username, $email_template->subj, $message, $general);
    }
}


function sendPhpMail($receiver_email, $receiver_name, $subject, $message)
{
    $gnl = GeneralSetting::first();
    $headers = "From: $gnl->sitename <$gnl->email_from> \r\n";
    $headers .= "Reply-To: $gnl->sitename <$gnl->email_from> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail($receiver_email, $subject, $message, $headers);
}


function sendSmtpMail($config, $receiver_email, $receiver_name, $subject, $message, $gnl)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = $config->host;
        $mail->SMTPAuth = true;
        $mail->Username = $config->username;
        $mail->Password = $config->password;
        if ($config->enc == 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $mail->Port = $config->port;
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom($gnl->email_from, $gnl->sitetitle);
        $mail->addAddress($receiver_email, $receiver_name);
        $mail->addReplyTo($gnl->email_from, $gnl->sitename);
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}


function sendSendGridMail($config, $receiver_email, $receiver_name, $subject, $message, $gnl)
{
    $sendgridMail = new \SendGrid\Mail\Mail();
    $sendgridMail->setFrom($gnl->email_from, $gnl->sitetitle);
    $sendgridMail->setSubject($subject);
    $sendgridMail->addTo($receiver_email, $receiver_name);
    $sendgridMail->addContent("text/html", $message);
    $sendgrid = new \SendGrid($config->appkey);
    try {
        $response = $sendgrid->send($sendgridMail);
    } catch (Exception $e) {
        // echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}


function sendMailjetMail($config, $receiver_email, $receiver_name, $subject, $message, $gnl)
{
    $mj = new \Mailjet\Client($config->public_key, $config->secret_key, true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $gnl->email_from,
                    'Name' => $gnl->sitetitle,
                ],
                'To' => [
                    [
                        'Email' => $receiver_email,
                        'Name' => $receiver_name,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
}


function getPaginate($paginate = 40)
{
    return $paginate;
}


function menuActive($routeName, $type = null)
{
    if ($type == 3) {
        $class = 'side-menu--open';
    } elseif ($type == 2) {
        $class = 'sidebar-submenu__open';
    } else {
        $class = 'active';
    }
    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routeName)) {
        return $class;
    }
}


function imagePath()
{
    $data['gateway'] = [
        'path' => 'assets/images/gateway',
        'size' => '800x800',
    ];
    $data['verify'] = [
        'withdraw' => [
            'path' => 'assets/images/verify/withdraw'
        ],
        'deposit' => [
            'path' => 'assets/images/verify/deposit'
        ]
    ];
    $data['image'] = [
        'default' => 'assets/images/default.png',
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'assets/images/support',
    ];
    $data['language'] = [
        'path' => 'assets/images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'assets/images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['extensions'] = [
        'path' => 'assets/images/extensions',
    ];
    $data['seo'] = [
        'path' => 'assets/images/seo',
        'size' => '600x315'
    ];
    $data['profile'] = [
        'user' => [
            'path' => 'assets/images/user/profile',
            'size' => '350x300'
        ],
        'admin' => [
            'path' => 'assets/admin/images/profile',
            'size' => '400x400'
        ]
    ];
    $data['category'] = [
        'path' => 'assets/images/category',
        'size' => '350x300'
    ];
    $data['service'] = [
        'path' => 'assets/images/service',
        'size' => '350x300'
    ];
    $data['banner'] = [
        'path' => 'assets/images/banner',
        'size' => '1530x640'
    ];
    return $data;
}

function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'd M, Y h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

//moveable
function sendGeneralEmail($email, $subject, $message, $receiver_name = '')
{

    $general = GeneralSetting::first();


    if ($general->en != 1 || !$general->email_from) {
        return;
    }


    $message = shortCodeReplacer("{{message}}", $message, $general->email_template);
    $message = shortCodeReplacer("{{name}}", $receiver_name, $message);

    $config = $general->mail_config;


    if ($config->name == 'php') {
        sendPhpMail($email, $receiver_name, $general->email_from, $subject, $message);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $email, $receiver_name, $general->email_from, $general->sitename, $subject, $message);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $email, $receiver_name, $general->email_from, $general->sitename, $subject, $message);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $email, $receiver_name, $general->email_from, $general->sitename, $subject, $message);
    }
}

function getContent($data_keys, $singleQuery = false, $limit = null, $orderById = false)
{
    if ($singleQuery) {
        $content = Frontend::where('data_keys', $data_keys)->latest()->first();
    } else {
        $article = Frontend::query();
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if ($orderById) {
            $content = $article->where('data_keys', $data_keys)->orderBy('id')->get();
        } else {
            $content = $article->where('data_keys', $data_keys)->latest()->get();
        }
    }
    return $content;
}


function gatewayRedirectUrl($type = false)
{
    if ($type) {
        return 'user.history';
    } else {
        return 'user.deposit';
    }
}

function paginateLinks($data, $design = 'admin.partials.paginate')
{
    return $data->appends(request()->all())->links($design);
}


function GetSettingState()
{
    $state = true;
    return $state;
}

//function getPlayerName()
//{
////    $client = new GuzzleHttp\Client();
////    $playerName =Http::get('https://api.pubg.com/shards/saad/players?5415356544');
//////        $client->get('https://api.pubg.com/shards/steam/players?5415356544','sdsd');
////    dd($playerName);
////    return $playerName;
//    $apiKey="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI4NWYwNGNkMC05OThkLTAxM2EtNGNmZC0xNzdkOTFhMjYxNGEiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNjQ5NDM4MTc2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6Ii1iZWUxMTBkYS1kNjQyLTRiOTgtOTliNi0wNDY0Mjg3ZTRlODkifQ.JiPITHPdJHbp2pchkOY2hgdqv6Y6tgjRPGYYO8ievZs";
//    $region = "pc-as"; // choose platform and region
//    $players = "account.69a0587badc340f09a97771109eff2a8"; // choose a player (ign)
//    $headers = array(
//        'Authorization' => $apiKey,
//        'Accept' => 'application/vnd.api+json'
//    );
//    $getPlayer = Requests::get('https://api.playbattlegrounds.com/shards/'.$region.'/players?filter[playerIds]='.$players.'', $headers);
//    $getPlayerContent = json_decode($getPlayer->body, true);
//    $name = $getPlayerContent['data'][0]['attributes']['name'];
//    return $name;
//}


function get5SimCountry()
{
    $country = [

    ];
    return $country;
}

function get5SimCountries()
{
    $countries = [
        "afghanistan" => "Afghanistan",
        "albania" => "Albania",
        "algeria" => "Algeria",
        "angola" => "Angola",
        "anguilla" => "Anguilla",
        "antiguaandbarbuda" => "Antigua and Barbuda",
        "argentina" => "Argentina",
        "aruba" => "Aruba",
        "australia" => "Australia",
        "austria" => "Austria",
        "azerbaijan" => "Azerbaijan",
        "bahamas" => "Bahamas",
        "bahrain" => "Bahrain",
        "bangladesh" => "Bangladesh",
        "barbados" => "Barbados",
        "belarus" => "Belarus",
        "belgium" => "Belgium",
        "belize" => "Belize",
        "benin" => "Benin",
        "bih" => "Bosnia and Herzegovina",
        "bolivia" => "Bolivia",
        "botswana" => "Botswana",
        "brazil" => "Brazil",
        "bulgaria" => "Bulgaria",
        "burkinafaso" => "Burkina Faso",
        "burundi" => "Burundi",
        "cambodia" => "Cambodia",
        "cameroon" => "Cameroon",
        "canada" => "Canada",
        "capeverde" => "Cape Verde",
        "caymanislands" => "Cayman Islands",
        "chad" => "Chad",
        "chile" => "Chile",
        "china" => "China",
        "colombia" => "Colombia",
        "comoros" => "Comoros",
        "congo" => "Congo",
        "costarica" => "Costa Rica",
        "croatia" => "Croatia",
        "cyprus" => "Cyprus",
        "czech" => "Czechia",
        "djibouti" => "Djibouti",
        "dominica" => "Dominica",
        "dominicana" => "Dominican Republic",
        "easttimor" => "East Timor",
        "ecuador" => "Ecuador",
        "egypt" => "Egypt",
        "england" => "England",
        "equatorialguinea" => "Equatorial Guinea",
        "eritrea" => "Eritrea",
        "estonia" => "Estonia",
        "ethiopia" => "Ethiopia",
        "finland" => "Finland",
        "france" => "France",
        "frenchguiana" => "French Guiana",
        "gabon" => "Gabon",
        "gambia" => "Gambia",
        "georgia" => "Georgia",
        "germany" => "Germany",
        "ghana" => "Ghana",
        "greece" => "Greece",
        "grenada" => "Grenada",
        "guadeloupe" => "Guadeloupe",
        "guatemala" => "Guatemala",
        "guinea" => "Guinea",
        "guineabissau" => "Guinea-Bissau",
        "guyana" => "Guyana",
        "haiti" => "Haiti",
        "honduras" => "Honduras",
        "hongkong" => "Hong Kong",
        "hungary" => "Hungary",
        "india" => "India",
        "indonesia" => "Indonesia",
        "ireland" => "Ireland",
        "italy" => "Italy",
        "ivorycoast" => "Ivory Coast",
        "jamaica" => "Jamaica",
        "japan" => "Japan",
        "jordan" => "Jordan",
        "kazakhstan" => "Kazakhstan",
        "kenya" => "Kenya",
        "kuwait" => "Kuwait",
        "kyrgyzstan" => "Kyrgyzstan",
        "laos" => "Laos",
        "latvia" => "Latvia",
        "lesotho" => "Lesotho",
        "liberia" => "Liberia",
        "lithuania" => "Lithuania",
        "luxembourg" => "Luxembourg",
        "macau" => "Macau",
        "madagascar" => "Madagascar",
        "malawi" => "Malawi",
        "malaysia" => "Malaysia",
        "maldives" => "Maldives",
        "mauritania" => "Mauritania",
        "mauritius" => "Mauritius",
        "mexico" => "Mexico",
        "moldova" => "Moldova",
        "mongolia" => "Mongolia",
        "montenegro" => "Montenegro",
        "montserrat" => "Montserrat",
        "morocco" => "Morocco",
        "mozambique" => "Mozambique",
        "myanmar" => "Myanmar",
        "namibia" => "Namibia",
        "nepal" => "Nepal",
        "netherlands" => "Netherlands",
        "newcaledonia" => "New Caledonia",
        "newzealand" => "New Zealand",
        "nicaragua" => "Nicaragua",
        "niger" => "Niger",
        "nigeria" => "Nigeria",
        "northmacedonia" => "North Macedonia",
        "norway" => "Norway",
        "oman" => "Oman",
        "pakistan" => "Pakistan",
        "panama" => "Panama",
        "papuanewguinea" => "Papua New Guinea",
        "paraguay" => "Paraguay",
        "peru" => "Peru",
        "philippines" => "Philippines",
        "poland" => "Poland",
        "portugal" => "Portugal",
        "puertorico" => "Puertorico",
        "reunion" => "Reunion",
        "romania" => "Romania",
        "russia" => "Russia",
        "rwanda" => "Rwanda",
        "saintkittsandnevis" => "Saint Kitts and Nevis",
        "saintlucia" => "Saint Lucia",
        "saintvincentandgrenadines" => "Saint Vincent and the Grenadines",
        "salvador" => "Salvador",
        "samoa" => "Samoa",
        "saotomeandprincipe" => "Sao Tome and Principe",
        "audiarabia" => "Saudi Arabia",
        "senegal" => "Senegal",
        "serbia" => "Serbia",
        "seychelles" => "Republic of Seychelles",
        "sierraleone" => "Sierra Leone",
        "singapore" => "Singapore",
        "slovakia" => "Slovakia",
        "slovenia" => "Slovenia",
        "solomonislands" => "Solomon Islands",
        "southafrica" => "South Africa",
        "spain" => "Spain",
        "srilanka" => "Sri Lanka",
        "suriname" => "Suriname",
        "swaziland" => "Swaziland",
        "sweden" => "Sweden",
        "switzerland" => "Switzerland",
        "taiwan" => "Taiwan",
        "tajikistan" => "Tajikistan",
        "tanzania" => "Tanzania",
        "tit" => "Trinidad and Tobago",
        "togo" => "Togo",
        "tonga" => "Tonga",
        "tunisia" => "Tunisia",
        "turkey" => "Turkey",
        "turkmenistan" => "Turkmenistan",
        "turksandcaicos" => "Turks and Caicos Island",
        "uganda" => "Uganda",
        "ukraine" => "Ukraine",
        "uruguay" => "Uruguay",
        "usa" => "USA",
        "uzbekistan" => "Uzbekistan",
        "venezuela" => "Venezuela",
        "vietnam" => "Vietnam",
        "virginislands" => "British Virgin Islands",
        "zambia" => "Zambia",
        "zimbabwe" => "Zimbabwe"

    ];
    return $countries;
}

function get5SimProducts()
{
    $products = [
        "airtel",
        "alfa",
        "bigolive",
        "cryptocom",
        "delivery",
        "facebook",
        "fiqsy",
        "fiverr",
        "foodpanda",
        "foody",
        "forwarding",
        "freecharge",
        "galaxy",
        "gamearena",
        "gameflip",
        "gamekit",
        "gamer",
        "gcash",
        "get",
        "getir",
        "gett",
        "gg",
        "gittigidiyor",
        "global24",
        "globaltel",
        "globus",
        "glovo",
        "google",
        "grabtaxi",
        "green",
        "grindr",
        "hamrahaval",
        "happn",
        "haraj",
        "hepsiburadacom",
        "hezzl",
        "hily",
        "hopi",
        "hqtrivia",
        "humblebundle",
        "humta",
        "huya",
        "icard",
        "icq",
        "icrypex",
        "ifood",
        "immowelt",
        "imo",
        "inboxlv",
        "indriver",
        "ininal",
        "instagram",
        "iost",
        "iqos",
        "ivi",
        "iyc",
        "jd",
        "jkf",
        "justdating",
        "justdial",
        "kakaotalk",
        "karusel",
        "keybase",
        "komandacard",
        "kotak811",
        "kucoinplay",
        "kufarby",
        "kvartplata",
        "kwai",
        "lazada",
        "lbry",
        "lenta",
        "lianxin",
        "line",
        "linkedin",
        "livescore",
        "magnit",
        "magnolia",
        "mailru",
        "mamba",
        "mcdonalds",
        "meetme",
        "mega",
        "mercado",
        "michat",
        "microsoft",
        "miloan",
        "miratorg",
        "mobile01",
        "momo",
        "monese",
        "monobank",
        "mosru",
        "mrgreen",
        "mtscashback",
        "myfishka",
        "myglo",
        "mylove",
        "mymusictaste",
        "mzadqatar",
        "nana",
        "naver",
        "ncsoft",
        "netflix",
        "nhseven",
        "nifty",
        "nike",
        "nimses",
        "nrjmusicawards",
        "nttgame",
        "odnoklassniki",
        "offerup",
        "offgamers",
        "okcupid",
        "okey",
        "okta",
        "olacabs",
        "olx",
        "onlinerby",
        "openpoint",
        "oraclecloud",
        "oriflame",
        "other",
        "ozon",
        "paddypower",
        "pairs",
        "papara",
        "paxful",
        "payberry",
        "paycell",
        "paymaya",
        "paypal",
        "paysend",
        "paytm",
        "peoplecom",
        "perekrestok",
        "pgbonus",
        "picpay",
        "pof",
        "pokec",
        "pokermaster",
        "potato",
        "powerkredite",
        "prajmeriz2020",
        "premiumone",
        "prom",
        "proton",
        "protonmail",
        "protp",
        "pubg",
        "pureplatfrom",
        "pyaterochka",
        "pyromusic",
        "q12trivia",
        "qiwiwallet",
        "quipp",
        "rakuten",
        "rambler",
        "rediffmail",
        "reuse",
        "ripkord",
        "rosakhutor",
        "rsa",
        "rutube",
        "samokat",
        "seosprint",
        "sheerid",
        "shopee",
        "signal",
        "sikayetvar",
        "skout",
        "snapchat",
        "snappfood",
        "sneakersnstuff",
        "socios",
        "sportmaster",
        "spothit",
        "ssoidnet",
        "steam",
        "surveytime",
        "swvl",
        "taksheel",
        "tango",
        "tantan",
        "taobao",
        "telegram",
        "tencentqq",
        "ticketmaster",
        "tiktok",
        "tinder",
        "tosla",
        "totalcoin",
        "touchance",
        "trendyol",
        "truecaller",
        "twitch",
        "twitter",
        "uber",
        "ukrnet",
        "uploaded",
        "vernyi",
        "vernyj",
        "viber",
        "vitajekspress",
        "vkontakte",
        "voopee",
        "wechat",
        "weibo",
        "weku",
        "weststein",
        "whatsapp",
        "wildberries",
        "wingmoney",
        "winston",
        "wish",
        "wmaraci",
        "wolt",
        "yaay",
        "yahoo",
        "yalla",
        "yandex",
        "yemeksepeti",
        "youdo",
        "youla",
        "youstar",
        "zalo",
        "zoho",
        "zomato",
    ];

    return $products;
}

function adminnotify($user, $type, $shortCodes = null)
{
    sendEmailtoAdmin($user, $type, $shortCodes);

}
function sendTelegramNotification($url,$data)
{
   $notification= new TelegramNotification($url,$data);
   $admin = Admin::first();
    Notification::send($admin, $notification);
}
function sendEmailtoAdmin($user, $type = null, $shortCodes = [])
{
    $general = GeneralSetting::first();
    $email_template = EmailTemplate::where('act', $type)->where('email_status', 1)->first();

    $message = shortCodeReplacer("{{name}}", 'ايها المدير', $general->email_template);
    $message = shortCodeReplacer("{{message}}", $email_template->email_body, $message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }
    foreach ($shortCodes as $code => $value) {
        $message = shortCodeReplacer('{{' . $code . '}}', $value, $message);
    }
    $config = $general->mail_config;
    foreach (\App\Models\Admin::all() as $admin) {
        if ($config->name == 'php') {
            sendPhpMail($admin->email, $user->username, $email_template->subj, $message);
        } else if ($config->name == 'smtp') {
            sendSmtpMail($config, $admin->email, $user->username, $email_template->subj, $message, $general);
        } else if ($config->name == 'sendgrid') {
            sendSendGridMail($config, $admin->email, $user->username, $email_template->subj, $message, $general);
        } else if ($config->name == 'mailjet') {
            sendMailjetMail($config, $admin->email, $user->username, $email_template->subj, $message, $general);
        }
    }
}

function getLevelName($level)
{
    if ($level == 1)
        return 'الاولى';
    elseif ($level == 2)
        return 'الثانية';
    elseif ($level == 3)
        return 'الثالثة';
    elseif ($level == 4)
        return 'الرابعة';
    elseif ($level == 5)
        return 'الخامسة';
    elseif ($level == 6)
        return 'السادسة';
    elseif ($level == 7)
        return 'السابعة';
    elseif ($level == 8)
        return 'الثامنة';
    elseif ($level == 9)
        return 'التاسعة';
    elseif ($level == 10)
        return 'العاشرة';
    return 'معلقة';
}

