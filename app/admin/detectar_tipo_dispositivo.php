<?php
//------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------// 
$navegador_tableta             = 0;
$navegador_movil               = 0;
$tipo_dispostv                 = 'PC';
$info_navegador_dsipostivo     = $_SERVER['HTTP_USER_AGENT'];
$cabecera_accept               = $_SERVER['HTTP_ACCEPT'];
//$perfil_http_wap               = $_SERVER['HTTP_X_WAP_PROFILE'];
//$perfil_http                   = $_SERVER['HTTP_PROFILE'];

if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($info_navegador_dsipostivo))) {
    $navegador_tableta++;
    $tipo_dispostv = "TABLETA";
}
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($info_navegador_dsipostivo))) {
    $navegador_movil++;
    $tipo_dispostv = "MOVIL";
}
if ((strpos(strtolower($cabecera_accept),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $navegador_movil++;
    $tipo_dispostv = "MOVIL";
}
$mobile_ua = strtolower(substr($info_navegador_dsipostivo, 0, 4));
$mobile_agents = array('w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $navegador_movil++;
}
 
if (strpos(strtolower($info_navegador_dsipostivo),'opera mini') > 0) {
    $navegador_movil++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $navegador_tableta++;
    }
}
if ($navegador_tableta > 0) { $tipo_dispositivo_encontrado = 'TABLETA'; }
else if ($navegador_movil > 0) { $tipo_dispositivo_encontrado = 'MOVIL'; }
else { $tipo_dispositivo_encontrado = 'PC'; }
//------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------//
?>