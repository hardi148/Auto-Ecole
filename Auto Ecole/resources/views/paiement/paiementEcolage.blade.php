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
          @if($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <h1>Paiement Ecolage
@if(isset($reste))
Reste {{ FormatNumber::formatter($reste) }} Ar
Tranche restante {{ $tranche_restante }}
@endif
      </h1>
          <form action="{{ url('/paiementEcolage') }}" method="POST">
              {{ csrf_field() }}
              @if(isset($reste))
              <input type="hidden" name="reste" value="{{ $reste }}"> 
              <input type="hidden" name="nbtranche" value="{{ $nbtranche }}">                
              @endif
                <input type="hidden" name="idetudiant" value="{{ $idetudiant }}">    
                
                @if(isset($reste))
                <input type="hidden" name="idpermi" value="{{ $idpermi }}">    
                @else
                <div class="mb-3">
                  <label class="form-label" style="color: rgb(0,0,0);width: 100%;text-align: left;">Permis :<select class="form-select" name="idpermi">
                      <option value="">choisir permis</option>                       
            @foreach($listePermis as $rows)
                      <option value="{{ $rows->idpermi }}">{{ $rows->typepermi }}  {{ $rows->montant }}Ar</option>
            @endforeach
                         </select></label>
                </div>
                <input type="hidden" name="tranche" value="{{ $tranche }}">
                @endif
              
                   
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Montant:</label>
                    <input type="number" name="montant" value="{{ old('montant') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Date Paiement:</label>
                    <input type="date" name="datepaiement" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
  
                <button type="submit" class="btn btn-primary">Payer</button>
            </form>         
            <a class="btn btn-primary" href="{{ url('/annuler') }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Annuler</a>
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




