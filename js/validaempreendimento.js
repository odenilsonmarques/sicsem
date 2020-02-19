
$(document).ready(function () {
    jQuery.validator.addMethod("isString", function (value, element) {
        var regExp = /[0-9]/;
        if (regExp.test(value))
            return false;
        return true;
    },
            "Por Favor! Insira Somente Letras");

    //Na linha abaixo, quando o form for submetido ele faz o validate 
    $('#frmempreendimento').validate({
        //na linha abaixo sao criada as regras de validacao
        rules: {
            empresa: {
                required: true
            },
            denominacao_comercial: {
                required: true,
                minlength: 5
            },
            atividade_empreendimento: {
                required: true
            },
            nome_atividade: {
                required: true,
                minlength: 10
            },
            grau_atividade: {
                required: true

            },
            nome_empreendimento: {
                required: true,
                minlength: 5
            },
            cnae: {
                required: true
            },
            atividade_operar: {
                required: true,
                minlength: 15,
                isString: true
            },
            descricao_atividade: {
                required: true,
                minlength: 15,
                isString: true
            },
            nome_logradouro: {
                required: true,
                minlength: 5
            },
            nome_bairro: {
                required: true
            },
            localizacao_map_empre: {
                required: true
            }
        },
        //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
        messages: {
            empresa: {
                required: "Campo Obrigatório*"
            },
            denominacao_comercial: {
                required: "Campo Obrigatório*"
            },
            atividade_empreendimento: {
                required: "Campo Obrigatório*"
            },
            nome_atividade: {
                required: "Campo Obrigatório*"
            },
            grau_atividade: {
                required: "Campo Obrigatório*"
            },
            nome_empreendimento: {
                required: "Campo Obrigatório*",
                minlength: "Nome do Empreendimento Inválido! Por Favor Informe Mais Detalhes"
            },
            descricao_atividade: {
                required: "Campo Obrigatório*",
                minlength: "Descrição Inválida! Por Favor Informe Mais Detalhes"
            },
            nome_logradouro: {
                required: "Campo Obrigatório*",
                minlength: "Endereço Inválido! Por Favor Informe Mais Detalhes"
            },
            nome_bairro: {
                required: "Campo Obrigatório*"
            },
            telefone: {
                required: "Campo Obrigatório*"
            },
            localizacao_map_empre: {
                required: "Campo Obrigatório*"
            }
        }
    });
});


function mostrarDivInformacoesAtiEmpre(valor) {
    if (valor === "EMPREENDIMENTO") {
        document.getElementById("LOGRADOURO").style.display = "block";
        document.getElementById("ATIV").style.display = "none";
        document.getElementById("ATIV_GRAU").style.display = "none";
    } else if (valor === "ATIVIDADE") {
        document.getElementById("ATIV").style.display = "block";
        document.getElementById("ATIV_GRAU").style.display = "block";
        document.getElementById("LOGRADOURO").style.display = "none";
    }
}
                               