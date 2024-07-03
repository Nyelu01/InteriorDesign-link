<?php

namespace App\Http\Controllers\BudgetItem;

use App\Http\Controllers\Controller;
use App\Models\BudgetItem;
use App\Models\DesignRequirement;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BudgetItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            // Fetch requirement_id from the request parameters
            $requirement_id = $request->get('requirement_id');

            // Fetch budget items for the specific requirement and authenticated user
            $items = BudgetItem::where('designer_id', Auth::id())
                ->where('requirement_id', $requirement_id)
                ->with('designer', 'client') // Ensure 'client' relationship is included
                ->get();

            // Calculate total budget for the specific requirement
            $totalBudget = $items->sum('total_price');

            return view('designer.pages.BudgetItem.create', compact('items', 'totalBudget', 'requirement_id'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch budget items: ' . $e->getMessage());
        }
    }






    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'unit_price' => 'nullable|numeric',
            'total_price' => 'nullable|numeric',
            'requirement_id' => 'required|exists:design_requirements,id',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Check if the item already exists for the requirement
            $existingItem = BudgetItem::where('requirement_id', $request->requirement_id)
                ->where('name', $request->name)
                ->first();

            if ($existingItem) {
                throw new \Exception('Item already exists for this requirement.');
            }

            // Create the BudgetItem
            $item = new BudgetItem([
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'total_price' => $request->total_price,
                'designer_id' => Auth::id(),
                'requirement_id' => $request->requirement_id,
            ]);

            $item->save();

            // Commit transaction
            DB::commit();

            // Redirect to items index filtered by the requirement_id of the newly added item
            return redirect()->route('items.index', ['requirement_id' => $request->requirement_id])->with('success', 'Item added successfully.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();

            return redirect()->back()->with('error', 'Failed to add item: ' . $e->getMessage());
        }
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the BudgetItem by ID
            $item = BudgetItem::findOrFail($id);

            // Check if the authenticated user is authorized to delete the item
            if ($item->designer_id !== Auth::id()) {
                return redirect()->route('items.index')->with('error', 'You are not authorized to delete this item.');
            }

            // Delete the item
            $item->delete();

            // Redirect with success message
            return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->route('items.index')->with('error', 'Failed to delete item: ' . $e->getMessage());
        }
    }
}
