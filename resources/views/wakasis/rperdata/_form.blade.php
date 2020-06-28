<div class="card-body">


        <div class="form-group">
           
            <label for="title">Nama Guru</label>
            <input class="form-control" required="required" type="text" readonly="true" value="{{$data[0]->guru}}"/>
        </div>

        <div class="form-group"> 
            <label for="title">Kehadiran</label>
            <input class="form-control" required="required" name="kehadiran" type="text" readonly="true" value="{{$data[0]->kehadiran}}"/>
            
        </div>
        <div class="form-group"> 
            <label for="title">Petugas Piket</label>
            <input class="form-control" required="required" name="nama_petugas" type="text" readonly="true" value="{{$data[0]->petugas}}"/>
            
        </div>
    <div class="card-footer bg-transparent">
        <button class="btn btn-primary" type="button" name="save">
            Print
        </button>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
