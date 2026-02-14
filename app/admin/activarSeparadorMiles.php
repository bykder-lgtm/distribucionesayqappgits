<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Separador de miles en tiempo real</title>
  <style>
    input{
      padding: .5rem;
      font-size: 1.2rem;
      width: 100%;
      max-width: 400px;
      box-sizing: border-box;
    }
  </style>
</head>
<body>

<h2>Introduce un número y ve el separador de miles aparecer con cada tecla:</h2>
<input type="text" id="precio_venta_producto_formateado" placeholder="">

<script>
/**
 * Añade formato de separador de miles (punto) mientras se escribe
 *
 * @param {HTMLInputElement | HTMLTextAreaElement} el   Elemento que recibirá la entrada
 */
function activarSeparadorMiles(evento_valor){
    // Se activa con cada cambio en el input (tecla, pegado, borrado…)
    evento_valor.addEventListener('input', () => {
        let precio_venta_producto_formateado = evento_valor.value;

        /* 1. Mantener signo negativo si existe */
        const esNegativo = precio_venta_producto_formateado.startsWith('-');
        
        if (esNegativo) { 
          precio_venta_producto_formateado = precio_venta_producto_formateado.slice(1); 
        }

        /* 2. Eliminar todo lo que no sea dígito */
        precio_venta_producto_formateado = precio_venta_producto_formateado.replace(/\D/g, '');

        /* 3. Si el número tiene más de 3 cifras, insertamos los puntos
           usando una expresión regular que coloca un punto antes de cada
           grupo de tres dígitos que vaya a la izquierda (desde la derecha). */
        if (precio_venta_producto_formateado.length > 3) {
            precio_venta_producto_formateado = precio_venta_producto_formateado.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        /* 4. Volver a colocar el signo negativo al principio si lo había */
        if (esNegativo && precio_venta_producto_formateado !== '') precio_venta_producto_formateado = '-' + precio_venta_producto_formateado;

        evento_valor.value = precio_venta_producto_formateado;   // Actualizamos el contenido del input
    });
}

// Ejemplo de uso:
const campoNumero = document.getElementById('precio_venta_producto_formateado');
activarSeparadorMiles(campoNumero);
</script>
</body>
</html>