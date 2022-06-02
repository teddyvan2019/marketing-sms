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


// Auth::routes();

// Route::resource('acteurs', 'ActeurControleController');
// Route::get('/home', 'HomeController@index')->name('home');

Route::auth();
Route::resource('/', 'DashboardController'); //accueil
Route::get('/dashboard', 'DashboardController@index');


Route::get('logout', 'Auth\LoginController@logout'); 

Route::resource('users', 'UserController');
Route::get('editPassword/{user}', 'UserController@editPassword');
Route::put('savePassword/{user}', 'UserController@updatePWD');

Route::resource('religions', 'ReligionController')->except('create');
Route::resource('villes', 'VilleController');
Route::resource('genres', 'GenreController');

// repertoire
Route::resource('repertoires', 'RepertoireController')->except('create');
Route::get('activerRepertoire/{repertoire}', 'RepertoireController@activer');
Route::get('desactiverRepertoire/{repertoire}', 'RepertoireController@desactiver');

// campagne
Route::resource('campagne', 'CampagneController');
Route::get('activerCampagne/{campagne}', 'CampagneController@activer');
Route::get('desactiverCampagne/{campagne}', 'CampagneController@desactiver');

// message 

Route::get('listeMessage/{campagne}', 'MessageCampagnesController@messageByIdCampagne');

// COntact
Route::resource('contacts', 'ContactController')->except('index','create');
Route::get('activerContact/{contact}', 'ContactController@activer');
Route::get('desactiverContact/{contact}', 'ContactController@desactiver');
Route::get('listeContact/{repertoire}', 'ContactController@contactByIdRepertoire');
Route::post('file', 'ContactController@storebyFile');

Route::post('import', 'ContactController@cvs_import');
Route::get('csv_file/export', 'CsvFileContact@csv_export')->name('export');

Route::resource('dashboard', 'DashboardController')->only('index');
Route::post('/dashboardCampagneRecherche ', 'DashboardController@getCampagnesOfUser');

Route::resource('profil', 'ProfilController')->only('index', 'update'); 
Route::get('editPasswordProfil/{user}', 'ProfilController@editPassword');
Route::put('savePasswordProfil/{user}', 'ProfilController@updatePWD');
 
// sms except edit
Route::resource('messagesinstantane', 'SmsInstantaneController');

// anniversaire
Route::resource('anniversaire', 'AnniversaireController');

// message - campagne
Route::resource('messages', 'MessageCampagnesController');


Route::get('messagecreer/{campagne}', 'MessageCampagnesController@create');
// Route::post('messageStore/{campagne}', 'MessageCampagnesController@store');
Route::get('messageEdit/{id}/{campagne}', 'MessageCampagnesController@edit');
Route::put('messageUpdate/{id}/{campagne}', 'MessageCampagnesController@update');
Route::delete('messageDelete/{id}/{campagne}', 'MessageCampagnesController@destroy');
Route::get('detailMessage/{id}/{campagne}', 'MessageCampagnesController@show');

//relance
Route::resource('relance', 'RelanceController');
Route::get('activerCampagne/{campagne}', 'CampagneController@activer');
Route::get('desactiverCampagne/{campagne}', 'CampagneController@desactiver');
Route::get('activerCampagne/{campagne}', 'CampagneController@activer');

//envoie de message automatisé 
//Route::resource('autoEnvoiSmsCampagne', 'AutoMessageController');
Route::get('autoEnvoiSmsCampagne', 'AutoMessageController@EnvoyerMessage');
Route::get('UserDetailSmsCampagne/{message}', 'AutoMessageController@getinfos');