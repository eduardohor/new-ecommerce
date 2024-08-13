<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request): View
    {
        $customers = $this->customer->getcustomers($request->get('search', ''));

        return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(CustomerRequest $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $data['profile_image'] = $imagePath;
            }

            $this->customer->create($data);

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Cliente cadastrado com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao criar customer:', [
                'message' => $error->getMessage()
            ]);

            return redirect()->route('customers.index')->with('error', 'Erro ao criar cliente. Por favor, tente novamente.');
        }
    }

    public function edit($id)
    {
        $customer = $this->customer->find($id);

        if (!$customer) {
            return redirect()->route('customers.index');
        }

        $addresses = $customer->addresses()->paginate(5);

        $payments = $customer->payments()->paginate(5);


        return view('admin.customer.edit', compact('customer', 'addresses', 'payments'));
    }

    public function update(CustomerRequest $request, $id)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $customer = $this->customer->find($id);

            if (!$customer) {
                return redirect()->route('customers.index');
            }

            if ($request->hasFile('profile_image')) {

                if ($customer->profile_image && Storage::disk('public')->exists($customer->profile_image)) {
                    Storage::disk('public')->delete($customer->profile_image);
                }

                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $data['profile_image'] = $imagePath;
            }

            $customer->update($data);

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Cliente atualizado com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao criar customer:', [
                'message' => $error->getMessage()
            ]);

            return redirect()->route('customers.index')->with('error', 'Erro ao atualizar cliente. Por favor, tente novamente.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $customer = $this->customer->find($id);

            if (!$customer) {
                return redirect()->route('customers.index');
            }

            $customer->delete();

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Cliente excluído com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao criar customer:', [
                'message' => $error->getMessage()
            ]);

            return redirect()->route('customers.index')->with('error', 'Erro ao excluir cliente. Por favor, tente novamente.');
        }
    }
}
