<div>



    <x-partials.loader />

    {{-- <div class="border border-3">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2" style="height: 150px;">
            <div>Halo Semuanya</div>
            <div>Aman ?</div>
        </div>
    </div> --}}

    <div class="row g-2 mb-3">
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pasien</x-slot>
            <x-slot:icon>pregnancy</x-slot>
            <x-slot:url>{{ url("admin/pasien") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>User</x-slot>
            <x-slot:icon>person</x-slot>
            <x-slot:url>{{ url("admin/pasien") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Posyandu</x-slot>
            <x-slot:icon>family_home</x-slot>
            <x-slot:url>{{ url("admin/posyandu") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pemeriksaan Bayi</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:url>{{ url("admin/pemeriksaan/bayi") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pemeriksaan Ibu Hamil</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:url>{{ url("admin/pemeriksaan/bumil") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pemeriksaan Nifas</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:url>{{ url("admin/pemeriksaan/nifas") }}</x-slot>
        </x-partials.dashboard.quickmenu>
    </div>

    <div class="row g-1 g-lg-3">
        <x-partials.dashboard.infomenu>
            <x-slot:title>Pasien</x-slot>
            <x-slot:icon>pregnancy</x-slot>
            <x-slot:info>{{ $jmlPasien }} Total Pasien</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Bayi</x-slot>
            <x-slot:icon>breastfeeding</x-slot>
            <x-slot:info>{{ $jmlBayi }} Total Bayi</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Pemiksaan Tahun {{ date('Y') }}</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:info>{{ $jmlPeriksaTahunIni }} Pemeriksaan</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Pemiksaan Bulan {{ Carbon\Carbon::now()->translatedFormat('F') }}</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:info>{{ $jmlPeriksaBulanIni }} Pemeriksaan</x-slot>
        </x-partials.dashboard.infomenu>
    </div>


</div>
