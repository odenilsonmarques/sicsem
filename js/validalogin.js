function validaLogin(){
    
     if(document.frmlogin.Email.value === "" && document.frmlogin.Senha.value === ""){
        alert("Por Favor Preencha o Formulario!");
        document.frmlogin.Email.focus();
        document.frmlogin.Senha.focus();
        return false;
    }
    
    if(document.frmlogin.Email.value === ""){
        alert("Preencha o Campo Email!");
        document.frmlogin.Email.focus();
        return false;
    }
    
    if( document.frmlogin.Email.value.indexOf('@')===-1){
         alert("E-mail Inválido!");
        document.frmlogin.Email.focus();
        return false;
    }
    
     else if(document.frmlogin.Email.value.indexOf('.')===-1){
         alert("Email Inválido!");
        document.frmlogin.Email.focus();
        return false;
    }
    
    if(document.frmlogin.Senha.value === ""){
        alert("Preencha o Campo Senha!");
        document.frmlogin.Senha.focus();
        return false;
        
    }
    
   
}



