//validacão via javascript
function autuadoInfrator() {
    
//    if (document.frmautuadoinfrator.Nome_AutuadoInfrator.value === "") {
//        alert("Preencha o Campo Nome / Autuado Infrator");
//        document.frmautuadoinfrator.Nome_AutuadoInfrator.focus();
//        return  false;//garante que o campo nao pode ser nulo
//    }

    if (document.frmautuadoinfrator.Nome_AutuadoInfrator.value.length < 5) {
        alert("Campo Nome / Autuado Inválido! Nome Muito Pequeno");
        document.frmautuadoinfrator.Nome_AutuadoInfrator.focus();
        return  false;//garante que o campo nao pode ser nulo
    }
    
    //pedido para informar se a pessoa é fisica ou jurudica
    if (document.frmautuadoinfrator.Pessoa_FisicaJuridica.value === "") {
        alert("Informe se a Pessoa é Física / Jurídica ");
        document.frmautuadoinfrator.Pessoa_FisicaJuridica.focus();
        return  false;
    }
    
    if (document.frmautuadoinfrator.Pessoa_FisicaJuridica.Fisica.value === "Cpf" && document.frmautuadoinfrator.Cpf.value ==="") {
        alert("Informe se a Pessoa é Cpf ");
        document.frmautuadoinfrator.Pessoa_FisicaJuridica.focus();
        return  false;
    }
    
//    if(document.frmautuadoinfrator.Fisica.value === "" ){
//        alert("Informe o Numero do cpf");
//        document.frmautuadoinfrator.Fisica.focus();
//        document.frmautuadoinfrator.Cpf.focus();
//        return  false;
//    }
//    
//    if (document.frmautuadoinfrator.Profissao_Atividade.value === "") {
//        alert("Informe a Profissão ou a Atividade");
//        document.frmautuadoinfrator.Profissao_Atividade.focus();
//        return  false;
//    }
//      
//    if (document.frmautuadoinfrator.Profissao_Atividade.value.length < 10) {
//        alert("O Campo Profissão / Atividade Inválido! Nome Muito Pequeno ");
//        document.frmautuadoinfrator.Profissao_Atividade.focus();
//        return  false;
//    }
//    
//    if (document.frmautuadoinfrator.Endereco.value === "") {
//        alert("Preencha o Campo Endereço");
//        document.frmautuadoinfrator.Endereco.focus();
//        return  false;
//    }
//    
//    
//    if (document.frmautuadoinfrator.Endereco.value.length < 4) {
//        alert("Campo Endereço Inválido! Nome Muito Pequeno");
//        document.frmautuadoinfrator.Endereco.focus();
//        return  false;
//    }
//   
//    if (document.frmautuadoinfrator.Cidade.value === "") {
//        alert("Preencha o Campo Cidade");
//        document.frmautuadoinfrator.Cidade.focus();
//        return  false;
//    }
//    if (document.frmautuadoinfrator.Cidade.value.length < 5) {
//        alert("Campo Cidade Inválido!Nome Muito Pequeno");
//        document.frmautuadoinfrator.Cidade.focus();
//        return  false;
//    }
//    if (document.frmautuadoinfrator.Uf.value === "") {
//        alert("Infome o Estado");
//        document.frmautuadoinfrator.Uf.focus();
//        return  false;
//    }
}