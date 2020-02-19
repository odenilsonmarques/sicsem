function processo() {
    if (document.frmprocesso.Orgao.value === "") {
        alert('Informe o Orgao Emissor');
        document.frmprocesso.Orgao.focus();
        return false;
    }

    if (document.frmprocesso.Numero_Processo.value === "") {
        alert('Informe o Numero do Processo');
        document.frmprocesso.Numero_Processo.focus();
        return false;
    }

    if (document.frmprocesso.Data_Processo.value === "") {
        alert('Informe a Data de Abertura do Processo');
        document.frmprocesso.Data_Proceeso.focus();
        return false;
    }
    if (document.frmprocesso.tb_autuadoinfrator.value === "") {
        alert('Selecione o Nome / Atuado Infrator');
        document.frmprocesso.tb_autuadoinfrator.focus();
        return false;
    }
    if (document.frmprocesso.Assunto.value === "") {
        alert('Informe o Assunto');
        document.frmprocesso.Assunto.focus();
        return false;
    }

}


function comparaDataAnoProcesso()
{
    var ano = document.getElementById("ano").value;
    var data_processo = document.getElementById("data_processo").value;
    var data = data_processo.substr(0, 4); // pega só o ano
    if (ano !== data) {
        alert("ERRO! O ANO DA DATA INFORMADA, ESTÁ DIFERENTE DO ANO INFORMADO");
        ano = document.getElementById("ano").value = '';
        data_processo = document.getElementById("data_processo").value = '';
    }
}



$(document).ready(function () {
    jQuery.validator.addMethod("isString", function (value, element) {
        var regExp = /[0-9]/;
        if (regExp.test(value))
            return false;
        return true;
    },
            "Por Favor! Insira Somente Letras");
    //Na linha abaixo, quando o form for submetido ele faz o validate 
    $('#frmprocesso').validate({
        //na linha abaixo sao criada as regras de validacao
        rules: {
            numero_processo: {
                required: true,
                maxlength: 3
            },
            ano: {
                required: true
            },
            data_processo: {
                required: true
            },
            empresa: {
                required: true
            },
            empreendimento: {
                required: true
            },
            assunto: {
                required: true
            }
        },
        //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
        messages: {
            numero_processo: {
                required: "Campo Obrigatório*",
                maxlength: "Erro! Informe no Máximo 3 Digitos!"
            },
            ano: {
                required: "Campo Obrigatório*"
            },
            data_processo: {
                required: "Campo Obrigatório*"
            },
            empresa: {
                required: "Campo Obrigatório*",
                minlength: "Nome Inválido!"
            },
            empreendimento: {
                required: "Campo Obrigatório, Caso Não Apareça, Selecione a Empresa Novamente *"
            },
            assunto: {
                required: "Campo Obrigatório*"
            }
        }
    });
});

function somenteNumeros(num) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
        campo.value = "";
    }
}
