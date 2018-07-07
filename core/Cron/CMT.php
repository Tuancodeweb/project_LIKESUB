<?php
include '../connect.php';
$result = mysqli_query($conn, 'SELECT user_id, cmts, max_cmt,noi_dung,gender,hash_tag FROM vipcmt ORDER BY RAND()');
while ($vip = mysqli_fetch_assoc($result)) {
    $feed = json_decode(DuySex('https://graph.fb.me/' . $vip['user_id'] . '/feed?limit=1&fields=id,comments,message&access_token=' . $tokenx . '&method=get'), true);
    $listcmt = explode("\n", $vip['noi_dung']);
    if (stripos($feed['data'][0]['message'], $vip['hash_tag'], 0) === false) {
        $limit = $vip['cmts'];
        if ($feed['data'][0]['comments']['count'] <= $vip['max_cmt']) {
            $result1 = mysqli_query($conn, 'SELECT access_token FROM autocmt ORDER BY RAND() LIMIT '.$limit);
            while ($token = mysqli_fetch_assoc($result1)) {
                $cmt = urlencode($listcmt[array_rand($listcmt)]);
                $me = json_decode(DuySex('https://graph.fb.me/me?access_token=' . $token['access_token'] . '&fields=gender,id&method=get'), true);
                if ($vip['gender'] != 'both') {
                    if ($vip['gender'] == $me['gender']) {
                        echo DuySex('https://graph.fb.me/' . $feed['data'][0]['id'] . '/comments?access_token=' . $token['access_token'] . '&message=' . $cmt . '&method=post');
                    }
                } else {
                    echo DuySex('https://graph.fb.me/' . $feed['data'][0]['id'] . '/comments?access_token=' . $token['access_token'] . '&message=' . $cmt . '&method=post');
                }
            }
        }
    }
}

function DuySex($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    return $duy = curl_exec($ch);
    curl_close($ch);
}

?>