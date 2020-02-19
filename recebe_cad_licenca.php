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
    if (isset($_POST['empreendimento']) && empty($_POST['empreendimento']) == FALSE) {
        if (isset($_POST['processo']) && empty($_POST['processo']) == FALSE) {
            if (isset($_POST['numero_licenca']) && empty($_POST['numero_licenca']) == FALSE) {
                if (isset($_POST['ano_licenca']) && empty($_POST['ano_licenca']) == FALSE) {
                    if (isset($_POST['data_emissao']) && empty($_POST['data_emissao']) == FALSE) {
                        if (isset($_POST['data_validade']) && empty($_POST['data_validade']) == FALSE) {
                            if (isset($_POST['descricao_atividade']) && empty($_POST['descricao_atividade']) == FALSE) {

                                    $empresa = strtoupper(addslashes($_POST['empresa']));
                                    $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
                                    $processo = strtoupper(addslashes($_POST['processo']));
                                    $numero_licenca = strtoupper(addslashes($_POST['numero_licenca']));
                                    $ano_licenca = strtoupper(addslashes($_POST['ano_licenca']));
                                    $data_emissao = strtoupper(addslashes($_POST['data_emissao']));
                                    $data_validade = strtoupper(addslashes($_POST['data_validade']));
                                    $taxa = strtoupper(addslashes($_POST['taxa']));
                                    $descricao_atividade = strtoupper(addslashes($_POST['descricao_atividade']));

                                    /* codigo responsavel pela comparaçõa entre as data de emissoa e validade */
                                    if ($data_emissao >= $data_validade) {
                                        ?>
                                        <script>
                                            alert('ERRO! A DATA DE EMISSÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE VALIDADE');
                                            window.history.back();
                                        </script>
                                        <?php
                                    }
                                    //VERIFICANDO SE JÁ EXISTE UM NÚMERO E O UM TIPO DE LICEÇA JÁ CADASTRADOS 
                                    $consulta_licenca = "SELECT fk1_codigo_processo,numero_licenca,ano_licenca FROM tb_licenca,tb_processo WHERE tb_licenca.fk1_codigo_processo='" . $_POST['processo']."' AND tb_licenca.numero_licenca='".$_POST['numero_licenca']."'AND tb_licenca.ano_licenca='".$_POST['ano_licenca']."'";
                           
                                    $recebe_consulta = mysqli_query($con, $consulta_licenca);

                                    if (mysqli_num_rows($recebe_consulta) > 0) {
                                        ?>
                                        <script>
                                            alert('ERRO! JÁ EXISTE UM NÚMERO E O TIPO DE LICENÇA CADASTRO COM ESSAS INFORMÇÕES, POR FAVOR INFORME OUTRO NÚMERO OU TIPO DE LICENÇA!');
                                            window.history.back();
                                        </script>
                                        <?php
                                    } else {

                                        $sql = "INSERT INTO tb_licenca(fk4_codigo_empresa,fk1_codigo_empreendimento,fk1_codigo_processo,numero_licenca,ano_licenca,data_emissao,data_validade,taxa,descricao_atividade)"
                                                . "VALUES('$empresa','$empreendimento','$processo','$numero_licenca','$ano_licenca','$data_emissao','$data_validade','$taxa',UPPER('$descricao_atividade'))";
                                        mysqli_query($con, $sql);
                                        $_SESSION['controle_de_abas'] = 2;
                                     
                                        // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
                                        $emailUser = $_SESSION['email'];
                                        $user = $_SESSION['nome'];
                                        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
                                        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
                                        $data = Date("Y-m-d H:i:s");
                                        $acaoUsuario = "Realizou o Cadastro da licenca de numero ->$numero_licenca, para o empreendimento de codigo->$empreendimento, empresa de codigo $empreendimento, e processo de codigo $processo";
                                        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
                                        mysqli_query($con, $sqlLog);
                                        ?>
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header btn-success">
                                                        <h4 class="modal-title text-center" id="myModalLabel"><strong>LICENÇA CADASTRADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
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
?>
<!--<script>
    alert('ERRO!PREENCHA O FORMUIÁRIO');
    window.history.back();
</script>-->

