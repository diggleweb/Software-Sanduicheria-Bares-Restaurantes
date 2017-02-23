$(function() {
    $( "#accordion" ).accordion({
      collapsible: true,
      heightStyle: "content"
    });

  } 
);

function excluirConta(id) {
  if (confirm("Você realmente deseja se desfazer desta conta encerrada? Se você realizar esta operação, estes dados serão perdidos permanentemente.") == true) {
    $.get("/excluirContaEncerrada", {"id": id}, function(data) {
      alert(data);
      location.reload();
    });
  }
}




