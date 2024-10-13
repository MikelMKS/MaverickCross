<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedmineSession;
use App\Http\Middleware\GMUSession;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlertasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\AdministrativosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\ReportesController;

route::get('/',[LoginController::class, 'login'])->name('loginRaiz');
route::get('login',[LoginController::class,'login'])->name('login');
route::post('valida',[LoginController::class,'valida'])->name('valida');
route::get('closesesion',[LoginController::class,'closesesion'])->name('closesesion');

Route::middleware([RedmineSession::class])->group(function () {

    //  ALERTAS
    route::get('revisarAlertas',[AlertasController::class,'revisarAlertas'])->name('revisarAlertas');
    route::get('verNotificacion',[AlertasController::class,'verNotificacion'])->name('verNotificacion');
    route::get('enteradoCumpleaños',[AlertasController::class,'enteradoCumpleaños'])->name('enteradoCumpleaños');
    route::get('enteradoFinMes',[AlertasController::class,'enteradoFinMes'])->name('enteradoFinMes');
    route::get('enteradoFinSemana',[AlertasController::class,'enteradoFinSemana'])->name('enteradoFinSemana');

    route::get('index',[InicioController::class,'index'])->name('index');
    route::get('tabla',[InicioController::class,'tabla'])->name('tabla');

    route::get('editarPerfil',[LoginController::class,'editarPerfil'])->name('editarPerfil');
    route::post('updatePerfil',[LoginController::class,'updatePerfil'])->name('updatePerfil');

    Route::middleware([GMUSession::class])->group(function () {
        // ADMINISTRATIVOS
        route::get('administrativos',[AdministrativosController::class,'index'])->name('administrativos');
        route::get('agregarAdministrativo',[AdministrativosController::class,'agregarAdministrativo'])->name('agregarAdministrativo');
        route::post('guardarAdministrativo',[AdministrativosController::class,'guardarAdministrativo'])->name('guardarAdministrativo');
        route::get('editarAdministrativo',[AdministrativosController::class,'editarAdministrativo'])->name('editarAdministrativo');
        route::post('updateAdministrativo',[AdministrativosController::class,'updateAdministrativo'])->name('updateAdministrativo');
        route::post('accionesAdministrativo',[AdministrativosController::class,'accionesAdministrativo'])->name('accionesAdministrativo');
    });

    // CLIENTES
    route::get('clientes',[ClientesController::class,'index'])->name('clientes');
    route::get('agregarClienteMain',[ClientesController::class,'agregarClienteMain'])->name('agregarClienteMain');
    route::post('guardarCliente',[ClientesController::class,'guardarCliente'])->name('guardarCliente');
    route::get('agregarInvitadoMain',[ClientesController::class,'agregarInvitadoMain'])->name('agregarInvitadoMain');
    route::post('guardarInvitado',[ClientesController::class,'guardarInvitado'])->name('guardarInvitado');

    route::get('verCliente',[ClientesController::class,'verCliente'])->name('verCliente');
    route::post('updateCliente',[ClientesController::class,'updateCliente'])->name('updateCliente');


    // SERICIOS
    route::get('servicios',[ServiciosController::class,'index'])->name('servicios');
    route::get('serviciosTabla',[ServiciosController::class,'serviciosTabla'])->name('serviciosTabla');
    route::get('deudaCliente',[ServiciosController::class,'deudaCliente'])->name('deudaCliente');
    route::get('invitadosActivos',[ServiciosController::class,'invitadosActivos'])->name('invitadosActivos');
    route::get('buscaMembresiasActivas',[ServiciosController::class,'buscaMembresiasActivas'])->name('buscaMembresiasActivas');
    route::post('guardarServicio',[ServiciosController::class,'guardarServicio'])->name('guardarServicio');
    route::get('agregarServicioMain',[ServiciosController::class,'agregarServicioMain'])->name('agregarServicioMain');
    route::get('cambiarFecIni',[ServiciosController::class,'cambiarFecIni'])->name('cambiarFecIni');
    route::post('guardarEdicionMembresia',[ServiciosController::class,'guardarEdicionMembresia'])->name('guardarEdicionMembresia');


    // REPORTES
    route::get('reportes',[ReportesController::class,'index'])->name('reportes');
    route::get('reportePendientes',[ReportesController::class,'reportePendientes'])->name('reportePendientes');

    route::get('reporteCorte',[ReportesController::class,'reporteCorte'])->name('reporteCorte');
    route::get('reporteCorteTabla',[ReportesController::class,'reporteCorteTabla'])->name('reporteCorteTabla');
    route::get('drillSeccion',[ReportesController::class,'drillSeccion'])->name('drillSeccion');
    route::get('drillTotalGeneral',[ReportesController::class,'drillTotalGeneral'])->name('drillTotalGeneral');

    route::get('reporteMembresias',[ReportesController::class,'reporteMembresias'])->name('reporteMembresias');
    route::get('reporteMembresiasTabla',[ReportesController::class,'reporteMembresiasTabla'])->name('reporteMembresiasTabla');
});
