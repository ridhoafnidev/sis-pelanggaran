@if($pelanggaran[0]->total_poin <= 20)
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-heading"><b>Sanksi:</b> <i>Peringatan Lisan!</i></strong>
    </div>
@elseif($pelanggaran[0]->total_poin <= 49)
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-heading"><b>Sanksi:</b> <i>Peringatan Tulisan dan penindakan oleh Tim Disiplin selama 2 hari!</i></strong>
    </div>
@elseif($pelanggaran[0]->total_poin <= 70)
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-heading"><b>Sanksi:</b> <i>SP1 dan pemanggilan orang tua serta penindakan oleh Tim Disiplin selama 5 hari!</i></strong>
    </div>
@elseif($pelanggaran[0]->total_poin <= 80)
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-heading"><b>Sanksi:</b> <i>SP2 dan pemanggilan orang tua serta penindakan oleh Tim Disiplin selama 7 hari!</i></strong>
    </div>
@elseif($pelanggaran[0]->total_poin <= 99)
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-heading"><b>Sanksi:</b> <i>SP3 dan pemanggilan orang tua serta penindakan oleh Tim Disiplin selama 10 hari!</i></strong>
    </div>
@elseif($pelanggaran[0]->total_poin >= 100)
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-heading"><b>Sanksi:</b> <i>Dikembalikan kepada orang tua!</i></strong>
    </div>
@endif