<?php 

use App\Http\Controllers\PlanetpressController;

Route::get('listplanetpress', [PlanetpressController::class, 'listPlanetPress']);

Route::get('listplanetpress/search', [PlanetpressController::class, 'searchPlanetPress']);

Route::post('addplanetpress', [PlanetpressController::class, 'addPlanetpress']);

Route::post('copyplanetpress', [PlanetpressController::class, 'copyPlanetPress']);

Route::post('editplanetpress', [PlanetpressController::class, 'editPlanetpress']);

Route::get('deleteplanetpress/{id}', [PlanetpressController::class, 'deletePlanetPress']);

//thai host

Route::get('listplanetpressthai', [PlanetpressController::class, 'listPlanetPressThai']);

Route::get('listplanetpressthai/search', [PlanetpressController::class, 'searchPlanetPressThai']);

Route::post('addplanetpressthai', [PlanetpressController::class, 'addPlanetpressThai']);

Route::post('copyplanetpressthai', [PlanetpressController::class, 'copyPlanetPressThai']);

Route::post('editplanetpressthai', [PlanetpressController::class, 'editPlanetpressThai']);

Route::get('deleteplanetpressthai/{id}', [PlanetpressController::class, 'deletePlanetPressThai']);

?>