<?php



use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//admin 
Route::get('/',\App\Http\Controllers\AdminController::class . '@index');
Route::post('/log_admin',\App\Http\Controllers\AdminController::class . '@log_admin');
Route::get('/log_out',\App\Http\Controllers\AdminController::class . '@log_out');




Route::get('/ListePaiement',\App\Http\Controllers\EtudiantController::class . '@ListePaiement');
Route::get('/ListeExamen',\App\Http\Controllers\EtudiantController::class . '@ListeExamen');



// etudiant

Route::get('/formetudiant',\App\Http\Controllers\EtudiantController::class . '@form');
Route::get('/listeEtudiant',\App\Http\Controllers\EtudiantController::class . '@listeEtudiant');
Route::get('/paginationetudiant/{numero}',\App\Http\Controllers\EtudiantController::class . '@pagination');
Route::get('/versmodifieretudiant/{id}/{idpermi}',\App\Http\Controllers\EtudiantController::class . '@versmodifier');
Route::post('/modifieretudiant',\App\Http\Controllers\EtudiantController::class . '@modifier');
Route::post('/ajouteretudiant',\App\Http\Controllers\EtudiantController::class . '@ajouter');
Route::get('/supprimeretudiant/{id}',\App\Http\Controllers\EtudiantController::class . '@supprimer');
Route::post('/rechercheetudiant',\App\Http\Controllers\EtudiantController::class . '@recherche');
Route::post('/modifierparcours',\App\Http\Controllers\ParcoursController::class . '@modifier');

// permis etudiant 

Route::post('/ajouterpermis',\App\Http\Controllers\EtudiantController::class . '@ajouterpermis');
Route::get('/annuler',\App\Http\Controllers\EtudiantController::class . '@annuler');
Route::post('/paiementEcolage',\App\Http\Controllers\EtudiantController::class . '@paiementEcolage');

//paiement ecolage 
Route::get('/payerEcolage/{idetudiant}/{idpermi}/{reste}/{nbtranche}/{tranche_restante}',\App\Http\Controllers\EtudiantController::class . '@payerEcolage');
Route::get('/ListePaiement',\App\Http\Controllers\PaiementController::class . '@listePaiement');
Route::get('/paginationpaiementecolage/{numero}',\App\Http\Controllers\PaiementController::class . '@pagination');
Route::post('/recherchepaiementecolage',\App\Http\Controllers\PaiementController::class . '@recherche');


//examen  code
Route::get('/listeExamenCode',\App\Http\Controllers\ExamenCodeController::class . '@listeExamen');
Route::get('/paginationexamencode/{numero}',\App\Http\Controllers\ExamenCodeController::class . '@pagination');
Route::post('/rechercheexamencode',\App\Http\Controllers\ExamenCodeController::class . '@recherche');
Route::get('/passerexamencode/{idetudiant}/{idpermi}',\App\Http\Controllers\ExamenCodeController::class . '@passerexamen');
Route::post('/ajouterexamencode',\App\Http\Controllers\ExamenCodeController::class . '@ajouter');
Route::get('/annulercode/{idexamen}',\App\Http\Controllers\ExamenCodeController::class . '@annuler');
Route::get('/emettrecode/{idexamen}',\App\Http\Controllers\ExamenCodeController::class . '@emettre');
Route::post('/resultatcode',\App\Http\Controllers\ExamenCodeController::class . '@resultat');

//examen  conduite 
Route::get('/listeExamenConduite',\App\Http\Controllers\ExamenConduiteController::class . '@listeExamen');
Route::get('/paginationexamenconduite/{numero}',\App\Http\Controllers\ExamenConduiteController::class . '@pagination');
Route::post('/rechercheexamenconduite',\App\Http\Controllers\ExamenConduiteController::class . '@recherche');
Route::get('/passerexamenconduite/{idetudiant}/{idpermi}',\App\Http\Controllers\ExamenConduiteController::class . '@passerexamen');
Route::post('/ajouterexamenconduite',\App\Http\Controllers\ExamenConduiteController::class . '@ajouter');
Route::get('/annulerconduite/{idexamen}',\App\Http\Controllers\ExamenConduiteController::class . '@annuler');
Route::get('/emettreconduite/{idexamen}',\App\Http\Controllers\ExamenConduiteController::class . '@emettre');
Route::post('/resultatconduite',\App\Http\Controllers\ExamenConduiteController::class . '@resultat');


//detail etudiant 
Route::get('/detailetudiant/{idetudiant}/{idpermi}',\App\Http\Controllers\ParcoursController::class . '@index');
Route::get('/terminercode/{idetudiant}/{idpermi}',\App\Http\Controllers\ParcoursController::class . '@terminercode');
Route::get('/terminerconduite/{idetudiant}/{idpermi}',\App\Http\Controllers\ParcoursController::class . '@terminerconduite');




