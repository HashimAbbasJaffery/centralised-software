<?php

namespace App\Http\Controllers;

use App\Models\LeadLink;
use Illuminate\Http\Request;

class LeadLinkController extends Controller
{
    public function index()
    {
        return view("Leads.index");
    }
    public function create()
    {
        return view("Leads.create");
    }

    public function reEligibilityForm($token)
    {
        $link = LeadLink::where('token', $token)->first();

        if (!$link) {
            abort(403, "Link is invalid!");
        }

        if ($link->expires_at && $link->expires_at->isPast()) {
            $link->markExpired(); // ensure status updated
            return view('Leads.expired');
        }

        if ($link->status === 'used') {
            return view('Leads.used');
        }

        return view('Leads.re-eligibility', compact('link'));
    }
}
