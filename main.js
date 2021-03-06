$(document).ready(function() {
var ID, opcion;
opcion = 4;
    
tablaUsuarios = $('#tablaUsuarios').DataTable({  
    "ajax":{            
        "url": "bd/crud.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "TITULO"},
        {"data": "IMAGEN"},
        {"data": "DESCRIPCION"},
        {"data": "AUTOR"},
        {"data": "FECHA"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});     

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formPublicacion').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    TITULO = $.trim($('#TITULO').val());    
    IMAGEN = $.trim($('#IMAGEN').val());
    DESCRIPCION = $.trim($('#DESCRIPCION').val());    
    AUTOR = $.trim($('#AUTOR').val());    
    FECHA = $.trim($('#FECHA').val());                         
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {ID:ID, TITULO:TITULO, IMAGEN:IMAGEN, DESCRIPCION:DESCRIPCION, AUTOR:AUTOR, FECHA:FECHA  ,opcion:opcion},    
          success: function(data) {
            tablaUsuarios.ajax.reload(null, false);
           }
        });			        
    $('#modalCRUD').modal('hide');											     			
});
        
 

//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = 1; //alta           
    ID=null;
    $("#formPublicacion").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("AGREGAR PUBLICACIÓN");
    $('#modalCRUD').modal('show');	    
});

//Editar        
$(document).on("click", ".btnEditar", function(){		        
    opcion = 2;//editar
    fila = $(this).closest("tr");	        
    ID = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    TITULO = fila.find('td:eq(1)').text();
    IMAGEN = fila.find('td:eq(2)').text();
    DESCRIPCION = fila.find('td:eq(3)').text();
    AUTOR = fila.find('td:eq(4)').text();
    FECHA = fila.find('td:eq(5)').text();
    $("#TITULO").val(TITULO);
    $("#IMAGEN").val(IMAGEN);
    $("#DESCRIPCION").val(DESCRIPCION);
    $("#AUTOR").val(AUTOR);
    $("#FECHA").val(FECHA);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("EDITAR PUBLICACIÓN");		
    $('#modalCRUD').modal('show');		   
});

//Borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);           
    ID = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
    opcion = 3; //eliminar        
    var respuesta = confirm("¿Está seguro de borrar el registro "+ID+"?");                
    if (respuesta) {            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {opcion:opcion, ID:ID},    
          success: function() {
              tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
           }
        });	
    }
 });
     
});    