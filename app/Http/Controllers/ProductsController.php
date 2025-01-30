<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        $Products = Products::all();

        return response()->json($Products);
    }

    public function create(Request $request) {
        try {
            Products::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json(['success' => 'Group created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create group: ' . $e->getMessage()], 500);
        }

    }

    public function update(Request $request, $id) {
        // Find the group by ID
        try {
            $group = Products::findOrFail($id);

            // Update the group's details
            $group->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json(['success' => 'Group updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' =>  'Error updating route.', $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $group = Products::findOrFail($id);
            $group->delete();

            return response()->json(['Group deleted Succesful'], 200);
        } catch (\Exception $e) {
            return response()->json(['Error Deleting Group', $e->getMessage()], 500);
        }
    }
}
