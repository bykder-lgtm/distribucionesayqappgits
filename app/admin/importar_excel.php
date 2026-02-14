<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">
<title>Importar archivo de Excel a MySQL usando PHP - BaulPHP</title>
</head>
<body>
<div class="container">
  <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
    
    <div class="outer-container">
        <form action="../admin/importar_excel_reg.php" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Elija Archivo Excel</label> <input type="file" name="csv" id="csv" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import" class="btn-submit">Importar Registros</button>
            </div>
        </form>
    </div>
      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 

  
</div>

</body>
</html>