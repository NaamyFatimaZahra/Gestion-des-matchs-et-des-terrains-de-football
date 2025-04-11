<?php

namespace Database\Seeders;

use App\Models\Service;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerrainServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $terrainServices = [
           ['terrain_id'=>2,'service_id'=>2,'price'=>15],
           ['terrain_id'=>2,'service_id'=>1,'price'=>10],
           ['terrain_id'=>2,'service_id'=>3,'price'=>0],
           ['terrain_id'=>3,'service_id'=>2,'price'=>2],
           ['terrain_id'=>3,'service_id'=>1,'price'=>3],
           ['terrain_id'=>3,'service_id'=>3,'price'=>4],  
           ['terrain_id'=>3,'service_id'=>4,'price'=>4],
           ['terrain_id'=>3,'service_id'=>5,'price'=>20],
           ['terrain_id'=>1,'service_id'=>3,'price'=>12],  
           ['terrain_id'=>1,'service_id'=>2,'price'=>12],
           ['terrain_id'=>1,'service_id'=>1,'price'=>10],
           ['terrain_id'=>1,'service_id'=>6,'price'=>10],
         
        

        ];

        foreach ($terrainServices as $service) {
             DB::table('terrain_service')->insert([
                    'terrain_id' =>  $service['terrain_id'],
                    'service_id' =>$service['service_id'],
                    'price' =>$service['price'] ,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
           
        }
    }
}
