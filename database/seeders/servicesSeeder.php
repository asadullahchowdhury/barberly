<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class servicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** Removes all data **/
        Services::truncate();

        Services::insert([
            [
                'name' => 'Haircut & styling',
                'icon' => 'haircut-styling.svg',
            ],

            [
                'name' => 'Barber',
                'icon' => 'barber.svg',
            ],

            [
                'name' => 'Hair removal',
                'icon' => 'hair-removal.svg',
            ],

            [
                'name' => 'Hair extensions',
                'icon' => 'hair-extensions.svg',
            ],

            [
                'name' => 'Face & skin',
                'icon' => 'face-skin.svg',
            ],

            [
                'name' => 'Massage',
                'icon' => 'massage.svg',
            ],

            [
                'name' => 'Nails',
                'icon' => 'nails.svg',
            ],

            [
                'name' => 'Lashes & brows',
                'icon' => 'lashes-brows.svg',
            ],

            [
                'name' => 'Makeup',
                'icon' => 'makeup.svg',
            ],

            [
                'name' => 'Injectables',
                'icon' => 'injectables.svg',
            ],

            [
                'name' => 'Piercing & tattoo',
                'icon' => 'piercing-tattoo.svg',
            ],

            [
                'name' => 'Spa & wellness',
                'icon' => 'spa-wellness.svg',
            ],


        ]);
    }
}
