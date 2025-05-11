<?php

namespace App\Repositories\Eloquent;

use App\Models\Service;
use App\Repositories\Interface\ServiceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements ServiceRepositoryInterface
{
   
    public function getAll():LengthAwarePaginator
    {
        return Service::paginate(5);
    }

  
    public function create(array $data): Service
    {
        return Service::create([
            'name' => $data['service']
        ]);
    }

  
    public function update(Service $service, array $data): bool
    {
        return $service->update([
            'name' => $data['service']
        ]);
    }

  
    public function delete(Service $service): bool
    {
        return $service->delete();
    }
}