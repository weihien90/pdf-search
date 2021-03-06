<?php

namespace App\Http\Controllers;

use App\File;

use App\Jobs\ExtractFileText;
use App\Http\Requests\StorePdfFile;
use App\Http\Requests\UpdatePdfFile;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $files = $request->user()
            ->files()
            ->subContent(100)
            ->get();

        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePdfFile $request)
    {
        $file_path = 'files/' . $request->user()->id . '/';
        $request->file->storeAs($file_path, $request->name, 'local');

		$file = new File;
        $file->name = $request->name;
        $file->description = $request->description;
        $request->user()->files()->save($file);

        dispatch(new ExtractFileText($file, $file_path));

        return redirect()->route('files.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return $file;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePdfFile $request, File $file)
    {
        $file->name = $request->name;
        $file->description = $request->description;
        $file->save();

        return redirect()->route('files.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
