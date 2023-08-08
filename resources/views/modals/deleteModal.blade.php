<div id="deleteModal" tabindex="-1" aria-hidden="true" class="modal">
    <div class="modal-top">
        <!-- Modal content -->
        <div class="modal-content-delete">
            <button type="button" class="btn-modal" data-modal-hide="authentication-modal">
                <svg style="width: 12px; height: 12px;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="modal-body">
                <svg class="delete-icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <p class="confirm-text">Are you sure you want to delete this item?</p>
                <div class="button-group">
                    <button type="button" class="btn-no">
                        Tidak
                    </button>
                    <form action="{{ route('deleteUser') }}" method="post" id="deleteForm" style="display: inline-block">
                        @csrf
                        <input type="text" name="delete_id" id="delete_id" hidden>
                        <button type="submit" class="btn-yes">
                            Ya
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var deleteUserURL = "{{ route('deleteUser') }}";
    var deleteCityURL = "{{ route('deleteCity') }}";
</script>