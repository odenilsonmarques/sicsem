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

if (isset($_POST['razaosocial_pessoafisica']) && empty($_POST['razaosocial_pessoafisica']) == FALSE) {
    if (isset($_POST['nome_fantasia']) && empty($_POST['nome_fantasia']) == FALSE) {
        if (isset($_POST['pessoa_fisicajuridica']) && empty($_POST['pessoa_fisicajuridica']) == FALSE) {
            if (isset($_POST['cnpj_cpf']) && empty($_POST['cnpj_cpf']) == FALSE) {
                if (isset($_POST['cep']) && empty($_POST['cep']) == FALSE) {
                    if (isset($_POST['logradouro']) && empty($_POST['logradouro']) == FALSE) {
                        if (isset($_POST['localizacao_map']) && empty($_POST['localizacao_map']) == FALSE) {
                            if (isset($_POST['uf']) && empty($_POST['uf']) == FALSE) {
                                if (isset($_POST['municipio']) && empty($_POST['municipio']) == FALSE) {
                                    if (isset($_POST['bairro']) && empty($_POST['bairro']) == FALSE) {
                                        if (isset($_POST['telefone']) && empty($_POST['telefone']) == FALSE) {

                                            $razaosocial_pessoafisica = strtoupper(addslashes($_POST['razaosocial_pessoafisica']));
                                            $nome_fantasia = strtoupper(addslashes($_POST['nome_fantasia']));
                                            $pessoa_fisicajuridica = strtoupper(addslashes($_POST['pessoa_fisicajuridica']));
                                            $cnpj_cpf = strtoupper(addslashes($_POST['cnpj_cpf']));
                                            $cep = strtoupper(addslashes($_POST['cep']));
                                            $logradouro = strtoupper(addslashes($_POST['logradouro']));
                                            $numero = strtoupper(addslashes($_POST['numero']));
                                            $complemento = strtoupper(addslashes($_POST['complemento']));
                                            $localizacao_map = (addslashes($_POST['localizacao_map']));
                                            $uf = strtoupper(addslashes($_POST['uf']));
                                            $municipio = strtoupper(addslashes($_POST['municipio']));
                                            $bairro = strtoupper(addslashes($_POST['bairro']));
                                            $email = strtoupper(addslashes($_POST['email']));
                                            $telefone = strtoupper(addslashes($_POST['telefone']));

                                            //verifacando se o nome da erazao social / pessoa fisica já está cadastrado
                                            $consulta_empresa = "SELECT *FROM tb_empresa WHERE razaosocial_pessoafisica = '" . $_POST['razaosocial_pessoafisica'] . "'";
                                            $recebe_consulta_empresa = mysqli_query($con, $consulta_empresa);

                                            //verificando se o cpf ou o cnpj ja existe no banco de dados
                                            $consulta_cnpjcpf = "SELECT *FROM tb_empresa WHERE cnpj_cpf ='" . $_POST['cnpj_cpf'] . "' ";
                                            $recebe_consulta = mysqli_query($con, $consulta_cnpjcpf);

                                            if (mysqli_num_rows($recebe_consulta_empresa) > 0) {
                                                ?>
                                                <script>
                                                    alert('ERRO A RAZÃO SOCIAL / PESSOA FISCA JÁ EXISTE');
                                                    window.history.back();
                                                </script>
                                                <?php
                                            } else if (mysqli_num_rows($recebe_consulta) > 0) {
                                                ?>
                                                <script>
                                                    alert('ERRO O CPF / CNPJ INFORMADO JÁ EXISTE, POR FAVOR INFORME OUTRO NÚMERO!');
                                                    window.history.back();
                                                </script>
                                                <?php
                                            } else {
                                                $sql = "INSERT INTO tb_empresa(razaosocial_pessoafisica,nome_fantasia,pessoa_fisicajuridica,cnpj_cpf,cep,logradouro,numero,complemento,localizacao_map,uf,municipio,bairro,email,telefone)"
                                                        . "VALUES(UPPER('$razaosocial_pessoafisica'),UPPER('$nome_fantasia'),UPPER('$pessoa_fisicajuridica'),UPPER('$cnpj_cpf'),UPPER('$cep'),UPPER('$logradouro'),UPPER('$numero'),UPPER('$complemento'),('$localizacao_map'),UPPER('$uf'),UPPER('$municipio'),UPPER('$bairro'),UPPER('$email'),UPPER('$telefone'))";
                                                mysqli_query($con, $sql);
//                                            print_r($sql);
                                                //recuperando o ultimo id do usuario inserido
                                                $ultimo_cod = mysqli_insert_id($con);
                                                echo $ultimo_cod;
                                                $_SESSION['ultimo_cod'] = $ultimo_cod;
                                                ?>
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn-success">
                                                                <h4 class="modal-title" id="myModalLabel"><strong>EMPRESA / PESSOA FÍSICA CADASTRADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                                                            <script type="text/javascript">
//                                                                setTimeout('window.location.href="cad_processo.php"', 3500);
                                                                setTimeout('window.location.href="cad_licenca.php"', 3500);
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
}
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ERRO! POR FAVOR PREENCHA O FORMULÁRIO</h4>
            </div>

            <div class="modal-footer">
                <a href="cadastros.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
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


