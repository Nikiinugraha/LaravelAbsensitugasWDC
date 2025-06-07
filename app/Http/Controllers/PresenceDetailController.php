<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PresenceDetail;

class PresenceDetailController extends Controller
{
    public function Destroy ($id) {
        $presenceDetail = PresenceDetail::findOrFail($id);
        $presenceDetail->delete();

        return redirect()->back();
    }
}
