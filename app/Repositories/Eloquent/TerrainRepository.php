<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\TerrainRequest;
use App\Models\Document;
use App\Models\Terrain;
use App\Repositories\Interface\TerrainRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerrainRepository implements TerrainRepositoryInterface
{
  
    public function getAllByProprietaire(int $proprietaireId): Collection
    {
        return Terrain::withoutTrashed()
            ->where('proprietaire_id', '=', $proprietaireId)
            ->get();
    }
   
    public function updateStatus(Request $request, Terrain $terrain): bool
    {
        if ($terrain->admin_approval === 'en_attente') {
            return false;
        }
        
        $terrain->status = $request->status;
        return $terrain->save();
    }
    
   
    public function create(TerrainRequest $request, int $userId): Terrain
    {
        $validated = $request->validated();
        
        DB::beginTransaction();
        try {
            // Créer un nouveau terrain avec les données validées
            $terrain = new Terrain();
            $terrain->name = $validated['name'];
            $terrain->description = $validated['description'];
            $terrain->capacity = $validated['capacity'];
            $terrain->price = $validated['price'];
            $terrain->surface = $validated['surface'];
            $terrain->payment_method = $validated['payment_method'];
            $terrain->city = $validated['city'];
            $terrain->adress = $validated['adress'];
            $terrain->latitude = $validated['latitude'];
            $terrain->longitude = $validated['longitude'];
            $terrain->proprietaire_id = $userId;
            $terrain->contact = $validated['contact'];
            
            // Enregistrer le terrain dans la base de données
            $terrain->save();
    
            // Associer les services au terrain
            foreach ($validated['services'] as $serviceId) {
                $terrain->services()->attach($serviceId, ['price' => 0]);
            }
    
            // Traiter les images
            foreach ($request->file('images') as $image) {
                // Générer un nom unique pour l'image
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                
                // Stocker l'image dans le répertoire de stockage
                $imagePath = $image->storeAs('terrains', $imageName, 'public');
                
                // Créer un nouveau document pour l'image
                $document = new Document();
                $document->terrain_id = $terrain->id;
                $document->photo_path = $imagePath;
                $document->save();
            }
            
            DB::commit();
            return $terrain;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
  
    public function getWithRelations(Terrain $terrain): Terrain
    {
        return $terrain->load('services', 'documents', 'comments');
    }
    
    /**
     * Met à jour les informations d'un terrain
     * 
     * @param Request $request
     * @param Terrain $terrain
     * @return bool
     */
    public function update(Request $request, Terrain $terrain): bool
    {
        // Implémentation de la méthode de mise à jour
        // Cette méthode n'est pas complètement implémentée dans le controller original
        // mais nous ajoutons une implémentation de base
        
        DB::beginTransaction();
        try {
            // Mise à jour des attributs du terrain
            $terrain->fill($request->validated());
            $terrain->save();
            
            // Mise à jour des services si présents dans la requête
            if ($request->has('services')) {
                $terrain->services()->sync($request->services);
            }
            
            // Traitement des nouvelles images si présentes
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                    $imagePath = $image->storeAs('terrains', $imageName, 'public');
                    
                    $document = new Document();
                    $document->terrain_id = $terrain->id;
                    $document->photo_path = $imagePath;
                    $document->save();
                }
            }
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    /**
     * Supprime un terrain
     * 
     * @param Terrain $terrain
     * @return bool
     */
    public function delete(Terrain $terrain): bool
{
    // On tente de soft delete le modèle
    if ($terrain->delete()) {
        return true;
    }

    return false;
}

public function isDeleted(Terrain $terrain): bool
{
    return $terrain->trashed();
}

}