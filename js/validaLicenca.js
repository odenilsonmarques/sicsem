
$(document).ready(function () {
    jQuery.validator.addMethod("isString", function (value, element) {
        var regExp = /[0-9]/;
        if (regExp.test(value))
            return false;
        return true;
    },
            "Por Favor! Insira Somente Letras");
    //Na linha abaixo, quando o form for submetido ele faz o validate 
    $('#frmlicenca').validate({
        //na linha abaixo sao criada as regras de validacao
        rules: {
            numero_licenca: {
                required: true,
                maxlength: 3
            },
            ano_licenca: {
                required: true
            },
            data_emissao: {
                required: true
            },
            data_validade: {
                required: true
            },
            taxa: {
                required: true,
                maxlength: 4,
                minlength: 2
            },
            atividade_realizada: {
                required: true,
                minlength: 10,
                isString: true
            },
            atividade: {
                required: true
            },
            empresa: {
                required: true
            },
            processo: {
                required: true
            }
        },
        //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
        messages: {
            numero_licenca: {
                required: "Campo Obrigatório*",
                maxlength: "Erro! Informe no Máximo 3 Digitos!"
            },
            ano_licenca: {
                required: "Campo Obrigatório*"
            },
            data_emissao: {
                required: "Campo Obrigatório*"
            },
            data_validade: {
                required: "Campo Obrigatório*"
            },
            taxa: {
                required: "Campo Obrigatório*",
                maxlength: "Erro! Informe no Máximo 4 Digitos!",
                minlength: "Erro! Informe no Mínino 2 Digitos!"
            },
            atividade_realizada: {
                required: "Campo Obrigatório*",
                minlength: "Atividade Inválida, Informe Mais Detalhes Para Que o Cadastro Possa Ser Realizado!"
            },
            atividade: {
                required: "Campo Obrigatório*"
            },
            empresa: {
                required: "Campo Obrigatório*"
            },
            processo: {
                required: "Campo Obrigatório*"
            }
        }
    });
});
function comparaDatas()
{
    var data_emissao = document.getElementById("data_emissao");
    var data_validade = document.getElementById("data_validade");
    if (data_emissao.value >= data_validade.value) {
        alert("ERRO! A DATA DE EMISSÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE VALIDADE");
        data_emissao = document.getElementById('data_emissao').value = '';
        data_validade = document.getElementById('data_validade').value = '';
    }

}
function comparaDataAno() {
    var ano_licenca = document.getElementById("ano_licenca").value;
    var data_emissao = document.getElementById("data_emissao").value;
    var data = data_emissao.substr(0, 4); // pega só o ano
    if (ano_licenca !== data) {
        alert("ERRO! O  CAMPO ANO DA LICENÇA NÃO FOI INFORMADO OU NÃO ESTÁ COM O MESMO ANO DA DATA DE EMISSÃO");
        window.history();
        ano_licenca = document.getElementById("ano_licenca").value = '';
        data_emissao = document.getElementById("data_emissao").value = '';
    }
}