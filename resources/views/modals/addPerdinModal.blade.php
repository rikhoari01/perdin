<div id="addPerdin-modal" tabindex="-1" aria-hidden="true" class="modal">
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
                <h3 class="modal-title">Tambah Perdin</h3>
                <form style="margin-top: 16px;" action="{{ route('storePerdin') }}" method="POST" id="formPerdin">
                    @csrf
                    <input type="text" name="total_day" id="total_day" hidden>
                    <div class="form-group-2">
                        <label for="city">Kota</label>
                        <div class="input-group">
                            <select name="city_from" id="city_from">
                                <option disabled selected>Pilih Kota</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                @endforeach
                            </select>
                            <i class="fa fa-arrow-right input-arrow"></i>
                            <select name="city_to" id="city_to">
                                <option disabled selected>Pilih Kota</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group-2">
                        <label for="date">Tanggal</label>
                        <div class="input-group">
                            <input type="date" name="date_from" id="date_from">
                            <div class="fa fa-arrow-right input-arrow"></div>
                            <input type="date" name="date_to" id="date_to">
                        </div>
                    </div>
                    <div class="form-group-2">
                        <label for="information">Keterangan</label>
                        <textarea name="information" id="information"></textarea>
                    </div>
                    <div class="form-info-2">
                        <h5 class="info-title">Total Perjalanan Dinas</h5>
                        <div class="total-perdin">
                            <span class="day">0</span>
                            Hari
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-add">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 