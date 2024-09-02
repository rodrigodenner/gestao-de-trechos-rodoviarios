<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrechoRequest;
use App\Http\Requests\TrechoUpdateRequest;
use App\Models\Rodovia;
use App\Models\Trecho;
use App\Models\UF;
use App\Services\GeoService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RouteController extends Controller
{
    protected $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    public function index(Trecho $trecho, UF $uf, Rodovia $rodovia)
    {
      $routes = $trecho->with(['uf', 'rodovia'])->latest()->get();
      $ufs = $uf->all();
      $rodovias = $rodovia->all();

      return Inertia::render('Home', compact('routes', 'ufs', 'rodovias'));
    }

    public function create(Rodovia $rodovia, UF $uf)
    {
        $rodovias = $rodovia->all();
        $ufs = $uf->all();

      return Inertia::render('Home', compact('rodovias', 'ufs'));
    }


    public function store(TrechoRequest $request, Rodovia $rodovia, UF $uf, Trecho $trecho)
    {

        $newRoute = $request->validated();
        $rodovia = $rodovia->find($newRoute['rodovia_id']);
        $uf = $uf->find($newRoute['uf_id']);

        $params = [
            'br' =>$rodovia->rodovia,
            'tipo' => $newRoute['tipo'],
            'uf' => $uf->UF,
            'cd_tipo' => 'null',
            'data' => $newRoute['data_referencia'],
            'kmi' => $newRoute['kmInicial'],
            'kmf' => $newRoute['kmFinal'],
        ];

        $geoData = $this->geoService->getGeoData($params);

        if ($geoData) {
            $newRoute['geo'] = json_encode($geoData);
            $trecho->create($newRoute);
//            return redirect()->route('route.index')->with('success', 'Trecho criado com sucesso');
          return to_route('route.index')->with('success', 'Trecho criado com sucesso');
        }

         return to_route('route.index')->with('error', 'Erro ao gerar GeoJSON');
    }

    public function show(Trecho $trecho, $id)
    {
        $trecho = $trecho->find($id);
        if (!$trecho) {
            return Inertia::render('Home')->with('error', 'Nenhum trecho encontrado');
        }
        return Inertia::render('Home', compact('trecho'));

    }

    public function edit(Trecho $trecho, $id)
    {
        $route = $trecho->with(['uf', 'rodovia'])->find($id);
        if (!$route) {
            return Inertia::render('Home')->with('error', 'Nenhum trecho encontrado');
        }

        $ufs = UF::all();
        $rodovias = Rodovia::all();

        return Inertia::render('Edit', compact('route', 'ufs', 'rodovias'));
    }

    public function update(TrechoRequest $request, Trecho $trecho, $id)
    {
        $route = $trecho->find($id);
        if (!$route) {
            return  to_route('route.index')->with('error', 'Nenhum trecho encontrado');
        }

        $routeUpdate = $request->validated();
        $route->update($routeUpdate);

        // Se os campos responsáveis pelo Map forem atualizados, gere um novo GeoJSON
        if ($request->hasAny(['rodovia_id', 'uf_id', 'kmInicial', 'kmFinal', 'tipo'])) {
            $rodovia = Rodovia::find($route->rodovia_id);
            $uf = UF::find($route->uf_id);

            $params = [
                'br' => $rodovia->rodovia,
                'tipo' => $routeUpdate['tipo'],
                'uf' => $uf->UF,
                'cd_tipo' => 'null',
                'data' => $route->data_referencia,
                'kmi' => $route->kmInicial,
                'kmf' => $route->kmFinal,
            ];
            $geoData = $this->geoService->getGeoData($params);

            if (!$geoData) {
                return to_route('route.index')->with('error', 'Erro ao gerar GeoJSON');
            }
            $route->update(['geo' => json_encode($geoData)]);
        }

        return to_route('route.index')->with('success', 'Trecho atualizado com sucesso');
    }


   public function destroy(Trecho $trecho, $id)
   {
       $route = $trecho->with(['uf', 'rodovia'])->find($id);
       if (!$route) {
           return to_route('route.index')->with('error', 'Nenhum trecho encontrado');
       }

     $route->delete();
     return to_route('route.index')->with('success', 'Trecho deletado com sucesso');
   }
}
