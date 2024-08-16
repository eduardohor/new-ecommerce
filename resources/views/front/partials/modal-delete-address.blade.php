<div class="modal fade" id="deleteModal{{ $address->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <!-- modal content -->
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Excluir endereço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- modal body -->
            <div class="modal-body">
                <h6>Tem certeza de que deseja excluir este endereço?</h6>
                <p class="mb-6">{{ $address->city }}, {{ $address->zip_code }}<br>
                    {{ $address->neighborhood }}, {{ $address->street }}<br>
                    Nº {{ $address->number }}, {{ $address->complement }}<br>
                    {{ $address->state }}</p>
            </div>
            <!-- modal footer -->
            <div class="modal-footer">
                <!-- btn -->
                <button type="button" class="btn btn-outline-gray-400" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('address.destroy', $address->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
