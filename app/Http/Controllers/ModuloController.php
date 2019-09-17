<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulos;
use DB;
class ModuloController extends Controller
{
    public function index()
    {
        $modulos = Modulos::All();

        $modulos=DB::table('MODULOS  AS MD')  
        ->select('MD.ID_MOD','MD.NOMBRE_MOD','MD.ICONO_MOD','MD.URL_MOD','MD.ESTADO_MOD','MD.PADRE_ITEM',
        \DB::raw("(SELECT NOMBRE_MOD FROM MODULOS where MD.PADRE_ITEM = ID_MOD) AS PADRE_NOMBRE"))      
        ->orderBy('MD.NOMBRE_MOD','DESC')
        ->get();

        return $modulos;
    }
    public function store(Request $request)
    {
        $success = false;
        $data = null;
        $message = '';
        try {
            $modulo = Modulos::create($request->all());
            $data = $modulo;
            $success = true;
            $message = 'Módulo creado correctamente.';

        } catch (\Exception $e) {
            $success = false;
            $message = 'Módulo NO creada.';
            $errorCode = $e->getCode();
           switch($errorCode)
           {
                case 23000:
                $message.= ' Registro duplicado o vacio';
                break;
                case 22001:
                $message.= ' Datos demasiado largos para la columna';
                break;
           }
        }
       $datos = array(
           'success' => $success,
           'data' => $data,
           'message' => $message
       );
        return response()->json($datos,200);
    }
    public function destroy(Modulos $modulo)
    {
        $success = false;
        $data = null;
        $message = '';
        try {
            $modulo_ = Modulos::findOrFail($modulo->ID_MOD);
            if($modulo_->ESTADO_MOD > 0)
            $modulo_->ESTADO_MOD = 0;
            else $modulo_->ESTADO_MOD = 1;
            $modulo_->update();
            $data = $modulo_;
            $success = true;
            $message = $modulo_->ESTADO_MOD==0?'Módulo '.$modulo_->NOMBRE_MOD.' desactivado correctamente.':'Módulo '.$modulo->NOMBRE_MOD.' activado correctamente.';

        } catch (\Exception $e) {
            $success = false;
            $message = $modulo_->ESTADO_MOD==0?'Módulo '.$modulo_->NOMBRE_MOD.' NO activado.':'Módulo '.$modulo->NOMBRE_MOD.' NO desactivado.';
        }
       $datos = array(
           'success' => $success,
           'data' => $data,
           'message' => $message
       );
        return response()->json($datos,200);
    }
    public function update(Request $request)
    {
        $success = false;
        $data = null;
        $message = '';
        try {
            $modulo = Modulos::findOrFail($request->ID_MOD);
            $modulo->NOMBRE_MOD = $request->NOMBRE_MOD;
            $modulo->ICONO_MOD = $request->ICONO_MOD;
            $modulo->URL_MOD = $request->URL_MOD;
            $modulo->PADRE_ITEM = $request->PADRE_ITEM;
            $modulo->update();
            $data = $modulo;
            $success = true;
            $message = 'Módulo actualizado correctamente.';

        } catch (\Exception $e) {
            $success = false;
            $message = 'Módulo NO actualizado.';
        }
       $datos = array(
           'success' => $success,
           'data' => $data,
           'message' => $message
       );
        return response()->json($datos,200);
    }
}
