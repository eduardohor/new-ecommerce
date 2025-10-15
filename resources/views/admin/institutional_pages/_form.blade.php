<div class="card">
  <div class="card-body">
    <div class="mb-4">
      <label for="title" class="form-label">Título</label>
      <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $page->title) }}" required>
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-4">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror"
        value="{{ old('slug', $page->slug) }}" required>
      <small class="text-muted">Utilizado na URL da página. Apenas letras, números e hífens.</small>
      @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-4">
      <label class="form-label" for="editor">Conteúdo</label>
      <div class="py-4" id="editor"></div>
      <input type="hidden" name="content" id="description" value="{{ old('content', $page->content) }}">
      <small class="text-muted">O conteúdo aceita formatação rica (negrito, listas, links, imagens e vídeos).</small>
      @error('content')
        <span class="text-danger d-block mt-2">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active"
        {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_active">Página ativa</label>
    </div>
  </div>
  <div class="card-footer text-end">
    <a href="{{ route('institutional-pages.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
  </div>
</div>
