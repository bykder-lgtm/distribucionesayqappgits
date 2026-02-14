setlocal EnableDelayedExpansion

set fecha_ymd_venta_producto_ini=%date:~-4,4%-%date:~-7,2%-%date:~-10,2%
set ruta_actual=%CD%
set ruta_actual_remplazar_contraslash=%ruta_actual:\=/% 
set separacion_slash_1=%ruta_actual_remplazar_contraslash:*/=%
set separacion_slash_2=%separacion_slash_1:*/=%
set separacion_slash_3=%separacion_slash_2:*/=%
set separacion_slash_4=%separacion_slash_3:*/=%
set separacion_slash_5=%separacion_slash_4:*/=%
set http=http://localhost/

set ruta_carpeta_sin_espacios_prueba=%separacion_slash_6: =%
set ruta_carpeta_sin_espacios_produccion=%separacion_slash_3: =%

set ruta_http_prueba=%http%sistemaseditaxe/mysqli/%ruta_carpeta_sin_espacios_prueba%
set ruta_http_produccion=%http%%ruta_carpeta_sin_espacios_produccion%

cd..
cd curl
cd x86
curl %ruta_http_produccion%/enviar_correo_personal_recordatorio_renovaciones_tipo_cobro_outlook_reg.php?fecha_ymd_venta_producto_ini=%fecha_ymd_venta_producto_ini%
::curl %ruta_http_prueba%/enviar_correo_personal_recordatorio_renovaciones_tipo_cobro_outlook_reg.php?fecha_ymd_venta_producto_ini=%fecha_ymd_venta_producto_ini%
pause