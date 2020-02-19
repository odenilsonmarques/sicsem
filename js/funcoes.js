/*
 * 1ª selecionar o elemento empresa que está representado pelo id no select empresa
 * logo depois atribuir o elemento empresa ao evento change sendo este um evento que acontece 
 * quando for selecionado um item do select, logo quando ele selecionar o item o mesmo vai disparar uma funcao
 * e essa funcoavai desparar um codigo ajax.
 * 
 * A funcao sucess é exibida quando hover sucesso na execucao da busca do processo e armazena no paramentro result o resultado
 * 
 */

$(function (){

$("#empresa").change(function (){
    
    var id = $(this).val(); /*armazena o id do empresa(notificado) selecionado */
    
    $.ajax({
        type:"POST",
        url: "exibe_processo.php?id="+id,
        dataType:"text",
        success:function(result){
            $("#processo").append(result);
            
        }
    });
});


$("#empresa").change(function (){
    
    var id = $(this).val(); /*armazena o id do empresa(notificado) selecionado */
    
    $.ajax({
        type:"POST",
        url: "exibe_empreendimento.php?id="+id,
        dataType:"text",
        success:function(result){
            $("#empreendimento").append(result);
            
        }
    });
});
});


