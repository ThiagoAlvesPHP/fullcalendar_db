<?php 
require 'classe.php'; 
$c = new Classe();

$dados = $c->getAll();

echo json_encode($dados);

?>