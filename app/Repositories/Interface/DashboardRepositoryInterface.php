<?php

namespace App\Repositories\Interface    ;

interface DashboardRepositoryInterface
{
   
    public function getAllTerrains(): array;
    
   
    public function getTerrainEvolution(): array;
    
   
    public function getTerrainStats(): array;
}