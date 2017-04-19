var valorfijo;
var total;
var admin;

$(document).ready(function($){

  $("#buscar").click(Busqueda);

  $("#actualizar").click(Actualizar);

  $("#abono").keydown(ValidarPago);

  $("#eliminar").click(Eliminar);

  obtenerAdmin();

  $("#modificar").click(Modificar);

  $("#historial").click(Historial);

});

function QR(nocarnet, nombre, apellido_mat, apellido_pat){
  $("#qrcode").empty();
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    width : 100,
    height : 100
  })
  qrcode.makeCode(nocarnet);
}

function Historial(event){
  $("#tablebody").empty();
  $("#myModal").modal('show');
  var dato = {
    'nocarnet' : $("#nocarnet").val()
  }
  $.ajax({
    type     : 'POST',
    url      : 'historial.php',
    data     : dato,
    dataType : 'json',
    encode   : true
  })
  .done(function(tabla){
    $.each(tabla, function(i, tabla) {
        var row =
        '<tr>'
        + '<td>' + tabla.nocarnet + '</td>'
        + '<td>' + tabla.fecha + '</td>'
        + '<td>' + tabla.abono + '</td>'
        + '</tr>'
        $(row).appendTo("#tablajson tbody");
      })
  })
}

function transaccion(event){
  var fecha = new Date();
  var cadenafecha = fecha.getFullYear()+"/"+(fecha.getMonth()+1)+"/"+fecha.getDate();
  var cadenafecha = cadenafecha+" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();

  var datos ={
    'nocarnet' : $("#nocarnet").val(),
    'fecha': cadenafecha,
    'abono' : (parseFloat($("#abono").val())),
  };

  $.ajax({
    type     : 'POST',
    url      : 'transaccion.php',
    data     : datos,
    dataType : 'json',
    encode   : true
  })
  .done(function(datosRecibir){
    if(datosRecibir.exito == false){
      alert("Error!");
    }else{
      $("#abono").val("");
      Busqueda();
    }
  });
};

function Modificar(event){
  var datos = {
    'nocarnet' : $("#nocarnet").val(),
    'nombre' : $("#nombre").val(),
    'apellido_pat' : $("#apellido_pat").val(),
    'apellido_mat' : $("#apellido_mat").val(),
    'escuela' : $("#escuela").val(),
    'correo' : $("#correo").val(),
    'telefono' : $("#telefono").val(),
    'abono' : $("#abono").val(),
  }

  $.ajax({
    type     : 'POST',
    url      : 'modificar.php',
    data     : datos,
    dataType : 'json',
    encode   : true
  })

  .done(function(datosRecibir){
    if(datosRecibir.exito){
      alert("Registro Actualizado Exitosamente");
      Busqueda();
    }
  })
  event.preventDefault();
}

function obtenerAdmin(){
  $.getJSON("menu.php", function(usuario){
    if(usuario.admin == "true"){
      admin = true;
    }
  })
}

function Eliminar(event){
  var datos = {
    'nocarnet' : $("#nocarnet").val(),
  }

  $.ajax({
    type     : 'POST',
    url      : 'eliminar.php',
    data     : datos,
    dataType : 'json',
    encode   : true
  })

  .done(function(datosRecibir){
    if(datosRecibir.exito){
      alert("Registro Eliminado Exitosamente");
      $("#formBuscar")[0].reset();
      $("#talla").empty().append('');
      $("#carnet").empty().append('');
      $("#visita").empty().append('');
      $("#taller").empty().append('');
      $("#nocarnet").focus();
    }
  })
  event.preventDefault();
}

function ValidarPago(event){
  if(event.shiftKey){
    event.preventDefault();
  }

  if(event.keyCode == 46 || event.keyCode == 8){

  }else {
    if(event.keyCode < 95){
      if(event.keyCode < 48 || event.keyCode > 57){
        event.preventDefault();
      }
    }else {
      if(event.keyCode < 96 || event.keyCode > 105){
        event.preventDefault();
      }
    }
  }

  $("#abono").keyup(function(){
    var valor = $(this).val();
    $("#restante").val(valorfijo - valor);
  })
}

function Actualizar(event){
  var datos = {
    'nocarnet' : $("#nocarnet").val(),
    'abono' : (parseFloat($("#abono").val()) + (parseFloat(total))),
    'opcion' : "actualizar"
  }

  $.ajax({
    type     : 'POST',
    url      : 'consultar.php',
    data     : datos,
    dataType : 'json',
    encode   : true
  })

  .done(function(datosRecibir){
    if(datosRecibir.exito){
      alert("Registro Actualizado Exitosamente");
      $("#abono").val("");
      Busqueda();
    }else{
      alert(datosRecibir.errores.abono);
    }
  })
  transaccion();
  event.preventDefault();
}

function Busqueda(event){
  var datos = {
    'nocarnet' : $("#nocarnet").val(),
    'opcion' : "buscar"
  }

  $.ajax({
    type     : 'POST',
    url      : 'consultar.php',
    data     : datos,
    dataType : 'json',
    encode   : true
  })

  .done(function(datosRecibir){
    if(datosRecibir.exito){
      var restante = (datosRecibir.consulta.PRECIO) - (datosRecibir.consulta.PAGO);
      valorfijo = restante;
      total = datosRecibir.consulta.PAGO;
      $("#nombre").empty().append('');
      $("#apellido_pat").empty().append('');
      $("#apellido_mat").empty().append('');
      $("#escuela").empty().append('');
      $("#correo").empty().append('');
      $("#telefono").empty().append('');
      $("#talla").empty().append('');
      $("#carnet").empty().append('');
      $("#visita").empty().append('');
      $("#taller").empty().append('');
      $("#abonado").empty().append('');
      $("#precio").empty().append('');
      $("#restante").empty().append('');

      $("#nombre").val(datosRecibir.consulta.NOMBRE);
      $("#apellido_pat").val(datosRecibir.consulta.APELLIDO_PAT);
      $("#apellido_mat").val(datosRecibir.consulta.APELLIDO_MAT);
      $("#escuela").val(datosRecibir.consulta.ESCUELA);
      $("#correo").val(datosRecibir.consulta.CORREO);
      $("#telefono").val(datosRecibir.consulta.TELEFONO);
      $("#talla").append(new Option(datosRecibir.consulta.TALLA, true));
      $("#carnet").append(new Option(datosRecibir.consulta.TIPO, true));
      $("#taller").append(new Option(datosRecibir.consulta.NOMBRE_TALLER, true));
      $("#visita").append(new Option(datosRecibir.consulta.NOMBRE_VISITA, true));
      $("#abonado").val(datosRecibir.consulta.PAGO);
      $("#precio").val(datosRecibir.consulta.PRECIO);
      $("#restante").val(restante);

      $("#actualizar").attr("disabled", false);
      QR($("#nocarnet").val(), datosRecibir.consulta.NOMBRE, datosRecibir.consulta.APELLIDO_PAT, datosRecibir.consulta.APELLIDO_MAT);
      if(admin == true){
        $("#modificar").attr("disabled", false);
        $("#eliminar").attr("disabled", false);
        $("#nombre").attr("readonly", false);
        $("#apellido_pat").attr("readonly", false);
        $("#apellido_mat").attr("readonly", false);
        $("#escuela").attr("readonly", false);
        $("#correo").attr("readonly", false);
        $("#telefono").attr("readonly", false);
        $("#talla").attr("readonly", false);
        $("#carnet").attr("readonly", false);
        $("#taller").attr("readonly", false);
        $("#visita").attr("readonly", false);
      }
    }else{
      alert(datosRecibir.errores.nocarnet);
    }
  })
  $("#abono").focus();
  event.preventDefault();
};
