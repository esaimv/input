var vistas;

$(document).ready(function($){
  $("#intugo").click(function(){
    visitas = 11;
    Consultar_Visita(visitas);
  })

  $("#tiempo").click(function(){
    visitas = 12;
    Consultar_Visita(visitas);
  })

  $("#nearsoft").click(function(){
    visitas = 13;
    Consultar_Visita(visitas);
  })

  $("#crol").click(function(){
    visitas = 14;
    Consultar_Visita(visitas);
  })

  $("#descargar").click(function(){
    var reporte = new jsPDF();
    reporte.addHTML($("#tabla")[0], 15, 15,{
      'background' : '#fff',}, function(){
        reporte.save('ReporteVisitas.pdf');
      })
  })
})

function Consultar_Visita(visitas){
  $("#tablebody").empty();
  $("#myModal").modal('show');

  var dato = {
    'idvisita' : visitas
  }

  $.ajax({
    type    : 'POST',
    url     : 'visitas.php',
    data    : dato,
    dataType: 'json',
    encode  : true
  })

  .done(function(tabla){

    $.each(tabla, function(i, tabla){
      $("#nombrevisita").text(tabla.nombrevisita);
      var row =
      '<tr>'
      + '<td>' + tabla.nocarnet + '</td>'
      + '<td>' + tabla.nombre + '</td>'
      + '<td>' + tabla.apellido_pat + '</td>'
      + '<td>' + tabla.apellido_mat + '</td>'
      + '</tr>'

      $(row).appendTo("#tabla tbody");
    })
  })
}
