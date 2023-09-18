<?php

namespace App\Http\Livewire\Admin\Gamecomp;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gamecomp;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $gamecomp, $gamecomp_id;

    public function rules()
{
    return [
        'name' => 'required|string',
        'status' => 'sometimes', // allow null values
    ];
}


    public function mount()
    {
        $this->gamecomp = Gamecomp::get();
    }

    public function editGamecomp($id)
    {
        $gamecomp = Gamecomp::find($id);
        $this->gamecomp_id = $gamecomp->id;
        $this->name = $gamecomp->name;
        $this->status = $gamecomp->status;
        $this->openModal();
    }
    
    public function deleteGamecomp($gamecompId){
    Gamecomp::find($gamecompId)->delete();
    session()->flash('success', 'Game Company deleted successfully.');
    $this->closeModal();
}


    public function updateGamecomp()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        $gamecomp = Gamecomp::findOrFail($this->gamecomp_id);
        $gamecomp->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);
    
        $this->closeModal();
        $this->resetForm();
    }
    
    public function resetForm()
    {
        $this->gamecomp_id = null;
        $this->name = '';
        $this->status = false;
    }
    public function storeGamecomp()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'status' => 'sometimes|boolean', 
        ]);
    
        if (!isset($data['status'])) {
            $data['status'] = null; 
        }
    
        Gamecomp::updateOrCreate(['id' => $this->gamecomp_id], $data);
    
        session()->flash('message', $this->gamecomp_id ? 'Game Company updated successfully.' : 'Game Company created successfully.');
    
        $this->closeModal();
        $this->resetForm();
    }    
public function closeModal(){
    $this->resetForm();
    $this->dispatchBrowserEvent('closeModal');
}

public function openModal(){
    $this->dispatchBrowserEvent('openModal');
}


public function render()
{
    $gamecomp = Gamecomp::orderBy('id', 'DESC')->paginate(10);
    return view('livewire.admin.gamecomp.index', ['gamecomp'=> $gamecomp])

        ->extends('layouts.admin') 
        ->section('content');


}
}
