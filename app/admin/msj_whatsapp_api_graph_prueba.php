<?php
$directorio_certificado_seguridad        = dirname(__FILE__);
$nombre_archivo_certificado_seguridad    = "cacert.pem";
$ruta_certificado_seguridad_comilla      = $directorio_certificado_seguridad.'\"'.$nombre_archivo_certificado_seguridad;
$ruta_certificado_seguridad              = str_replace('"', '', $ruta_certificado_seguridad_comilla);

$url_test_number                         = 'https://graph.facebook.com/v22.0/537918802748038/messages';
$url_tel_virgin                          = 'https://graph.facebook.com/v22.0/571625459375875/messages';
$token                                   = 'EAAIV6SWDOcEBO9JL2nyFKW1uAnaQUbZCEFxGzDDvkySj8yo9PNIl06ERqngnO6R1A7HOtgzTcxYgcNCvI8m23FNz9Fyqk3IQMfX5K2uQ5EWZBIiRawOGOL5HkYEBu7prZAZC0YoVaB7bk9FFxgeP3FbtlqgVvc5IwQ0R8i1VxiwCPB714ZCvyE0JrKL9ZBoyVFpgZDZD';

$nombre                                  = "Camilo";
$telefono_virgin_receptor                = "573192545831";
$telefono_wom_receptor                   = "573028551795";
$telefono_tigo_receptor                  = "573012910881";
$nombre_plantilla_whatsapp               = "prueba_plantilla";
$nombre_plantilla_whatsapp2              = "plantilla_nombre_1";
$idioma_plantilla_whatsapp               = "es_COL";
/*
$data = '{
  "messaging_product": "whatsapp",
  "recipient_type": "individual",
  "to": $telefono_wom_receptor,
  "type": "interactive",
  "interactive" : {
    "type": "flow",
    "header": {
      "type": "text",
      "text": "Flow message header"
    },
    "body": {
      "text": "Flow message body"
    },
    "footer": {
      "text": "Flow message footer"
    },
    "action": {
      "name": "flow",
      "parameters": {
        "flow_message_version": "3",
        "flow_id": "<FLOW_ID>", // Or flow_name
        "flow_cta": "Book!",
       }
      }
    }
  }
}';
$data_string = $data;

  "messaging_product":"whatsapp",
  "recipient_type":"individual",
  "to":"573028551795",
  "type":"template",
  "template":{
    "name":"prueba_nombre",
    "language":{
      "code":"es_CO"
    },
    "components":[
      {
        "type":"body",
        "parameters":[
          {
            "type":"text",
            "text":"Emanuel"
          }
        ]
      }
    ]
  }
}

{ 
  "messaging_product": "whatsapp", 
  "recipient_type": "individual", 
  "to": "573028551795", 
  "type": "template", 
  "template": { 
    "name": "prueba_nombre", 
    "language": { 
      "code": "es_CO" 
    }, 
    "components": [ 
      { 
        "type": "body", 
        "parameters": [ 
          { 
            "type": "text", 
            "text": "Camilo Villanueva" 
          } 
        ] 
      } 
    ] 
  } 
} 
*/

/*
$datos_json = '';
$datos_json .= '        {';
$datos_json .= '          "messaging_product": "whatsapp",';
$datos_json .= '          "recipient_type": "individual",';
$datos_json .= '          "to": "'.$telefono_wom_receptor.'",';
$datos_json .= '          "type": "template", ';
$datos_json .= '          "template":{';
$datos_json .= '            "name": "'.$nombre_plantilla_whatsapp2.'",';
$datos_json .= '            "language":{';
$datos_json .= '              "code": "es_CO" ';
$datos_json .= '            },';
$datos_json .= '          "components":[';
$datos_json .= '            {';
$datos_json .= '              "type": "body",';
$datos_json .= '              "parameters":[';
$datos_json .= '                {';
$datos_json .= '                  "type": "text",';
$datos_json .= '                  "text": "'.$nombre.'"';
$datos_json .= '                }';
$datos_json .= '              ]';
$datos_json .= '             }';
$datos_json .= '            ]';
$datos_json .= '          }';
$datos_json .= '        }';
*/
$data = array(
    "messaging_product" => "whatsapp",
    "recipient_type" => "individual",
    "to" => $telefono_wom_receptor,
    "type" => "template",
    "template" => array(
        "name" => $nombre_plantilla_whatsapp2,
        "language" => array(
            "code" => "es_CO"
        ),
        "components" => array(
            array(
                "type" => "body",
                "parameters" => array(
                    array(
                        "type" => "text",
                        "text" => $nombre
                    )
                )
            )
        )
    )
);
$datos_json = json_encode($data);


$curl = curl_init($url_test_number);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE); 
curl_setopt($curl, CURLOPT_CAINFO, $ruta_certificado_seguridad);
//curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $datos_json);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json',
    'Content-Length: ' . strlen($datos_json)
));

$result = curl_exec($curl);
// Verificar si hubo un error
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    echo 'Error: ' . $error_msg;
}

// Obtener el código de estado HTTP
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

echo '<br>HTTP Code: '.$http_code . PHP_EOL;
echo '<br>Response: '.$result;
echo '<br>'.$datos_json;

//curl_close($curl);
//echo $result;
?>