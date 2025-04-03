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
            <x-slot:title>Galeri</x-slot>
            <x-slot:icon>image</x-slot>
            <x-slot:url>{{ url("admin/galeri") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Activity</x-slot>
            <x-slot:icon>sports_kabaddi</x-slot>
            <x-slot:url>{{ url("admin/activity") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Blog</x-slot>
            <x-slot:icon>news</x-slot>
            <x-slot:url>{{ url("admin/blog") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Package</x-slot>
            <x-slot:icon>style</x-slot>
            <x-slot:url>{{ url("admin/package") }}</x-slot>
        </x-partials.dashboard.quickmenu>
    </div>

    <div class="row g-1 g-lg-3">
        <x-partials.dashboard.infomenu>
            <x-slot:title>Galeri</x-slot>
            <x-slot:icon>image</x-slot>
            <x-slot:info>{{ $jmlGaleri }} Total Galeri</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Activity</x-slot>
            <x-slot:icon>sports_kabaddi</x-slot>
            <x-slot:info>{{ $jmlKegiatan }} Total Activity</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Blog</x-slot>
            <x-slot:icon>news</x-slot>
            <x-slot:info>{{ $jmlBlog }} Total Blog</x-slot>
        </x-partials.dashboard.infomenu>
    </div>


</div>
