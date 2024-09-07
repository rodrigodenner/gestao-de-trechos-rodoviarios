<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrechoRequest;
use App\Models\Trecho;
use App\Services\RouteService;
use Inertia\Inertia;

class RouteController extends Controller
{
  protected $routeService;

  public function __construct(RouteService $routeService)
  {
    $this->routeService = $routeService;
  }

  public function index()
  {
    $routes = $this->routeService->getAllTechos();
    $ufs = $this->routeService->getAllUfs();
    $rodovias = $this->routeService->getAllRodovias();

    return Inertia::render('Home', compact('routes', 'ufs', 'rodovias'));
  }

  public function create()
  {
    $rodovias = $this->routeService->getAllRodovias();
    $ufs = $this->routeService->getAllUfs();

    return Inertia::render('Home', compact('rodovias', 'ufs'));
  }

  public function store(TrechoRequest $request)
  {
    $newRouter = $this->routeService->createRoute($request->validated());

    return to_route('route.index')->with($newRouter['status'] ? 'success' : 'error', $newRouter['message']);
  }

  public function show($id)
  {
    $trecho = $this->routeService->getRouteById($id);
    if (!$trecho) {
      return Inertia::render('Home')->with('error', 'Nenhum trecho encontrado');
    }
    return Inertia::render('Home', compact('trecho'));

  }

  public function edit(Trecho $trecho,$id)
  {
    $route = $trecho->with(['uf', 'rodovia'])->find($id);
    if (!$route) {
      return Inertia::render('Home')->with('error', 'Nenhum trecho encontrado');
    }

    $ufs = $this->routeService->getAllUfs();
    $rodovias = $this->routeService->getAllRodovias();

    return Inertia::render('Edit', compact('route', 'ufs', 'rodovias'));
  }

  public function update(TrechoRequest $request, $id)
  {
    $updateRouter = $this->routeService->updateRoute($id, $request->validated());
    return to_route('route.index')->with($updateRouter['status'] ? 'success' : 'error', $updateRouter['message']);
  }

  public function destroy($id)
  {
    $result = $this->routeService->deleteRoute($id);
    return to_route('route.index')->with($result['status'] ? 'success' : 'error', $result['message']);
  }
}
