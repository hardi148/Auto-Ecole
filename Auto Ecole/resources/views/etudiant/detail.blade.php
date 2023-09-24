
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
      <div class="col-lg-4 col-sm-6 mb-4">
       
    
            <h1 style="font-size:18px;">{{ $detail->nom }} {{ $detail->prenom }}</h1>
            <h1 style="font-size:18px;">Adresse : {{ $detail->adresse }}</h1>
            <h1 style="font-size:18px;">Tel : {{ $detail->numtel }}</h1>
            <h2 style="font-size:18px;">{{ $detail->typepermi }}</h2>
            <h3 style="font-size:18px;">Vous avez {{  $detail->nbcode }} cours de code et {{  $detail->nbconduite }} cours de conduite</h3>


            @if($detail->codetermine == 1)
            <h3 style="font-size:18px;">Vous avez termine tous les cours de code</h3>
            <a class="btn btn-primary" href="{{ url('/passerexamencode') }}/{{ $detail->idetudiant }}/{{ $detail->idpermi }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Passer un examen Code</a>
            @else
            <a class="btn btn-primary" href="{{ url('/terminercode') }}/{{ $detail->idetudiant }}/{{ $detail->idpermi }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Terminer tous les cours de code</a>
            @endif

            @if($detail->conduitetermine == 1)
            <h3 style="font-size:18px;">Vous avez termine tous les cours de conduite</h3>
            @if($resultat_code == 2)
            <a class="btn btn-primary" href="{{ url('/passerexamenconduite') }}/{{ $detail->idetudiant }}/{{ $detail->idpermi }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Passer un examen Conduite</a>
            @endif
            @else
            <a class="btn btn-primary" href="{{ url('/terminerconduite') }}/{{ $detail->idetudiant }}/{{ $detail->idpermi }}" style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Terminer tous les cours de conduite</a>
            @endif
             
    </div>
    
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




