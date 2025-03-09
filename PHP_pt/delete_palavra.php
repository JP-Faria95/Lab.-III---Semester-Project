<?php

/* Neste código faremos a ultima função do CRUD, o DELETE. É uma função que deve ser executada com cuidado pois uma vez usada,
deleta definitivamente uma linha do banco de dados (caso este não possa backup). */

include('conexão_mysql.php');

/* O programa inicia solicitando ao usuário o ID a ser removido. Utilizei a função trim() antes da função fgets() para elinar
a quebra de linha que atrapalhava a exibição de algumas frases no final do programa. Defini a variavel $checar_id que carrega
a query de SELECT * junto da clausula WHERE com o respectivo ID a ser validado. Em sequência a variavel $id_query armazena 
o retorno da função mysqli_query() e é usada como parâmetro da função mysqli_num_rows(). Caso o retorno da função seja diferente
de zero, o ID é valido e a operação pode continuar acessando um condicional IF (linha 16). Caso negativo, o programa acessa
o condicional ELSE (linha 46) e finaliza o programa. */

echo "ID a ser removido: "; $id = trim(fgets(STDIN));
$checar_id = "SELECT * FROM DICTIONARY WHERE ID = $id";
$id_query = mysqli_query($conexão,$checar_id);
if(mysqli_num_rows($id_query) != 0){
    echo "ID é valido. Confirma a deleção dos dados?\n";

    /* Utilizei um laço DO/WHILE para validar a opção de confimação da operação caso o ID seja válido. */

    do{
        echo "1 - Sim.\n";
        echo "2 - Não.\n";
        $opc = fgets(STDIN);
        if($opc!=1 and $opc!=2){
            echo "OPÇÃO INVÁLIDA.\n";
            echo "\nConfirma a deleção dos dados?\n";
        }
    }while($opc!=1 and $opc!=2);

    /* Caso o usuário confirme a sequência da operação, utilizei um condicional SWITCH para estruturar o restante da operação.
    Caso o usuario opte por 1, a variavel $delete_query utiliza a query DELETE do SQL junto do ID informado, em formato string.
    Caso opte por 2, significa que o usuario optou por cancelar a operação, mesmo o ID sendo válido. */

    switch($opc){
        case 1: 
            $delete_query = "DELETE FROM DICTIONARY WHERE ID = $id"; break;
        case 2:
            echo "--------------------\n";
            echo "Deleção cancelada.\n";
            exit("--------------------\n");
    }
}
else{
    echo "------------------------------------------------\n";
    echo "Sem registros para o ID $id, operação cancelada.\n";
    exit("------------------------------------------------\n");
    
}

/* Finalmente, a variavel $envio_mysql armazena o retorno da função mysqli_query, esta por sua vez usa a variavel $delete_query
definida no condicional SWITCH (linha 39) como parâmetro. Caso o retorno seja TRUE, o programa acessa o condicional IF e 
exibe a frase de operação bem sucedida. Caso o retorno seja FALSE, o programa acessa o condicional ELSE exibindo a frase de 
operação mal sucedida. */

$envio_mysql = mysqli_query($conexão,$delete_query);
if($envio_mysql){
    echo "----------------------------\n";
    echo "Dados deletados com sucesso.\n";
    echo "----------------------------\n";
}
else{
    echo "-----------------------\n";
    echo "Erro ao deletar dados.\n";
    echo "-----------------------\n";
}
?>
