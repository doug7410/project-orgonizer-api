<?php

use App\Project;
use App\Server;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<10; $i++) {
            $project = factory(Project::class)->create();
            factory(Server::class)->create([
                'project_id' => $project->id,
                'type' => 'staging'
            ]);
            factory(Server::class)->create([
                'project_id' => $project->id,
                'type' => 'production'
            ]);
        }
    }
}
