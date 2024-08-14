<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected $customer;
    protected $address;
    protected $order;

    public function __construct(User $customer, Address $address, Order $order)
    {
        $this->customer = $customer;
        $this->address = $address;
        $this->order = $order;
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
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado.');
        }

        $addresses = $customer->addresses()->orderByDesc('updated_at')->paginate(5);

        $payments = $customer->payments()->orderByDesc('updated_at')->paginate(5);


        return view('admin.customer.edit', compact('customer', 'addresses', 'payments'));
    }

    public function update(CustomerRequest $request, $id)
    {
        $data = $request->all();

        $customer = $this->customer->find($id);

        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado.');
        }

        try {
            DB::beginTransaction();

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
        $customer = $this->customer->find($id);

        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado.');
        }
        try {
            DB::beginTransaction();

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

    public function storeAddress(AddressRequest $request, $id)
    {
        $data = $request->all();
        $customer = $this->customer->find($id);

        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado.');
        }

        try {
            DB::beginTransaction();

            $customer->addresses()->create($data);

            DB::commit();

            return redirect()->route('customers.edit', $customer->id)
                ->with('success', 'Endereço cadastrado com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao criar customer:', [
                'message' => $error->getMessage()
            ]);

            return redirect()->route('customers.index')->with('error', 'Erro ao cadastrar endereço. Por favor, tente novamente.');
        }
    }

    public function updateAddress(AddressRequest $request, $id)
    {
        $data = $request->all();
        $address = $this->address->find($id);

        if (!$address) {
            return redirect()->route('customers.index')->with('error', 'Endereço não encontrado.');
        }

        try {
            DB::beginTransaction();

            $address->update($data);

            DB::commit();

            return redirect()->route('customers.edit', $address->user_id)
                ->with('success', 'Endereço atualizado com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao atualizar endereço:', [
                'message' => $error->getMessage()
            ]);

            return redirect()->route('customers.index')->with('error', 'Erro ao atualizar endereço. Por favor, tente novamente.');
        }
    }

    public function destroyAddress($id)
    {
        $address = $this->address->find($id);

        if (!$address) {
            return redirect()->route('customers.index')->with('error', 'Endereço não encontrado.');
        }

        try {
            DB::beginTransaction();

            $address->delete();

            DB::commit();

            return redirect()->route('customers.edit', $address->user_id)
                ->with('success', 'Endereço excluído com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao excluir endereço:', [
                'message' => $error->getMessage()
            ]);

            return redirect()->route('customers.index')->with('error', 'Erro ao excluir endereço. Por favor, tente novamente.');
        }
    }

    public function storePayment(PaymentRequest $request, $id)
    {
        $data = $request->all();
        $customer = $this->customer->find($id);

        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado.');
        }

        $order = $this->order->where('order_number', $data['order_number'])->first();

        if (!$order) {
            return redirect()->route('customers.edit', $customer->id)->with('error', 'Pedido não encontrado.');
        }

        try {
            DB::beginTransaction();

            $order->payment()->create($data);

            // $customer->payments()->create([
            //     'order_id' => $order->id,
            //     'payment_method' => $data['payment_method'],
            //     'payment_type'=> $data['payment_type'],
            //     'transaction_id' => $data['transaction_id'],
            //     'amount' => $data['amount'],
            //     'status' => $data['status'],
            //     'installments' => $data['installments'],
            // ]);

            DB::commit();

            return redirect()->route('customers.edit', $customer->id)
                ->with('success', 'Pagamento cadastrado com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao criar pagamento:', [
                'message' => $error->getMessage()
            ]);

            return redirect()->route('customers.index')->with('error', 'Erro ao cadastrar pagamento. Por favor, tente novamente.');
        }
    }
}
