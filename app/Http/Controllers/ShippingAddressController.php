<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;  // Assuming you have an Address model

class ShippingAddressController extends Controller
{
    // Edit Address
    public function edit()
{
    $address = auth()->user()->address;  // Fetch the address for the logged-in user

    if (!$address) {
        // If no address found, redirect with an error message or handle it appropriately
        return redirect()->route('cart.checkout')->with('error', 'No address found.');
    }

    return view('shipping_address.edit', compact('address'));
}


    // Update Address
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
        ]);
    
        $address = auth()->user()->address;
    
        if (!$address) {
            return redirect()->route('cart.checkout')->with('error', 'No address found.');
        }
    
        $address->update($request->all());  // Update address with new details
    
        return redirect()->route('cart.checkout')->with('success', 'Address updated successfully.');
    }
    

    // Delete Address
    public function destroy()
    {
        $address = auth()->user()->address;
    
        if (!$address) {
            return redirect()->route('cart.checkout')->with('error', 'No address found.');
        }
    
        $address->delete();  // Delete the address
    
        return redirect()->route('cart.checkout')->with('success', 'Address deleted successfully.');
    }
    
}
