<!-- _delete_modal.blade.php -->

<div class="modal fade" id="confirm-deletion" tabindex="-1" aria-labelledby="confirm-deletion-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteForm" method="post" action="#" class="p-6">
        @csrf
        @method('delete')

        <div class="modal-header">
          <h5 class="modal-title" id="confirm-deletion-label">
            Tem certeza de que deseja excluir?
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <h5 class="mt-1 text-xl text-gray-600">
            Nome: <strong id="resourceName"></strong>
          </h5>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" class="btn btn-danger">
            Excluir
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function showDeleteModal(resourceName, deleteRoute) {
      $('#resourceName').text(resourceName);
      $('#deleteForm').attr('action', deleteRoute);
      $('#confirm-deletion-modal').modal('show');
  }
</script>