<?php
$bd = new mysqli('147.2.10.24', 'root', 'm@llandr0', "codinjecao");
if ($bd ->connect_error) {
    die('Não foi possível conectar: ' . $bd->connect_error);
}
$name = $_POST['id'];
$sql = "SELECT DescricaoDoItemHonda FROM  tab_itemdoarquivo WHERE CodigoDoItemHonda = '$name'  LIMIT 1";
$result = mysqli_query($bd, $sql);
if ($result !== false) {
  $value = mysqli_fetch_field($result);
  $valorDesc = mysqli_fetch_row($result);
  return print_r($valorDesc[0]);
}
?>