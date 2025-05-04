<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Interface\TerrainRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $terrainRepository;

    public function __construct(TerrainRepositoryInterface $terrainRepository){
         $this->terrainRepository=$terrainRepository;
    }
    public function index()
    {
        return view("Home.home");
    }
    public function about()
    {
        return view("Home.about");
    }
    public function getCitiesSearched($city){
       $terrains=$this->terrainRepository->getTerrainsByCity($city);
        return response()->json([$terrains]);
    }
}
