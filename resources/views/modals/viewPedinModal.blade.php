<div id="viewPerdin-modal" tabindex="-1" aria-hidden="true" class="modal">
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
                <h3 class="modal-title">Approval Pengajuan Perdin</h3>
                <div style="margin-top: 16px;">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" value="Abdurikho Min Khoiri" disabled>
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <input type="text" name="city_from" id="city_from" value="Bandung" disabled>
                        <i class="fa fa-arrow-right input-arrow"></i>
                        <input type="text" name="city_to" id="city_to" value="Surabaya" disabled>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="text" name="date_from" id="date_from" value="28 September 2022" disabled>
                        <i class="fa fa-arrow-right input-arrow"></i>
                        <input type="text" name="date_to" id="date_to" value="1 Oktober 2022" disabled>
                    </div>
                    <div class="form-group">
                        <label for="information">Keterangan</label>
                        <textarea name="information" id="information" disabled>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo numquam ad impedit facere maxime dicta laborum accusantium sapiente ipsa reprehenderit corrupti quisquam consequuntur quas, iure vero assumenda harum autem at.</textarea>
                    </div>
                    <div class="form-info">
                        <table>
                            <tr class="info-head">
                                <td>Total Hari</td>
                                <td>Jarak Tempuh</td>
                                <td>Total Uang Perdin</td>
                            </tr>
                            <tr class="info-content">
                                <td><span class="data-day"></span> Hari</td>
                                <td>
                                    <span class="data-distance"></span> KM
                                    <div class="perdin-fee">Rp250.000,- / Hari</div>
                                    <div class="perdin-clasification">Jarak > 60km</div>
                                </td>
                                <td><span class="data-fee"></span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="button-group">
                        <form action="{{ route('rejectPerdin') }}" method="post" style="display: inline-block">
                            @csrf
                            <input type="text" name="reject_id" id="reject_id" hidden>
                            <button type="submit" class="btn-reject">Reject</button>
                        </form>
                        <form action="{{ route('approvePerdin') }}" method="post" style="display: inline-block">
                            @csrf
                            <input type="text" name="approve_id" id="approve_id" hidden>
                            <button type="submit" class="btn-approve">Approve</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 