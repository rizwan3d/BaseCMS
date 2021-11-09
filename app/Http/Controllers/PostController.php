<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getPost(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . url('edit/' .$row->id   ) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="#/"  class="delete btn btn-danger btn-sm" onclick="deleteCall(' . $row->id   . ')">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'Title' => 'required|unique:posts|max:191',
            'category_id' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                        ->withErrors($validated)
                        ->withInput($request->input());
        }

        $request['Url'] = str_replace(" ","-",$request->title) . '-' . Str::random(6);
        // day/mm/yy/title
        // @User/Title
        // TItle-user
        Post::create($request->all());

        return redirect()->back()->with( "sucess"  , "Category created sucessfully!" );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c = Post::find($id);

        
        return view('admin.Category.edit')->with('c', $c);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'Title' => 'required|unique:posts|max:191',
            'category_id' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                        ->withErrors($validated)
                        ->withInput($request->input());
        }
        
        Post::find($id)->update($request->all());

        return redirect()->back()->with( "sucess"  , "Category updated sucessfully!" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
    }
}
