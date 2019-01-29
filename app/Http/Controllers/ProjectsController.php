<?php

namespace App\Http\Controllers;

use App\Server;
use App\Project;
use App\Http\Requests\ProjectRequest;

class ProjectsController extends Controller
{
    public function index()
    {
        return Project::with('servers')->orderBy('name')->get();
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->except(['stagingServer', 'productionServer']));

        Server::create(
            array_merge(
                ['project_id' => $project->id],
                $request->input('stagingServer')
            )
        );

        Server::create(
            array_merge(
                ['project_id' => $project->id],
                $request->input('productionServer')
            )
        );

        return $project;
    }

    public function show($id)
    {
        $project = Project::find($id)->toArray();
        $project['stagingServer'] = Server::where(['project_id' => $id, 'type' => 'staging'])->first();
        $project['productionServer'] = Server::where(['project_id' => $id, 'type' => 'production'])->first();

        return $project;
    }

    public function update(ProjectRequest $request)
    {
        $project = Project::find($request->input('id'));
        $stagingServer = Server::where(['project_id' => $project->id, 'type' => 'staging'])->first();
        $productionServer = Server::where(['project_id' => $project->id, 'type' => 'production'])->first();

        $project->name = $request->input('name');
        $project->repository = $request->input('repository');
        $project->notes = $request->input('notes');
        $project->type = $request->input('type');

        $stagingServer->fill($request->input('stagingServer'));
        $productionServer->fill($request->input('productionServer'));

        $project->save();
        $stagingServer->save();
        $productionServer->save();

        return compact($project, $stagingServer, $productionServer);
    }

    public function delete($id)
    {
        Project::find($id)->delete();
        Server::where('project_id', $id)->delete();

        return response('200');
    }
}
