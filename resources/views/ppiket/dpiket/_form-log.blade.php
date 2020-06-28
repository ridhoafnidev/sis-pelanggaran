<div class="card-body">
    <!-- log -->

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="title">Pelanggaran</label>
                <input class="form-control" type="text" value="{{$logPelanggaran[0]->jenis_pelanggaran}}" readonly />
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="title">Guru</label>
                <input class="form-control" type="text" value="{{$logPelanggaran[0]->nama_guru}}" readonly />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="title">Kehadiran</label>
                <input class="form-control" type="text" value="{{$logPelanggaran[0]->jenis_kehadiran}}" readonly />
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="title">Petugas Piket</label>
                <input class="form-control" type="text" value="{{$logPelanggaran[0]->nama_petugas}}" readonly />
            </div>
        </div>
    </div>
    <!-- endlog -->
</div>