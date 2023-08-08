<div id="cityModal" tabindex="-1" aria-hidden="true" class="modal">
    <div class="modal-top">
        <!-- Modal content -->
        <div class="modal-content">
            <button type="button" class="btn-modal" data-modal-hide="authentication-modal">
                <svg style="width: 12px; height: 12px;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="modal-body">
                <h3 class="modal-title">Tambah Kota</h3>
                <form style="margin-top: 16px;" action="{{ route('storeCity') }}" method="POST" id="formCity">
                    @csrf
                    <input type="text" name="id" id="id" hidden>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <input type="text" name="city" id="city" placeholder="Nama Kota">
                    </div>
                    <div class="form-group">
                        <label for="province">Provinsi</label>
                        <input type="text" name="province" id="province" placeholder="Nama Provinsi">
                    </div>
                    <div class="form-group">
                        <label for="island">Pulau</label>
                        <input type="text" name="island" id="island" placeholder="Nama Pulau">
                    </div>
                    <div class="form-group">
                        <label for="is_overseas">Apakah di luar negeri?</label>
                        <select name="is_overseas" id="is_overseas">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" name="latitude" id="latitude" placeholder="Latitude">
                    </div>
                    <div class="form-group">
                        <label for="longtitude">Longtitude</label>
                        <input type="text" name="longtitude" id="longtitude" placeholder="Longtitude">
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-add" id="cityBtn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<script>
    var addCityURL = "{{ route('storeCity') }}";
    var updateCityURL = "{{ route('updateCity') }}";
</script>