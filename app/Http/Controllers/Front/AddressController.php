<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AddressController extends Controller
{
    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function index(): View
    {
        $userId = auth()->user()->id;
        $addresses = $this->address->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();


        return view('front.address.index', compact('addresses'));
    }

    public function store(AddressRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $addresses = $this->address->where('user_id', $user->id)->get();

            // Desmarcar o endereço padrão existente, se houver
            if ($request->filled('is_default') && $request->is_default) {
                foreach ($addresses as $address) {
                    if ($address->is_default) {
                        $address->is_default = false;
                        $address->save();
                    }
                }
            }

            $this->address->create([
                'user_id' => $user->id,
                'name' => $request->name,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'number' => $request->number,
                'complement' => $request->complement,
                'neighborhood' => $request->neighborhood,
                'is_default' => $request->is_default ? true : false,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Endereço Cadastrado!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o endereço. Tente novamente.');
        }
    }

    public function update(AddressRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $address = $this->address->findOrFail($id);
            $addresses = $this->address->where('user_id', $user->id)->get();

            if ($address->user_id !== $user->id) {
                return redirect()->back()->with('error', 'Você não tem permissão para atualizar este endereço.');
            }

            // Desmarcar o endereço padrão existente, se houver
            if ($request->filled('is_default') && $request->is_default) {
                foreach ($addresses as $addr) {
                    if ($addr->is_default && $addr->id !== $address->id) {
                        $addr->is_default = false;
                        $addr->save();
                    }
                }
            }

            $address->update([
                'name' => $request->name,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'number' => $request->number,
                'complement' => $request->complement,
                'neighborhood' => $request->neighborhood,
                'is_default' => $request->is_default ? true : false,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Endereço atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o endereço. Tente novamente.');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $address = $this->address->findOrFail($id);

            if ($address->user_id !== $user->id) {
                return redirect()->back()->with('error', 'Você não tem permissão para excluir este endereço.');
            }

            $address->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Endereço excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir o endereço. Tente novamente.');
        }
    }

    public function setDefault($id)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $address = $this->address->findOrFail($id);
            $addresses = $this->address->where('user_id', $user->id)->get();

            // Verifique se o endereço pertence ao usuário
            if ($address->user_id !== $user->id) {
                return redirect()->back()->with('error', 'Você não tem permissão para definir este endereço como padrão.');
            }

            // Desmarcar o endereço padrão existente, se houver
            foreach ($addresses as $addr) {
                if ($addr->is_default && $addr->id !== $address->id) {
                    $addr->is_default = false;
                    $addr->save();
                }
            }

            // Defina o endereço atual como padrão
            $address->is_default = true;
            $address->save();

            DB::commit();

            return redirect()->back()->with('success', 'Endereço definido como padrão com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Ocorreu um erro ao definir o endereço como padrão. Tente novamente.');
        }
    }
}
