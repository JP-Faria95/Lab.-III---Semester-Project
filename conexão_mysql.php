<?php

/* Este código é o código que fará a conexão do PHP ao MySQL. Criamos as variaveis que serão parametros da função 
mysqli_connect(). Esta função usa 4 parametros:
    hostname = O servidor do próprio SGDB (no caso para a mesma máquina = localhost)*
    username = O nome do usuário no SGDB (no caso para esta máquina = root)**
    passoword = A senha do SGDB cadastrada (usamos 1234)***
    database = O nome do banco de dados no SGDB (criamos como lab3_projeto)**** */

$hostname = 'localhost';    // *
$username = 'root';         // **
$password = '1234';         // ***
$database = 'lab3_projeto'; // ****

/* A função mysqli_connect é chamada, com seus respectivos parâmetros. O resultado é armazenado na variavel $conexão.
Utilizei a função mysqli_char_set e o parâmetro utf8mb4 para permitir a leitura de caracteres especias. */

mb_internal_encoding("UTF-8");
$conexão = mysqli_connect($hostname,$username,$password,$database);
mysqli_set_charset($conexão,"utf8mb4");


/* Criamos uma condicional IF/ELSE que trata a variavel $conexão ao receber o valor da função mysqli_connect()
Caso a variavel receba um valor TRUE do retorno da função, acessa o IF.
Caso a variavel receba um valor FALSE do retorno da função, acessa o ELSE e utilizando a função mysqli_connect_error
é possível verificar qual o possível erro que ocorreu. */

if($conexão){
    echo "----------------------\n";
    echo "Conexão bem sucedida.\n";
    echo "----------------------\n";
}
else{
    echo "A conexão falhou devido a: ".mysqli_connect_error();
}
?>