<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function index(Request $request): View
    {
        $query = Coupon::query()->orderByDesc('created_at');

        if ($search = $request->string('search')->trim()->value()) {
            $query->where('code', 'like', '%' . $search . '%');
        }

        if ($request->filled('status')) {
            $status = $request->input('status');

            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($status === 'expired') {
                $query->whereNotNull('ends_at')->where('ends_at', '<', now());
            }
        }

        $coupons = $query->paginate(15)->withQueryString();

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create(): View
    {
        return view('admin.coupons.create');
    }

    public function store(CouponRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Coupon::create($data);

        return redirect()->route('coupons.index')->with('success', 'Cupom criado com sucesso!');
    }

    public function edit(Coupon $coupon): View
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(CouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $data = $request->validated();

        $coupon->update($data);

        return redirect()->route('coupons.index')->with('success', 'Cupom atualizado com sucesso!');
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Cupom excluído com sucesso!');
    }
}
