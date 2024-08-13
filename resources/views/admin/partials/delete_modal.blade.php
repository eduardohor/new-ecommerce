<!-- _delete_modal.blade.php -->

<div class="modal fade" id="confirm-deletion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <form id="deleteForm" method="post" action="#" class="p-6">
                @csrf
                @method('delete')

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="d-flex flex-column align-items-center d-flex flex-column gap-6">
                        <div class="bg-danger rounded-circle icon-xl bg-light-danger text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-trash3-fill text-danger" viewBox="0 0 16 16">
                                <path
                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                            </svg>
                        </div>
                        <div class="d-flex flex-column gap-2 text-center">
                            <h3 class="mb-0 h4">Excluir <strong id="resourceName"></strong> </h3>
                            <p class="mb-0">você tem certeza que gostaria de fazer isso?</p>
                        </div>
                        <div class="d-flex flex-row gap-2">
                            <a href="#!" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancelar</a>
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </div>
                    </div>
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
