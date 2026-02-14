<?php
function hasConnection() {  
    $ch = curl_init("https://www.google.com");  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  
    curl_exec($ch);  
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
    curl_close($ch);  
    return ($httpcode>=200 && $httpcode<300) ? TRUE : FALSE;
}
echo hasConnection();
?>