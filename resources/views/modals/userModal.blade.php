<div id="addUser-modal" tabindex="-1" aria-hidden="true" class="modal">
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
                <h3 class="modal-title">Tambah Akun Pegawai</h3>
                <form style="margin-top: 16px;" action="{{ route('storeUser') }}" method="POST" id="formUser">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group password">
                        <label for="passsword">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password">
                        <i class="fa fa-eye show-password"></i>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Nama Pegawai">
                    </div>
                    <div class="form-group">
                        <label for="role">Divisi</label>
                        <select name="role" id="role">
                            <option value="sdm">SDM</option>
                            <option value="pegawai">Pegawai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-add" id="userBtn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<script>
    var addUserURL = "{{ route('storeUser') }}";
    var updateUserURL = "{{ route('updateUser') }}";
</script>