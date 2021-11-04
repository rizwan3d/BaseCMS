<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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

    public function getCategory(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
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
            'Name' => 'required|unique:categories|max:191',
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                        ->withErrors($validated)
                        ->withInput($request->input());
        }

        Category::create($request->all());

        return redirect()->back()->with( "sucess"  , "Category created sucessfully!" );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c = Category::find($id);
        return view('admin.Category.edit')->with('c', $c);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'Name' => 'required|unique:categories|max:191',
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                        ->withErrors($validated)
                        ->withInput($request->input());
        }

        
        Category::find($id)->update($request->all());

        return redirect()->back()->with( "sucess"  , "Category updated sucessfully!" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
    }
}
