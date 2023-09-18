<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GameCompDataTable;
use App\Models\GameComp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\GameCompFormRequest;

class GameCompController extends Controller
{
    public function index(GameCompDataTable $dataTable)
    {
        // return view('admin.category.index');
        return $dataTable->render('admin.gamecomp.index');
    }

    public function create()
    {
        return view('admin.gamecomp.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);
    
        $gamecomp = new GameComp();
        $gamecomp->name = $validatedData['name'];
        $gamecomp->slug = Str::slug($validatedData['slug']);
    
        $gamecomp->save();
    
        return redirect()->route('gamecomp.index')->with('message', 'Game Company Added Successfully');
    }
    

    public function edit (GameComp $gamecomp) 
    {
        return view('admin.gamecomp.edit', compact('gamecomp'));
    } 

    public function update(GameCompFormRequest $request, $gamecomp)
    {
        $validatedData = $request->validated();
        $gamecomp = GameComp::findOrFail($gamecomp);
    
        $gamecomp->name = $validatedData['name'];
        $gamecomp->slug = Str::slug($validatedData['slug']);
    
        $uploadPath = 'uploads/gamecomp/';
       
        if ($request->hasFile('image')) {
            $path = 'uploads/gamecomp/' . $gamecomp->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
    
            $file->move('uploads/gamecomp/', $filename);
            $gamecomp->image = $uploadPath . $filename;
        }
        // try {
        //     $gamecomp->save();
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
        

        return redirect('admin/gamecomp')->with('message', 'Game Company Updated Successfully');
    }
    

    public function destroy(GameComp $gamecomp)
    {
        $gamecomp->delete();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Game Company deleted successfully');
    }
}