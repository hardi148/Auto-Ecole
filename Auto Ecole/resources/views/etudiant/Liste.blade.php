<?php
use App\FormatNumber;
use App\FormatDate;
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
            <form action="{{ url('/rechercheetudiant') }}" method="post">
              {{ csrf_field() }}  
              
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom :</label>
                <input type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Prenom :</label>
                <input type="text" name="prenom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Adresse:</label>
                <input type="text" name="adresse" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Type Permi:</label>
                <input type="text" name="typepermi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Etat:</label>
                <select name="etat">
                   <option value="">Etat Ecolage</option> 
                   <option value="1">Non Paye</option> 
                   <option value="0">Paye</option>     
                </select>    
              </div>

                <input type="submit" value="rechercher">
            </form>   
            <br>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('suppression'))
        <div class="alert alert-success">
            {{ session('suppression') }}
        </div>
    @endif
    @if(session('modification'))
    <div class="alert alert-info">
        {{ session('modification') }}
    </div>
@endif
        <br>
        <a class="btn btn-primary" href="{{ url('/formetudiant') }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Inscription Etudiant</a>
        <br>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nom & Prenom</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Permis</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Date inscription</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Montant Paye</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Reste</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Etat</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nombre Tranche</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nombre Tranche Restant</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($liste as $rows)
                    <tr>
                      <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $rows->nom }} {{ $rows->prenom }}</h6></td>
                      <td class="border-bottom-0">
                        {{ $rows->typepermi }}
                      </td>
                      <td class="border-bottom-0">
                        {{ FormatDate::format($rows->dateinscription) }}
                      </td>
                      <td class="border-bottom-0">
                        {{ FormatNumber::formatter($rows->total_montant) }} Ar
                      </td>
                      <td class="border-bottom-0">
                        {{ FormatNumber::formatter($rows->reste) }} Ar
                      </td>
                      @if($rows->total_montant==0 && $rows->reste==0)
                      <td class="border-bottom-0">
                         Non Paye
                      </td>
                      @elseif($rows->total_montant!=0 && $rows->reste!=0)
                     <td class="border-bottom-0">
                        Non Paye
                     </td>
                     @elseif($rows->total_montant==0 && $rows->reste!=0)
                     <td class="border-bottom-0">
                      Non Paye
                     </td>
                     @elseif($rows->total_montant!=0 && $rows->reste==0)
                     <td class="border-bottom-0">
                       Paye
                     </td>
                     @endif
                     <td class="border-bottom-0">
                      {{ $rows->nbtranche }}
                     </td>    
                     <td class="border-bottom-0">
                      {{ $rows->tranche_restante }}
                     </td>                     
                     @if($rows->total_montant==0 && $rows->reste==0)
                 
                      <td class="border-bottom-0">
                        <a class="btn btn-primary" href="{{ url('/payerEcolage') }}/{{ $rows->idetudiant }}/{{ $rows->idpermi }}/{{ $rows->montant }}/{{ $rows->nbtranche }}/{{ $rows->tranche_restante }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Payer Ecolage</a>
                      </td>
                    
                     @elseif($rows->total_montant!=0 && $rows->reste!=0)
                     <td class="border-bottom-0">
                      <a class="btn btn-primary" href="{{ url('/payerEcolage') }}/{{ $rows->idetudiant }}/{{ $rows->idpermi }}/{{ $rows->reste }}/{{ $rows->nbtranche }}/{{ $rows->tranche_restante }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Payer Ecolage</a>
                    </td>
                    @elseif($rows->total_montant==0 && $rows->reste!=0)
                    <td class="border-bottom-0">
                      <a class="btn btn-primary" href="{{ url('/payerEcolage') }}/{{ $rows->idetudiant }}/{{ $rows->idpermi }}/{{ $rows->reste }}/{{ $rows->nbtranche }}/{{ $rows->tranche_restante }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Payer Ecolage</a>
                    </td>
                    @elseif($rows->total_montant!=0 && $rows->reste==0)
                    <td class="border-bottom-0">
                    </td>
                    @endif
                    
                    <td class="border-bottom-0">
                      <a class="btn btn-primary" href="{{ url('/detailetudiant') }}/{{ $rows->idetudiant }}/{{ $rows->idpermi }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Plus de Details</a>
                    </td>
                      <td class="border-bottom-0">
                        <a class="btn btn-primary" href="{{ url('/versmodifieretudiant') }}/{{ $rows->idetudiant }}/{{ $rows->idpermi }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Modifier</a>
                      </td>
                    </tr>          
                    @endforeach           
                  </tbody>
                </table>
              </div>
              
  <nav aria-label="Page navigation example">
    <ul class="pagination">
  <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
  <a class="page-link" href="{{ $currentPage == 1 ? '#' : url('/paginationetudiant') }}/{{ $currentPage - 1 }}" aria-label="Précédent">
  <span aria-hidden="true">&laquo;</span>
  <span class="sr-only">Précédent</span>
  </a>
  </li>
  @foreach($listeNumeroPage as $rows)
  <li class="page-item {{ $rows == $currentPage ? 'active' : '' }}">
  <a class="page-link" href="{{ url('/paginationetudiant') }}/{{ $rows }}">{{ $rows }}</a>
  </li>
  @endforeach
  <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
  <a class="page-link" href="{{ $currentPage == $lastPage ? '#' : url('/paginationetudiant') }}/{{ $currentPage + 1 }}" aria-label="Suivant">
  <span aria-hidden="true">&raquo;</span>
  <span class="sr-only">Suivant</span>
  </a>
  </li>
  </ul>
  </nav>
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




