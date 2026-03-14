<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo 3 - Árbol Jerárquico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .jstree-default .jstree-icon.bi { font-size: 1.1rem; }
        .jstree-anchor { font-size: 1.1rem; padding-left: 5px; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2><span class="badge bg-warning text-dark">Opción 3</span> Árbol Jerárquico (OrgChart / TreeView)</h2>
        <p class="text-muted">Visualiza toda la jerarquía de Distribuciones AYQ. Arrastra nodos para moverlos a otros superiores (usando jsTree).</p>
        
        <div class="card shadow-sm mt-4 border-0">
            <div class="card-body p-4 bg-white rounded">
                <div id="jstree_demo">
                    <!-- Árbol en HTML procesado por jsTree -->
                    <ul>
                        <li data-jstree='{"opened":true,"icon":"bi bi-diagram-3-fill text-primary"}' id="lider-1">Líder: Mauricio Ramos
                            <ul>
                                <li data-jstree='{"opened":true, "icon":"bi bi-person-fill text-success"}' id="coord-1">Coordinador: Norte
                                    <ul>
                                        <li data-jstree='{"icon":"bi bi-person-badge text-warning"}' id="asesor-1">Asesor: Juan
                                            <ul>
                                                <li data-jstree='{"icon":"bi bi-shop text-secondary"}'>Tienda A</li>
                                                <li data-jstree='{"icon":"bi bi-shop text-secondary"}'>Tienda B</li>
                                            </ul>
                                        </li>
                                        <li data-jstree='{"icon":"bi bi-person-badge text-warning"}' id="asesor-2">Asesor: Carlos</li>
                                    </ul>
                                </li>
                                <li data-jstree='{"opened":true, "icon":"bi bi-person-fill text-success"}' id="coord-2">Coordinador: Sur
                                    <ul>
                                        <li data-jstree='{"icon":"bi bi-person-badge text-warning"}' id="asesor-3">Asesora: María
                                            <ul>
                                                <li data-jstree='{"icon":"bi bi-shop text-secondary"}'>Minimarket Sol</li>
                                                <li data-jstree='{"icon":"bi bi-shop text-secondary"}'>Bodega Sur</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-footer bg-light text-muted">
                <i class="bi bi-info-circle"></i> Intenta arrastrar "Asesor: Juan" y soltarlo dentro de "Coordinador: Sur".
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('#jstree_demo').jstree({
                "core" : {
                    "animation" : 150,
                    "check_callback" : true, // Habilita modificación del árbol
                    "themes" : { "stripes" : true }
                },
                "plugins" : [ "dnd", "wholerow" ] // dnd = Drag and Drop
            }).bind("move_node.jstree", function (e, data) {
                // Evento disparado al soltar un nodo
                let nodeText = data.node.text;
                let parentText = data.instance.get_node(data.parent).text;

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: 'Nodo movido',
                    html: `<b>${nodeText}</b> ahora reporta a <b>${parentText}</b><br>(Petición AJAX a db pendiente)`,
                    showConfirmButton: false,
                    timer: 4000
                });
            });
        });
    </script>
</body>
</html>
