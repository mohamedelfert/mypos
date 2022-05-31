<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:clients_read'])->only('index');
        $this->middleware(['permission:clients_create'])->only('create');
        $this->middleware(['permission:clients_update'])->only('edit');
        $this->middleware(['permission:clients_delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        $title = trans('site.clients');
        $clients = Client::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('address', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.clients.index', compact('title', 'clients'));
    }

    public function create()
    {
        $title = trans('site.clients');
        return view('dashboard.clients.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:clients',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'email' => 'required|email|unique:clients',
            'address' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = $request->all();
        $data['phone'] = array_filter($request->phone);

        Client::create($data);

        session()->flash('success', trans('site.data_added_successfully'));
        return redirect()->route('dashboard.clients.index');
    }

    public function show(Client $client)
    {
        //
    }

    public function edit(Client $client)
    {
        $title = trans('site.clients');
        return view('dashboard.clients.edit', compact('title', 'client'));
    }

    public function update(Request $request, Client $client)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:clients,name,' . $client->id,
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'address' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = $request->all();
        $data['phone'] = array_filter($request->phone);

        $client->update($data);

        session()->flash('success', trans('site.data_updated_successfully'));
        return redirect()->route('dashboard.clients.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', trans('site.data_deleted_successfully'));
        return redirect()->back();
    }
}
