<?php

/**
 * @author lolkittens
 * @copyright 2015
 */
 

// MÉTODO GET - LIST
#$url = "http://localhost/code_api/example/user/id/1/format/json"; # UM USUÁRIO
#$url = "http://sistemas.simtv.com.br/code_api/example/user/id/1/format/json";
$url = "http://sistemas.simtv.com.br/code_api/example/user/id/1/format/json"; # UM USUÁRIO
#$url = "http://zend/api/user"; # TODOS USUÁRIOS
$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_URL, $url);
$contents = curl_exec($c);
curl_close($c);

$resultado = json_decode($contents);

echo '<pre>';
print_r($resultado);



/*
// MÉTODO POST - CREATE
$dados = array('nome' => 'Novo teste', 'email' => 'novo.teste@teste.com', 'password' => '123456');
$url = "http://zend/api/user";
$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, $dados);
$contents = curl_exec($c);
curl_close($c);

$resultado = json_decode($contents);

echo '<pre>';
print_r($resultado);
*/


/*
// MÉTODO PUT - UPDATE
$dados = array('nome' => 'Novo teste 123', 'email' => 'novo.teste@teste.com', 'password' => '123456');
$url = "http://zend/api/user/7";
$c = curl_init();
curl_setopt($c, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($dados));
$contents = curl_exec($c);
curl_close($c);

$resultado = json_decode($contents);

echo '<pre>';
print_r($resultado);
*/

/*
// MÉTODO DELETE - DELETE
$url = "http://zend/api/user/14";
$c = curl_init();
curl_setopt($c, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_URL, $url);
$contents = curl_exec($c);
curl_close($c);

$resultado = json_decode($contents);

echo '<pre>';
print_r($resultado);
*/
?>