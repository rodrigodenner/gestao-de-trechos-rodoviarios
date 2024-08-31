<?php

namespace App\Http\Controllers;

use App\Models\Trecho;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RouteController extends Controller
{
  public function index(Trecho $trecho)
  {
    $router = $trecho->with(['uf','trecho'])->get();
    if(!$router){
      return with('error', 'Nenhum trecho encontrado');
    }
    return Inertia::render('Home', compact('router'));
  }

  public function show(Trecho $trecho, $id)
  {
    $router = $trecho->with(['uf','trecho'])->find($id);
    if(!$router){
      return with('error', 'Nenhum trecho encontrado');
    }
    return Inertia::render('Home', compact('router'));
  }

  public function store(Request $request, Trecho $trecho)
  {
    $router = $request->all();
    $trecho->create($router);
    return to_route('route.index')->with('success', 'Trecho criado com sucesso');
  }

  public function edit(Trecho $trecho, $id)
  {
    $router = $trecho->with(['uf','trecho'])->find($id);
    if(!$router){
      return with('error', 'Nenhum trecho encontrado');
    }
    return Inertia::render('Home', compact('router'));
  }

  public function update(Request $request, Trecho $trecho, $id)
  {
    $router = $trecho->find($id);
    if(!$router){
      return with('error', 'Nenhum trecho encontrado');
    }
    $router->update($request->all());
    return to_route('route.index')->with('success', 'Trecho atualizado com sucesso');
  }

  public function destroy(Trecho $trecho, $id)
  {
    $router = $trecho->find($id);
    if(!$router){
      return with('error', 'Nenhum trecho encontrado');
    }
    $router->delete();
    return to_route('route.index')->with('success', 'Trecho deletado com sucesso');
  }
}
