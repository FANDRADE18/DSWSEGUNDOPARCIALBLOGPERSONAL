<?php 
include 'bd/config.php';
include 'bd/conexionhome.php';
include 'templates/cabecera.php';

?>

<style >
 .image-center { 
    height:325px;
    width:45%;
    display:block;
     margin:auto; 
 
 }

 .text-color { 
    background-color: #3498DB; 
    color:white;
 
 }
 .text-center { 
    text-align: center;
 
 }
 .text-right { 
    text-align: right;

 
 }
 .text-justify { 
    text-align: justify;

 
 }
 .text-left { 
    text-align: left;
    font-weight:bold;

 
 }
 
</style>
<br><br>
    <div class="row">

     <?php 
          $sentencia=$pdo->prepare("SELECT * FROM CardBlog ORDER BY FECHA DESC");
          $sentencia->execute();
          $data=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    
    ?>

    <?php foreach($data as $publicacion){ ?>

         <div class="col-12">
            <div class="card">

            <div class="card-body text-color">
                <h1 class="text-center"><?php echo $publicacion['TITULO'] ?></h1>
                <h3 class="text-right">FECHA: <?php echo $publicacion['FECHA'] ?></h3>

                </div>
                <br>

                <img class="image-center" title="<?php echo $publicacion['TITULO']; ?>" 
                alt="<?php echo $publicacion['TITULO']; ?>"  
                src="<?php echo $publicacion['IMAGEN']; ?>"
                
                >
                <div class="card-body">

                    <h4 class="card-title text-justify" style="color:#3498DB;"><?php echo $publicacion['DESCRIPCION']; ?></h4>
                    <br>
                    <h5 class="card-title text-left " style="color:#21618C;">AUTOR: <?php echo $publicacion['AUTOR']; ?></h5>


                    
                </div>
              
            </div>
            
        </div>

    <?php } ?>



       
        
    </div>
    </div>
    
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php
include "templates/pie.php"
?>