<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>SIM TV - 2ª VIA BOLETO</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/personalizado.css">
</head>
<body>
    
    <div id="detalhamento">
    
        <div id="cabecalho">
            <img class="logoSimTv" src="images/logoSimTv.PNG" alt="log_sim_tv" />
            <span>
                <?php echo utf8_encode($dadosboleto["cedente"]); ?><br />
                &nbsp;&nbsp;CNPJ: <?php echo utf8_encode($dadosboleto["cpf_cnpj"]); ?><br />
                &nbsp;&nbsp;<?php echo utf8_encode($dadosboleto["endereco"]); ?> - CEP: <?php echo utf8_encode($dadosboleto["cep"]); ?><br />
                &nbsp;&nbsp;<?php echo utf8_encode($dadosboleto["cidade_uf"]); ?>
            </span>
            <div style="clear:both"></div>
        </div>
        
        <div>
            <table class="semBorda" cellpadding="0" cellspacing="5" border="0">
                <tr>
                  <td class="tdEscura">
                    <strong>SEU CÓDIGO SIM</strong>
                    <span><?php echo $dadosSacadoTitulo[0]->ASSINANTE; ?></span>
                  </td>
                  <td class="tdEscura">
                    <strong>CPF/CGC</strong>
                    <span><?php echo preg_replace('/^([0-9]{3})([0-9]{3})([0-9]{3})/', '$1.$2.$3-', $dadosSacadoTitulo[0]->CPF); ?></span>
                  </td> 
                  <td class="tdEscura">
                    <strong>VENCIMENTO</strong>
                    <span><?php echo $dadosTitulo[0]->DATA_VENCIMENTO; ?></span>
                  </td>
                </tr>
                <tr>
                    <td class="tdEscura" colspan="2">
                        <strong>Assinante</strong>
                        <span><?php echo $dadosSacadoTitulo[0]->NOME; ?></span>
                    </td>
                    <td class="tdEscura" colspan="1">
                        <strong>Documento</strong>
                        <span><?php echo $dadosSacadoTitulo[0]->TITULO; ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="tdEscura" colspan="2">
                        <strong>Endereço</strong>
                        <span><?php echo $dadosSacadoTitulo[0]->ENDERECO.' BAIRRO: '.$dadosSacadoTitulo[0]->BAIRRO.' CEP: '.preg_replace('/^([0-9]{5})([0-9]{3})/', '$1-$2', $dadosSacadoTitulo[0]->CEP).' '.$dadosSacadoTitulo[0]->CIDADE.'-'.$dadosSacadoTitulo[0]->UF; ?></span>
                    </td>
                    <td class="tdEscura" colspan="1">
                        <strong>Emissão</strong>
                        <span><?php echo $dadosTitulo[0]->DATA_GERACAO; ?></span>
                    </td>
                </tr>
            </table>
            
            <table class="semBorda" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <th class="colEstreira">
                    <strong>DATA</strong>
                  </th>
                  <th class="colLarga">
                    <strong>SERVIÇO</strong>
                  </th> 
                  <th class="colLarga">
                    <strong>REFERÊNCIA</strong>
                  </th>
                  <th class="colEstreira">
                    <strong>VALOR(R$)</strong>
                  </th>
                </tr>
                <?php
                $totalItem = 0;
                foreach($dadosItensTitulo as $dadosItem){
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
    
    <div style="width: 666px">
    <!-- COMENTADO  POR TIAGO
        <div class="noprint info">
            <h2>Instruções de Impressão</h2>
            <ul>
                <li>Imprima em impressora jato de tinta (ink jet) ou laser em qualidade normal ou alta (Não use modo econômico).</li>
                <li>Utilize folha A4 (210 x 297 mm) ou Carta (216 x 279 mm) e margens mínimas à esquerda e à direita do formulário.</li>
                <li>Corte na linha indicada. Não rasure, risque, fure ou dobre a região onde se encontra o código de barras.</li>
                <li>Caso não apareça o código de barras no final, pressione F5 para atualizar esta tela.</li>
                <li>Caso tenha problemas ao imprimir, copie a sequencia numérica abaixo e pague no caixa eletrônico ou no internet banking:</li>
            </ul>
            <span class="header">Linha Digitável: 23791.17209 60007.589645 52013.261301 6 55880000002300</span>
            <span class="header">Valor: R$ 23,00</span>                        <br>
            <div class="linha-pontilhada" style="margin-bottom: 20px;">Recibo do sacado</div>
        </div>

        <div class="info-empresa">
                        <div style="display: inline-block; vertical-align: super;">
                <div><strong>Empresa de cosméticos LTDA</strong></div>
                <div>02.123.123/0001-11</div>
                <div>CLS 403 Lj 23</div>
                <div>71000-000 - Brasília - DF</div>
            </div>
        </div>
        <br>
   COMENTADO  POR TIAGO -->
    <!-- COMENTADO  POR TIAGO
        <table class="table-boleto" cellpadding="0" cellspacing="0" border="0">
            <tbody>
            <tr>
                <td valign="bottom" colspan="8" class="noborder nopadding">
                    <div class="logocontainer">
                        <div class="logobanco">
                            <img src="data:image/jpg;base64,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" alt="logotipo do banco">
                        </div>
                        <div class="codbanco">237-2</div>
                    </div>
                    <div class="linha-digitavel">23791.17209 60007.589645 52013.261301 6 55880000002300</div>
                </td>
            </tr>
            <tr>
                <td colspan="2" width="250">
                    <div class="titulo">Cedente</div>
                    <div class="conteudo">Empresa de cosméticos LTDA</div>
                </td>
                <td>
                    <div class="titulo">CPF/CNPJ</div>
                    <div class="conteudo">02.123.123/0001-11</div>
                </td>
                <td width="120">
                    <div class="titulo">Agência/Código do Cedente</div>
                    <div class="conteudo rtl">1172-1 / 132613-2</div>
                </td>
                <td width="110">
                    <div class="titulo">Vencimento</div>
                    <div class="conteudo rtl">24/01/2013</div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="titulo">Sacado</div>
                    <div class="conteudo">Fernando Maia</div>
                </td>
                <td>
                    <div class="titulo">Nº documento</div>
                    <div class="conteudo rtl"></div>
                </td>
                <td>
                    <div class="titulo">Nosso número</div>
                    <div class="conteudo rtl">75896452</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="titulo">Espécie</div>
                    <div class="conteudo">REAL</div>
                </td>
                <td>
                    <div class="titulo">Quantidade</div>
                    <div class="conteudo rtl"></div>
                </td>
                <td>
                    <div class="titulo">Valor</div>
                    <div class="conteudo rtl"></div>
                </td>
                <td>
                    <div class="titulo">(-) Descontos / Abatimentos</div>
                    <div class="conteudo rtl"></div>
                </td>
                <td>
                    <div class="titulo">(=) Valor Documento</div>
                    <div class="conteudo rtl">23,00</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="conteudo"></div>
                    <div class="titulo">Demonstrativo</div>
                </td>
                <td>
                    <div class="titulo">(-) Outras deduções</div>
                    <div class="conteudo"></div>
                </td>
                <td>
                    <div class="titulo">(+) Outros acréscimos</div>
                    <div class="conteudo rtl"></div>
                </td>
                <td>
                    <div class="titulo">(=) Valor cobrado</div>
                    <div class="conteudo rtl"></div>
                </td>
            </tr>
            <tr>
                <td colspan="4"><div style="margin-top: 10px" class="conteudo">Compra de materiais cosméticos</div></td>
                <td class="noleftborder"><div class="titulo">Autenticação mecânica</div></td>
            </tr>
            <tr>
                <td colspan="5" class="notopborder"><div class="conteudo">Compra de alicate</div></td>
            </tr>
            <tr>
                <td colspan="5" class="notopborder"><div class="conteudo"></div></td>
            </tr>
            <tr>
                <td colspan="5" class="notopborder"><div class="conteudo"></div></td>
            </tr>
            <tr>
                <td colspan="5" class="notopborder bottomborder"><div style="margin-bottom: 10px;" class="conteudo"></div></td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="linha-pontilhada">Corte na linha pontilhada</div>
        <br>
    COMENTADO  POR TIAGO -->
        <!-- Ficha de compensação -->
        <!--
 * OpenBoleto - Geração de boletos bancários em PHP
 *
 * LICENSE: The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this
 * software and associated documentation files (the "Software"), to deal in the Software
 * without restriction, including without limitation the rights to use, copy, modify,
 * merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies
 * or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->

        <table class="table-boleto" cellpadding="0" cellspacing="0" border="0">
            <tbody>
            <tr>
            <!--
                <td valign="bottom" colspan="8" class="noborder nopadding">
                    <div class="logocontainer">
                        <div class="logobanco">
                            <img src="data:image/jpg;base64,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" alt="logotipo do banco">
                        </div>
                        <div class="codbanco"><?php echo $codigo_banco_com_dv; ?></div>
                    </div>
                    <div class="linha-digitavel"><?php echo $dadosTitulo[0]->LINHA_DIGITAVEL; ?></div>
                </td>
            -->
                <td><img src="data:image/jpg;base64,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" alt="logotipo do banco"></td>
                <td><span class="codigoBanco"><?php echo $codigo_banco_com_dv; ?></span></td>
                <td colspan="6" class="lateralDireita linhaDigitavel"><?php echo $dadosTitulo[0]->LINHA_DIGITAVEL; ?></td>
            </tr>
            <tr>
                <td colspan="7">
                    <div class="titulo"><strong>Local de pagamento</strong></div>
                    <div class="conteudo"><?php echo utf8_encode($dadosboleto["local_pagamento"]); ?></div>
                </td>
                    <td class="lateralDireita" style="width: 180px;">
                <!--<td class="lateralDireita">-->
                    <div class="titulo"><strong>Vencimento</strong></div>
                    <div style="text-align: right;"><?php echo $dadosTitulo[0]->DATA_VENCIMENTO; ?></div>
                    <!--<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                            <td  style="width: 180px; border: 0px solid;">Vencimento</td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid; text-align: right;"><?php echo $dadosTitulo[0]->DATA_VENCIMENTO; ?></td>
                        </tr>
                    </table>-->
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <div class="titulo"><strong>Cedente</strong></div>
                    <div class="conteudo"><?php echo utf8_encode($dadosboleto["cedente"]); ?></div>
                </td>
                <td class="lateralDireita">
                    <div class="titulo"><strong>Agência/Código cedente</strong></div>
                    <div class="conteudo rtl"><?php echo $dadosboleto["agencia"]; ?> / <?php echo $dadosboleto["conta"]; ?></div>
                </td>
            </tr>
            <tr>
                <td width="110" colspan="2">
                    <div class="titulo"><strong>Data do documento</strong></div>
                    <div class="conteudo"><?php echo $dadosTitulo[0]->DATA_GERACAO; ?></div>
                </td>
                <td width="115" colspan="2">
                    <div class="titulo"><strong>Nº documento</strong></div>
                    <div class="conteudo"><?php echo $dadosSacadoTitulo[0]->PERMISSOR; ?>00<?php echo $dadosSacadoTitulo[0]->TITULO; ?></div>
                </td>
                <td width="65">
                    <div class="titulo"><strong>Espécie doc.</strong></div>
                    <div class="conteudo"><?php echo $dadosboleto["especie_doc"]; ?></div>
                </td>
                <td>
                    <div class="titulo"><strong>Aceite</strong></div>
                    <div class="conteudo"><?php echo $dadosboleto["aceite"]; ?></div>
                </td>
                <td width="110">
                    <div class="titulo"><strong>Data processamento</strong></div>
                    <div class="conteudo"><?php echo $dadosTitulo[0]->DATA_GERACAO; ?></div>
                </td>
                <td class="lateralDireita">
                    <div class="titulo"><strong>Nosso número</strong></div>
                    <div class="conteudo rtl"><?php echo $dadosboleto["nosso_numero"];?></div>
                </td>
            </tr>
            <tr>
                <td class="tdTop">
                    <div class="titulo"><strong>Uso do banco</strong></div>
                    <div class="conteudo"></div>
                </td>
                
                            <!-- Campo exclusivo do Bradesco -->
                    <td width="20">
                        <div class="titulo"><strong>CIP</strong></div>
                        <div class="conteudo"><?php echo $dadosboleto["cip"];?></div>
                    </td>
                
                <td>
                    <div class="titulo"><strong>Carteira</strong></div>
                    <div class="conteudo"><?php echo $dadosboleto["carteira"];?></div>
                </td>
                <td width="35">
                    <div class="titulo"><strong>Espécie</strong></div>
                    <div class="conteudo"><?php echo $dadosboleto["especie"]; ?></div>
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
                    <div class="conteudo rtl">R$ <?php echo number_format($dadosTitulo[0]->VALOR, 2, ',', ' '); ?></div>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <div class="titulo">Instruções (Texto de responsabilidade do cedente)</div>
                </td>
                <td class="lateralDireita">
                    <div class="titulo"><strong>(-) Descontos / Abatimentos</strong></div>
                    <div class="conteudo rtl"></div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding: 10px;" rowspan="4" colspan="7" class="notopborder">
                    <div id="instrucoes" class="conteudo">
                    <?php echo utf8_encode($dadosboleto["instrucoes1"]); ?><br />
                    <?php echo utf8_encode($dadosboleto["instrucoes2"]); ?><br />
                    <?php echo utf8_encode($dadosboleto["instrucoes3"]); ?><br />
                    <?php echo utf8_encode($dadosboleto["instrucoes4"]); ?>
                    </div>                        
                </td>
                <td class="lateralDireita">
                    <div class="titulo"><strong>(-) Outras deduções</strong></div>
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
                    <div class="titulo"><strong>(+) Outros acréscimos</strong></div>
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
                    <div class="conteudo"><?php echo $dadosboleto["sacado"]; ?></div>
                    <div class="conteudo"><?php echo $dadosboleto["endereco1"]; ?></div>
                    <div class="conteudo"><?php echo $dadosboleto["endereco2"]; ?></div>
        
                </td>
                <td class="noleftborder lateralDireita">
                    <div class="titulo" style="margin-top: 50px"><!--Cód. Baixa--></div>
                </td>
            </tr>
        
            <tr>
                <td colspan="6" class="bottomborder">
                    <div class="titulo">
                        <strong>Sacador/Avalista</strong> 
                    </div>
                    <div class="conteudo"><?php echo utf8_encode($dadosboleto["cedente"].', CNPJ: '.$dadosboleto["cpf_cnpj"]); ?></div>
                    <div class="conteudo"><?php echo utf8_encode($dadosboleto["bairro_cedente"].' '.$dadosboleto["cidade_uf"]); ?></div>
                    <div class="conteudo"><?php echo utf8_encode($dadosboleto["endereco"].' - CEP: '.$dadosboleto['cep']); ?></div>
                </td>
                <td colspan="2" class="noleftborder bottomborder lateralDireita">
                    <div class="conteudo noborder rtl"></div>
                </td>
            </tr>
        <!--
            <tr>
                <td colspan="8" id="codigoBarras" class="noborder">
                    <div id="autenticacao_mecanica">Autenticação mecânica - Ficha de Compensação</div>
                    <div class="barcode">
                    <?php /*fbarcode($dadosTitulo[0]->CODIGO_BARRA);*/ ?>
                    </div>        
                </td>
            </tr>
        -->
            </tbody>
        </table>    
        <table style="width: 666px;">
            <tr>
                <td id="autenticacao_mecanica">Autenticação mecânica - Ficha de Compensação</td>
            </tr>
            <tr>
                <td><?php fbarcode(trim($dadosTitulo[0]->CODIGO_BARRA)); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>