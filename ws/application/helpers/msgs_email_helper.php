<?php

function msgEmailSegundaVia($nome, $vencimento){
    
    error_reporting(0);
    
    $primeiro_nome = array_shift(explode(' ',trim($nome))); 
    $ultimo_nome = array_pop(explode(' ',trim($nome)));
    
    return "
                <style>
                html{-webkit-text-size-adjust:none;}
                body{width:100% !important; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
                #outlook a{padding:0;} 
                .ReadMsgBody{width:100%;}
                .ExternalClass{width:100%;}
                p { margin:1em 0;}
                h1, h2, h3, h4, h5, h6 { color:black !important; line-height:100% !important;}
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color:blue !important;}
                h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active { color:red !important;}
                h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color:purple !important;}
                table td { border-collapse:collapse;}
                </style><table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#ffffff'>
                <tr><td align='center' valign='top' style='background:#ffffff; width:100%; font-family:'Trebuchet MS',Arial,Verdana,Geneva,sans-serif; font-size:1px'>
                		<table width='585'  border='0' cellpadding='0' cellspacing='0' bgcolor='#c9c9c9' style='margin-bottom:20px'>
                		<tr><td width='585' style='color:#000; font-size:28px; font-weight:700; line-height:20px; padding:25px 15px 10px 15px;'>
                				Prezado(a) ".$primeiro_nome." ".$ultimo_nome.",</td>
                		</tr>
                                
                        <tr><td width='585' style='color:#000; font-size:15px; line-height:13px; padding:15px'>Você está recebendo um Boleto de Cobrança atualizado para o vencimento:</td>
                		</tr>
                                
                        <tr><td width='585' style='color:#000; font-size:25px; font-weight:700; line-height:18px; padding:5px 15px'>".$vencimento."</td>
                		</tr>
                                
                        <tr><td width='585' style='color:#000; font-size:16px; line-height:25px; padding:5px 15px'>Em caso de dúvidas, entre em contato com nossa <strong style='font-size:22px; display:block'>Central de Relacionamento com o Cliente:</strong></td>
                		</tr>
                                
                        <tr><td width='585'><img src='http://www.simtv.com.br/mail/2via/c1.jpg' width='585' height='456' alt='Reclamações:10603, outros assuntos:4004-1003' title='SIM, a resposta certa.' border='0' style='display:block' usemap='#mapa1'></td>
                		</tr>
                		</table>
                	</td>
                </tr>
                </table>
                
                <map name='mapa1'><area shape='rect' coords='19,202,297,367' href='http://www.simtv.com.br' alt='SIM Tv' title='SIM Tv'></map><hr><p style='font-size: 9px; color: #8B8989'>    
                Esta mensagem eletrônica e quaisquer arquivos a ela anexados são confidenciais e reservados, achando-se legalmente protegidos e devendo ser descartados na hipótese de recebimento indevido.<br/>
                Aos colaboradores da SIM: Somente atenda este e-mail durante sua jornada de trabalho.<br>
                This eletronic message and any files attached are confidential, privileged and legally protected and must be discarded in case of undue receipt.<br>
                Este mensaje electrónico y cualesquier archivos adjuntos son confidenciales, reservados, protegidos legalmente y deben ser descartados en caso de recibimiento indebido.
                            </p>";
    
}