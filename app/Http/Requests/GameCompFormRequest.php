<?php

namespace App\Http\Requests;

use App\Models\GameComp;
use Yajra\DataTables\Utilities\Request;
use Illuminate\Foundation\Http\FormRequest;

class GameCompFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    /**
     * @return array<string, mixed>
     * */

     public function rules(){
        return [
            'name'=>[
                'required',
                'string'
            ],
            'slug'=>[
                'required',
                'string'
            ],
            ];
     }








    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         // Define validation rules for your form fields
    //     ]);
    
    //     // Create or save the data to the database
    //     GameComp::create($validatedData); // or $gameComp->save();
    
    //     // Redirect back with errors if validation fails
    //     return redirect()->back()->withErrors('Validation error message');
    // }
}    