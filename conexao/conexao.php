<?php
const database = "fluxorj";
const user = "root";
const host = "localhost";
const key = "";

$conexaoSQL = mysqli_connect(host, user, key, database);
if(mysqli_errno($conexaoSQL)) printf("Ops... Não foi possí­vel aceder o banco de dados %s. 
Tente novamente mais tarde ou comunique um adminstrativo do website. ERRO : %d", database, mysqli_errno($conexaoSQL));


?>
