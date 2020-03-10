<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'TokensController@login');
Route::post('registro', 'TokensController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'TokensController@details');
    Route::get('logout', 'TokensController@logout');

    Route::get('roles', 'RolesController@obtenerTodos')->name('obtenerTodosRoles');
    Route::get('usuarios/cliente', 'UsuariosController@obtenerClientes')->name('obtenerClientes');
    Route::get('usuarios/vendedor', 'UsuariosController@obtenerVendedores')->name('obtenerVendedores');
    Route::get('usuarios/administrador', 'UsuariosController@obtenerAdministradores')->name('obtenerAdministradores');
    
    Route::post('roles', 'RolesController@crearRol')->name('crearRol');
    Route::get('roles/{id}', 'RolesController@obtenerRol')->name('obtenerRol');
    Route::post('roles/{id}', 'RolesController@editarRol')->name('editarRol');
    Route::get('roles/eliminar/{id}', 'RolesController@eliminarRol')->name('eliminarRol');

    Route::post('usuarios', 'UsuariosController@crearUsuario')->name('crearUsuario');
    Route::get('usuarios/{id}', 'UsuariosController@obtenerUsuario')->name('obtenerUsuario');
    Route::post('usuarios/{id}', 'UsuariosController@editarUsuario')->name('editarUsuario');
    Route::get('usuarios/eliminar/{id}', 'UsuariosController@eliminarUsuario')->name('eliminarUsuario');
});