    
<?php

include("../conexion.php");
ob_start();
$texto = $_POST['texto'];

$search_in_sql = "";
$max_reg = $_POST['max'];
if (!empty($texto)) {
  // $search_in_sql = " AND (titulo like '%" . $texto . "%'  OR interprete like '%" . $texto . "%'  OR ruta like '%" . $texto . "%' )";
  if(isset($_POST['exacto']) && $_POST['exacto'] == 'SI'){
    $search_in_sql = " AND interprete LIKE '".$texto."'";
  }else{
    $search_in_sql = " AND (titulo like '%" . $texto . "%'  OR interprete like '%" . $texto . "%')";
  }
}

$conn = db();
$sql = "SELECT COUNT(idCancion) as cantidad FROM tblcanciones WHERE tipo LIKE 'MUSICA' $search_in_sql";
$stmt = $conn->prepare($sql);
$stmt->execute();

$total_records = $stmt->fetchColumn();
$total_pages = ceil($total_records / $max_reg);

$table = '<nav aria-label="Navegacion" class="d-flex justify-content-center">
<ul class="pagination">';

for ($i = 1; $i <= $total_pages; $i++) {
  $table .= '<li class="page-item"><a class="page-link" href="#">'.$i.'</a></li>';
};
$table .= "</ul></nav>";

$mensaje = array('tabla' => $table, 'records' => $total_records, 'total_pages' => $total_pages);
ob_end_clean();
echo json_encode($mensaje);
?>    
