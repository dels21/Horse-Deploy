           {{--No dan Tipe Identitas --}}
           <div class="row p-0">
            <div class="mt-4 col p-0">
                <x-input-label for="noIdentitas" :value="__('Nomor Identitas')" />
                <x-text-input id="noIdentitas" class="block mt-1 w-full" type="text" name="noIdentitas" :value="old('noIdentitas')" required autofocus autocomplete="noIdentitas" />
                {{-- <x-input-error :messages="$errors->get('noIdentitas')" class="mt-2" /> --}}
            </div>
            <div class="p-1"></div>
            <div class="mt-4 col p-0">
                <x-input-label for="tipeIdentitas" :value="__('Tipe Identitas')" />
                <select type="text" id="tipeIdentitas" class="block mt-1 w-full form-control shadow-sm" name="tipeIdentitas":value="old('tipeIdentitas')">
                    <option style="color: rgba(0, 0, 0, 0.421)">Pilih tipe identitas anda</option>
                    <option>KTP</option>
                    <option>Paspor</option>
                    <option>SIM</option>
                </select>
            </div>
        </div>
        {{--End No dan Tipe Identitas --}}

        {{-- Pekerjaan dan kelamin --}}
        <div class="row p-0">
            <div class="mt-4 col p-0">
                <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                <x-text-input id="pekerjaan" class="block mt-1 w-full" type="text" name="pekerjaan" :value="old('pekerjaan')" required autofocus autocomplete="pekerjaan" />
                {{-- <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2" /> --}}
            </div>
            <div class="p-1"></div>
            <div class="mt-4 col p-0">
                <x-input-label for="jenisKelamin" :value="__('Jenis kelamin')" />
                <select type="text" id="jenisKelamin" class="block mt-1 w-full form-control shadow-sm" name="jenisKelamin":value="old('jenisKelamin')">
                    <option style="color: rgba(0, 0, 0, 0.421)">Pilih jenis kelamin anda</option>
                    <option>Laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
        </div>
        {{-- End Pekerjaan dan kelamin --}}
        {{-- Tempat dan tanggal lahir --}}
        <div class="row p-0">
            <div class="mt-4 col p-0">
                <x-input-label for="tempatLahir" :value="__('Tempat lahir')" />
                <x-text-input id="tempatLahir" class="block mt-1 w-full " type="text" name="tempatLahir" :value="old('tempatLahir')" required autofocus autocomplete="tempatLahir" />
                {{-- <x-input-error :messages="$errors->get('tempatLahir')" class="mt-2" /> --}}
            </div>
            <div class="p-1"></div>
            <div class="mt-4 col p-0">
                <x-input-label for="tanggalLahir" :value="__('Tanggal lahir')" />
                <input id="tanggalLahir" class="block mt-1 w-full form-control shadow-sm" type="date" name="tanggalLahir" :value="old('tanggalLahir')" required autofocus autocomplete="tanggalLahir" placeholder="DD/MM/YYYY">
                {{-- <x-input-error :messages="$errors->get('tanggalLahir')" class="mt-2" /> --}}
            </div>
        </div>
        {{-- End Tempat dan tanggal lahir --}}

        {{-- Alamat dan Kota --}}
        <div class="row p-0">
            <div class="mt-4 col p-0">
                <x-input-label for="alamat" :value="__('Alamat')" />
                <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required autofocus autocomplete="alamat" />
                {{-- <x-input-error :messages="$errors->get('alamat')" class="mt-2" /> --}}
            </div>
            <div class="p-1"></div>
            <div class="mt-4 col p-0">
                <x-input-label for="kota" :value="__('Kota')" />
                <input id="kota" class="block mt-1 w-full form-control shadow-sm" type="text" name="kota" :value="old('kota')" required autofocus autocomplete="kota">
                {{-- <x-input-error :messages="$errors->get('kota')" class="mt-2" /> --}}
            </div>
        </div>
        {{-- End Alamat dan Kota --}}


        <!-- Status Perkawinan and Agama -->
<div class="row p-0">
<div class="mt-4 col p-0">
    <x-input-label for="statusPerkawinan" :value="__('Status Perkawinan')" />
    <select id="statusPerkawinan" class="block mt-1 w-full form-control shadow-sm" name="statusPerkawinan" required autofocus autocomplete="statusPerkawinan">
        <option value="">Pilih status perkawinan</option>
        <option value="menikah">Menikah</option>
        <option value="tidak menikah">Tidak Menikah</option>
    </select>
</div>
<div class="p-1"></div>
<div class="mt-4 col p-0">
    <x-input-label for="agama" :value="__('Agama')" />
    <select id="agama" class="block mt-1 w-full form-control shadow-sm" name="agama" required autofocus autocomplete="agama">
        <option value="">Pilih agama</option>
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Katolik">Katolik</option>
        <option value="Hindu">Hindu</option>
        <option value="Buddha">Buddha</option>
    </select>
</div>
</div>

<!-- Nomor Rumah and Nomor HP -->
<div class="row p-0">
<div class="mt-4 col p-0">
    <x-input-label for="nomorRumah" :value="__('Nomor Rumah')" />
    <x-text-input id="nomorRumah" class="block mt-1 w-full" type="text" name="nomorRumah" :value="old('nomorRumah')" required autofocus autocomplete="nomorRumah" />
</div>
<div class="p-1"></div>
<div class="mt-4 col p-0">
    <x-input-label for="nomorHp" :value="__('Nomor HP')" />
    <x-text-input id="nomorHp" class="block mt-1 w-full" type="text" name="nomorHp" :value="old('nomorHp')" required autofocus autocomplete="nomorHp" />
</div>
</div>

<!-- Nama Kontak Darurat and Nomor Darurat -->
<div class="row p-0">
<div class="mt-4 col p-0">
    <x-input-label for="namaKontakDarurat" :value="__('Nama Kontak Darurat')" />
    <x-text-input id="namaKontakDarurat" class="block mt-1 w-full" type="text" name="namaKontakDarurat" :value="old('namaKontakDarurat')" required autofocus autocomplete="namaKontakDarurat" />
</div>
<div class="p-1"></div>
<div class="mt-4 col p-0">
    <x-input-label for="nomorDarurat" :value="__('Nomor Darurat')" />
    <x-text-input id="nomorDarurat" class="block mt-1 w-full" type="text" name="nomorDarurat" :value="old('nomorDarurat')" required autofocus autocomplete="nomorDarurat" />
</div>
</div>

<!-- Kewarganegaraan and Tanggal Daftar -->
<div class="row p-0">
<div class="mt-4 col p-0">
    <x-input-label for="kewarganegaraan" :value="__('Kewarganegaraan')" />
    <x-text-input id="kewarganegaraan" class="block mt-1 w-full" type="text" name="kewarganegaraan" :value="old('kewarganegaraan')" required autofocus autocomplete="kewarganegaraan" />
</div>
<div class="p-1"></div>
<div class="mt-4 col p-0">
    <x-input-label for="tanggalDaftar" :value="__('Tanggal Daftar')" />
    <input id="tanggalDaftar" class="block mt-1 w-full form-control" type="date" name="tanggalDaftar" value="{{ now()->format('Y-m-d') }}" required autofocus autocomplete="tanggalDaftar" placeholder="DD/MM/YYYY" disabled>
    <input type="hidden" name="tanggalDaftar" value="{{ now()->format('Y-m-d') }}">
</div>

</div>

<!-- Alergi and Golongan Darah -->
<div class="row p-0">
<div class="mt-4 col p-0 shadow-sm">
    <label for="alergi">Alergi</label>
    <input id="alergi" class="block mt-1 w-full form-control" name="alergi" required autofocus autocomplete="alergi">{{ old('alergi') }}</input>
</div>
<div class="p-1"></div>
<div class="mt-4 col p-0">
    <x-input-label for="golonganDarah" :value="__('Golongan Darah')" />
    <select id="golonganDarah" class="block mt-1 w-full form-control shadow-sm" name="golonganDarah" required autofocus autocomplete="golonganDarah">
        <option value="">Pilih golongan darah</option>
        <option value="A+">A+</option>
        <option value="B+">B+</option>
        <option value="AB+">AB+</option>
        <option value="O+">O+</option>
        <option value="A-">A-</option>
        <option value="B-">B-</option>
        <option value="AB-">AB-</option>
        <option value="O-">O-</option>
    </select>
</div>

</div>

<!-- Tinggi Badan and Berat Badan -->
<div class="row p-0">
<div class="mt-4 col p-0">
    <x-input-label for="tinggiBadan" :value="__('Tinggi Badan')" />
    <x-text-input id="tinggiBadan" class="block mt-1 w-full" type="number" name="tinggiBadan" :value="old('tinggiBadan')" required autofocus autocomplete="tinggiBadan" />
</div>
<div class="p-1"></div>
<div class="mt-4 col p-0">
    <x-input-label for="beratBadan" :value="__('Berat Badan')" />
    <x-text-input id="beratBadan" class="block mt-1 w-full" type="number" name="beratBadan" :value="old('beratBadan')" required autofocus autocomplete="beratBadan" />
</div>
</div>
