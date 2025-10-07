<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // you might require tenant admin role middleware
    }

    public function index(Request $request)
    {
        $tenantId = Auth::id() ?? null;
        $slots = Slot::where('tenant_id', $tenantId)
                    ->orderBy('start_at','asc')
                    ->paginate(20);

        return view('admin.slots.index', compact('slots'));
    }

    public function create()
    {
        return view('admin.slots.form', ['slot' => new Slot()]);
    }

    public function store(Request $request)
    {
        $tenantId = Auth::id();

        $data = $request->validate([
            'title'=>'nullable|string|max:255',
            'start_at'=>'required|date',
            'end_at'=>'required|date|after:start_at',
            'capacity'=>'required|integer|min:1',
            'buffer_minutes'=>'nullable|integer|min:0',
            'notes'=>'nullable|string',
            'active'=>'nullable|boolean'
        ]);

        $data['tenant_id'] = $tenantId;
        $data['active'] = $request->has('active');

        Slot::create($data);

        Session::flash('success', 'Slot created successfully!');
        return "success";
    }

    public function edit(Slot $slot)
    {
        // verify tenant
        $this->authorizeSlot($slot);
        return view('admin.slots.form', compact('slot'));
    }

    public function update(Request $request, Slot $slot)
    {
        $this->authorizeSlot($slot);

        $data = $request->validate([
            'title'=>'nullable|string|max:255',
            'start_at'=>'required|date',
            'end_at'=>'required|date|after:start_at',
            'capacity'=>'required|integer|min:1',
            'buffer_minutes'=>'nullable|integer|min:0',
            'notes'=>'nullable|string',
            'active'=>'nullable|boolean'
        ]);
        $data['active'] = $request->has('active');

        $slot->update($data);

        Session::flash('success', 'Slot Updated successfully!');
        return "success";
    }

    public function destroy(Slot $slot)
    {
        $this->authorizeSlot($slot);
        $slot->delete();
        Session::flash('success', 'Slot Deleted successfully!');
        return "success";
    }

    protected function authorizeSlot(Slot $slot)
    {
        $tenantId = Auth::id();
        abort_unless($slot->tenant_id == $tenantId, 403);
    }
}
