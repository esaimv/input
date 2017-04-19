var taller;

$(document).ready(function($){
  $("#js").click(function(){
    taller = 31;
    Consultar_Taller(taller);
  })

  $("#photoshop").click(function(){
    taller = 32;
    Consultar_Taller(taller);
  })

  $("#lego").click(function(){
    taller = 33;
    Consultar_Taller(taller);
  })

  $("#scrum").click(function(){
    taller = 34;
    Consultar_Taller(taller);
  })

  $("#unity").click(function(){
    taller = 35;
    Consultar_Taller(taller);
  })

  $("#android").click(function(){
    taller = 36;
    Consultar_Taller(taller);
  })

  $("#java").click(function(){
    taller = 37;
    Consultar_Taller(taller);
  })

  $("#imp").click(function(){
    taller = 38;
    Consultar_Taller(taller);
  })

  $("#git").click(function(){
    taller = 39;
    Consultar_Taller(taller);
  })

  $("#descargar").click(function(){
    var reporte = new jsPDF();
    reporte.addHTML($("#tabla")[0], 15, 15,{
      'background' : '#fff',}, function(){
        reporte.save('ReporteTalleres.pdf');
      })
  })
})

function Consultar_Taller(taller){
  $("#tablebody").empty();
  $("#myModal").modal('show');

  var dato = {
    'idtaller' : taller
  }

  $.ajax({
    type    : 'POST',
    url     : 'talleres.php',
    data    : dato,
    dataType: 'json',
    encode  : true
  })

  .done(function(tabla){
    $.each(tabla, function(i, tabla){
      $("#nombretaller").text(tabla.nombretaller);
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
