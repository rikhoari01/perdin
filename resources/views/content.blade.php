<section class="content">
    <div class="content-title">
        Dashboard  
        <i class="fa fa-angle-right"></i>  
        @if(Auth::user()->role == 'admin')
            Kelola Pengguna
        @endif

        @if(Auth::user()->role == 'sdm' && request()->is('dashboard'))
            Kelola Perdin
        @elseif(Auth::user()->role == 'sdm' && request()->is('master-city'))
            Kelola Kota
        @endif

        @if(Auth::user()->role == 'pegawai')
            Kelola Perdinku
        @endif
    </div>
    <div class="content-container">
        @if(Auth::user()->role == 'admin')
            <div class="btn-content">
                <button id="addUser" class="btn-add"><i class="fa fa-add"></i> Tambah Pegawai</button>
            </div>
        @endif

        @if(Auth::user()->role == 'pegawai')
            <div class="btn-content">
                <button id="addPerdin" class="btn-add"><i class="fa fa-add"></i> Tambah Perdinku</button>
            </div>
        @endif

        @if(Auth::user()->role == 'sdm')
            @if(request()->is('master-city'))
                <div class="btn-content">
                    <button id="addCity" class="btn-add"><i class="fa fa-add"></i> Tambah Kota</button>
                </div>
            @else
                <ul class="menu-tab">
                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            Pengajuan Baru
                            <div class="new-perdin">{{ count($perdin) }}</div>
                        </a>
                    </li>
                    <li class="{{ request()->is('history') ? 'active' : '' }}">
                        <a href="{{ route('history') }}">
                            Histori Pengajuan
                        </a>
                    </li>
                </ul>
            @endif
        @endif
        <table class="table" id="Table" width="100%" cellspacing="0">
            <thead>
                @if(Auth::user()->role == 'admin')
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Pegawai</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                @endif

                @if(Auth::user()->role == 'pegawai')
                    <tr>
                        <th>No</th>
                        <th>Kota</th>
                        <th>Tanggal</th>
                        <th class="perdin-info">Keterangan</th>
                        <th>Status</th>
                    </tr>
                @endif

                @if(Auth::user()->role == 'sdm')
                    @if(request()->is('master-city'))
                        <tr>
                            <th>No</th>
                            <th>Nama Kota</th>
                            <th>Provinsi</th>
                            <th>Pulau</th>
                            <th>Luar Negeri</th>
                            <th>Latitude</th>
                            <th>Longtitude</th>
                            <th>Aksi</th>
                        </tr>
                    @else
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Kota</th>
                            <th>Tanggal</th>
                            <th class="perdin-info">Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    @endif
                @endif
            </thead>
            <tbody>
                @if(Auth::user()->role == 'admin')
                    @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ ($user->status == 1) ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td>
                            <button class="btn-edit edit-user" data-username="{{ $user->username }}" data-name="{{ $user->name }}" data-role="{{ $user->role }}" data-status="{{ $user->status }}"><i class="fa fa-pencil"></i></button>
                            <button class="btn-delete delete-user" data-id="{{ $user->id }}" data-username="{{ $user->username }}"><i class="fa fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                @endif

                @if(Auth::user()->role == 'sdm')
                    @if(request()->is('master-city'))
                        @foreach($cities as $index => $city)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $city->city }}</td>
                                <td>{{ $city->province }}</td>
                                <td>{{ $city->island }}</td>
                                <td>{{ $city->is_overseas ? "Ya" : "Tidak" }}</td>
                                <td>{{ $city->latitude }}</td>
                                <td>{{ $city->longtitude }}</td>
                                <td>
                                    <button class="btn-edit edit-city" data-id="{{ $city->id }}" data-city="{{ $city->city }}" data-province="{{ $city->province }}" data-island="{{ $city->island }}" data-is_overseas="{{ $city->is_overseas }}" data-latitude="{{ $city->latitude }}" data-longtitude="{{ $city->longtitude }}"><i class="fa fa-pencil"></i></button>
                                    <button class="btn-delete delete-city" data-id="{{ $city->id }}" data-city="{{ $city->city }}" ><i class="fa fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @elseif(request()->is('dashboard'))
                        @foreach($perdin as $index => $item)
                            @php
                                $user      = \App\Models\User::find($item->user_id)->name;
                                $city1     = \App\Models\City::find($item->city_from);
                                $city2     = \App\Models\City::find($item->city_to);
                                $city_from = $city1->city;
                                $city_to   = $city2->city;
                                $date_from = \Carbon\Carbon::parse($item->date_from)->format('d F Y');
                                $date_to   = \Carbon\Carbon::parse($item->date_to)->format('d F Y');
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user }}</td>
                                <td>{{ $city_from }} <i class="fa fa-arrow-right"></i> {{ $city_to }}</td>
                                <td>{{ $date_from }} - {{ $date_to }} <div class="total-day">({{ $item->total_day }} hari)</div></td>
                                <td>{{ $item->information }}</td>
                                <td>
                                    <button class="btn-view perdin-view" data-id="{{ $item->id }}"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($history as $index => $item)
                            @php
                                $user      = \App\Models\User::find($item->user_id)->name;
                                $city1     = \App\Models\City::find($item->city_from);
                                $city2     = \App\Models\City::find($item->city_to);
                                $city_from = $city1->city;
                                $city_to   = $city2->city;
                                $date_from = \Carbon\Carbon::parse($item->date_from)->format('d F Y');
                                $date_to   = \Carbon\Carbon::parse($item->date_to)->format('d F Y');
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user }}</td>
                                <td>{{ $city_from }} <i class="fa fa-arrow-right"></i> {{ $city_to }}</td>
                                <td>{{ $date_from }} - {{ $date_to }} <div class="total-day">({{ $item->total_day }} hari)</div></td>
                                <td>{{ $item->information }}</td>
                                <td>
                                    @if($item->status == 'pending')
                                        <span class="pending">Pending</span>
                                    @elseif($item->status == 'approved')
                                        <span class="approve">Approved</span>
                                    @else
                                        <span class="reject">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endif

                @if(Auth::user()->role == 'pegawai')
                    @foreach($perdin as $index => $item)
                        @php
                            $city_from = \App\Models\City::find($item->city_from)->city;
                            $city_to   = \App\Models\City::find($item->city_to)->city;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $city_from }} <i class="fa fa-arrow-right"></i> {{ $city_to }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date_from)->format('d F Y') }} - {{ \Carbon\Carbon::parse($item->date_to)->format('d F Y') }} <div class="total-day">({{ $item->total_day }} hari)</div></td>
                            <td>{{ $item->information }}</td>
                            <td>
                                @if($item->status == 'pending')
                                    <span class="pending">Pending</span>
                                @elseif($item->status == 'approved')
                                    <span class="approve">Approved</span>
                                @else
                                    <span class="reject">Rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
      </table>
    </div>

    <footer>
        <div class="footer-text">&copy Copyright 2023 | Made with <i class="fa fa-heart"></i> by <a href="https://github.com/rikhoari01" target="_blank" rel="noopener noreferrer">Rikho Ari</a></div>
    </footer>
</section>
<script>
    var userURL   = "{{ route('indexUser') }}";
    var perdinURL = "{{ route('indexPerdin') }}";
    var cityURL   = "{{ route('indexCity') }}";
</script>