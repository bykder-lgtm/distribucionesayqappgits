<?php
/**
 * Plantilla HTML del contrato "OFERTA MERCANTIL"
 * Generada a partir del documento Word: OFERTA MERCANTIL.docx
 * 
 * Variables esperadas (deben definirse antes de incluir este archivo):
 * - $nombre_intermediario_credito
 * - $firma_gestor_operador (base64 imagen firma)
 * - $nombre_rep_legal_gestor
 * - $documento_rep_legal_gestor
 * - $fecha_firma_gestor
 * - $firma_intermediario (base64 imagen firma)
 * - $representante_intermediario
 * - $documento_intermediario
 * - $fecha_intermediario
 * - $razon_social_tienda
 * - $nit_tienda
 * - $representante_legal_aliado
 * - $documento_aliado
 * - $correo_tienda
 * - $telefono_tienda
 * - $direccion_tienda
 * - $firma_aliado (base64 imagen firma - se llena al firmar)
 * - $nombre_rep_legal_aliado
 * - $documento_rep_legal_aliado
 * - $fecha_firma_aliado
 */

// Valores por defecto si no se pasan
$nombre_intermediario_credito   = isset($nombre_intermediario_credito) ? $nombre_intermediario_credito : '[NOMBRE INTERMEDIARIO]';
$firma_gestor_operador          = isset($firma_gestor_operador) ? $firma_gestor_operador : '';
$nombre_rep_legal_gestor        = isset($nombre_rep_legal_gestor) ? $nombre_rep_legal_gestor : '';
$documento_rep_legal_gestor     = isset($documento_rep_legal_gestor) ? $documento_rep_legal_gestor : '';
$fecha_firma_gestor             = isset($fecha_firma_gestor) ? $fecha_firma_gestor : '';
$firma_intermediario            = isset($firma_intermediario) ? $firma_intermediario : '';
$representante_intermediario    = isset($representante_intermediario) ? $representante_intermediario : '';
$documento_intermediario        = isset($documento_intermediario) ? $documento_intermediario : '';
$fecha_intermediario            = isset($fecha_intermediario) ? $fecha_intermediario : '';
$razon_social_tienda            = isset($razon_social_tienda) ? $razon_social_tienda : '';
$nit_tienda                     = isset($nit_tienda) ? $nit_tienda : '';
$representante_legal_aliado     = isset($representante_legal_aliado) ? $representante_legal_aliado : '';
$documento_aliado               = isset($documento_aliado) ? $documento_aliado : '';
$correo_tienda                  = isset($correo_tienda) ? $correo_tienda : '';
$telefono_tienda                = isset($telefono_tienda) ? $telefono_tienda : '';
$direccion_tienda               = isset($direccion_tienda) ? $direccion_tienda : '';
$firma_aliado                   = isset($firma_aliado) ? $firma_aliado : '';
$nombre_rep_legal_aliado        = isset($nombre_rep_legal_aliado) ? $nombre_rep_legal_aliado : '';
$documento_rep_legal_aliado     = isset($documento_rep_legal_aliado) ? $documento_rep_legal_aliado : '';
$fecha_firma_aliado             = isset($fecha_firma_aliado) ? $fecha_firma_aliado : '';
?>

<style>
.contrato-container {
    background: #fff;
    color: #222;
    font-family: 'Times New Roman', Times, serif;
    font-size: 14px;
    line-height: 1.6;
    padding: 2rem 1.5rem;
    border-radius: 12px;
    max-width: 800px;
    margin: 0 auto 2rem auto;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}
.contrato-container h1 {
    font-size: 1.1rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1.5rem;
    color: #111;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.contrato-container h2 {
    font-size: 1rem;
    font-weight: 700;
    margin: 1.5rem 0 0.5rem 0;
    color: #111;
}
.contrato-container p {
    margin-bottom: 0.5rem;
    text-align: justify;
}
.contrato-container .campo-dinamico {
    font-weight: 700;
    color: #1a56db;
    background: rgba(26, 86, 219, 0.06);
    padding: 1px 4px;
    border-radius: 3px;
}
.contrato-container ol, .contrato-container ul {
    margin: 0.5rem 0 0.5rem 1.5rem;
}
.contrato-container li {
    margin-bottom: 0.4rem;
}
.contrato-tabla-firmas {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
    font-size: 13px;
}
.contrato-tabla-firmas td, .contrato-tabla-firmas th {
    border: 1px solid #bbb;
    padding: 8px 10px;
    vertical-align: top;
}
.contrato-tabla-firmas th {
    background: #f0f0f0;
    font-weight: 700;
    text-align: left;
}
.contrato-firma-img {
    max-width: 200px;
    max-height: 80px;
}
.contrato-tabla-aceptante {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
    font-size: 13px;
}
.contrato-tabla-aceptante td {
    border: 1px solid #bbb;
    padding: 8px 10px;
}
.contrato-tabla-aceptante td:first-child {
    font-weight: 700;
    width: 200px;
    background: #fafafa;
}
.contrato-seccion-firma-aliado {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 2px solid #ddd;
}
.contrato-seccion-firma-aliado p {
    font-size: 13px;
    color: #555;
}
@media (max-width: 600px) {
    .contrato-container {
        padding: 1rem 0.75rem;
        font-size: 12px;
    }
    .contrato-container h1 { font-size: 0.95rem; }
    .contrato-tabla-firmas td, .contrato-tabla-firmas th,
    .contrato-tabla-aceptante td { padding: 5px 7px; font-size: 11px; }
    .contrato-firma-img { max-width: 140px; }
}
</style>

<div class="contrato-container">

    <h1>OFERTA MERCANTIL PARA LA HABILITACIÓN DE VENTAS FINANCIADAS CON INTERMEDIACIÓN COMERCIAL</h1>

    <h2>PARTES</h2>
    <p><span class="campo-dinamico">[NOMBRE PROMOTORA]</span>, sociedad comercial legalmente constituida, en adelante "PROMOTORA".</p>
    <p><span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span>, sociedad comercial, en adelante "EL INTERMEDIARIO" Y</p>
    <p>EL COMERCIO ALIADO, persona jurídica que acepta la presente oferta, en adelante "EL COMERCIO".</p>

    <h2>PRIMERO. OBJETO</h2>
    <p>Mediante la presente oferta mercantil, PROMOTORA habilita al COMERCIO para ofrecer a sus clientes finales la adquisición de bienes y/o servicios mediante fuentes de financiación de terceros; para tal fin actuando <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span> como intermediario comercial exclusivo entre PROMOTORA y EL COMERCIO.</p>

    <h2>SEGUNDO. ROL DE PROMOTORA.</h2>
    <p><span class="campo-dinamico">[PROMOTORA]</span> actúa en el presente esquema como prestador de servicios de habilitación, gestión, coordinación y canalización de operaciones de venta financiada, facilitando la interacción operativa y comercial entre los comercios aliados y las entidades financiadoras con las cuales mantiene convenios vigentes.</p>
    <p>En desarrollo de dicho rol, PROMOTORA no otorga créditos, no adquiere cartera, no actúa como entidad financiera ni como vendedora de bienes o servicios, limitándose a prestar un servicio de naturaleza operativa y comercial, que incluye la habilitación del comercio aliado, la coordinación del proceso de financiación y la gestión del pago anticipado al comercio.</p>
    <p>PROMOTORA podrá recibir de las entidades financiadoras el valor total de las operaciones realizadas dentro de los plazos acordados, del cual retendrá una tarifa diferencial que constituye ingreso propio por concepto de los servicios prestados; transfiriendo dentro de las 24 horas siguientes a cada transacción el valor correspondiente la diferencia resultante de la transacción menos la comisión acordada, conforme a lo autorizado expresamente en la presente oferta comercial.</p>

    <h2>TERCERO. ROL DE <?php echo htmlspecialchars($nombre_intermediario_credito); ?></h2>
    <p>EL INTERMEDIARIO será el encargado de:</p>
    <ol type="a">
        <li>Gestionar la vinculación comercial y documental del COMERCIO.</li>
        <li>Obtener la aceptación y firma de las ofertas mercantiles aplicables.</li>
        <li>Administrar el flujo contractual, documental y de información entre las partes.</li>
        <li>Actuar como intermediario comercial entre PROMOTORA y EL COMERCIO.</li>
        <li>Garantizar el cumplimiento de las obligaciones de protección de datos personales.</li>
    </ol>
    <p>EL INTERMEDIARIO no recibe, administra ni dispone recursos financieros de las transacciones.</p>

    <h2>CUARTO. ROL DE LAS ENTIDADES FINANCIADORAS.</h2>
    <p>Las entidades financiadoras vinculadas al presente esquema, tales como Addi, Sistecrédito y aquellas que <span class="campo-dinamico">[PROMOTORA]</span> tenga habilitadas; actúan de manera independiente y autónoma como otorgantes de crédito al consumidor final, celebrando directamente con éste los contratos de financiación correspondientes.</p>
    <p>Las entidades financiadoras son las únicas responsables de la evaluación del riesgo crediticio, aprobación, administración y recaudo de los créditos otorgados, asumiendo integralmente el riesgo de incumplimiento del consumidor, sin que dicho riesgo sea trasladado al comercio aliado, a PROMOTORA o a <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span></p>
    <p>El pago efectuado por las entidades financiadoras corresponde al desembolso del crédito otorgado al consumidor final, realizado para efectos de cubrir el precio del bien o servicio adquirido, sin que dicho pago constituya compra de cartera, operación de factoring, mandato de recaudo o adquisición de bienes por parte de la entidad financiadora.</p>

    <h2>QUINTO. TARIFA DIFERENCIAL Y COMISIÓN</h2>
    <p>PROMOTORA podrá retener una tarifa diferencial sobre el valor de cada operación, la cual constituye ingreso propio por los servicios prestados.</p>
    <p>Dentro de dicha tarifa se encuentra incluida la comisión de intermediación a favor de DISTRIBUCIONES, cuyo porcentaje o valor será definido en anexo independiente, el cual hace parte integral de la presente oferta.</p>
    <p>La tarifa diferencial retenida por PROMOTORA corresponde exclusivamente a la contraprestación por los servicios de habilitación, operación y gestión comercial aquí descritos, e incluye, cuando aplique, la comisión de intermediación a favor de DISTRIBUCIONES A &amp; Q S.A.S, según las condiciones pactadas internamente, sin que ello implique financiación, descuento de cartera ni operación de factoring.</p>

    <h2>SEXTO. INDEPENDENCIA DE LAS PARTES.</h2>
    <p>La participación de las entidades financiadoras no implica vínculo societario, representación, agencia comercial ni corresponsalía financiera con el comercio aliado, PROMOTORA o <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span>, manteniendo cada una de las partes plena autonomía jurídica, administrativa y patrimonial.</p>

    <h2>SEPTIMO. CLÁUSULA DE FACTURACIÓN, FLUJO CONTABLE Y SOPORTE TRIBUTARIO</h2>
    <p>Facturación y Tratamiento Tributario.</p>
    <p>Las partes acuerdan que la facturación y el registro contable de las operaciones realizadas bajo el presente esquema se sujetarán a las siguientes reglas, con el fin de garantizar la correcta identificación de los ingresos, costos y gastos de cada interviniente, así como el cumplimiento de la normativa tributaria vigente:</p>
    <ol type="a">
        <li><strong>Facturación del Comercio Aliado.</strong><br>
        El Comercio Aliado será el único responsable de facturar al consumidor final el valor total del bien o servicio vendido, incluyendo los impuestos que resulten aplicables, independientemente de que el pago sea efectuado mediante financiación otorgada por una entidad financiadora.<br>
        La factura deberá reflejar como medio de pago la financiación o el pago realizado por un tercero, sin que ello modifique la calidad del Comercio Aliado como único vendedor del bien o servicio.</li>
        <li><strong>Recepción de Recursos por PROMOTORA.</strong><br>
        <span class="campo-dinamico">[PROMOTORA]</span> podrá recibir de las entidades financiadoras el valor total de la operación como resultado del desembolso del crédito otorgado al consumidor final.<br>
        Dichos recursos serán registrados contablemente de la siguiente manera:
            <ul>
                <li>El valor correspondiente al precio del bien o servicio a favor del Comercio Aliado será reconocido como una cuenta por pagar a éste.</li>
                <li>El valor correspondiente a la tarifa diferencial pactada constituirá ingreso propio de PROMOTORA, por concepto de servicios de habilitación, gestión y canalización de ventas financiadas.</li>
            </ul>
        </li>
        <li><strong>Pago al Comercio Aliado.</strong><br>
        PROMOTORA pagará al Comercio Aliado el valor del bien o servicio vendido, una vez deducida la tarifa diferencial autorizada en la presente oferta comercial. Dicho pago no constituye gasto ni costo para PROMOTORA, sino la cancelación de una obligación frente a un tercero.</li>
        <li><strong>Facturación y Comisión de <?php echo htmlspecialchars($nombre_intermediario_credito); ?></strong><br>
        <?php echo htmlspecialchars($nombre_intermediario_credito); ?> facturará exclusivamente a PROMOTORA la comisión de intermediación comercial pactada, la cual se encuentra incluida dentro de la tarifa diferencial retenida por PROMOTORA.<br>
        Dicha comisión constituirá ingreso gravado para <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span> y gasto deducible para PROMOTORA, sujeta a los impuestos y retenciones a que haya lugar conforme a la ley.</li>
        <li><strong>Exclusión de Manejo de Recursos por <?php echo htmlspecialchars($nombre_intermediario_credito); ?></strong><br>
        Las partes reconocen expresamente que <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span> no recibe, administra ni canaliza recursos provenientes de las entidades financiadoras, de los consumidores finales ni de los comercios aliados, limitándose su intervención a la intermediación comercial y contractual.</li>
        <li><strong>Impuestos, Retenciones y Cumplimiento Normativo.</strong><br>
        Cada parte será responsable de declarar, facturar y pagar los impuestos que le correspondan por los ingresos que le sean propios, así como de practicar y soportar las retenciones a que haya lugar, manteniendo indemnes a las demás partes frente a cualquier reclamación de la autoridad tributaria derivada del incumplimiento de sus obligaciones fiscales.</li>
        <li><strong>Soportes y Trazabilidad.</strong><br>
        Las partes se obligan a conservar los soportes contables y tributarios que respalden cada operación, incluyendo facturas, comprobantes de pago, conciliaciones y contratos, los cuales deberán ser suministrados a la otra parte cuando sean requeridos para efectos de auditoría, fiscalización o cumplimiento normativo.</li>
    </ol>

    <h2>OCTAVO. CLÁUSULA ANTI-BYPASS Y PENALIDAD</h2>
    <p>PROMOTORA se obliga a no contratar directa o indirectamente con EL COMERCIO presentado por <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span>, durante la vigencia de la oferta y por tres (3) años posteriores a su terminación.</p>
    <p>En caso de incumplimiento:</p>
    <p>• PROMOTORA pagará a <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span> una penalidad equivalente a cinco (5) salarios mínimos legales mensuales vigentes por cada venta realizada sin la intermediación.</p>
    <p>Esta penalidad:</p>
    <ol type="i">
        <li>Presta mérito ejecutivo.</li>
        <li>Podrá ser exigida sin protesto.</li>
        <li>Será dirimida mediante arbitraje en la ciudad de Cartagena, conforme a la Ley 2540 de 2025 y Ley 1563 de 2012.</li>
    </ol>

    <h2>NOVENO. CLÁUSULA DE RESPONSABILIDADES CRUZADAS</h2>
    <p>Las partes acuerdan que sus obligaciones y responsabilidades dentro del presente esquema comercial son independientes, delimitadas y no solidarias, conforme a la naturaleza de los servicios prestados por cada una, de acuerdo con las siguientes reglas:</p>
    
    <p><strong>1. Responsabilidad del Comercio Aliado.</strong></p>
    <p>El Comercio Aliado será el único responsable por:</p>
    <ol type="a">
        <li>La venta, calidad, idoneidad, garantía, entrega y condiciones del bien o servicio ofrecido al consumidor final.</li>
        <li>La correcta facturación de la operación al consumidor final por el valor total del bien o servicio, incluyendo los impuestos que resulten aplicables.</li>
        <li>El cumplimiento de las normas de protección al consumidor, garantías legales y responsabilidad por producto.</li>
    </ol>
    <p>En ningún caso <span class="campo-dinamico">[PROMOTORA]</span> ni <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span> asumirán responsabilidad alguna frente al consumidor por defectos del producto, incumplimientos contractuales del comercio o reclamaciones derivadas de la relación de consumo.</p>

    <p><strong>2. RESPONSABILIDAD DE [PROMOTORA]</strong></p>
    <p>PROMOTORA será responsable exclusivamente por:</p>
    <ol type="a">
        <li>La prestación de los servicios de habilitación, gestión, coordinación y canalización de operaciones de venta financiada.</li>
        <li>La correcta aplicación de la tarifa diferencial pactada y el pago al Comercio Aliado del valor correspondiente, conforme a lo autorizado en la presente oferta.</li>
        <li>La correcta liquidación, reconocimiento y pago de la comisión a favor de <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span></li>
    </ol>
    <p>PROMOTORA no será responsable por:</p>
    <ol type="a">
        <li>La aprobación, rechazo, condiciones o administración del crédito otorgado al consumidor.</li>
        <li>El incumplimiento del consumidor final frente a la entidad financiadora.</li>
        <li>La calidad, entrega o garantía del bien o servicio vendido por el Comercio Aliado.</li>
    </ol>

    <p><strong>3. RESPONSABILIDAD DE <?php echo htmlspecialchars($nombre_intermediario_credito); ?></strong></p>
    <p><?php echo htmlspecialchars($nombre_intermediario_credito); ?> actuará como intermediario comercial y gestor del relacionamiento entre PROMOTORA y los Comercios Aliados, siendo responsable por:</p>
    <ol type="a">
        <li>La gestión comercial, vinculación y formalización contractual de los Comercios Aliados.</li>
        <li>El tratamiento de datos personales conforme a la normatividad vigente y a las autorizaciones obtenidas.</li>
    </ol>
    <p><?php echo htmlspecialchars($nombre_intermediario_credito); ?> no asumirá responsabilidad alguna por:</p>
    <ol type="i">
        <li>La ejecución de los pagos.</li>
        <li>La aprobación de créditos.</li>
        <li>La entrega, calidad o garantía de los bienes o servicios.</li>
        <li>El recaudo o incumplimiento del consumidor final.</li>
    </ol>

    <p><strong>4. RESPONSABILIDAD DE LAS ENTIDADES FINANCIADORAS.</strong></p>
    <p>Las entidades financiadoras serán las únicas responsables por:</p>
    <ol type="a">
        <li>La evaluación del riesgo crediticio del consumidor.</li>
        <li>La aprobación, administración, recaudo y cobranza del crédito.</li>
        <li>Las condiciones financieras del crédito otorgado.</li>
    </ol>
    <p>El riesgo de incumplimiento del consumidor final será asumido exclusivamente por la entidad financiadora, sin posibilidad de repetición contra el Comercio Aliado, PROMOTORA o <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span></p>

    <ol start="5" type="1">
        <li><strong>EXCLUSIÓN DE SOLIDARIDAD Y RESPONSABILIDAD CONJUNTA.</strong><br>
        En ningún caso se entenderá que existe solidaridad, mandato, agencia comercial, corresponsalía financiera, sociedad de hecho o relación laboral entre las partes. Cada parte responderá únicamente por las obligaciones que le son propias conforme al presente instrumento.</li>
        <li><strong>INDEMNIDAD.</strong><br>
        Cada parte se obliga a mantener indemne a las demás frente a reclamaciones, sanciones, multas o demandas de terceros que se deriven del incumplimiento de sus propias obligaciones legales o contractuales.</li>
    </ol>

    <h2>DECIMO. CLÁUSULA DE CONFIDENCIALIDAD</h2>
    <p>Las partes acuerdan que toda información a la que tengan acceso con ocasión de la presente oferta comercial y de su ejecución, incluyendo, pero sin limitarse a información comercial, financiera, tributaria, contable, contractual, tecnológica, operativa, bases de datos, listas de clientes, aliados, condiciones económicas, tarifas, comisiones, modelos de negocio, flujos de operación, integraciones y cualquier otra información no pública, tendrá el carácter de información confidencial.</p>
    
    <p><strong>1. Obligación de Confidencialidad.</strong></p>
    <p>Las partes se obligan a:</p>
    <ol type="a">
        <li>Utilizar la información confidencial única y exclusivamente para la ejecución del presente esquema comercial.</li>
        <li>No divulgar, revelar, transferir, ceder ni permitir el acceso a terceros no autorizados, por ningún medio, a la información confidencial.</li>
        <li>Adoptar medidas razonables de seguridad administrativas, técnicas y jurídicas para proteger la información confidencial.</li>
    </ol>

    <p><strong>2. Información Excluida.</strong></p>
    <p>No tendrá el carácter de información confidencial aquella que:</p>
    <ol type="a">
        <li>Sea de dominio público sin infracción a la presente cláusula.</li>
        <li>Haya sido conocida legítimamente por la parte receptora con anterioridad.</li>
        <li>Deba ser revelada por mandato legal, judicial o de autoridad competente, caso en el cual la parte obligada informará previamente a las demás partes, en la medida de lo posible.</li>
    </ol>

    <p><strong>3. Prohibición de Uso Indebido y No Desvío.</strong></p>
    <p>Las partes se obligan a no utilizar la información confidencial para:</p>
    <ol type="1">
        <li>Contactar, contratar o vincular directa o indirectamente a los aliados, comercios, financiadores o clientes presentados por otra de las partes, sin la participación y autorización expresa de ésta.</li>
        <li>Replicar, adaptar o implementar el modelo de negocio, flujos operativos o estructura contractual aquí descritos por fuera del presente acuerdo.</li>
    </ol>

    <ol start="4" type="1">
        <li><strong>Vigencia de la Confidencialidad.</strong><br>
        La obligación de confidencialidad se mantendrá vigente durante la ejecución del presente instrumento y por un término adicional de tres (3) años contados a partir de su terminación, por cualquier causa.</li>
        <li><strong>Incumplimiento y Penalidad.</strong><br>
        El incumplimiento de la presente cláusula dará lugar al pago de una penalidad a favor de la parte afectada equivalente a cinco (5) salarios mínimos legales mensuales vigentes por cada operación realizada utilizando indebidamente la información confidencial o sin la participación de la parte que suministró dicha información, sin perjuicio de la indemnización de perjuicios adicionales a que haya lugar.</li>
        <li><strong>Mérito Ejecutivo.</strong><br>
        La presente cláusula presta mérito ejecutivo para el cobro de las obligaciones económicas aquí establecidas, incluyendo la penalidad, sin necesidad de requerimiento previo ni constitución en mora.</li>
        <li><strong>Supervivencia.</strong><br>
        Las obligaciones contenidas en la presente cláusula sobrevivirán a la terminación del presente instrumento y serán exigibles conforme a la ley aplicable.</li>
    </ol>

    <h2>DECIMO PRIMERO. CLÁUSULA DE CONSENTIMIENTO Y PROTECCIÓN DE DATOS PERSONALES</h2>
    <p>Tratamiento de Datos Personales y Autorización.</p>
    <p>En cumplimiento de lo dispuesto en la Ley 1581 de 2012, el Decreto 1377 de 2013 y demás normas concordantes, las partes autorizan de manera previa, expresa e informada el tratamiento de los datos personales que sean suministrados o a los que se tenga acceso con ocasión de la ejecución de la presente oferta comercial, conforme a las siguientes condiciones:</p>

    <p><strong>1. Responsables y Encargados del Tratamiento.</strong></p>
    <p>Para efectos del tratamiento de datos personales:</p>
    <ol type="a">
        <li><span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span> actuará como encargado del tratamiento, siendo responsable de la recolección, administración, custodia y gestión de los datos personales de los intervinientes, consumidores finales, aliados comerciales y financiadores, conforme a las autorizaciones otorgadas.</li>
        <li><span class="campo-dinamico">[PROMOTORA]</span>, y los Comercios Aliados actuarán como responsables del tratamiento, respecto de los datos que administren dentro del ámbito de sus respectivas actividades.</li>
    </ol>

    <p><strong>2. Finalidades del Tratamiento.</strong></p>
    <p>Los datos personales serán tratados para las siguientes finalidades:</p>
    <ol type="a">
        <li>La vinculación, formalización y ejecución de la presente oferta comercial y de los contratos que se deriven de ella.</li>
        <li>La gestión operativa, comercial, contable, tributaria y administrativa de las operaciones de venta financiada.</li>
        <li>La interacción con entidades financiadoras para la evaluación, aprobación y administración de créditos al consumidor final.</li>
        <li>El cumplimiento de obligaciones legales, contractuales, contables y de reporte ante autoridades administrativas y tributarias.</li>
        <li>La gestión de reclamaciones, auditorías, procesos arbitrales o judiciales.</li>
    </ol>

    <ol start="3" type="1">
        <li><strong>Datos Sensibles y Datos de Consumidores Finales.</strong><br>
        Las partes reconocen que el suministro de datos sensibles y de datos de los consumidores finales es de carácter facultativo, salvo aquellos estrictamente necesarios para la evaluación crediticia por parte de las entidades financiadoras, los cuales serán tratados exclusivamente por éstas conforme a su calidad de responsables del tratamiento.</li>
        <li><strong>Transferencia y Transmisión de Datos.</strong><br>
        Las partes autorizan expresamente la transmisión y transferencia de datos personales entre PROMOTORA, <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span>, los Comercios Aliados y las Entidades Financiadoras, cuando ello sea necesario para el cumplimiento de las finalidades aquí descritas, garantizando en todo caso la confidencialidad y seguridad de la información.</li>
        <li><strong>Derechos del Titular.</strong><br>
        Los titulares de los datos personales podrán ejercer en cualquier momento los derechos de acceso, actualización, rectificación, supresión y revocatoria de la autorización, conforme a la ley, mediante solicitud escrita dirigida al responsable o encargado del tratamiento correspondiente.</li>
        <li><strong>Medidas de Seguridad.</strong><br>
        Las partes se obligan a implementar medidas técnicas, humanas y administrativas razonables para garantizar la seguridad de los datos personales y evitar su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento.</li>
        <li><strong>Conservación de la Información.</strong><br>
        Los datos personales serán conservados durante el tiempo necesario para cumplir las finalidades del tratamiento y las obligaciones legales o contractuales, y posteriormente serán eliminados o anonimizados conforme a la normativa vigente.</li>
        <li><strong>Responsabilidad por Incumplimiento.</strong><br>
        Cada parte será responsable por el tratamiento indebido de los datos personales bajo su control y se obliga a mantener indemnes a las demás partes frente a reclamaciones, sanciones o multas impuestas por la autoridad competente derivadas del incumplimiento de la normativa de protección de datos.</li>
        <li><strong>Autorización Expresa.</strong><br>
        Con la aceptación de la presente oferta comercial, las partes declaran haber sido informadas de manera clara y suficiente sobre el tratamiento de sus datos personales y otorgan su autorización expresa para el tratamiento de los mismos conforme a lo aquí dispuesto.</li>
    </ol>

    <h2>DECIMO SEGUNDO. VIGENCIA Y TERMINACIÓN</h2>
    <p>La oferta tendrá una vigencia inicial de doce (12) meses, renovable automáticamente.</p>
    <p>Cualquiera de las partes podrá terminarla con 30 días de preaviso, sin perjuicio del pago de comisiones causadas y penalidades aplicables.</p>

    <h2>DECIMO TERCERO. CLÁUSULA DE SOLUCIÓN DE CONTROVERSIAS</h2>
    <p>Solución de Controversias y Mecanismo de Resolución.</p>
    <p>Las partes acuerdan que cualquier controversia, diferencia, reclamación o conflicto que surja con ocasión de la interpretación, ejecución, terminación o validez de la presente oferta comercial y de los contratos que se deriven de ella, será resuelta conforme a las siguientes reglas:</p>
    <ol type="a">
        <li><strong>Arreglo Directo.</strong><br>
        En primera instancia, las partes procurarán resolver la controversia de manera directa y amistosa dentro de un término de quince (15) días hábiles contados a partir de la notificación escrita de la controversia por cualquiera de las partes.</li>
        <li><strong>Arbitraje.</strong> De no lograrse un acuerdo en el término anterior, la controversia será sometida a arbitraje, el cual se adelantará de conformidad con la legislación colombiana vigente y las normas aplicables al arbitraje nacional.<br>
        El tribunal de arbitramento estará integrado por un (1) árbitro, designado de común acuerdo por las partes o, en su defecto, por el centro de arbitraje que se determine conforme a la ley.<br>
        El tribunal decidirá en derecho, tendrá su sede en la ciudad que se pacte entre las partes, y el procedimiento se surtirá en idioma español.</li>
        <li><strong>Mérito Ejecutivo.</strong><br>
        Las obligaciones claras, expresas y exigibles contenidas en la presente oferta comercial y en los contratos derivados de la misma, incluyendo las obligaciones de pago, comisiones y penalidades pactadas, prestan mérito ejecutivo y podrán ser exigidas directamente por la vía ejecutiva, sin perjuicio del trámite arbitral para las demás controversias.</li>
        <li><strong>Penalidades y Ejecución.</strong><br>
        Las penalidades económicas pactadas en el presente instrumento podrán ser ejecutadas sin necesidad de requerimiento previo ni protesto, y su cobro podrá adelantarse ante la jurisdicción competente o ante el tribunal de arbitramento, según corresponda, conforme a la normativa aplicable.</li>
        <li><strong>Ley Aplicable.</strong><br>
        La presente oferta comercial y los contratos que se deriven de ella se regirán e interpretarán conforme a las leyes de la República de Colombia.</li>
        <li><strong>Subsistencia.</strong><br>
        La presente cláusula subsistirá a la terminación de la oferta comercial y será aplicable a cualquier controversia surgida con posterioridad a dicha terminación.</li>
    </ol>

    <!-- ============================================ -->
    <!-- FIRMA DE LOS OFERENTES                       -->
    <!-- ============================================ -->
    <h2>DECIMO CUARTO. FIRMA DE LOS OFERENTES</h2>

    <table class="contrato-tabla-firmas">
        <tr>
            <td style="width:50%; text-align: center;">
                <?php if (!empty($firma_gestor_operador)): ?>
                    <img src="<?php echo $firma_gestor_operador; ?>" class="contrato-firma-img" alt="Firma Gestor">
                <?php else: ?>
                    <div style="height: 60px; border-bottom: 1px solid #999; margin: 10px 20px;"></div>
                <?php endif; ?>
            </td>
            <td style="width:50%; text-align: center;">
                <?php if (!empty($firma_intermediario)): ?>
                    <img src="<?php echo $firma_intermediario; ?>" class="contrato-firma-img" alt="Firma Intermediario">
                <?php else: ?>
                    <div style="height: 60px; border-bottom: 1px solid #999; margin: 10px 20px;"></div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td><strong>[NOMBRE PROMOTORA]</strong></td>
            <td><strong><?php echo htmlspecialchars($nombre_intermediario_credito); ?></strong></td>
        </tr>
        <tr>
            <td>Nombre representante legal: <?php echo htmlspecialchars($nombre_rep_legal_gestor); ?></td>
            <td>Nombre representante legal: <?php echo htmlspecialchars($representante_intermediario); ?></td>
        </tr>
        <tr>
            <td>Documento: <?php echo htmlspecialchars($documento_rep_legal_gestor); ?></td>
            <td>Documento: <?php echo htmlspecialchars($documento_intermediario); ?></td>
        </tr>
        <tr>
            <td>Fecha: <?php echo htmlspecialchars($fecha_firma_gestor); ?></td>
            <td>Fecha: <?php echo htmlspecialchars($fecha_intermediario); ?></td>
        </tr>
    </table>

    <!-- ============================================ -->
    <!-- ACEPTACIÓN DE LA OFERTA COMERCIAL            -->
    <!-- ============================================ -->
    <h2>DECIMO CUARTO. ACEPTACIÓN DE LA OFERTA COMERCIAL</h2>
    
    <p><strong>a) IDENTIFICACIÓN DEL ACEPTANTE (COMERCIO ALIADO)</strong></p>
    <table class="contrato-tabla-aceptante">
        <tr><td>Razón social:</td><td><?php echo htmlspecialchars($razon_social_tienda); ?></td></tr>
        <tr><td>NIT:</td><td><?php echo htmlspecialchars($nit_tienda); ?></td></tr>
        <tr><td>Representante legal:</td><td><?php echo htmlspecialchars($representante_legal_aliado); ?></td></tr>
        <tr><td>Documento de identidad:</td><td><?php echo htmlspecialchars($documento_aliado); ?></td></tr>
        <tr><td>Correo electrónico:</td><td><?php echo htmlspecialchars($correo_tienda); ?></td></tr>
        <tr><td>Teléfono:</td><td><?php echo htmlspecialchars($telefono_tienda); ?></td></tr>
        <tr><td>Dirección:</td><td><?php echo htmlspecialchars($direccion_tienda); ?></td></tr>
    </table>

    <p><strong>b) DECLARACIÓN DE ACEPTACIÓN</strong></p>
    <p>Por medio del presente documento, quien suscribe, en calidad de representante legal del Comercio Aliado, manifiesta que:</p>
    <ol type="a">
        <li>Ha recibido, leído y comprendido en su integridad la Oferta Comercial presentada por <span class="campo-dinamico">[PROMOTORA]</span>, con la intermediación de <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span></li>
        <li>Acepta expresa, libre y voluntariamente todas las condiciones jurídicas, comerciales, económicas, tributarias y operativas contenidas en dicha oferta, incluidos sus anexos.</li>
        <li>Autoriza expresamente a <span class="campo-dinamico">[PROMOTORA]</span> a retener la tarifa diferencial pactada, dentro de la cual se encuentra incluida la comisión de intermediación a favor de <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span></li>
        <li>Reconoce que <span class="campo-dinamico"><?php echo htmlspecialchars($nombre_intermediario_credito); ?></span> actúa como intermediario comercial y gestor contractual, sin manejo de recursos ni ejecución de pagos.</li>
        <li>Otorga autorización expresa para el tratamiento, transmisión y transferencia de datos personales, conforme a la cláusula de protección de datos incluida en la oferta comercial.</li>
        <li>Reconoce que la presente aceptación produce plenos efectos jurídicos, constituye acuerdo vinculante entre las partes y presta mérito ejecutivo respecto de las obligaciones claras, expresas y exigibles allí contenidas.</li>
    </ol>

    <p><strong>c) MODALIDADES DE ACEPTACIÓN</strong></p>
    <p>La presente oferta comercial podrá aceptarse válidamente por cualquiera de los siguientes medios, los cuales tendrán plena validez jurídica y probatoria, conforme a la legislación colombiana:</p>
    <ol type="1">
        <li>Aceptación con firma manuscrita: Mediante la suscripción física del presente documento.</li>
        <li>Aceptación con firma electrónica o digital: Mediante firma electrónica, firma digital o mecanismos equivalentes que permitan identificar al aceptante.</li>
        <li>Aceptación expresa por medio electrónico: Mediante manifestación inequívoca de aceptación enviada desde el correo electrónico corporativo del Comercio Aliado, o mediante confirmación expresa por medios electrónicos que permitan su trazabilidad.</li>
        <li>La ejecución de actos inequívocos de aceptación, tales como la realización de operaciones, la recepción de pagos canalizados por PROMOTORA o el uso del esquema de ventas financiadas aquí descrito.</li>
    </ol>
    <p>La aceptación por parte del COMERCIO producirá plenos efectos jurídicos y hará vinculantes todas las obligaciones contenidas en la presente oferta mercantil, sin requerirse su firma como parte formulante.</p>

    <p><strong>d) FECHA DE ENTRADA EN VIGENCIA</strong></p>
    <p>La oferta comercial se entenderá aceptada y vigente a partir de la fecha de la primera manifestación válida de aceptación por cualquiera de los medios antes indicados.</p>

    <!-- ============================================ -->
    <!-- FIRMA DEL COMERCIO ALIADO                    -->
    <!-- ============================================ -->
    <div class="contrato-seccion-firma-aliado">
        <p><strong>e) FIRMA</strong></p>
        
        <div style="margin-top: 1rem;">
            <?php if (!empty($firma_aliado)): ?>
                <div style="text-align: center; margin-bottom: 0.5rem;">
                    <img src="<?php echo $firma_aliado; ?>" class="contrato-firma-img" alt="Firma Aliado">
                </div>
            <?php else: ?>
                <div id="zona-firma-contrato" style="text-align: center; padding: 1rem; color: #999; font-style: italic;">
                    <!-- La firma digital se insertará aquí -->
                </div>
            <?php endif; ?>
            <p>Nombre del representante legal: <strong><?php echo htmlspecialchars($nombre_rep_legal_aliado); ?></strong></p>
            <p>Documento: <strong><?php echo htmlspecialchars($documento_rep_legal_aliado); ?></strong></p>
            <p>Fecha: <strong><?php echo htmlspecialchars($fecha_firma_aliado); ?></strong></p>
        </div>
    </div>

</div>
