
    $(document).ready(function () {
        $('#frmlogin').validate({//Nessa linha, quando o form for submetido ele faz o validate   
            rules: {//na linha abaixo sao criada as regras de validacao
                email: {
                    required: true,
                    email: true
                },
                senha: {
                    required: true
                }
            },
            messages: {//na linha abaixo sao criada as mensagem que serao vista pelo ususarios
                email: {
                    required: "Campo Obrigatório",
                    email: "Email invalido"
                },
                senha: {
                    required: "Campo Obrigatório"
                }
            }
        });
    });


