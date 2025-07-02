<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::insert([
            [
                'title' => 'Comprar víveres',
                'description' => 'Leche, pan, huevos',
                'due_date' => now()->addDays(1),
                'is_completed' => false,
            ],
            [
                'title' => 'Enviar informe',
                'description' => 'Informe de ventas del mes',
                'due_date' => now()->addDays(2),
                'is_completed' => false,
            ],
            [
                'title' => 'Estudiar Laravel',
                'description' => 'Repasar controladores y rutas',
                'due_date' => now()->addDays(3),
                'is_completed' => false,
            ],
            [
                'title' => 'Reunión con equipo',
                'description' => 'Discutir roadmap del proyecto',
                'due_date' => now()->addDay(),
                'is_completed' => false,
            ],
            [
                'title' => 'Actualizar CV',
                'description' => 'Agregar experiencia reciente',
                'due_date' => now()->addWeek(),
                'is_completed' => false,
            ],
        ]);
    }
}

