<?php

// use Faker\Extension\Helper;


function sendEmail($attach, $to, $title, $msg)
{
    $email = \Config\Services::email();
    // $sendemail = "xxx";
    // $sendname = "xxx";

    $config['protocol'] = 'smtp';
    $config['SMTPHost'] = 'smtp.gmail.com';
    $config['SMTPUser'] = EMAIL;
    $config['SMTPPass'] = EMAIL_PW;
    $config['SMTPCrypto'] = 'ssl';
    $config['SMTPPort'] = 465;
    $config['mailType'] = 'html';

    // $msg="Click link this below for reset Password";

    $email->initialize($config);
    $email->setFrom(EMAIL, EMAIL_NAME);
    $email->setTo($to);
    $email->setMessage($msg);
    // $email->attach($attach);
    $email->setSubject($title);

    if ($attach) {
        $email->attach($attach);
    }


    // $emailfill = [
    //     'attach' => $attach,
    //     'to' => $to,
    //     'title' => $title,
    //     'msg' => $msg,
    // ];

    if (!$email->send()) {
        // $notif = 'FAIL TO SEND EMAIL';
        $e = $email->printDebugger(['headers']);
        return $e;
    } else {
        // $notif = 'SUCCESS FOR SEND EMAIL';
        return true;
        # code...
    }
    // return $email;
}

function idForDate($date)
{

    $split = explode(' ', $date);
    $param1 = $split[0];
    $exp = explode(':', $split[1]);
    $param2 = $exp;
    $day = ['1' => 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    $month = ['1' => 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'sept', 'october', 'november', 'december'];
    $num = date('N', strtotime($param1));

    $split2 = explode('-', $param1);
    // $split3 = $param2;
    // $day[$num] . ', ' .
    $dt =  $split2[2] . ' ' . $month[(int)$split2[1]] . ' ' . $split2[0] . ', ' . $param2[0] . ':' . $param2[1];

    return $dt;
}

function number($perpage, $currentpg)
{
    $number = 1;
    if ($currentpg == true) {
        $number = 1 + ($perpage * ($currentpg - 1));
        # code...
    }
    return $number;
}

function purHtml($dirty_html)
{
    $config = HTMLPurifier_Config::createDefault();
    $config->set('URI.AllowedSchemes', ['data' => true]); // replace with your encoding
    // $config->set('Core', 'Encoding', 'ISO-8859-1'); // replace with your encoding
    // $config->set('HTML', 'Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($dirty_html);
    return $clean_html;
}
