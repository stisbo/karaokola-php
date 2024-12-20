        
<?php

include("../conexion.php");
$texto = $_POST['texto'];
$start_from = $_POST['start'];
$search_in_sql = "";
$max_reg = $_POST['max'];
if (!empty($texto)) {
  if(isset($_POST['exacto']) && $_POST['exacto'] == 'SI'){
    $search_in_sql = " AND interprete LIKE '".$texto."'";
  }else{
    $search_in_sql = " AND (titulo like '%" . $texto . "%'  OR interprete like '%" . $texto . "%')";
  }
}
$sql = "SELECT * FROM tblcanciones WHERE tipo LIKE 'MUSICA' $search_in_sql ORDER BY idCancion DESC LIMIT $start_from, $max_reg";
$conn = db();
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() === 0) {
  echo "<div style='text-align:center'><h2>Lista de Musicales vacia!</h2></div>";
} else {
  $resultado = "<div>
              <table style='text-align:center' class='table table-hover table-striped'>
                <tr>
                  <th width='50px'>
                    Elegir
                  </th>
                  <th width='150px'>
                    Intérprete
                  </th>
                  <th width='200px'>
                    Título
                  </th>
                </tr>
              ";
  $t = time();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    // print_r($row);
    $id = $row['idCancion'];
    $interprete = $row['interprete'];
    $titulo = $row['titulo'];
    $url = "";
    $resultado .= "<tr style='margin: 0 auto'>
      <td>
        <button class='btn btn-warning' data-toggle='modal' data-target='#modal_seleccionar_musica' data-titulo='" . $row['titulo'] . "' data-interprete='" . $row['interprete'] . "' data-id='" . $row['idCancion'] . "' data-ruta='" . $row['ruta'] . "'> <B class=''>Elegir</B></button>
      </td>
      <td>
      " . $interprete . "
      </td>
      <td>
      " . $titulo . "
      </td>
    </tr>";
  }

  $resultado .= "
</table>
</div>

";

  echo $resultado;
}

?>
