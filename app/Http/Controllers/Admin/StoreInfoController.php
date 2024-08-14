<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfoRequest;
use App\Models\StoreInfo;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreInfoController extends Controller
{
    protected $storeInfo;

    public function __construct(StoreInfo $storeInfo)
    {
        $this->storeInfo = $storeInfo;
    }

    public function show()
    {
        $storeInfo = $this->storeInfo->first();

        return view('admin.store_info.show', compact('storeInfo'));
    }

    public function saveOrUpdate(StoreInfoRequest $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $storeInfo = $this->storeInfo->first();

            if ($request->hasFile('logo')) {
                $data['logo'] = $this->handleLogoUpload($request, $storeInfo);
            }

            if ($storeInfo) {
                $storeInfo->update($data);
                $message = 'Informações da loja atualizadas com sucesso!';
            } else {
                $this->storeInfo->create($data);
                $message = 'Informações da loja criadas com sucesso!';
            }

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return redirect()->route('store.info.show')->with('error', 'Loja não encontrada.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('store.info.show')->with('error', 'Erro ao salvar as informações da loja: ' . $e->getMessage());
        }

        return redirect()->route('store.info.show')->with('success', $message);
    }

    protected function handleLogoUpload($request, $storeInfo)
    {
        if ($storeInfo && $storeInfo->logo && Storage::disk('public')->exists($storeInfo->logo)) {
            Storage::disk('public')->delete($storeInfo->logo);
        }

        return $request->file('logo')->store('logo', 'public');
    }
}
