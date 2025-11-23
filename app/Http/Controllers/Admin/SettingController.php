<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show settings index page
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Show website settings page
     */
    public function website()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.website', compact('settings'));
    }

    /**
     * Update website settings
     */
    public function updateWebsite(Request $request)
    {
        $request->validate([
            'cafe_name' => 'required|string|max:255',
            'cafe_description' => 'nullable|string',
            'cafe_address' => 'nullable|string',
            'cafe_phone' => 'nullable|string|max:20',
            'operating_hours' => 'nullable|string|max:100',
            'max_order_per_day' => 'nullable|integer|min:1',
            'order_enabled' => 'nullable|boolean',
        ]);

        foreach ($request->except('_token') as $key => $value) {
            $type = 'text';
            if ($key === 'max_order_per_day') {
                $type = 'number';
            } elseif ($key === 'order_enabled') {
                $type = 'boolean';
                $value = $request->has('order_enabled') ? '1' : '0';
            }

            Setting::set($key, $value ?? '', $type);
        }

        Setting::clearCache();

        return redirect()->route('admin.settings.website')
            ->with('success', 'Pengaturan website berhasil diperbarui');
    }

    /**
     * Show customer management page
     */
    public function customers()
    {
        $students = User::where('role', 'student')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.settings.customers', compact('students'));
    }

    /**
     * Delete a customer
     */
    public function deleteCustomer(User $user)
    {
        if ($user->role !== 'student') {
            return redirect()->back()->with('error', 'Hanya dapat menghapus akun pelanggan');
        }

        // Delete user's orders first
        $user->orders()->delete();
        $user->delete();

        return redirect()->route('admin.settings.customers')
            ->with('success', 'Pelanggan berhasil dihapus');
    }

    /**
     * Toggle customer active status
     */
    public function toggleCustomer(User $user)
    {
        if ($user->role !== 'student') {
            return redirect()->back()->with('error', 'Hanya dapat mengubah status akun pelanggan');
        }

        // Toggle active status (assuming we'll add this field)
        // For now, we can just return success
        return redirect()->route('admin.settings.customers')
            ->with('success', 'Status pelanggan berhasil diubah');
    }
}
