$(document).ready(function($){
  $("#btn-ingresar").click(Ingresar);

  // $("#aceptar").click(Opciones);

});

// function Opciones(event){
//   var datos = {
//
//   }
// }

function Ingresar(event){
  var datos = {
    'nombre' : $("#nombre").val(),
    'apellido_pat' : $("#apellido_pat").val(),
    'apellido_mat' : $("#apellido_mat").val(),
    'escuela' : $("#escuela").val(),
    'correo' : $("#correo").val(),
    'telefono' : $("#telefono").val(),
    'talla' : $("#talla").val(),
    'carnets' : $("#carnets").val()
  }

  $.ajax({
    type     : 'POST',
    url      : 'ingresar.php',
    data     : datos,
    dataType : 'json',
    encode   : true
  })

  .done(function(datos){
    $("#modalbody").load("ingresar_opciones.html");
    $("#myModal").modal('show');
    LlenarLB($("#carnets").val());
  })
}

function LlenarLB(tipocarnet){
  if(tipocarnet == 51 || tipocarnet == 53 || tipocarnet == 54 || tipocarnet == 56 || tipocarnet == 57 || tipocarnet == 59){
    $.getJSON("opciones_visitas.php", function(datos){
      $.each(datos, function(i, datos){
        $("#visita").append(new Option(datos.nombrevisita));
      })
    })
  }

  if(tipocarnet == 52 || tipocarnet == 53 || tipocarnet == 55 || tipocarnet == 56 || tipocarnet == 58 || tipocarnet == 59){
    $.getJSON("opciones_talleres.php", function(datos){
      $.each(datos, function(i, datos){
        $("#taller").append(new Option(datos.nombretaller));
      })
    })
  }

  $.getJSON("menu.php", function(usuario){
    if(usuario.admin == "true"){
      admin = true;
    }
  })
}
