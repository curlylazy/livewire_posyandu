<div>
    <section id="contact" class="contact section">
        <div class="container section-title">
            <h2>Profile</h2>

            <x-partials.loader />
            <x-partials.flashmsg />

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mt-5">
                <div class="col-lg-4 text-start">
                    <div class="fs-sm">Nama</div>
                    <div class="h4">{{ $dataAnggota->namaanggota }}</div>
                    <hr />
                    <div class="fs-sm">NIS</div>
                    <div class="h4">{{ $dataAnggota->nis }}</div>
                    <hr />
                    <div class="fs-sm">Kelas</div>
                    <div class="h4">{{ $dataAnggota->namakelas }}</div>
                    <hr />
                    <div class="fs-sm">Email</div>
                    <div class="h4">{{ $dataAnggota->email }}</div>
                    <hr />
                    <div class="fs-sm">No Telepon</div>
                    <div class="h4">{{ $dataAnggota->notelepon }}</div>
                    <hr />
                    <div class="fs-sm">Angkatan</div>
                    <div class="h4">{{ $dataAnggota->angkatan }}</div>
                    <hr />
                    <div class="fs-sm">Profile</div>
                    <div>
                        <img src="{{ ImageUtils::getImage($form->gambaranggota) }}" style="width: 200px; height: 200px; object-fit: cover;" class="rounded mt-2">
                    </div>
                </div>
                <div class="col-lg-8 text-start">
                    <form wire:submit="save">
                        <h4>Edit Profile</h4>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="namaanggota" wire:model='form.namaanggota'>
                                    <label for="namaanggota">Nama Anggota</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="password" wire:model='form.password'>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="notelepon" wire:model='form.notelepon'>
                                    <label for="notelepon">No Telepon</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" wire:model='form.email'>
                                    <label for="email">No Email</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="jk_l" value="L" wire:model='form.jk'>
                                    <label class="form-check-label" for="jk_l">Laki Laki</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="jk_p" value="P" wire:model='form.jk'>
                                    <label class="form-check-label" for="jk_p">Perempuan</label>
                                  </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="form.gambaranggotaFile" class="form-label">Gambar</label>
                                <input class="form-control" type="file" id="form.gambaranggotaFile" wire:model='form.gambaranggotaFile'>
                                @if ($form->gambaranggotaFile)
                                    <img src="{{ $form->gambaranggotaFile->temporaryUrl() }}" style="width: 500px; height: 500px; object-fit: cover;" class="rounded mt-2">
                                @endif
                            </div>
                        </div>

                        <div class="d-flex mt-3 gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
