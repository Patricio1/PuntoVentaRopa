<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::All();
        return $categorias;
    }
    public function store(Request $request)
    {
        $success = false;
        $data = null;
        $message = '';
        try {
            $categoria = Categoria::create($request->all());
            $data = $categoria;
            $success = true;
            $message = 'Categoría creada correctamente.';

        } catch (\Exception $e) {
            $success = false;
            $message = 'Categoría NO creada.';
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
    public function destroy(Categoria $categoria)
    {
        $success = false;
        $data = null;
        $message = '';
        try {
            $categoria_ = Categoria::findOrFail($categoria->ID_CAT);
            if($categoria_->ESTADO_CAT > 0)
            $categoria_->ESTADO_CAT = 0;
            else $categoria_->ESTADO_CAT = 1;
            $categoria_->update();
            $data = $categoria_;
            $success = true;
            $message = $categoria_->ESTADO_CAT==0?'Categoría '.$categoria_->NOMBRE_CAT.' desactivada correctamente.':'Categoría '.$categoria_->nombre_cat.' activada correctamente.';

        } catch (\Exception $e) {
            $success = false;
            $message = $categoria_->ESTADO_CAT==0?'Categoría '.$categoria_->NOMBRE_CAT.' NO activada.':'Categoría '.$categoria_->nombre_cat.' NO desactivada.';
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
            $categoria = Categoria::findOrFail($request->ID_CAT);
            $categoria->NOMBRE_CAT = $request->NOMBRE_CAT;
            $categoria->update();
            $data = $categoria;
            $success = true;
            $message = 'Categoría actualizada correctamente.';

        } catch (\Exception $e) {
            $success = false;
            $message = 'Categoría NO actualizada.';
        }
       $datos = array(
           'success' => $success,
           'data' => $data,
           'message' => $message
       );
        return response()->json($datos,200);
    }

}
