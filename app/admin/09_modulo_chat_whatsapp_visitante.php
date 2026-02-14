<div class="nav-bottom">
    <div class="popup-whatsapp fadeIn">
        <div class="content-whatsapp -top"><img src="../imagenes/secretary.png" width="50"><button type="button" class="closePopup"></button>

        <div class="">
           <p><strong>Servicio al Cliente</strong><br>¡Hola! Soy su asistente personal. Estaremos atentos a cualquier inquietud que tenga para ayudarle.</p>
        </div>
        </div>

<!--
        <div class="content-whatsapp -top"><button type="button" class="closePopup"><i class="material-icons icon-font-color">X</i></button> 
           <p><img src="../imagenes/secretary.png" width="50"> Servicio al Cliente<br>¡Hola! Soy su asistente personal. Estaremos atentos a cualquier inquietud que tenga para ayudarle.</p>
        </div>
-->
        <div class="content-whatsapp -bottom">
          <input class="whats-input" id="whats-in" type="text" Placeholder="Enviar mensaje..." />
            <button class="send-msPopup" id="send-btn" type="button"><img src="../imagenes/btn_enviar_whatsapp.png"></button>
        </div>
    </div>
    <button type="button" id="whats-openPopup" class="whatsapp-button"><div class="float"><img src="../imagenes/btn_whatsapp_flotante.png"></div></button>
    <div class="circle-anime"></div>
</div>

<script type="text/javascript">
popupWhatsApp = () => {
  
  let btnClosePopup = document.querySelector('.closePopup');
  let btnOpenPopup = document.querySelector('.whatsapp-button');
  let popup = document.querySelector('.popup-whatsapp');
  let sendBtn = document.getElementById('send-btn');

  btnClosePopup.addEventListener("click",  () => {
    popup.classList.toggle('is-active-whatsapp-popup')
  })
  
  btnOpenPopup.addEventListener("click",  () => {
    popup.classList.toggle('is-active-whatsapp-popup')
     popup.style.animation = "fadeIn .6s 0.0s both";
  })
  
  sendBtn.addEventListener("click", () => {
  let mensaje = document.getElementById('whats-in').value;
  let mensaje_trad = mensaje.replace(/ /g,"%20");
     
   window.open('https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>&text='+mensaje_trad, '_blank'); 
  
  });

  setTimeout(() => {
    popup.classList.toggle('is-active-whatsapp-popup');
  }, 3000);
}

popupWhatsApp();
</script>