<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Machine;
use Illuminate\Support\Facades\Auth;

class MachineController extends Controller
{
    
    public function index()  
    {  
        $user = Auth::user();
        if($user !== null && $user->user_type == 'admin') {
            $Machines = Machine::latest()->paginate(5);
            return view('machines.index',compact('Machines'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);;
        } else {
            return redirect()->route('login');
        }
        

    } 

    public function create()  
    {  
        $user = Auth::user();
        if($user !== null && $user->user_type == 'admin') {
            return view('machines.create');
        } else {
            return redirect()->route('login');
        }
    }  
    public function store(Request $request)  
    {  
        $user = Auth::user();
        if($user !== null && $user->user_type == 'admin') {
            $request->validate([
                'machine_name' => 'required',
            ]);
            Machine::create($request->all());
            return redirect()->route('machine.index')
                            ->with('success','Machine created successfully.');
        } else {
            return redirect()->route('login');
        }
    }
    public function show(Machine $machine)
    {
        $user = Auth::user();
        if($user !== null && $user->user_type == 'admin') {
            return view('machines.show',compact('machine'));
        } else {
            return redirect()->route('login');
        }
    }
    public function edit(Machine $machine)  
    {  
        $user = Auth::user();
        if($user !== null && $user->user_type == 'admin') {
            return view('machines.edit',compact('machine'));
        }  else {
            return redirect()->route('login');
        }
    }
    public function update(Request $request, Machine $machine)  
    {  
        $user = Auth::user();
        if($user !== null && $user->user_type == 'admin') {
            $request->validate([
                'machine_name' => 'required',
            ]);
            $machine->update($request->all());
            return redirect()->route('machine.index')
                            ->with('success','Machine updated successfully');
        } else {
            return redirect()->route('login');
        }
    } 

    public function destroy(Machine $machine)  
    {  
        $user = Auth::user();
        if($user !== null && $user->user_type == 'admin') {
            $machine->delete();
            return redirect()->route('machine.index')
                            ->with('success','Machine deleted successfully');
        } else {
            return redirect()->route('login');
        }
    }  
}
