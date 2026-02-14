<?php
$directorio_certificado_seguridad        = dirname(__FILE__);
$nombre_archivo_certificado_seguridad    = "cacert.pem";
$ruta_certificado_seguridad_comilla      = $directorio_certificado_seguridad.'\"'.$nombre_archivo_certificado_seguridad;
$ruta_certificado_seguridad              = str_replace('"', '', $ruta_certificado_seguridad_comilla);

$url                                     = 'https://graph.facebook.com/v22.0/537918802748038/messages';
$token                                   = 'EAAIV6SWDOcEBO9JL2nyFKW1uAnaQUbZCEFxGzDDvkySj8yo9PNIl06ERqngnO6R1A7HOtgzTcxYgcNCvI8m23FNz9Fyqk3IQMfX5K2uQ5EWZBIiRawOGOL5HkYEBu7prZAZC0YoVaB7bk9FFxgeP3FbtlqgVvc5IwQ0R8i1VxiwCPB714ZCvyE0JrKL9ZBoyVFpgZDZD';

$nombre                                  = "Emanuel";
$telefono_virgin_receptor                = "573192545831";
$telefono_wom_receptor                   = "573028551795";
$telefono_tigo_receptor                  = "573012910881";
$nombre_plantilla_whatsapp               = "hello_world";
$nombre_plantilla_whatsapp2              = "plantilla_msj_whatsapp";
$idioma_plantilla_whatsapp               = "es_COL";
$idioma_plantilla_whatsapp2              = "en_US";

$data = array(
    "messaging_product" => "whatsapp",
    "recipient_type" => "individual",
    "to" => $telefono_wom_receptor,
    "type" => "template",
    "template" => array(
        "name" => $nombre_plantilla_whatsapp,
        "language" => array(
            "code" => $idioma_plantilla_whatsapp2
        ),
/*
        "components" => array(
            array(
                "type" => "body",
                "parameters" => array(
                    array(
                        "type" => "text",
                        "text" => "nombre texto"
                    )
                )
            )
        )
*/
    )
);

$data_string = json_encode($data);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE); 
curl_setopt($curl, CURLOPT_CAINFO, $ruta_certificado_seguridad);
//curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token, 'Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));

$result = curl_exec($curl);
// Verificar si hubo un error
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    echo 'Error: ' . $error_msg;
}

// Obtener el código de estado HTTP
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

// Mostrar la respuesta y el código de estado
echo '<br>HTTP Code: ' . $http_code . PHP_EOL;
echo '<br>Response: ' . $result;

//curl_close($curl);
//echo $result;
?>