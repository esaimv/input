var mes = {
  1 : "ENERO",
  2 : "FEBRERO",
  3 : "MARZO",
  4 : "ABRIL",
  5 : "MAYO",
  6 : "JUNIO",
  7 : "JULIO",
  8 : "AGOSTO",
  9 : "SEPTIEMBRE",
  10 : "OCTUBRE",
  11 : "NOVIEMBRE",
  12 : "DICIEMBRE"
};

$(document).ready(function($){
  var fecha = new Date();
  var cadena_fecha = fecha.getDate() + " DE " + mes[fecha.getMonth()+1] + " DEL " + fecha.getFullYear();
  $("#fecha").text(cadena_fecha);

  $("#buscar").click(Asistente);

  $("#imprimir").click(function(){
    var constancia = new jsPDF();
    constancia.addHTML($("#report_const")[0], 15, 15, {
      'background' : '#fff',}, function(){
        constancia.save("Constancia.pdf");
      })
  })
});

function Asistente(event){
  var dato = {
    'nocarnet' : $("#nocarnet").val()
  }

  $.ajax({
    type     : 'POST',
    url      : 'constancia.php',
    data     : dato,
    dataType : 'json',
    encode   : true
  })

  .done(function(datos){
    var nom_completo;

    nom_completo = datos.NOMBRE + " " + datos.APELLIDO_PAT + " " + datos.APELLIDO_MAT;

    $("#nom_completo").text(nom_completo);
  })
}
