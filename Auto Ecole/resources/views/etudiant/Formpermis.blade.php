<?php
use App\FormatNumber;
?>
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
          @if(isset($test))
          <div class="alert alert-danger">
              <ul>  
                      <li>Vous ne pouvez pas choisir ce permis car vous n avez pas encore le permis A ou B</li>
              </ul>
          </div>
      @endif
          <form action="{{ url('/ajouterpermis') }}" method="POST">
              {{ csrf_field() }}
                <input type="hidden" name="idetudiant" value="{{ $idetudiant }}">     
                
                <div class="mb-3">
                  <label class="form-label">Permis:</label>
                  @foreach ($liste as $rows)
                      <div class="form-check">
                          <input type="checkbox" name="idpermi[]" value="{{ $rows->idpermi }}" class="form-check-input adresseCheckbox" data-permi-id="{{ $rows->idpermi }}">
                          <label class="form-check-label" for="adresseCheckbox{{ $rows->idpermi }}">{{ $rows->typepermi }}</label>
                          <div class="additional-fields" style="display: none;">
                              <div class="mb-3">
                                  <label class="form-label">Nombre de tranche pour le paiement ecolage:</label>
                                  <input type="number" name="nbtranche_{{ $rows->idpermi }}" value="{{ old('nbtranche') }}" class="form-control">
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Nombre de cours de code:</label>
                                  <input type="number" name="nbcode_{{ $rows->idpermi }}" value="{{ old('nbcode') }}" class="form-control">
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Nombre de cours de conduite:</label>
                                  <input type="number" name="nbconduite_{{ $rows->idpermi }}" value="{{ old('nbconduite') }}" class="form-control">
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
              
              <script>
                  // Récupérer tous les éléments checkbox
                  const checkboxes = document.querySelectorAll('.adresseCheckbox');
              
                  checkboxes.forEach(checkbox => {
                      checkbox.addEventListener('change', function () {
                          // Récupérer les champs additionnels correspondants à ce checkbox
                          const additionalFields = this.parentElement.querySelector('.additional-fields');
              
                          if (this.checked) {
                              // Si le checkbox est coché, afficher les champs additionnels
                              additionalFields.style.display = 'block';
                          } else {
                              // Sinon, masquer les champs additionnels
                              additionalFields.style.display = 'none';
                          }
                      });
                  });
              </script>
              
                
                  
                 
  
                <button type="submit" class="btn btn-primary">Enregistrer</button>
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




