
<div class="page-content">
    <!------- breadcrumb --------->
        <?php $this->load->view("backend/_partials/breadcrumb.php") ?>
    <!------- breadcrumb --------->
    <section id="input-validation">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
            <div class="card-body">
                <!-- FILTER -->
                        <p class="text-subtitle text-muted">Cari</p>
                        <form id="form-filter">
                            <div class="row">
                            <div class="col-12 col-md-4">
                            <input type="text" class="form-control" name="kwitansihidden" id="kwitansihidden" placeholder="Ketik Kwitansi Disini" style="display: none;"> 
                            <input type="text" class="form-control kwitansi" name="kwitansi" id="kwitansi" placeholder="Ketik Kwitansi Disini">   
                            </div>
                                    <div class="col-12 col-md-4">
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <button type="button" id="btn-filter" class="btn btn-primary"><i class="bi bi-search"></i> Cek</button>&nbsp;&nbsp;
                                    <button type="button" id="btn-reset" class="btn btn-success"><i class="bi bi-bootstrap-reboot"></i> Refresh</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    <hr>
                <!-- FILTER -->
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Vendor</th>
                            <th>Kwitansi</th>
                            <th>Nominal(Rp)</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </div>
                </div>
            </div>
        </div>
    </section>
</div>
        <!------- FOOTER --------->
            <?php $this->load->view("backend/_partials/footer.php") ?>
        <!------- FOOTER --------->
        </div>
    </div>
<!------- TOASTIFY JS --------->
    <?php $this->load->view("backend/_partials/toastify.php") ?>

<!------- TOASTIFY JS --------->
<script type="application/javascript">
var save_method;
var table;
var csfrData = {};
csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo
$this->security->get_csrf_hash(); ?>';
$.ajaxSetup({
data: csfrData
});
$(document).ready(function() {

    $('#kwitansihidden').val('defaultkosong');

    //datatables
    table = $('#mytable').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('backend/CekInvoice/get_ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.kwitansi = $('#kwitansihidden').val();
            }
        },


        "columnDefs": [
        {
            "targets": [ 0,1,2,3,4,5 ],
            "orderable": false,
        },
        ],

    });

    $('#btn-filter').click(function(){
        table.ajax.reload();
    });
    $('#btn-reset').click(function(){
        $('#form-filter')[0].reset();
        $('#kwitansihidden').val('defaultkosong');
        table.ajax.reload();
    });

    $("#kwitansi").keyup(function(){
        $('#kwitansihidden').val(this.value);
    });

});

function reload_table()
{
    table.ajax.reload(null,false);
}
</script>
</body>
</html>
