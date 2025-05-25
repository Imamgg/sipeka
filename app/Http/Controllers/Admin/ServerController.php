<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServerController extends Controller
{
  /**
   * Display the server status management page.
   */
  public function index()
  {
    $serverStatus = ServerStatus::current();

    return view('admin.server.index', compact('serverStatus'));
  }

  /**
   * Update server status (online/offline).
   */
  public function updateStatus(Request $request)
  {
    $request->validate([
      'is_online' => 'required|boolean',
      'maintenance_message' => 'nullable|string|max:255'
    ]);

    $serverStatus = ServerStatus::current();

    if ($request->is_online) {
      $serverStatus->setOnline(Auth::id());
    } else {
      $serverStatus->setOffline(
        $request->maintenance_message ?? 'Server sedang dalam pemeliharaan. Hanya admin yang dapat mengakses sistem.',
        Auth::id()
      );
    }

    $statusText = $request->is_online ? 'online' : 'maintenance';

    return redirect()->back()->with('success', "Status server berhasil diubah ke {$statusText}.");
  }
}
