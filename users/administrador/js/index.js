$(document).ready(function(){
  $.ajax({
    type: 'POST',
    url: 'php/cargar_lista_estado.php'
  })
  .done(function(lista_edo){
    $('#lista_estado').html(lista_edo)
  })
  .fail(function(){
    alert('Hubo un errror al cargar las lista_estados')
  })
    
  $('#lista_estado').on('change', function(){
    var id = $('#lista_estado').val()
    $.ajax({
      type: 'POST',
      url: 'php/cargar_lista_municipio.php',
      data: {'IDEstado': id}
    })
    .done(function(lista_edo){
      $('#municipios').html(lista_edo)
    })
    .fail(function(){
      alert('Hubo un errror al cargar los municipios')
    })
  })
    
  $('#lista_estado').on('change', function(){
    var id = $('#lista_estado').val()
    $.ajax({
      type: 'POST',
      url: 'php/cargar_lista_it.php',
      data: {'IDEstado': id}
    })
    .done(function(lista_edo){
      $('#it').html(lista_edo)
    })
    .fail(function(){
      alert('Hubo un errror al cargar los IT')
    })
  })    
    

 
})