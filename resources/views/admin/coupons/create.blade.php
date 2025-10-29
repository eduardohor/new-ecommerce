@extends('admin.layouts.dashboard')
@section('title', 'Cadastrar Cupom')

@section('content')
<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Novo Cupom</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}" class="text-inherit">Cupons</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('coupons.index') }}" class="btn btn-light">Voltar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card card-lg border-0">
                    <div class="card-body p-6">
                        <form method="POST" action="{{ route('coupons.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Código <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                       value="{{ old('code') }}" placeholder="EX: PROMO10" required>
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tipo de desconto <span class="text-danger">*</span></label>
                                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Valor</option>
                                        <option value="percent" {{ old('type') === 'percent' ? 'selected' : '' }}>Percentual</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Valor <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" name="value"
                                           class="form-control @error('value') is-invalid @enderror"
                                           value="{{ old('value') }}" placeholder="Ex: 10.00" required>
                                    @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Quantidade máxima de uso</label>
                                    <input type="number" min="1" name="max_uses"
                                           class="form-control @error('max_uses') is-invalid @enderror"
                                           value="{{ old('max_uses') }}" placeholder="Deixe em branco para ilimitado">
                                    @error('max_uses')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Valor mínimo do pedido</label>
                                    <input type="number" step="0.01" min="0" name="min_order_value"
                                           class="form-control @error('min_order_value') is-invalid @enderror"
                                           value="{{ old('min_order_value') }}" placeholder="Opcional">
                                    @error('min_order_value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Início</label>
                                    <input type="datetime-local" name="starts_at"
                                           class="form-control @error('starts_at') is-invalid @enderror"
                                           value="{{ old('starts_at') }}">
                                    @error('starts_at')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Término</label>
                                    <input type="datetime-local" name="ends_at"
                                           class="form-control @error('ends_at') is-invalid @enderror"
                                           value="{{ old('ends_at') }}">
                                    @error('ends_at')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="couponActive"
                                       name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="couponActive">Cupom ativo</label>
                            </div>

                            <div class="mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <a href="{{ route('coupons.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
