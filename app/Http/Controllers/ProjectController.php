<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  /**
   * Proteger las rutas para los usuarios autenticados
   * También se puede hacer en la ruta resource
   */
  public function __constructor()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $projects = Project::with('user')->paginate(10);

    return view('projects.index', compact('projects'));
  }
  
  public function create()
  {
    $project = new Project;
    $title   = __("Crear proyecto");
    $textButton = __("Crear");
    $route = route("projects.store");

    return view("projects.create", compact("title", "textButton", "route", "project"));
  }
  
  public function store(Request $request)
  {
    $this->validate($request, [
        "name" => "required|max:140|unique:projects",
        "description" => "nullable|string|min:10"
    ]);

    Project::create($request->only("name", "description"));

    return redirect(route("projects.index"))
        ->with("success", __("¡Proyecto creado!"));
  }
  
  public function show(Project $project)
  {
  }
  
  public function edit(Project $project)
  {
    $update = true;
    $title  = __("Editar proyecto");
    $textButton = __("Actualizar");
    $route = route("projects.update", ["project" => $project]);

    return view("projects.edit", compact("update", "title", "textButton", "route", "project"));
  }
  
  public function update(Request $request, Project $project)
  {
    $this->validate($request, [
        "name" => "required|unique:projects,name," . $project->id,
        "description" => "nullable|string|min:10"
    ]);

    $project->fill($request->only("name", "description"))->save();

    return back()->with("success", __("¡Proyecto actualizado!"));
  }
  
  public function destroy(Project $project)
  {
    $project->delete();
    
    return back()->with("success", __("¡Proyecto eliminado!"));
  }
}