<?php

namespace App\Services;

use App\Models\Rodovia;
use App\Models\Trecho;
use App\Models\UF;

class RouteService
{

  protected $geoService;

  public function __construct(GeoService $geoService)
  {
    $this->geoService = $geoService;
  }

  public function getAllUfs()
  {
    return UF::all();
  }

  public function getAllRodovias()
  {
    return Rodovia::all();
  }

  public function getAllTechos()
  {
    return Trecho::with(['uf', 'rodovia'])->latest()->get();
  }

  public function createRoute($data)
  {
    $rodovia = Rodovia::find($data['rodovia_id']);
    $uf = UF::find($data['uf_id']);

    $params = [
      'br' => $rodovia->rodovia,
      'tipo' => $data['tipo'],
      'uf' => $uf->UF,
      'cd_tipo' => 'null',
      'data' => $data['data_referencia'],
      'kmi' => $data['kmInicial'],
      'kmf' => $data['kmFinal'],
    ];
    $geoData = $this->geoService->getGeoData($params);

    if ($geoData) {
      $data['geo'] = json_encode($geoData);
      Trecho::create($data);
      return ['status' => true, 'message' => 'Trecho criado com sucesso'];
    }

    return ['status' => false, 'message' => 'Erro ao gerar GeoJSON'];
  }

  public function getRouteById($id)
  {
    return Trecho::with(['uf', 'rodovia'])->find($id);
  }
  public function updateRoute($id, array $data)
  {
    $route = Trecho::find($id);
    if (!$route) {
      return ['status' => false, 'message' => 'Nenhum trecho encontrado'];
    }
    $route->update($data);

    // Verificar se os campos responsáveis pelo GeoJSON foram atualizados
    $fieldsToCheck = ['rodovia_id', 'uf_id', 'kmInicial', 'kmFinal', 'tipo'];
    if (array_intersect_key(array_flip($fieldsToCheck), $data)) {
      // Buscar as entidades relacionadas
      $rodovia = Rodovia::find($route->rodovia_id);
      $uf = UF::find($route->uf_id);

      $params = [
        'br' => $rodovia->rodovia,
        'tipo' => $data['tipo'],
        'uf' => $uf->UF,
        'cd_tipo' => 'null',
        'data' => $route->data_referencia,
        'kmi' => $route->kmInicial,
        'kmf' => $route->kmFinal,
      ];

      $geoData = $this->geoService->getGeoData($params);
      if (!$geoData) {
        return ['status' => false, 'message' => 'Erro ao gerar GeoJSON'];
      }
      $route->update(['geo' => json_encode($geoData)]);
    }

    return ['status' => true, 'message' => 'Trecho atualizado com sucesso'];
  }

  public function deleteRoute($id)
  {
    $route = Trecho::find($id);
    if (!$route) {
      return ['status' => false, 'message' => 'Nenhum trecho encontrado'];
    }

    $route->delete();
    return ['status' => true, 'message' => 'Trecho deletado com sucesso'];
  }

}
