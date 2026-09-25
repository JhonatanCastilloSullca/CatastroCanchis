<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manzana;
use App\Models\Sectore;
use Illuminate\Support\Facades\Redirect;
use App\Services\RenumerarManzanaService;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class ManzanaController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:manzana.index')->only('index');
        $this->middleware('can:manzana.edit')->only('update');
        $this->middleware('can:manzana.create')->only('store');
        $this->middleware('can:manzana.destroy')->only('destroy');
    }
    public function index()
    {
        $manzanas=Manzana::all();
        $sectores=Sectore::all();
        $i=0;
        return view('pages.manzana.index',compact('manzanas','sectores','i'));
    }

    public function store(Request $request)
    {
        request()->validate(Manzana::$rules);
        $manzana=new Manzana();
        $manzana->id_mzna=$request->id_sector.''.str_pad($request->codi_mzna,3,'0',STR_PAD_LEFT);
        $manzana->id_sector=$request->id_sector;
        $manzana->codi_mzna=str_pad($request->codi_mzna,3,'0',STR_PAD_LEFT);
        $manzana->nume_mzna=strtoupper($request->nume_mzna);
        $manzana->estado=1;
        $manzana->save();
        return redirect()->route('manzana.index')
            ->with('success', 'Manzana Agregado Correctamente.');
    }
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id_sector' => ['required', 'regex:/^[0-9]{8}$/', 'exists:tf_sectores,id_sector'],
            'id_manzana' => ['required', 'regex:/^[0-9]{1,3}$/'],
            'codi_mzna' => ['required', 'regex:/^[0-9]{1,3}$/'],
            'nume_mzna' => ['required', 'string', 'max:15'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error_code', 5)->withErrors($validator)->withInput();
        }

        $datos = $validator->validated();
        try {
            app(RenumerarManzanaService::class)->ejecutar(
                (string) $datos['id_sector'],
                (string) $datos['id_manzana'],
                (string) $datos['codi_mzna'],
                $datos['nume_mzna']
            );
        } catch (ValidationException $exception) {
            return Redirect::back()->with('error_code', 5)->withErrors($exception->errors())->withInput();
        } catch (QueryException $exception) {
            report($exception);

            return Redirect::back()->with('error_code', 5)->withErrors([
                'codi_mzna' => 'No se pudo completar la renumeración. No se guardó ningún cambio. Revise las relaciones y los códigos de destino.',
            ])->withInput();
        }

        return redirect()->back()->with('success', 'Manzana Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $manzana= Manzana::findOrFail($request->id_manzana_2);
        if($manzana->estado=="1"){
            $manzana->estado= '0';
            $manzana->save();
            return redirect()->back()->with('success','Manzana Eliminado Correctamente!');
        }else{
            $manzana->estado= '1';
            $manzana->save();
            return redirect()->back()->with('success','Manzana Eliminado Correctamente!');
        }
    }
}
