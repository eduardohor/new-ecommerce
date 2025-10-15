@php($positions = $positions ?? config('banners.positions', []))
@php($editing = isset($banner))

<div class="row">
    <div class="col-lg-8 col-12">
        <div class="card mb-6 card-lg">
            <div class="card-body p-6">
                <div class="mb-3">
                    <label class="form-label">Posição <span class="text-danger">*</span></label>
                    <select name="position" class="form-select" required>
                        <option value="" disabled {{ old('position', $banner->position ?? '') === '' ? 'selected' : '' }}>Selecione a posição</option>
                        @foreach($positions as $key => $config)
                            <option value="{{ $key }}" {{ old('position', $banner->position ?? '') === $key ? 'selected' : '' }}>
                                {{ $config['label'] ?? $key }}
                            </option>
                        @endforeach
                    </select>
                    @error('position')<span class="text-danger">{{ $message }}</span>@enderror
                    @php($selectedConfig = $positions[old('position', $banner->position ?? '')] ?? null)
                    @if($selectedConfig && isset($selectedConfig['max_items']))
                        <small class="text-muted d-block mt-1">Limite para esta posição: {{ $selectedConfig['max_items'] }} banner(s).</small>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-8 col-12">
                <div class="mb-3">
                    <label class="form-label">Link</label>
                    <input type="url" name="link_url" class="form-control" value="{{ old('link_url', $banner->link_url ?? '') }}" placeholder="https://example.com">
                    <small class="text-muted">Deixe vazio para exibir apenas a imagem.</small>
                    @error('link_url')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-3">
                            <label class="form-label">Ordem</label>
                            <input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order ?? 0) }}">
                            <small class="text-muted">Utilizado para ordenar os banners quando a posição aceita vários itens.</small>
                            @error('sort_order')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="open_new_tab" name="open_new_tab" value="1" {{ old('open_new_tab', $banner->open_new_tab ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="open_new_tab">Abrir link em nova aba</label>
                    @error('open_new_tab')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Ativo</label>
                    @error('is_active')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="card mb-6 card-lg">
            <div class="card-body p-6">
                <div class="mb-3">
                    <label class="form-label">Imagem <span class="text-danger">{{ $editing ? '' : '*' }}</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*" @if(!$editing) required @endif>
                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    @if (old('position'))
                        @php($positionConfig = $positions[old('position')] ?? null)
                    @elseif(isset($banner))
                        @php($positionConfig = $positions[$banner->position] ?? null)
                    @else
                        @php($positionConfig = null)
                    @endif
                    @if($positionConfig && isset($positionConfig['dimensions']))
                        <small class="text-muted d-block mt-2">
                            Dimensões sugeridas: {{ $positionConfig['dimensions']['width'] }}x{{ $positionConfig['dimensions']['height'] }} px
                        </small>
                    @endif
                    @if($positionConfig && isset($positionConfig['notes']))
                        <small class="text-muted d-block">
                            {{ $positionConfig['notes'] }}
                        </small>
                    @endif
                </div>
                @if($editing && $banner->image_path)
                    <div class="mb-3">
                        <span class="d-block fw-semibold mb-2">Pré-visualização</span>
                        <img src="{{ $banner->image_url }}" alt="Banner" class="img-fluid rounded border">
                    </div>
                @endif
                <button type="submit" class="btn btn-primary w-100">
                    {{ $editing ? 'Atualizar Banner' : 'Salvar Banner' }}
                </button>
            </div>
        </div>
    </div>
</div>
