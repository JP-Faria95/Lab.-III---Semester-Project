<?php
/* Este código tem o objetivo de atualizar a tabela Dicionário no MYSQL de duas formas:
Alterando a linha inteira ou alterando apenas um campo específico. Ambos os casos são possíveis.
O usuario fica responsável pela escolha da opção que achar mais adequada. */

include ('conexão_mysql.php');

/* Linhas 12 a 21 utilizei um sistema de opções na qual o usuário escolhe se quer alterar uma linha inteira ou apenas um campo.
Utilizei um condicional IF para checar se a opção digitada pelo usuário é valida, caso negativo, o laço DO/WHILE se encarrega
de mante-lo na repetição até que a opção válida seja escolhida. */

do{                                         
    echo "\n--------------------\n";
    echo "Escolha uma opcao:\n";
    echo "1 - Alterar linha.\n";
    echo "2 - Alterar campo.\n";
    echo "--------------------\n";
    $opc = fgets(STDIN);
    if($opc!=1 and $opc!=2)
        echo "OPÇÃO INVÁLIDA.";
}while($opc!=1 and $opc!=2);

/* Entre as linhas 29 a 32, realizei a validação do ID inserido pelo usuário, uma vez que a query de update normalmente utiliza uma clausula de 
filtragem, a WHERE. Neste caso vamos fazer o update de dados de acordo com o ID inserido pelo usuário. Desta forma é essencial validar previamente
o ID inserido, pois uma vez que seja negativo, não seria possível fazer qualquer mudança no banco de dados. Para validação utilizei uma variavel
$id_query que representa a query de selecionar os dados de acordo com o ID. Esta variavel é inserida como parametro na função mysqli_query que retorna
um valor positivo ou negativo para a variavel $checar_id. */

echo "ID referencial: "; 
$id = trim(fgets(STDIN));
$id_query = "SELECT * FROM DICTIONARY WHERE ID = $id";
$checar_id = mysqli_query ($conexão,$id_query);

/* A variavel $checar_id é parametro na função mysqli_num_rows que conta quantas linhas satisfazem a clausula where. Nesta aplicação, necessariamente,
o retorno em mysqli_num_rows sempre será 1 (caso o ID exista na tabela) uma vez que os IDs são chave primária na tabela e auto_increment, logo não se
repetem. Se o retorno da função mysqli_num_rows() for diferente de zero, significa que o ID informado pelo usuario existe no banco de dados. 
Assim sendo, utilizei um condicional IF para checar essa condição e caso verdadeira, o programa segue para um condicional SWITCH. */

if(mysqli_num_rows($checar_id)!= 0){
    echo "ID Válido.\n";

    /* Escolhi um condicional SWITCH (linhas 48 a 95) para controlar a sequência do programa de acordo com a opção escolhida pelo usuário.
    Caso opte pela opção 1, o programa segue para recolher todos os campos da tabela (linhas 49 a 59).
    Caso opte pela opção 2, o programa segue para um novo menu de opções, no qual o usuário escolhe uma destas de acordo com o campo que deseja
    fazer o UPDATE. Novamente utilizei um laço DO/WHILE e um condicional IF para validar a opção inserida pelo usuario, sendo esta
    negativa, o laço se repete até que seja inserida uma opção valida (linhas 60 a 71). */

    switch($opc){
        case 1:
            echo "Novo termo, em inglês: ";
            $palavra_en = trim(fgets(STDIN));
            echo "Novo termo, em português: ";
            $palavra_pt = trim(fgets(STDIN));
            echo "Disciplina: ";
            $disciplina = trim(fgets(STDIN));
            echo "Aplicação: ";
            $aplicação = trim(fgets(STDIN));
            $update_query = "UPDATE DICTIONARY SET Term = '$palavra_en', Term_PT = '$palavra_pt', Subject = '$disciplina', Application = '$aplicação' WHERE ID = $id";
            break;
        case 2: 
            do{
                echo "\nQual campo deseja alterar?\n";
                echo "1 - Termo em inglês.\n";
                echo "2 - Termo em português.\n";
                echo "3 - Disciplina.\n";
                echo "4 - Aplicação.\n";
                $opc = fgets(STDIN);
                if($opc<1 or $opc>4){
                    echo "OPÇÃO INVALIDA.\n";
                }
            }while($opc<1 or $opc>4);

            /* Das linhas 77 a 93, o programa usa condicionais IF/ELSE IF para ler um campo específico de acordo com a opção escolhida pelo
            usuario. Assim que faz a leitura do novo termo, da nova disciplina ou da nova aplicação, é definida e declarada uma variavel $update_query
            que utiliza a variavel digitada pelo usuario e o ID digitado e validado anteriormente em uma string da query de update em SQL. */

            if($opc == 1){
                echo "Novo termo, em inglês: "; $palavra_en = trim(fgets(STDIN));
                $update_query = "UPDATE DICTIONARY SET Term = '$palavra_en' WHERE ID = $id";
            }
            else if($opc == 2){
                echo "Novo termo, em português: "; $palavra_pt = trim(fgets(STDIN));
                $update_query = "UPDATE DICTIONARY SET Term_PT = '$palavra_pt' WHERE ID = $id";
            }
            else if($opc == 3){
                echo "Nova disciplina: "; $disciplina = trim(fgets(STDIN));
                $update_query = "UPDATE DICTIONARY SET Subject = '$disciplina' WHERE ID = $id";
            }
            else{
                echo "Nova aplicação: "; $aplicação = trim(fgets(STDIN));
                $update_query = "UPDATE DICTIONARY SET Application = '$aplicação' WHERE ID = $id";
            }
            break;
    }
}

/* Caso a validação do ID retorne um valor igual a zero, significa que o respectivo ID informado pelo usuário não existe no banco de dados. Assim
é necessário que os dados sejam inseridos através de uma query INSERT e não UPDATE. Desta forma o programa entra no condicional ELSE, que finaliza-o
ao utilizar a função exit com uma frase de indicação. */

else{
    exit("Sem registros para este ID, utilize a função INSERT.\n");
}

/* O resultado final do condicional SWITCH é a variavel $update_query que é utilizada como parametro da função mysqli_query, junto da variavel
$conexão que executa a conexão com o MySQL. O resultado da função mysqli_query é armazeado na variavel $envio_mysql que ao retornar um valor true,
mostra a frase referente ao resultado positivo. Caso false, uma frase de falha é informada ao usuario. */

$envio_mysql = mysqli_query($conexão,$update_query);
if($envio_mysql){
    echo "Os dados foram atualizados.\n";
}
else{
    echo "Erro ao atualizar dados.\n";
}
?>
