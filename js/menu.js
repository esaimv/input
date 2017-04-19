
function openNav() {
  if($(window).width() <= 970){
    document.getElementById("mySidenav").style.width = "350px";
    document.getElementById("main").style.marginLeft = "0";
  }else{
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

$('.dropdown-button').dropdown({
    inDuration     : 300,
    outDuration    : 225,
    constrain_width: false, // Does not change width of dropdown to that of the activator
    hover          : true, // Activate on hover
    gutter         : 0, // Spacing from edge
    belowOrigin    : false, // Displays dropdown below the button
    alignment      : 'left' // Displays dropdown with edge aligned to the left of button
});

function User(event){
  var datos = {
    'nada':'nada'
  }

  $.ajax({
    type     : 'POST',
    url      : 'menu.php',
    data     :  datos,
    dataType : 'json',
    encode   : true
  })

  .done(function(usuario){
    $('#usuario').text(usuario.nombre);
    if(usuario.nombre=="Invalido"){
      document.location = "index.html";
    }
  })
}

$(document).ready(function($){
  User();

  $("#inicio").click(function(){
    location.reload();
  })

  $("#ingresar").click(function(){
    $("#main").load("ingresar.html");
  })
  $("#salir").click(function(){
    document.location("cerrarsesion.php");
  })

  $("#consultar").click(function(){
    $("#main").load("consultar.html");
  })

  $("#talleres").click(function(){
    $("#main").load("talleres.html");
  })

  $("#visitas").click(function(){
    $("#main").load("Visitas.html");
  })

  $("#constancia").click(function(){
    $("#main").load("constancia.html");
  })

  var Width=$(window).width();
  if( Width <=  970 ) {
    closeNav();
  }else{
    openNav();
  }
  $(window).resize(function() {
    Width = $(window).width();
    if( Width <=  970 ) {
      closeNav();
    }else{
      openNav();
    }
  });
});
