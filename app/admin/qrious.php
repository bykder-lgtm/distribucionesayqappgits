<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Puedes descargar el 
 script e incluirlo de manera local si así prefieres-->
	<script type="text/javascript" src="../js/qrious.js"></script>
	<title>Generar códigos QR - By Parzibyte</title>
</head>

<body>
	<img alt="Código QR" id="codigo">
	<script>
		new QRious({
			element: document.querySelector("#codigo"),
			value: "https://catalogo-vpfe.dian.gov.co/document/searchqr", // La URL o el texto
			size: 90,
			backgroundAlpha: 0, // 0 para fondo transparente
			foreground: "#000", // Color del QR
			level: "H", // Puede ser L,M,Q y H (L es el de menor nivel, H el mayor)
		});
	</script>
</body>

</html>