<?php

function consultaApi($banco, $informacao, $dadosEnviados){
    
    $importante = array('senha' => 'apiSimTV', 'informacao' => $informacao, 'base' => $banco);
    $dados = array_merge($dadosEnviados, $importante);
    
    $url = "http://sistemas.simtv.com.br/api/select.php";
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $dados);
    $contents = curl_exec($c);
    curl_close($c);
    
    return $resultado = json_decode($contents);

} # Fecha consultaApi()

/*
$url = "http://sistemas.simtv.com.br/code_api/titulo/segundaViaPdf";
$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_URL, $url);
#curl_setopt($c, CURLOPT_POST, true);
#curl_setopt($c, CURLOPT_POSTFIELDS, $dados);
$contents = curl_exec($c);
curl_close($c);
print_r(json_decode($contents));
*/
?>
<h1>Teste nova segunda via</h1>
<form method="post" target="_blank" action="http://sistemas.simtv.com.br/ws/titulo/segundaViaPdfPaga">
    
    <label>Permissor
        <input name="permissor" />
    </label>
    
    <label>T&iacute;tulo
        <input name="titulo" />
    </label>
    
    <label>E-mail
        <input name="email" />
    </label>
    
    <input type="hidden" name="senha" value="apiSimTv" />
    
    <input type="submit" value="Enviar" />

</form>