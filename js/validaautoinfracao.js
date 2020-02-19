function autoinfracao(){
    
    if(document.frmautoinfracao.tb_autuadoinfrator.value === ""){
        alert("Por favor! Informe o Autuado / Infrator");
        document.frmautoinfracao.tb_autuadoinfrator.focus();
        return false;
    }
    if(document.frmautoinfracao.nome_fiscal.value === ""){
        alert("Por favor! Informe o nome do fiscal");
        document.frmautoinfracao.nome_fiscal.focus();
        return false;
    }
    if(document.frmautoinfracao.matricula.value === ""){
        alert("Por favor! Informe a Matricula");
        document.frmautoinfracao.matricula.focus();
        return false;
    }
    if(document.frmautoinfracao.Data_AutoInfracao.value === ""){
        alert("Por favor! Informe a Data o Auto");
        document.frmautoinfracao.Data_AutoInfracao.focus();
        return false;
    }
    if(document.frmautoinfracao.Numero_AutoInfracao.value === ""){
        alert("Por favor! Informe o Numero ");
        document.frmautoinfracao.Numero_AutoInfracao.focus();
        return false;
    }

    if(document.frmautoinfracao.Licenca.value === ""){
        alert("Por favor! A Licença ");
        document.frmautoinfracao.Licenca.focus();
        return false;
    }

    if(document.frmautoinfracao.Valor_Multa.value === ""){
        alert("Por favor! O Valor da Multa");
        document.frmautoinfracao.Valor_Multa.focus();
        return false;
    }

    if(document.frmautoinfracao.Descricao_AutoInfracao.value === ""){
        alert("Por favor! A Descricão do Auto");
        document.frmautoinfracao.Descricao_AutoInfracao.focus();
        return false;
    }
    
}

