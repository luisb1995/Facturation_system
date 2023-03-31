<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use App\Product;
use App\Content;

//############################################# RUTAS WEB ##########################################################################################

//#############################################
//Vista de home
//#############################################
Route::get('/', function () {
    return view('auth.login');
})->name('baterias-home');

Auth::routes();

//#############################################
//Inicio del dashboard
//#############################################
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth')->name('dashboard');

//#############################################
//Modulo de productos
//#############################################
Route::get('dashboard/products', function () {
    if(Auth::user()->can('Interfaz productos')){
        return view('dashboard.inventario');
    }
    else{
        return redirect()->route('dashboard');
    }

})->middleware('auth','cors')->name('dashboard-products');

Route::get('dashboard/comprobante/','reportController@index')->name('comprobante-invoice');

//#############################################
//Modulo de caja
//#############################################
Route::get('dashboard/billing', function () {
    if(Auth::user()->can('Interfaz caja')){
        return view('dashboard.invoice');
    }
    else{
        return redirect()->route('dashboard');
    }

})->middleware('auth','cors')->name('dashboard-billing');

//#############################################
//Modulo de clientes
//#############################################
Route::get('dashboard/clients', function () {
    if(Auth::user()->can('Interfaz clientes')){
        return view('dashboard.clientes');
    }
    else{
        return redirect()->route('dashboard');
    }

})->middleware('auth','cors')->name('dashboard-clientes');


//#############################################
//Modulo de usuarios
//#############################################
Route::get('dashboard/usuarios', function () {
    if(Auth::user()->can('Interfaz usuarios')){
        return view('dashboard.user');
    }
    else{
        return redirect()->route('dashboard');
    }

})->middleware('auth')->name('dashboard-usuarios');



//#############################################
//Modulo de permisos
//#############################################
Route::get('dashboard/permisologia', function () {
    if(Auth::user()->can('Interfaz permisologia')){
        return view('dashboard.permission');
    }
    else{
        return redirect()->route('dashboard');
    }
})->middleware('auth','cors')->name('dashboard-permission');

//#############################################
//Modulo de administracion
//#############################################
Route::get('dashboard/administration', function (){
    if(Auth::user()->can('Interfaz administracion')){
        return view('dashboard.administracion');
    }
    else{
        return redirect()->route('dashboard');
    }
})->middleware(['auth','cors'])->name('dashboard-administration');


//#############################################
//Modulo de reportes
//#############################################
Route::get('dashboard/reports', function (){
    return view('dashboard.reportes');
})->middleware(['auth','cors'])->name('dashboard-reports');

//#############################################
//cambiar idioma
//#############################################
Route::get('/lang/{lang}', 'LanguageController@swap')->name('lang.swap');




