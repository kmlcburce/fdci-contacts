<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $contacts = Contact::where('user_id', Auth::id())
            ->when($request->search, function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('email', 'like', '%'.$request->search.'%')
                        ->orWhere('phone', 'like', '%'.$request->search.'%')
                        ->orWhere('company', 'like', '%'.$request->search.'%');
                });
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('contacts.partials.contacts-table', compact('contacts'));
        }

        return view('contacts.index', compact('contacts'));
    }


    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'nullable|string', 
        ]);

        // Include user_id as the logged-in user
        $contactData = $request->all();
        $contactData['user_id'] = Auth::id(); 

        Contact::create($contactData);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'nullable|string', 
        ]);

        $contactData = $request->all();
        $contactData['user_id'] = Auth::id();

        $contact->update($contactData);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
