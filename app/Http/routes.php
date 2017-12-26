<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', array('as' => 'login', function() {
   return view('login.login');
}));

Route::POST('loginvalidacion',[
'as' =>'loginvalidacion',
'uses'=> 'ControllerLogin@store'
]);

Route::get('salir',[
'as' =>'salir',
'uses'=> 'ControllerLogin@salir'
]);

//Perfiles
Route::get('entrenadorPerfil',[
   'as' =>'entrenadorPerfil',
   'uses'=>'ControllerLogin@entrenadorPerfil'
]);

Route::get('clientePerfil',[
   'as' =>'clientePerfil',
   'uses'=>'ControllerLogin@clientePerfil'
]);
///


//Modulo Root
Route::get('rootPerfil',[
   'as' =>'rootPerfil',
   'uses'=>'ControllerLogin@rootPerfil'
]);

Route::get('search',[
'as' => 'search',
'uses' => 'ControllerRoot@search'
]);

Route::get('getSelectedUser', [
   'as' => 'getSelectedUser',
   'uses' => 'ControllerRoot@getSelectedUser'
]);

Route::POST('changeUsers',[
'as' => 'changeUsers',
'uses' => 'ControllerRoot@changeUsers'
]);

Route::get('rootUsuarios', array('as' => 'rootUsuarios', function() {
   return view('root.root_users');
}));

Route::get('rootUsuarios/registrarAdmin',  array('as' => 'rootUsuarios/registrarAdmin', function(){
   return view('crud.create_user_root');
}));

Route::get('liveSearchRootModule',[
'as' =>'liveSearchRootModule', 
'uses' => 'ControllerRoot@liveSearch'
]);

Route::get('getSelectedUserRootModule',[
'as' => 'getSelectedUserRootModule',
'uses' => 'ControllerRoot@getSelectedUser'
]);

Route::post('changeUsersDataRootModule',[
'as' => 'changeUsersDataRootModule',
'uses' => 'ControllerRoot@changeUsers'
]);

Route::post('deleteSelectedUserRootModule',[
'as' => 'deleteSelectedUserRootModule',
'uses' => 'ControllerRoot@deleteUser'
]);

Route::post('createUserRootModule',[
'as' => 'createUserRootModule',
'uses' => 'ControllerRoot@createUser'
]);

Route::post('typeUserRootModule',[
'as' => 'typeUserRootModule',
'uses' => 'ControllerRoot@typeUser'
]);

Route::post('changeRootData', [
'as' => 'changeRootData',
'uses' => 'ControllerRoot@changeProfileData'
]);
//

//Modulo Administrador
Route::get('adminPerfil', [
'as' => 'adminPerfil',
'uses' => 'ControllerAdmin@adminProfile'
]);

Route::get('adminUsuarios', [
'as' => 'adminUsuarios',
'uses' => 'ControllerAdmin@adminUsers'
]);

Route::get('adminUsuarios/registrarUsuario', [
'as' => 'adminUsuarios/registrarUsuario',
'uses' => 'ControllerAdmin@UsersRegistration'
]);

Route::post('changeAdminData', [
'as' => 'changeAdminData',
'uses' => 'ControllerAdmin@changeProfileData'
]);

Route::get('liveSearchAdminModule',[
'as' =>'liveSearchAdminModule', 
'uses' => 'ControllerAdmin@liveSearch'
]);

Route::get('getSelectedUserAdminModule',[
'as' => 'getSelectedUserAdminModule',
'uses' => 'ControllerAdmin@getSelectedUser'
]);

Route::post('changeUsersDataAdminModule',[
'as' => 'changeUsersDataAdminModule',
'uses' => 'ControllerAdmin@chageUsersData'
]);

Route::post('deleteUserAdminModule',[
'as' => 'deleteUserAdminModule',
'uses' => 'ControllerAdmin@deleteUser'
]);

Route::post('createUserAdminModule',[
'as' => 'createUserAdminModule',
'uses' => 'ControllerAdmin@createUser'
]);

Route::post('makePaymentAdminModule',[
'as' => 'makePaymentAdminModule',
'uses' => 'ControllerAdmin@makePayment'
]);

Route::get('activeUser',[
'as' => 'activeUser',
'uses' => 'ControllerAdmin@isActive'
]);
//

Route::get('inicio', array('as' => 'inicio', function() {
   return view('login.dashboard_selection');
}));

// Modulo rutinas
Route::get('entrenadorUsuarios', [
   'as' => 'entrenadorUsuarios',
   function() {
      return view('trainer.trainer_users');
   }
]);

Route::group(['as' => 'routine::', 'prefix' => 'rutina'], function() {
   Route::get('search', [
      'as' =>'search', 
      'uses' => 'ControllerRutina@liveSearch'
   ]);
   Route::get('select', [
      'as' => 'select',
      'uses' => 'ControllerRutina@getSelectedUser'
   ]);
   Route::get('tiposenfermedades', [
      'as' => 'getTipoEnfermedad',
      'uses' => 'ControllerRutina@getTiposEnfermedades'
   ]);
   Route::get('enfermedades/{tipo_enfermedad}', [
      'as' => 'getEnfermedad',
      'uses' => 'ControllerRutina@getEnfermedades'
   ]);
   Route::get('gruposmusculares', [
      'as' => 'getGrupoMuscular',
      'uses' => 'ControllerRutina@getGruposMusculares'
   ]);
   Route::get('ejercicios/{grupo_muscular}', [
      'as' => 'getEjercicio',
      'uses' => 'ControllerRutina@getEjercicios'
   ]);
   Route::get('tiposlesiones', [
      'as' => 'getTipoLesion',
      'uses' => 'ControllerRutina@getTipoLesiones'
   ]);
   Route::get('lesiones/{tipo_lesion}', [
      'as' => 'getLesion',
      'uses' => 'ControllerRutina@getLesiones'
   ]);
   Route::get('{id}/asignarRutina/1',  [
      'as' => 'asignarRutina1',
      'uses' => 'ControllerRutina@indexStep1'
   ]);
   Route::post('{id}/asignarRutina/1',  [
      'as' => 'asignarRutina1',
      'uses' => 'ControllerRutina@storeMedicalForm'
   ]);
   Route::get('{id}/asignarRutina/2',  [
      'as' => 'asignarRutina2',
      'uses' => 'ControllerRutina@indexStep2'
   ]);
   Route::post('{id}/asignarRutina/2',  [
      'as' => 'asignarRutina2',
      'uses' => 'ControllerRutina@storeSomatometricForm'
   ]);
   Route::get('{id}/asignarRutina/3',  [
      'as' => 'asignarRutina3',
      'uses' => 'ControllerRutina@indexStep3'
   ]);
   Route::post('{id}/asignarRutina/3',  [
      'as' => 'asignarRutina3',
      'uses' => 'ControllerRutina@storeRoutine'
   ]);
   Route::get('{id}/show', [
      'as' => 'show',
      'uses' => 'ControllerRutina@showRoutine'
   ]);
   Route::get('{id}/edit', [
      'as' => 'edit',
      'uses' => 'ControllerRutina@editRoutine'
   ]);
   Route::get('{id}/delete', [
      'as' => 'delete',
      'uses' => 'ControllerRutina@deleteRoutine'
   ]);
});


// Route::post('dashboard_selection','ControllerLogin@nextvew');


// Modulo progreso

Route::group(['as' => 'progress::', 'prefix' => 'progress'], function() {
   Route::get('show/{id}', [
      'as' => 'progreso_entrenador',
      'uses' => 'ControllerProgreso@showTrainer'
   ]);
   Route::get('show_client/{id}', [
      'as' => 'progreso_cliente',
      'uses' => 'ControllerProgreso@showClient'
   ]);
   Route::get('noProgress/{id}', [
      'as' => 'noRecords',
      'uses' => 'ControllerProgreso@noRecords'
   ]);
   Route::get('nuevoRegistro/{id}', [
      'as' => 'newRecord',
      'uses' => 'ControllerProgreso@newRecord'
   ]);
   Route::post('store/{id}', [
      'as' => 'store',
      'uses' => 'ControllerProgreso@store'
   ]);
      
   // Test routes
   // Route::get('test1', [
   //    'as' => 'test1_trainer_record_progress',
   //    function(){
   //       return view('trainer.trainer_record_progress');
   //    }
   // ]);
   
});

//Ruta para probar flexbox
Route::get('testview', function () {
    return view('layout.dashboard_test');
});
