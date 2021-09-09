<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Project::all(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project  = Project::create($request->all());
        // $project  =  new Project;
        if ($request->hasFile('image')) {
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName , PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $comPic = str_replace(' ' , '_',$fileNameOnly).'_'.rand() . '_'.time(). '.'.$extension;
            $path = $request->file('image')->storeAs('public/projects' , $comPic);
            // dd($path);
            $project->image = $comPic;

        }
        if ($project->save()) {
            return response()->json(['status' => true , 'message' => 'Project posted successfully', 'project_details' => $project] , 200);
        }else{
            return response()->json(['status' => false , 'message' => 'Project went wrong' ] ,400 );
        }
        // return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        if (is_null($project)) {
            return response()->json(['message' => 'Project Not found'] , 404 );
        }
        return response()->json($project::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $project = Project::find($id);

        // if (is_null($project)) {
        //     return response()->json(['message' => 'project not found'] , 404);
        // }
        // $project -> update($request->all());
        // return response($project,200);
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'id not found'], 404);
        }



        if ($request->hasFile('image')) {
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName , PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $comPic = str_replace(' ' , '_',$fileNameOnly).'_'.rand() . '_'.time(). '.'.$extension;
            $path = $request->file('image')->storeAs('public/projects' , $comPic);
            // dd($path);
            $project->image = $comPic;

        }
        if ($project->update->all()) {
            return response()->json(['status' => true , 'message' => 'Project updated successfully', 'project_details' => $project] , 200);
        }else{
            return response()->json(['status' => false , 'message' => 'Project went wrong' ] ,400 );
        }

        //update with all fields from $request except 'company_logo'

        // $project->update($request->all());

        // return response()->json(['success' => true, 'message' => 'Project updated successfully!', 'updated_data' => $project], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $project = Project::find($id);
        if (is_null($project)) {
            return response()->json(['message' => 'project not found'] , 404);
        }
        $project -> delete($request->all());
        return response()->json(['message' => 'project successfully deleted'],200);
    }
}
