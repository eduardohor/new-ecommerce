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
            ->orderByDesc('is_default')
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
}
