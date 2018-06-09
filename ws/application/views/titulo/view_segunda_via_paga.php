<?php
// DADOS DO SEU CLIENTE
$sacado = $dadosSacado->NOME.', CPF: '.preg_replace('/^([0-9]{3})([0-9]{3})([0-9]{3})/', '$1.$2.$3-', $dadosSacado->CPF);
$endereco1 = $dadosSacado->BAIRRO.'-'.$dadosSacado->CIDADE.' /';
$endereco2 = $dadosSacado->ENDERECO.' - CEP: '.preg_replace('/^([0-9]{5})([0-9]{3})/', '$1-$2', $dadosSacado->CEP);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>SIM TV - 2ª VIA BOLETO</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/titulo'); ?>css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/titulo'); ?>css/personalizado.css">
</head>
<body>
    
    <div id="detalhamento">
    
        <div id="cabecalho">
            <img class="logoSimTv" src="<?php echo $logoPrincipal; ?>" alt="log_sim_tv" />
            <span>
                &nbsp;<?php echo $dadosCedente["cedente"]; ?><br />
                &nbsp;&nbsp;CNPJ: <?php echo $dadosCedente["cnpj"]; ?><br />
                &nbsp;&nbsp;<?php echo $dadosCedente["endereco"]; ?> - CEP: <?php echo $dadosCedente["cep"]; ?><br />
                &nbsp;&nbsp;<?php echo $dadosCedente["cidade_uf"]; ?>
            </span>
            <div style="clear:both"></div>
        </div>
        <div class="barraTitulo"><strong>SEUS DADOS</strong></div>
        
        <div>
            <table class="semBorda" cellpadding="0" cellspacing="5" border="0">
                <tr>
                  <td class="tdEscura">
                    <strong><?php echo utf8_encode('SEU CÓDIGO SIM'); ?></strong>
                    <span><?php echo $dadosSacado->ASSINANTE; ?></span>
                  </td>
                  <td class="tdEscura">
                    <strong>CPF/CGC</strong>
                    <span><?php echo preg_replace('/^([0-9]{3})([0-9]{3})([0-9]{3})/', '$1.$2.$3-', $dadosSacado->CPF); ?></span>
                  </td> 
                  <td class="tdEscura">
                    <strong>VENCIMENTO</strong>
                    <span><?php echo $dadosTitulo->DATA_VENCIMENTO; ?></span>
                  </td>
                </tr>
                <tr>
                    <td class="tdEscura" colspan="2">
                        <strong>Assinante</strong>
                        <span><?php echo $dadosSacado->NOME; ?></span>
                    </td>
                    <td class="tdEscura" colspan="1">
                        <strong>Documento</strong>
                        <span><?php echo $dadosSacado->TITULO; ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="tdEscura" colspan="2">
                        <strong><?php echo utf8_encode('Endereço'); ?></strong>
                        <span><?php echo $dadosSacado->ENDERECO.' BAIRRO: '.$dadosSacado->BAIRRO.' CEP: '.preg_replace('/^([0-9]{5})([0-9]{3})/', '$1-$2', $dadosSacado->CEP).' '.$dadosSacado->CIDADE.'-'.$dadosSacado->UF; ?></span>
                    </td>
                    <td class="tdEscura" colspan="1">
                        <strong><?php echo utf8_encode('Emissão'); ?></strong>
                        <span><?php echo $dadosTitulo->DATA_GERACAO; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" class="tdEscura" colspan="3">
                        <strong>FATURA PAGA</strong>
                    </td>
                </tr>
            </table>
            <div class="barraTitulo"><strong>SUA FATURA</strong></div>
            <div id="divBoleto">
        
                <table class="table-boleto" cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <tr>
                        <td><img src="<?php echo $logoBanco;?>" alt="logotipo do banco"></td>
                        <td><span class="codigoBanco"><?php echo $codigo_banco_com_dv; ?></span></td>
                        <td colspan="6" class="lateralDireita linhaDigitavel"><?php echo $dadosTitulo->LINHA_DIGITAVEL; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="titulo"><strong>Local de pagamento</strong></div>
                            <div class="conteudo"><?php echo $dadosFixos["local_pagamento"]; ?></div>
                        </td>
                            <td class="lateralDireita" style="width: 180px;">
                            <div class="titulo"><strong>Vencimento</strong></div>
                            <div style="text-align: right;"><?php echo $dadosTitulo->DATA_VENCIMENTO; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="titulo"><strong>Cedente</strong></div>
                            <div class="conteudo"><?php echo $dadosCedente["cedente"]; ?></div>
                        </td>
                        <td class="lateralDireita">
                            <div class="titulo"><strong><?php echo utf8_encode('Agência/Código cedente'); ?></strong></div>
                            <div class="conteudo rtl"><?php echo $dadosTitulo->AGENCIA; ?> / <?php echo $dadosTitulo->CONTA; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td width="110" colspan="2">
                            <div class="titulo"><strong>Data do documento</strong></div>
                            <div class="conteudo"><?php echo $dadosTitulo->DATA_GERACAO; ?></div>
                        </td>
                        <td width="115" colspan="2">
                            <div class="titulo"><strong>Nº documento</strong></div>
                            <div class="conteudo"><?php echo $dadosSacado->PERMISSOR; ?>00<?php echo $dadosSacado->TITULO; ?></div>
                        </td>
                        <td width="65">
                            <div class="titulo"><strong><?php utf8_encode('Espécie doc.'); ?></strong></div>
                            <div class="conteudo"><?php echo $dadosFixos["especie_doc"]; ?></div>
                        </td>
                        <td>
                            <div class="titulo"><strong>Aceite</strong></div>
                            <div class="conteudo"><?php echo $dadosFixos["aceite"]; ?></div>
                        </td>
                        <td width="110">
                            <div class="titulo"><strong>Data processamento</strong></div>
                            <div class="conteudo"><?php echo $dadosTitulo->DATA_GERACAO; ?></div>
                        </td>
                        <td class="lateralDireita">
                            <div class="titulo"><strong><?php echo utf8_encode('Nosso número'); ?></strong></div>
                            <div class="conteudo rtl"><?php echo $dadosSacado->NOSSO_NUMERO;?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdTop">
                            <div class="titulo"><strong>Uso do banco</strong></div>
                            <div class="conteudo"></div>
                        </td>
                        
                            <td width="20">
                                <div class="titulo"><strong>CIP</strong></div>
                                <div class="conteudo"><?php echo $dadosFixos["cip"];?></div>
                            </td>
                        
                        <td>
                            <div class="titulo"><strong>Carteira</strong></div>
                            <div class="conteudo"><?php echo $dadosTitulo->CARTEIRA;?></div>
                        </td>
                        <td width="35">
                            <div class="titulo"><strong><?php echo utf8_encode('Espécie'); ?></strong></div>
                            <div class="conteudo"><?php echo $dadosFixos["especie"]; ?></div>
                        </td>
                        <td class="tdTop" colspan="2">
                            <div class="titulo"><strong>Quantidade</strong></div>
                            <div class="conteudo"></div>
                        </td>
                        <td class="tdTop" width="110">
                            <div class="titulo"><strong>Valor</strong></div>
                            <div class="conteudo"></div>
                        </td>
                        <td class="lateralDireita">
                            <div class="titulo"><strong>(=) Valor do Documento</strong></div>
                            <div class="conteudo rtl">R$ <?php echo number_format($dadosTitulo->VALOR, 2, ',', ' '); ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="titulo">Instruções (Texto de responsabilidade do cedente</div>
                        </td>
                        <td class="lateralDireita">
                            <div class="titulo"><strong>(-) Descontos / Abatimentos</strong></div>
                            <div class="conteudo rtl"></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding: 10px;" rowspan="4" colspan="7" class="notopborder">
                            <div id="instrucoes" class="conteudo">
                            <?php echo $dadosFixos["instrucoes1"]; ?><br />
                            <?php echo $dadosFixos["instrucoes2"]; ?><br />
                            <?php echo $dadosFixos["instrucoes3"]; ?><br />
                            <?php echo $dadosFixos["instrucoes4"]; ?>
                            </div>                        
                        </td>
                        <td class="lateralDireita">
                            <div class="titulo"><strong><?php echo utf8_encode('(-) Outras deduções'); ?></strong></div>
                            <div class="conteudo rtl"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lateralDireita">
                            <div class="titulo"><strong>(+) Mora / Multa</strong></div>
                            <div class="conteudo rtl"></div>
                        </td>
                    </tr>
                    <tr class="lateralDireita">
                        <td class="lateralDireita">
                            <div class="titulo"><strong><?php echo utf8_encode('(+) Outros acréscimos'); ?></strong></div>
                            <div class="conteudo rtl"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="lateralDireita">
                            <div class="titulo"><strong>(=) Valor cobrado</strong></div>
                            <div class="conteudo rtl"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="titulo"><strong>Sacado</strong></div>
                            <div class="conteudo"><?php echo $sacado; ?></div>
                            <div class="conteudo"><?php echo $endereco1; ?></div>
                            <div class="conteudo"><?php echo $endereco2; ?></div>
                
                        </td>
                        <td class="noleftborder lateralDireita">
                            <div class="titulo" style="margin-top: 50px"></div>
                        </td>
                    </tr>
                
                    <tr>
                        <td colspan="6" class="bottomborder">
                            <div class="titulo">
                                <strong>Sacador/Avalista</strong> 
                            </div>
                            <div class="conteudo"><?php echo $dadosCedente["cedente"].', CNPJ: '.$dadosCedente["cnpj"]; ?></div>
                            <div class="conteudo"><?php echo $dadosCedente["bairro"].' '.$dadosCedente["cidade_uf"]; ?></div>
                            <div class="conteudo"><?php echo $dadosCedente["endereco"].' - CEP: '.$dadosCedente["cep"]; ?></div>
                        </td>
                        <td colspan="2" class="noleftborder bottomborder lateralDireita">
                            <div class="conteudo noborder rtl"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>   
                <!-- 
                <table style="width: 666px; margin-bottom: 20px;">
                    <tr>
                        <td id="autenticacao_mecanica">Autenticação mecânica - Ficha de Compensação</td>
                    </tr>
                    <tr>
                        <td><?php /*fbarcode(trim($dadosTitulo->CODIGO_BARRA));*/ ?></td>
                    </tr>
                </table>
                -->
                <div><?php echo str_repeat("-", 131); ?></div>
            </div>            
            
            <div class="barraTitulo"><strong>SEU DETALHAMENTO DE CONTA</strong></div>
            <table class="semBorda margemTop" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <th class="colEstreira">
                    <strong>DATA</strong>
                  </th>
                  <th class="colLarga">
                    <strong><?php echo utf8_encode('SERVIÇO'); ?></strong>
                  </th> 
                  <th class="colLarga">
                    <strong><?php echo utf8_encode('REFERÊNCIA') ?></strong>
                  </th>
                  <th class="colEstreira">
                    <strong>VALOR(R$)</strong>
                  </th>
                </tr>
                <?php
                $totalItem = 0;
                #echo '<pre>';
                #print_r($dadosItensTitulo);
                #exit();
                foreach($itensTitulo as $dadosItem){
                    $totalItem += $dadosItem->VALOR;
                ?>                
                <tr>
                    <td>
                        <span><?php echo $dadosItem->DATA; ?></span>
                    </td>
                    <td>
                        <span><?php echo $dadosItem->CONCEITO; ?></span>
                    </td>
                    <td>
                        <span><?php echo $dadosItem->REFERENCIA; ?></span>
                    </td>
                    <td style="text-align: right;">
                        <span><?php echo number_format($dadosItem->VALOR, 2, ',', ' '); ?></span>
                    </td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td class="linhaTotal" colspan="3">
                        <strong>TOTAL:</strong>
                    </td>
                    <td style="text-align: right;" class="linhaTotal"><?php echo number_format($totalItem, 2, ',', ' '); ?></td>
                </tr>
            </table>
        </div>
    </div>
    
</body>
</html>