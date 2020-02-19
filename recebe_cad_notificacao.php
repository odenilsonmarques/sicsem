<?php
session_start();
require './config/conexao.php';
require './pages/header.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
    exit();
}

if (isset($_POST['empresa']) && empty($_POST['empresa']) == FALSE) {
    if (isset($_POST['numero_notificacao']) && empty($_POST['numero_notificacao']) == FALSE) {
        if (isset($_POST['data_notificacao']) && empty($_POST['data_notificacao']) == FALSE) {
            if (isset($_POST['data_comparecimento']) && empty($_POST['data_comparecimento']) == FALSE) {
                if (isset($_POST['profissao_atividade']) && empty($_POST['profissao_atividade']) == FALSE) {
                    if (isset($_POST['descricao_prazo']) && empty($_POST['descricao_prazo']) == FALSE) {
                        if (isset($_POST['fiscal']) && empty($_POST['fiscal']) == FALSE) {
                            if (isset($_POST['chefe_fiscalizacao']) && empty($_POST['chefe_fiscalizacao']) == FALSE) {
                                if (isset($_POST['status_notificado']) && empty($_POST['status_notificado']) == FALSE) {
                                    if (isset($_POST['status_informacoes_adicionais']) && empty($_POST['status_informacoes_adicionais']) == FALSE) {


                                        $empresa = strtoupper(addslashes($_POST['empresa']));
                                        $processo = strtoupper(addslashes($_POST['processo']));
                                        $fiscal = strtoupper(addslashes($_POST['fiscal']));
                                        $numero_notificacao = strtoupper(addslashes($_POST['numero_notificacao']));
                                        $ano_notificacao = strtoupper(addslashes($_POST['ano_notificacao']));
                                        $data_notificacao = strtoupper(addslashes($_POST['data_notificacao']));
                                        $data_comparecimento = strtoupper(addslashes($_POST['data_comparecimento']));
                                        $profissao_atividade = strtoupper(addslashes($_POST['profissao_atividade']));
                                        $descricao_prazo = strtoupper(addslashes($_POST['descricao_prazo']));
                                        $status = strtoupper(addslashes($_POST['status']));
                                        $status_informacoes_adicionais = strtoupper(addslashes($_POST['status_informacoes_adicionais']));
                                        $numero_notificacao_anterior = strtoupper(addslashes($_POST['numero_notificacao_anterior']));
                                        $numero_notificacao_ano_anterior = strtoupper(addslashes($_POST['numero_notificacao_ano_anterior']));
                                        $numero_processo_notificacao_anterior = strtoupper(addslashes($_POST['numero_processo_notificacao_anterior']));
                                        $ano_processo_notificacao_anterior = strtoupper(addslashes($_POST['ano_processo_notificacao_anterior']));
                                        $status_licenca = strtoupper(addslashes($_POST['status_licenca']));
                                        $numero_licenca_notificacao_anterior = strtoupper(addslashes($_POST['numero_licenca_notificacao_anterior']));
                                        $ano_licenca_notificacao_anterior = strtoupper(addslashes($_POST['ano_licenca_notificacao_anterior']));
                                        $orgao_emissor_licenca = strtoupper(addslashes($_POST['orgao_emissor_licenca']));
                                        $data_validade = strtoupper(addslashes($_POST['data_validade']));
                                        $status_notificado = strtoupper(addslashes($_POST['status_notificado']));
                                        $nome_notificado = strtoupper(addslashes($_POST['nome_notificado']));
                                        $cpf = strtoupper(addslashes($_POST['cpf']));
                                        $logradouro = strtoupper(addslashes($_POST['logradouro']));
                                        $numero = strtoupper(addslashes($_POST['numero']));
                                        $bairro = strtoupper(addslashes($_POST['bairro']));
                                        $testemunha = strtoupper(addslashes($_POST['testemunha']));
                                        $chefe_fiscalizacao = strtoupper(addslashes($_POST['chefe_fiscalizacao']));

                                        if ($data_notificacao >= $data_comparecimento) {
                                            ?>  
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">ERRO! A DATA DE NOTIFICAÇÃO NÃO PODE SER MAIOR NEM IGUAL A DATA DE COMPARECIMENTO</h4>
                                                            <script type="text/javascript">                                         
                                                                window.history.back();
                                                            </script>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#myModal').modal('show');
                                                });
                                            </script>
                                            <?php
                                        }
                                        //verificando se ja existe uma notificação com o numero informado banco de dados
                                        $consulta_notificacao = "SELECT *FROM tb_notificacao WHERE numero_notificacao ='" . $_POST['numero_notificacao'] . "'";
                                        $recebe_consulta = mysqli_query($con, $consulta_notificacao);

                                        if (mysqli_num_rows($recebe_consulta) > 0) {
                                            ?>
                                            <script>
                                                alert('ERRO JÁ EXISTE UMA NOTIFICAÇÃO COM O NÚMERO INFORMADO, POR FAVOR INFORME OUTRO NÚMERO!');
                                                window.history.back();
                                            </script>                       
                                            <?php
                                        } else {
                                            $sql = "INSERT INTO tb_notificacao(fk5_codigo_empresa,fk2_codigo_processo,fk1_codigo_fiscal,numero_notificacao,ano_notificacao,data_notificacao,data_comparecimento,profissao_atividade,descricao_prazo,status,status_informacoes_adicionais,numero_notificacao_anterior,numero_notificacao_ano_anterior,numero_processo_notificacao_anterior,ano_processo_notificacao_anterior,status_licenca,numero_licenca_notificacao_anterior,ano_licenca_notificacao_anterior,orgao_emissor_licenca,data_validade,status_notificado,nome_notificado,cpf,logradouro,numero,bairro,testemunha,chefe_fiscalizacao)"
                                                    . "VALUES('$empresa','$processo','$fiscal','$numero_notificacao','$ano_notificacao','$data_notificacao','$data_comparecimento',UPPER('$profissao_atividade'),UPPER('$descricao_prazo'),'$status','$status_informacoes_adicionais','$numero_notificacao_anterior','$numero_notificacao_ano_anterior','$numero_processo_notificacao_anterior','$ano_processo_notificacao_anterior','$status_licenca','$numero_licenca_notificacao_anterior','$ano_licenca_notificacao_anterior',UPPER('$orgao_emissor_licenca'),'$data_validade',UPPER('$status_notificado'),UPPER('$nome_notificado'),'$cpf',UPPER('$logradouro'),'$numero',UPPER('$bairro'),UPPER('$testemunha'),UPPER('$chefe_fiscalizacao'))";
                                            mysqli_query($con, $sql);
//                                            print_r($sql);
                                            
                                             // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
                                        $emailUser = $_SESSION['email'];
                                        $user = $_SESSION['nome'];
                                        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
                                        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
                                        $data = Date("Y-m-d H:i:s");
                                        $acaoUsuario = "Realizou o Cadastro da Notificação de Numero ->$numero_notificacao, para empresa de codigo $empresa, e processo de codigo $processo";
                                        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
                                        mysqli_query($con, $sqlLog);
                                            
                                            ?>
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-success">
                                                            <h4 class="modal-title text-center" id="myModalLabel"><strong>NOTIFICAÇÃO CADASTRADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                                                            <div class="spinner"></div>
                                                            
                                                            <script type="text/javascript">
                                                                setTimeout('window.location.href="cadastros.php"', 3500);
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#myModal').modal('show');
                                                });
                                            </script>                                          
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ERRO! POR FAVOR PREENCHA O FORMULÁRIO</h4>
            </div>
            <div class="modal-footer">
                <a href="cad_notificacao.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
                <a href="home.php"><button type="button" class="btn btn-danger"><strong>CANCELAR</strong></button></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myModal').modal('show');
    });
</script>



