<?php

use Illuminate\Database\Seeder;
use App\Models\Projeto;
use App\Models\Modelo;
use App\Models\Campo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Projeto::firstOrCreate(['nome' => 'Projeto', 'linguagem' => "Angular"]);
        
        Modelo::firstOrCreate(['projeto_id' => 1, 'singular' => "instituicao", 'plural' => "instituicoes"]);
        Modelo::firstOrCreate(['projeto_id' => 1, 'singular' => "pesoa", 'plural' => "pessoas"]);
        Modelo::firstOrCreate(['projeto_id' => 1, 'singular' => "ministerio", 'plural' => "inisterios"]);

        Campo::firstOrCreate(['modelo_id' => 1, 'nome' => "nome", 'validador' => "required", 'tipo_input' => "Text"]);
        Campo::firstOrCreate(['modelo_id' => 1, 'nome' => "endereco", 'validador' => "", 'tipo_input' => "Text"]);
        Campo::firstOrCreate(['modelo_id' => 1, 'nome' => "rua", 'validador' => "", 'tipo_input' => "Text"]);

        Campo::firstOrCreate(['modelo_id' => 2, 'nome' => "nome", 'validador' => "required", 'tipo_input' => "Text"]);
        Campo::firstOrCreate(['modelo_id' => 2, 'nome' => "endereco", 'validador' => "", 'tipo_input' => "Text"]);
        Campo::firstOrCreate(['modelo_id' => 2, 'nome' => "rua", 'validador' => "", 'tipo_input' => "Text"]);

        Campo::firstOrCreate(['modelo_id' => 3, 'nome' => "nome", 'validador' => "required", 'tipo_input' => "Text"]);
        Campo::firstOrCreate(['modelo_id' => 3, 'nome' => "endereco", 'validador' => "", 'tipo_input' => "Text"]);
        Campo::firstOrCreate(['modelo_id' => 3, 'nome' => "rua", 'validador' => "", 'tipo_input' => "Text"]);
    }
}
