<?php

namespace App\Http\Controllers;

use App\Models\OrderLine;
use App\Models\SalesOrder;
use Exception;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesOrders = SalesOrder::with('orderLine')->get();
        return $salesOrders;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            SalesOrder::create($request);
            return response()->json(['message' => 'Sales order created successfully'], 201);
        } catch (\Exception $e) {
            // Handle validation errors or other exceptions
            return response()->json(['error' => $e->getMessage()], 422); // Unprocessable Entity
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salesOrder = SalesOrder::with('orderLine')->findOrFail($id);
        return $salesOrder;
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
        $validatedData = $request->validate([
            'sales_order_id' => 'required|exists:sales_orders,id',
            'product' => 'required',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'tax_excl' => 'required|numeric|min:0',
            'disc' => 'required|numeric|min:0',
            'delivered' => 'required|boolean',
            'invoiced' => 'required|boolean',
            // Add validation rules for other fields
        ]);

        $salesOrder = SalesOrder::findOrFail($id);
        $salesOrder->update($validatedData);

        return response()->json(['message' => 'Order line updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy( SalesOrder $order)
    // {
    //     $request->disableEscapingToken();

    //     $salesOrder = SalesOrder::findOrFail($id);
    //     $salesOrder->delete();
    //     return response()->json(['message' => 'Deleted sales order successfully'], 200);
    // }

    public function destroy(string $id)
    {
        try {
            $salesOrder = SalesOrder::findOrFail($id);
            $salesOrder->delete();
            return response()->json(['message' => 'Deleted sales order successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Sales order not found'], 404);
        }
        // $salesOrder = SalesOrder::findOrFail($id);
        // $salesOrder->delete();
        // return response()->json(['message' => 'Deleted sales order successfully yyyy'], 200);
    }
}
