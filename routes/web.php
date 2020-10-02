<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
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
Route::get('/verify', function () {
    return view('home');
});
Auth::routes(['verify' => true]);
Route::get('/', function () {
    return view('Acceuil');
});
Route::get('/home','HomeController@index')->name('home');
// Route::get('profile', function () {
//     // Only verified users may enter...
// })->middleware('verified');
//clients registration
Route::get('/clients/registration','ClientController@create')->name('registration.client');
Route::post('/client','ClientController@register')->name('client.register');
//pharmaciens registration
Route::get('/pharmaciens/registration','PharmaciensController@create')->name('registration.pharmacien');
Route::post('/pharmaciens','PharmaciensController@register')->name('pharmaciens.register');
//users connexion
Route::get('/users/login','UsersController@login')->name('login');
Route::post('/users/auth','UsersController@auth')->name('user.auth');

// users logoutroute
Route::get('/users/logout',[
    'uses'=>'UsersController@logout',
    'as'=>'users.logout'
]);
//livreurs
Route::get('livreurs','UsersController@livreurs')->name('livreurs.liste');
Route::get('pharmaciens','UsersController@pharmaciens')->name('pharmaciens.liste');
Route::delete('pharmaciens/{id}', 'PharmaciensController@destroypharmacien');
Route::get('clients','ClientController@clients')->name('clients.liste');
Route::delete('clients/{id}', 'ClientController@destroyclient');
Route::get('admin/livreurs','LivreurController@livreurs')->name('admin.livreurs');
Route::delete('admin/livreurs/{id}', 'LivreurController@destroylivreur');


//commande
Route::group(['middleware' => 'auth'], function () {
Route::get('commandes/{id}/create','CommandesController@create')->name('commande.creer');
Route::get('commandes','CommandesController@index')->name('commande.liste');
Route::get('commandes/client','UsersController@client')->name('commandes.client');
Route::get('commandes/livreur','CommandesController@livreur')->name('commandes.livreur');
Route::get('commandes/livreur/reçue','CommandesController@livreur2')->name('commandes.livreur');

Route::post('commandes','CommandesController@store')->name('passer.commande');
Route::get('commandes/{id}/edit', 'CommandesController@edit');
Route::delete('commandes/{id}', 'CommandesController@destroy');
Route::delete('pharmaciens/commandes/{id}', 'CommandesController@delete');
Route::put('commandes/{id}/update', 'CommandesController@update')->name('commande.update');
Route::get('commandes/{id}/details', 'CommandesController@details')->name('commande.details');
Route::get('commandes/{id}/accepter', 'CommandesController@accepter')->name('commande.accepter');
Route::get('commandes/{id}/refuser', 'CommandesController@refuser')->name('commande.accepter');
Route::get('commandes/{id}/traiter', 'CommandesController@traiter')->name('commande.traiter');
Route::get('commandes/{id}/exedier', 'CommandesController@expedier')->name('commande.expedier');
Route::get('commandes/{id}/recevoir', 'CommandesController@recevoir')->name('commande.reçus');

//client
//pharmacies

Route::get('pharmacies/create','PharmaciesController@create')->name('pharmacie.ajouter');
Route::get('pharmacies/client','PharmaciesController@index')->name('pharmacies.liste');
Route::get('pharmacies/pharmacien','PharmaciesController@index2')->name('votre.pharmacie');
Route::get('pharmacies/admin','PharmaciesController@index1')->name('admin.pharmacie');
Route::post('pharmacies/chercher', 'PharmaciesController@search')->name('pharmacies.search');

Route::post('pharmacies','PharmaciesController@store')->name('pharmacies.store');
Route::get('pharmacies/{id}/edit', 'PharmaciesController@edit');
Route::delete('pharmacies/{id}', 'PharmaciesController@destroy');
Route::put('pharmacies/{id}', 'PharmaciesController@update');
Route::get('pharmacies/{id}/accepter', 'PharmaciesController@accepter')->name('pharmacie.accepter');
Route::get('pharmacies/{id}/refuser', 'PharmaciesController@refuser')->name('pharmacie.accepter');

//pharmacien creer livreur
Route::get('livreurs/{id}/create','LivreurController@create_livreur')->name('liveurs.creer');
Route::post('livreurs','LivreurController@add_livreur')->name('livreur.add');
Route::get('livreurs','LivreurController@index')->name('livreurs.liste');
Route::delete('livreurs/{id}', 'LivreurController@destroy');

//medicaments
Route::get('medicaments/create','MedicamentsController@create')->name('medicament.creer');
Route::get('medicaments','MedicamentsController@index')->name('medicaments.liste');

Route::post('medicaments/{id}/store','MedicamentsController@store')->name('medicaments.store');
Route::get('medicaments/{id}/edit', 'MedicamentsController@edit');
Route::delete('medicaments/{id}', 'MedicamentsController@destroy');
Route::put('medicaments/{id}', 'MedicamentsController@update');
//Route::post('medicaments/chercher', 'MedicamentsController@search')->name('medicaments.search');
Route::get('medicaments/{id}/ajouter', 'MedicamentsController@ajouter')->name('medicaments.ajouter');

//factures
Route::get('factures/{id}/create','FacturesController@create')->name('facture.creer');
Route::get('factures','FacturesController@index')->name('factures.liste');
Route::get('/client/factures/liste','FacturesController@indexclient')->name('client.factures-liste');
Route::get('factures/{id}/details','FacturesController@facture')->name('factures.client');
Route::get('factures/{id}/imprimer','FacturesController@imprimer')->name('factures.print');
Route::post('factures','FacturesController@store')->name('passer.facture');
Route::get('factures/{id}/edit', 'FacturesController@edit');
Route::delete('factures/{id}', 'FacturesController@destroy');
Route::put('factures/{id}', 'FacturesController@update');
Route::get('/livreurs/factures/liste','FacturesController@indexlivreur')->name('livreur.factures-liste');
Route::get('factures/{id}/livrer','FacturesController@livraison')->name('factures.livrer');

Route::get('factures/{id}/paiement', 'FacturesController@paiement');
Route::post('factures/{id}/payer', 'CardsController@pay')->name('paiement.payer');

});




























// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// Route::group(['middleware' => 'auth'], function () {
// 		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
// 		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
// 		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
// 		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
// 		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
// 		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
// 		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
// });

// Route::group(['middleware' => 'auth'], function () {
// 	Route::resource('user', 'UserController', ['except' => ['show']]);
// 	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
// 	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
// 	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
// });

