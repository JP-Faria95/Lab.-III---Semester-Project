<?php

/* Este código servirá para fazermos a leitura dos dados já inseridos na tabela Dicionário. A leitura (READ) será feita 
pela query 'SELECT * from Dicionário'. */

mb_internal_encoding("UTF-8");
include ('conexão_mysql.php');                         // Arquivo de conexão incluido.
mysqli_set_charset($conexão,"utf8mb4");

/* Neste programa, o usuário tem a opção de escolher se quer realizar a leitura completa da tabela, ou definir um ID específico
para utilizar na clausa WHERE da query. Utilizei um laço do/while para garantir a verificação do valor da opção escolhida. */

do{
    echo "Escolha entre:\n";
    echo "1 - Leitura completa.\n";
    echo "2 - Linha específica.\n";
    $opc = trim(fgets(STDIN));
    if($opc!=1 and $opc!=2){
        echo "OPÇÃO INVÁLIDA.\n";
    }
}while($opc!=1 and $opc!=2);
if($opc == 1){
    $select_query = "SELECT * FROM DICTIONARY";

    /* Utilizei a variavel $checar_query e a função mysqli_num_rows() para finalizar o programa caso não haja nenhum dado
    previamente inserido na tabela Dicionário. */

    $checar_query = mysqli_query($conexão,$select_query);
    if(mysqli_num_rows($checar_query) == 0){
        exit("Não há registros na tabela Dicionário.\n");
    }
}

/* Caso opte pela opção de linha específica, o usuário então deverá informar de qual ID ele deseja fazer a leitura dos dados.
É preciso verificar se o ID informado consta na tabela usando então a função mysqli_num_rows (linha 36). */

else{
    echo "ID referência: "; $id = fgets(STDIN);
    $select_query = "SELECT * FROM DICTIONARY WHERE ID = $id";
}

/* A variavel $select_query vai guardar em formato string a query de projeção de dados em SQL, a SELECT. A variavel $envio_mysql
guarda o resultado da função mysqli_query que usa como parâmetro justamente a variavel $select_query. A função mysqli_num_rows
checa se o resultado de mysqli_query é igual a zero. Caso seja, então o programa finaliza com a função exit e uma frase de 
indicação. Caso diferente de zero, o programa segue para a leitura da linha especificada pelo usuário através de um ID válido.*/
 
$envio_mysql = mysqli_query ($conexão, $select_query);
if(mysqli_num_rows($envio_mysql) == 0){
    exit("ID não existe na tabela Dictionary, utilize a função INSERT.\n");
}

/* Aqui usamos o laço WHILE (linhas 58 a 65) para fazer a leitura da tabela completa. Para leitura usamos a função
mysqli_fetch_assoc(). Esta função lê a tabela e retorna cada linha como um elemento de um array associativo (strings).
Quando ela lê todas as linhas, retorna o valor NULL. Assim que encontra o valor null, o laço WHILE é encerrado. Usamos a 
variavel $coluna para guardar o resultado da função mysqli_fetch_assoc() e fazemos a leitura do array associativo de forma 
tradicional: "nome_do_array[indice]". No caso da leitura da tabela, os indices do array serão os nomes de cada coluna. */

echo "---------------------";
echo "\nTabela Dictionary.\n";
while($coluna = mysqli_fetch_assoc($envio_mysql)){
    echo "---------------------";
    echo "\nID: ".$coluna['ID']."\n";
    echo "Termo, em inglês: ".$coluna['Term']."\n";
    echo "Termo, em português: ".$coluna['Term_PT']."\n";
    echo "Disciplina: ".$coluna['Subject']."\n";
    echo "Aplicação: ".$coluna['Application']."\n";
}
echo "---------------------";
?>
