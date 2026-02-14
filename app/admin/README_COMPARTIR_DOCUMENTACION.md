# Sistema de Compartir Documentación de Aliados

## Descripción
Este sistema permite comprimir y compartir la documentación de los aliados (Cédula, RUT y Cámara de Comercio) de tres maneras diferentes:
1. **Enviar por Email** - Envía el ZIP por correo electrónico
2. **Descargar** - Descarga directamente el archivo ZIP
3. **Generar Enlace** - Crea un enlace para compartir

## Archivos Creados

### PHP Backend
- `generar_zip_documentacion.php` - Genera el archivo ZIP con los documentos
- `enviar_email_documentacion.php` - Envía el ZIP por correo electrónico usando PHPMailer

### Ubicación de Archivos Temporales
Los archivos ZIP se guardan temporalmente en:
```
app/archivador/temp_zips/
```

## Configuración Inicial

### 1. Crear Directorio para ZIPs Temporales
Ejecuta el siguiente comando en PowerShell desde la raíz del proyecto:

```powershell
New-Item -ItemType Directory -Path "app\archivador\temp_zips" -Force
```

### 2. Configurar Email (SMTP)

**IMPORTANTE:** El sistema utiliza la configuración SMTP guardada en la base de datos (tabla `tbl15_correo_smtp`).

Para configurar el servidor SMTP, debes hacerlo desde el panel de administración del sistema, donde se almacena:
- Host SMTP (smtp.gmail.com, smtp.office365.com, etc.)
- Puerto (587 para TLS, 465 para SSL)
- Usuario (tu email)
- Contraseña (contraseña de aplicación para Gmail)
- Tipo de seguridad (TLS/SSL)

#### Para Gmail:
1. Activa la verificación en dos pasos en tu cuenta de Google
2. Ve a: https://myaccount.google.com/apppasswords
3. Genera una "Contraseña de aplicación" para Correo
4. Usa esa contraseña en la configuración SMTP del sistema

**No necesitas editar archivos PHP** - toda la configuración se hace desde la interfaz web del sistema.

### 3. Verificar Extensión ZipArchive
Asegúrate de que la extensión `zip` esté habilitada en tu PHP:

En `php.ini`, busca y descomenta (quita el `;` al inicio):
```ini
extension=zip
```

Luego reinicia Apache.

## Uso

### Desde la Interfaz
1. En la lista de aliados, haz clic en el botón **"Compartir Docs"** (botón verde con ícono de compartir)
2. El sistema verificará que existan los archivos y generará el ZIP
3. Se mostrará un modal con tres opciones:

#### Opción 1: Enviar por Email
- Ingresa el email destino
- Opcional: Agrega un mensaje personalizado
- Haz clic en "Enviar"

#### Opción 2: Descargar
- Haz clic en "Descargar ZIP"
- El archivo se descargará automáticamente

#### Opción 3: Generar Enlace
- Haz clic en "Generar Enlace"
- Se mostrará un enlace que puedes copiar y compartir
- Usa el botón "Copiar" para copiar al portapapeles

## Características

### Validaciones Implementadas
- ✅ Verifica que los archivos existan antes de comprimir
- ✅ Valida formato de email
- ✅ Muestra mensajes de error descriptivos
- ✅ Loading spinner durante la generación del ZIP
- ✅ Confirmación de acciones exitosas

### Seguridad
- ✅ Verificación de sesión activa
- ✅ Validación de permisos de aliado
- ✅ Los archivos ZIP se crean con nombre único (incluye timestamp)
- ✅ Solo comprime archivos que existan físicamente

### Información Incluida en el ZIP
- Nombre del documento (Cédula, RUT, Cámara de Comercio)
- Nombre del archivo original
- Formato: `Tipo_NombreArchivo.ext`

## Limpieza de Archivos Temporales

Los archivos ZIP temporales se acumulan en `app/archivador/temp_zips/`. Se recomienda crear una tarea programada para limpiar archivos antiguos.

### Script de Limpieza (PowerShell)
Crea un archivo `limpiar_zips_antiguos.ps1`:

```powershell
# Eliminar archivos ZIP con más de 7 días de antigüedad
$ruta = "app\archivador\temp_zips"
$dias = 7
$fecha_limite = (Get-Date).AddDays(-$dias)

Get-ChildItem -Path $ruta -Filter "*.zip" | 
    Where-Object { $_.LastWriteTime -lt $fecha_limite } | 
    Remove-Item -Force

Write-Host "Limpieza completada. Archivos con más de $dias días han sido eliminados."
```

### Programar Limpieza Automática (Windows)
Usa el Programador de Tareas de Windows para ejecutar el script semanalmente.

## Troubleshooting

### Error: "No se encontraron documentos para comprimir"
**Causa**: Los campos de las URLs de documentos están vacíos o los archivos no existen físicamente.
**Solución**: Verifica que el aliado tenga documentos cargados y que los archivos existan en el servidor.

### Error: "No se pudo crear el archivo ZIP"
**Causa**: La extensión ZipArchive no está habilitada o no hay permisos de escritura.
**Solución**: 
1. Verifica que `extension=zip` esté habilitada en php.ini
2. Verifica permisos de escritura en `app/archivador/temp_zips/`

### Error al enviar email
**Causa**: Configuración incorrecta de SMTP o credenciales inválidas.
**Solución**:
1. Verifica las credenciales en `config_email.php`
2. Para Gmail, usa contraseña de aplicación (no la contraseña normal)
3. Verifica que el puerto y el tipo de seguridad sean correctos

### El enlace generado no funciona
**Causa**: Problema con la URL base o permisos de acceso.
**Solución**: Verifica que la carpeta `archivador/temp_zips/` sea accesible desde el navegador.

## Soporte Técnico

Para problemas o sugerencias, contacta al desarrollador del sistema.

---

**Versión:** 1.0  
**Fecha:** Febrero 2026  
**Autor:** Sistema de Gestión AYQ
