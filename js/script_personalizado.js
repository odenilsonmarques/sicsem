$(function (){
    //pesquisar o curso sem refresh na pagina
    $("#pesquisa").keyup(function(){
        
        var pesquisa = $(this).val();
        
        var dados = {
            palavra = pesquisa
        };
        $.post('listar_empreendimento_teste.php',dados,function(retorna){
            
            $(".resultado").html(retorna);
            
        });
    });
});
