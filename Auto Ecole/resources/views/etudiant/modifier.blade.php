
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css');?>">
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/css/checkbox.css');?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/33.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo asset('assets4/Login/js/test.css') ?>">
</head>
<body id="page-top">
  <div id="wrapper">
       @include('template.SideBar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        @include('template.Header')
        <div class="container-fluid">
          <h1>Informations personnelles</h1>
            <form action="{{ url('/modifieretudiant') }}" method="POST">
              {{ csrf_field() }}  
              
              <input type="hidden" name="idetudiant" value="{{ $valeur->idetudiant }}">

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom:</label>
                <input type="text" name="nom" value="{{ $valeur->nom }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Prenom:</label>
                <input type="text" name="prenom" value="{{ $valeur->prenom }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
          
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Telephone:</label>
                <input type="text" name="numtel" value="{{ $valeur->numtel }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
          
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Adresse:</label>
                <input type="text" name="adresse" value="{{ $valeur->adresse }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
             
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>         
        
        <h1>Informations sur le parcours:</h1>
        <form action="{{ url('/modifierparcours') }}" method="POST">
          {{ csrf_field() }}  
          <input type="hidden" name="idparcour" value="{{ $valeur->idparcour }}">
         
          <input type="hidden" name="idetudiant" value="{{ $valeur->idetudiant }}">
         
          <div class="mb-3">
            <label class="form-label" style="color: rgb(0,0,0);width: 100%;text-align: left;">Permis :<select class="form-select" name="idpermi">
                <option value="{{ $valeur->idpermi }}">{{ $valeur->typepermi }}</option>                       
      @foreach($listePermis as $rows)
                <option value="{{ $rows->idpermi }}">{{ $rows->typepermi }}  {{ $rows->montant }}Ar</option>
      @endforeach
                   </select></label>
          </div>
          

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre de tranche:</label>
            <input type="text" name="nbtranche" value="{{ $valeur->nbtranche }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre de cours de code:</label>
            <input type="number" name="nbcode" value="{{ $valeur->nbcode }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre de cours de conduite:</label>
            <input type="number" name="nbconduite" value="{{ $valeur->nbconduite }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form> 
      </div>        
              <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
                </div>
              </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
    <script src="<?php echo asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo asset('assets4/Acc_Admin/js/bs-init.js');?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="<?php echo asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js');?>"></script>
    <script src="<?php echo asset('assets4/Acc_Admin/js/theme.js');?>"></script>
</body>
</html>


</html>




