<?php
/* Este código servirá para utilizarmos a primeira função básica do SQL, o CREATE. Com este código será possível usarmos 
a querry de INSERT diretamente no banco de dados lab3_projeto. */

mb_internal_encoding("UTF-8");
include ('conexão_mysql.php');                         // Arquivo de conexão incluido.
mysqli_set_charset($conexão,"utf8mb4");

echo "Termo, em inglês: ";
$palavra_en = fgets(STDIN);
echo "Termo, em português: ";            
$palavra_pt = trim(fgets(STDIN));      // Definimos a variavel da palavara em português
echo "Disciplina associada: ";
$disciplina = trim(fgets(STDIN));      // Definimos a variavel da disciplina
echo "Aplicação: ";
$aplicação = trim(fgets(STDIN));       // Definimos a variavel da aplicação
echo "------------------\n";

/* A variavel $insert_query é responsável por carregar a query de INSERT no banco de dados. Como parametros ela recebe as 4
variaveis anteriores definidas pelo usuario. A variavel $envio_mysql vai ser responsável por guardar a função do PHP 
mysqli_query. A função mysqli_query recebe dois parametros, a variavel de conexão com o SGDB que fizemos no arquivo
conexão_mysql.php e a própria variavel insert_query que carrega a query de inserir novos valores na tabela DICIONÁRIO. */

$insert_query = "INSERT INTO DICTIONARY VALUES (null,'$palavra_en','$palavra_pt','$disciplina','$aplicação')";
$envio_mysql = mysqli_query($conexão,$insert_query);
if($envio_mysql){
    echo "Termo adicionado com sucesso ao Dicionário.\n";
}
else{
    echo "Falha ao adicionar o termo no Dicionário.\n";
}
?>
