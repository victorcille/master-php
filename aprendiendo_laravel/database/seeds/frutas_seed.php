<?php

use Illuminate\Database\Seeder;

class frutas_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 20; $i++){
            // Así se hace el insert en Laravel para que la tabla se rellene de datos al lanzar el comando correspondiente
            DB::table('frutas')->insert(array( 
                'nombre' => 'Cereza '.$i,
                'descripcion' => 'Descripcion de la fruta '.$i,
                'precio' => $i,
                'fecha' => date('Y-m-d')
            ));
        }
	   
        $this->command->info('La tabla de frutas ha sido rellenada');
    }
}
