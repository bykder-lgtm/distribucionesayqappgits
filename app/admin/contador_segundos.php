<div class="cronometro">
    <div id="segundos_cronometro"></div>
    <div class="boton start"></div>        
    <div class="boton stop"></div>
    <div class="boton reiniciar"></div>
</div>

<script>
window.onload = init;
function init(){
    document.querySelector(".start").addEventListener("click",cronometrar);
    document.querySelector(".stop").addEventListener("click",parar);
    document.querySelector(".reiniciar").addEventListener("click",reiniciar);
    h = 0;
    m = 0;
    s = 0;
    document.getElementById("segundos_cronometro").innerHTML="00";
}         
function cronometrar(){
    escribir();
    id = setInterval(escribir,1000);
    document.querySelector(".start").removeEventListener("click",cronometrar);
}
function escribir(){
    var hAux;
    var mAux;
    var sAux;
    s++;
    //sAux++;
    if (s>59) { m++;s=0; }
    if (m>59) { h++;m=0; }
    if (h>24) { h=0; }

    if (s<10) { sAux="0"+s; } else { sAux=s; }
    if (m<10) { mAux="0"+m; } else { mAux=m; }
    if (h<10) { hAux="0"+h; } else { hAux=h; }

    document.getElementById("segundos_cronometro").innerHTML = sAux; 
}

function parar(){
    clearInterval(id);
    //document.querySelector(".start").addEventListener("click",cronometrar);
}

function reiniciar(){
    clearInterval(id);
    //document.getElementById("segundos_cronometro").innerHTML="00";
    h = 0;
    m = 0;
    s = 0;
    //document.querySelector(".start").addEventListener("click",cronometrar);
}

</script>

<style>
*{box-sizing:border-box;margin:0;padding:0;}

.cronometro{
    width:200px;
    height:100px;
    top:50%;
    left:50%;
    position:absolute;
    margin-top:-50px;
    margin-left:-100px;
    text-align:center;
} 
.boton{display:inline-block;width:32px;height:32px;position:relative;}
#segundos_cronometro{
    height:68px;
    padding:5px 0;
    font-size:50px;
    color:#000;
    font-family: alarm;  
 }

    .start{background:url(../imagenes/active.png) 0 0 no-repeat;}
/*
    .stop{background:url(../imagenes/actualizar.png) 0 0 no-repeat;}
    .reiniciar{background:url(../imagenes/admiracion.png)0 0 no-repeat;}
*/

</style>