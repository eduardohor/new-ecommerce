<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreeShippingZipRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class FreeShippingZipRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ranges = FreeShippingZipRange::orderBy('zip_start')->paginate(15);

        return view('admin.free_shipping_zip_ranges.index', compact('ranges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.free_shipping_zip_ranges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'zip_start' => FreeShippingZipRange::cleanZipCode((string) $request->input('zip_start', '')),
            'zip_end' => FreeShippingZipRange::cleanZipCode((string) $request->input('zip_end', '')),
        ]);

        $validated = $request->validate([
            'zip_start' => 'required|string|size:8|regex:/^[0-9]{8}$/',
            'zip_end' => 'required|string|size:8|regex:/^[0-9]{8}$/',
            'active' => 'boolean',
        ], [
            'zip_start.required' => 'O CEP inicial é obrigatório.',
            'zip_start.size' => 'O CEP inicial deve ter 8 dígitos.',
            'zip_start.regex' => 'O CEP inicial deve conter apenas números.',
            'zip_end.required' => 'O CEP final é obrigatório.',
            'zip_end.size' => 'O CEP final deve ter 8 dígitos.',
            'zip_end.regex' => 'O CEP final deve conter apenas números.',
        ]);

        $validated['zip_start'] = FreeShippingZipRange::cleanZipCode($validated['zip_start']);
        $validated['zip_end'] = FreeShippingZipRange::cleanZipCode($validated['zip_end']);

        if ((int) $validated['zip_start'] > (int) $validated['zip_end']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'O CEP inicial deve ser menor ou igual ao CEP final.');
        }

        $overlapping = FreeShippingZipRange::active()
            ->where(function ($query) use ($validated) {
                $query->whereBetween('zip_start', [$validated['zip_start'], $validated['zip_end']])
                    ->orWhereBetween('zip_end', [$validated['zip_start'], $validated['zip_end']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('zip_start', '<=', $validated['zip_start'])
                            ->where('zip_end', '>=', $validated['zip_end']);
                    });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->back()
                ->withInput()
                ->with('warning', 'Esta faixa de CEP se sobrepõe a outra faixa ativa existente.');
        }

        try {
            DB::beginTransaction();

            $validated['active'] = $request->has('active');

            FreeShippingZipRange::create($validated);

            DB::commit();

            return redirect()->route('admin.free-shipping-zip-ranges.index')
                ->with('success', 'Faixa de CEP cadastrada com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar faixa de CEP: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $range = FreeShippingZipRange::findOrFail($id);

        return view('admin.free_shipping_zip_ranges.edit', compact('range'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $range = FreeShippingZipRange::findOrFail($id);

        $request->merge([
            'zip_start' => FreeShippingZipRange::cleanZipCode((string) $request->input('zip_start', '')),
            'zip_end' => FreeShippingZipRange::cleanZipCode((string) $request->input('zip_end', '')),
        ]);

        $validated = $request->validate([
            'zip_start' => 'required|string|size:8|regex:/^[0-9]{8}$/',
            'zip_end' => 'required|string|size:8|regex:/^[0-9]{8}$/',
            'active' => 'boolean',
        ], [
            'zip_start.required' => 'O CEP inicial é obrigatório.',
            'zip_start.size' => 'O CEP inicial deve ter 8 dígitos.',
            'zip_start.regex' => 'O CEP inicial deve conter apenas números.',
            'zip_end.required' => 'O CEP final é obrigatório.',
            'zip_end.size' => 'O CEP final deve ter 8 dígitos.',
            'zip_end.regex' => 'O CEP final deve conter apenas números.',
        ]);

        // Remove formatação dos CEPs
        $validated['zip_start'] = FreeShippingZipRange::cleanZipCode($validated['zip_start']);
        $validated['zip_end'] = FreeShippingZipRange::cleanZipCode($validated['zip_end']);

        if ((int) $validated['zip_start'] > (int) $validated['zip_end']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'O CEP inicial deve ser menor ou igual ao CEP final.');
        }

        $overlapping = FreeShippingZipRange::active()
            ->where('id', '!=', $id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('zip_start', [$validated['zip_start'], $validated['zip_end']])
                    ->orWhereBetween('zip_end', [$validated['zip_start'], $validated['zip_end']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('zip_start', '<=', $validated['zip_start'])
                            ->where('zip_end', '>=', $validated['zip_end']);
                    });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->back()
                ->withInput()
                ->with('warning', 'Esta faixa de CEP se sobrepõe a outra faixa ativa existente.');
        }

        try {
            DB::beginTransaction();

            $validated['active'] = $request->has('active');

            $range->update($validated);

            DB::commit();

            return redirect()->route('admin.free-shipping-zip-ranges.index')
                ->with('success', 'Faixa de CEP atualizada com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar faixa de CEP: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $range = FreeShippingZipRange::findOrFail($id);
            $range->delete();

            return redirect()->route('admin.free-shipping-zip-ranges.index')
                ->with('success', 'Faixa de CEP excluída com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao excluir faixa de CEP: ' . $e->getMessage());
        }
    }

    /**
     * Toggle active status
     */
    public function toggleActive(string $id)
    {
        try {
            $range = FreeShippingZipRange::findOrFail($id);
            $range->active = !$range->active;
            $range->save();

            $status = $range->active ? 'ativada' : 'desativada';

            return redirect()->route('admin.free-shipping-zip-ranges.index')
                ->with('success', "Faixa de CEP {$status} com sucesso!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao alterar status: ' . $e->getMessage());
        }
    }
}
