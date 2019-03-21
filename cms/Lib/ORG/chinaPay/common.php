<?php

function isEmpty($str){
    return $str==null||strlen(trim($str))==0?true:false;
}

function send_post($url, $post_data)
{
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}

//第一个是原串,第二个是 部份串
function startWith($str, $needle) {
    return strpos($str, $needle) === 0;
}

//第一个是原串,第二个是 部份串
function endWith($haystack, $needle) {
    $length = strlen($needle);
    if($length == 0)
    {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}

/**
 * 字符串补位.
 * @param val 字符串 .
 * @param type r右补位l左补位 .
 * @param size 补足长度 .
 * @param delim 补位用字符串 .
 * @return String .
 */
function pad($val, $type, $size, $delim)
{
    if (empty($val))
        return val;
    if ("r" == $type) {
        if (strlen($val) >= $size) {
            return substr($val, 0, $size);
        } else {
            return $val . repeat('r', $delim, $size - strlen($val));
        }
    } else {
        if (strlen($val) >= $size) {
            return substr($val, strlen($val) - $size);
        } else {
            return repeat('l', $delim, $size - strlen($val)) . $val;
        }
    }
}

/**
 * 重复字符串 .
 * @param type r右补位l左补位 .
 * @param val 字符串 .
 * @param len 长度 .
 * @return .
 */
function repeat($type, $val, $len)
{
    $tBuffer = "";
    while (strlen($tBuffer) < $len) {
        $tBuffer .= $val;
    }
    if ('r' == $type) {
        return substr($tBuffer, 0, $len);
    } else {
        return substr($tBuffer, strlen($tBuffer) - $len);
    }
}
