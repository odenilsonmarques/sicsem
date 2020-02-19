


$(document).ready(function () {

    jQuery.validator.addMethod("isString", function (value, element) {
        var regExp = /[0-9]/;
        if (regExp.test(value))
            return false;

        return true;
    },
            "Por Favor! Insira Somente Letras");

    //Na linha abaixo, quando o form for submetido ele faz o validate 
    $('#frmnotificacao').validate({
        //na linha abaixo sao criada as regras de validacao
        rules: {
            empresa: {
                required: true
            },
            processo: {
                required: true
            },
            numero_notificacao: {
                required: true,
                maxlength: 3
            },
            ano_notificacao: {
                required: true
            },
            data_notificacao: {
                required: true
            },
            data_comparecimento: {
                required: true
            },
            profissao_atividade: {
                required: true,
                minlength: 10,
                isString: true
            },
            descricao_prazo: {
                required: true,
                minlength: 30
            },
            status_informacoes_adicionais: {
                required: true
            },
            numero_notificacao_ano_anterior: {
                maxlength: 4

            },
            numero_notificacao_anterior: {
                maxlength: 3
            },
            numero_processo_notificacao_anterior: {
                maxlength: 3
            },
            ano_processo_notificacao_anterior: {
                maxlength: 4
            },
            numero_licenca_notificacao_anterior: {
                maxlength: 3
            },
            ano_licenca_notificacao_anterior: {
                maxlength: 4
            },
            orgao_emissor_licenca: {
                minlength: 4,
                isString: true
            },
            nome_notificado: {
                minlength: 12,
                isString: true
            },
            logradouro: {
                minlength: 5
            },
            bairro: {
                minlength: 5
            },
            testemunha: {
                minlength: 8,
                isString: true
            },
            status_notificado: {
                required: true
            },
            fiscal: {
                required: true
            },
            chefe: {
                required: true
            }
        },
        //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
        messages: {
            empresa: {
                required: "Campo Obrigatório*"
            },
            processo: {
                required: "Campo Obrigatório*"
            },
            numero_notificacao: {
                required: "Campo Obrigatório*",
                maxlength: "Erro! Informe no Máximo 3 Digitos!"
            },
            ano_notificacao: {
                required: "Campo Obrigatório*"
            },
            data_notificacao: {
                required: "Campo Obrigatório*"
            },
            data_comparecimento: {
                required: "Campo Obrigatório*"
            },
            profissao_atividade: {
                required: "Campo Obrigatório*",
                minlength: "Profisssão e / ou Atividade Realizada Inválida, Por Favor Informe Mais Detalhes!"

            },
            descricao_prazo: {
                required: "Campo Obrigatório*",
                minlength: "Descrição e / ou Prazo Inválidos, Por Favor Informe Mais Detalhes!"
            },
            status_informacoes_adicionais: {
                required: "Campo Obrigatório*"
            },
            numero_notificacao_ano_anterior: {
                maxlength: "Erro! Por Favor Insira no Máximo 4 numeros"

            },
            numero_notificacao_anterior: {
                maxlength: "Erro! Por Favor Insira somente 3 numeros"
            },
            numero_processo_notificacao_anterior: {
                maxlength: "Erro! Por Favor Insira somente 3 numeros"
            },
            ano_processo_notificacao_anterior: {
                maxlength: "Erro! Por Favor Insira somente 4 numeros"
            },
            numero_licenca_notificacao_anterior: {
                maxlength: "Erro! Por Favor Insira somente 3 numeros"
            },
            ano_licenca_notificacao_anterior: {
                maxlength: "Erro! Por Favor Insira somente 4 numeros"
            },
            orgao_emissor_licenca: {
                minlength: "Erro! Por Favor, Mais Detalhes"
            },
            nome_notificado: {
                minlength: "Erro! Por Favor Informe Mais Detalhes"
            },
            logradouro: {
                minlength: "Erro! Por Favor Informe Mais Detalhes"
            },
            bairro: {
                minlength: "Erro! Por Favor Informe Mais Detalhes"
            },
            testemunha: {
                minlength: "Erro! Por Favor Informe Mais Detalhes"
            },
            status_notificado: {
                required: "Campo Obrigatório*"
            },
            fiscal: {
                required: "Campo Obrigatório*"
            },
            chefe: {
                required: "Campo Obrigatório*"
            }
        }
    });
});
