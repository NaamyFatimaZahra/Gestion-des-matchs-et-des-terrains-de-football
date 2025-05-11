<?php

namespace App\Repositories\Interface;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{

    public function getAll(): LengthAwarePaginator;

  
    public function create(array $data): Service;

   
    public function update(Service $service, array $data): bool;

  
    public function delete(Service $service): bool;
}