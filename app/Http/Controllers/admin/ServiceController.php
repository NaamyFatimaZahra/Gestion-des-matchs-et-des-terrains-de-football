<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Interface\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->getAll();
        return view("admin.services.index", ['services' => $services]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|string',
        ]);

        $this->serviceRepository->create($request->all());
        return back()->with('success', 'Le service a été ajouté avec succès');
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service' => 'required|string',
        ]);

        $this->serviceRepository->update($service, $request->all());
        return back()->with('success', 'Le service a été modifié avec succès');
    }

    public function destroy(Service $service)
    {
        $this->serviceRepository->delete($service);
        return back()->with('success', 'Le service a été supprimé avec succès');
    }
}