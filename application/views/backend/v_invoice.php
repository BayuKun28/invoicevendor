
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
                        <?php if($this->session->userdata('access')=='1'):?>
                        <p class="text-subtitle text-muted">Filter Data</p>
                        <form id="form-filter">
                            <div class="row">
                            <div class="col-12 col-md-4">
                                <select class="form-select id_vendor" name="id_vendor" id="id_vendor" style="width:100%" required>
                                    <option value="">[Pilih Vendor]</option>
                                    <?php foreach ($vendors->result() as $row) : ?>
                                        <option value="<?php echo $row->id;?>"><?php echo $row->nama;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <select class="form-select" name="status_pembayaran" id="status_pembayaran" style="width:100%" required>
                                    <option value="">[Pilih Status]</option>
                                        <option value="Rencana Pembayaran">Rencana Pembayaran</option>
                                        <option value="Sudah Dibayar">Sudah Dibayar</option>
                                </select>
                            </div>
                                    <div class="col-12 col-md-4">
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <button type="button" id="btn-filter" class="btn btn-primary"><i class="bi bi-search"></i> Filter Data</button>&nbsp;&nbsp;
                                    <button type="button" id="btn-reset" class="btn btn-success"><i class="bi bi-bootstrap-reboot"></i> Refresh</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    <hr>
                        <?php else:?>

                        <?php endif;?>
                <!-- FILTER -->
                <a class="btn icon btn-sm btn-success float-end" onclick="add_invoice()"><i class="bi bi-plus"></i></a>&nbsp;&nbsp;
                <br/><br/>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kwitansi</th>
                            <th>Nominal(Rp)</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
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

    //datatables
    table = $('#mytable').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('backend/invoice/get_ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.status_pembayaran = $('#status_pembayaran').val(),
                data.id_vendor = $('#id_vendor').val()
            }
        },


        "columnDefs": [
        {
            "targets": [ 0,1,2,3,4 ],
            "orderable": false,
        },
        ],

    });


    
    $('#btn-filter').click(function(){
        table.ajax.reload();
    });
    $('#btn-reset').click(function(){
        $('#form-filter')[0].reset();
        $("#id_vendor").select2("destroy");
        $("#id_vendor").select2({
                cache: false,
                theme: "bootstrap-5",
        });
        table.ajax.reload();
    });

            $("#id_vendor").select2({
                cache: false,
                theme: "bootstrap-5"
            });

            $("#vendor").select2({
                cache: false,
                theme: "bootstrap-5",
                dropdownParent: $('#forminvoice')
            });

});



function add_invoice()
{
    save_method = 'add';
    $('#forminvoice')[0].reset();
    $('.show_edit').empty(); // clear error class
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $("#vendor").select2("destroy");
    $("#vendor").select2({
                cache: false,
                theme: "bootstrap-5",
                dropdownParent: $('#forminvoice')
            }); 
    $("#vendor").val('').trigger('change');
    $('#modal_form_invoice').modal('show');
    $('.modal-title').text('Tambah Invoice');

}

function edit_invoice(id_invoice)
{
    save_method = 'update';
    $('#forminvoice')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form_invoice').modal('show');
    $('.modal-title').text('Edit Invoice');
    
    var base_url = '<?php echo base_url(); ?>';
    $.ajax({
        url : "<?php echo site_url('backend/invoice/ajax_edit/')?>/" + id_invoice,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
                $('[name="id"]').val(data.id);
                $('[name="kwitansi"]').val(data.kwitansi);
                $('[name="nominal"]').val(data.nominal);
                $('[name="tgl_pembayaran"]').val(data.tgl_pembayaran);
                $('[name="status"]').val(data.status);
                $("#vendor").select2({
                    dropdownParent: $("#forminvoice"),
                    cache: false,
                    theme: "bootstrap-5",
                }).val(data.id_vendor).trigger("change");
                $('#modal_form_invoice').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false);
}

function addinvoice()
{
    var id = $(".id").val();
    var kwitansi = $("#kwitansi").val();
    var nominal = $("#nominal").val();
    var tgl_pembayaran = $("#tgl_pembayaran").val();
    var status = $("#status").val();
    var vendor = $("#vendor").val();

    var fd = new FormData();
    fd.append("id", id);
    fd.append("vendor", vendor);
    fd.append("kwitansi", kwitansi);
    fd.append("nominal", nominal);
    fd.append("tgl_pembayaran", tgl_pembayaran);
    fd.append("status", status);
    fd.append("<?php echo $this->security->get_csrf_token_name(); ?>", '<?php echo $this->security->get_csrf_hash(); ?>');
    $('#btnSave').text('saving...');
    $('#btnSave').attr('disabled',true);
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('backend/Invoice/add')?>";
    } else {
        url = "<?php echo site_url('backend/Invoice/edit')?>";
    }

    $.ajax({
        url : url,
        type: "POST",
        url : url,
        data: fd,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data)
        {

            if(data.status)
            {
                toastify_success();
                $('#modal_form_invoice').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    $("#vendor").select2({
                        cache: false,
                        theme: "bootstrap-5",
                        dropdownParent: $('#forminvoice')
                    }); 
                }
            }
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false);


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false);

        }
    });
}

$(document).on("click", "#del", function(e) {
        e.preventDefault();
        var idkon = $(this).attr("value");
        console.log(idkon);
        Swal.fire({
            title: "Apakah kamu yakin ingin menghapus Invoice ini?",
            text: "Data ini akan di hapus secara Permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url : "<?php echo site_url('backend/Invoice/delete')?>",
                    data: {
                        idkon: idkon,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.res == "success") {
                            Swal.fire(
                                "Deleted!",
                                "Data berhasil dihapus.",
                                "success"
                            );

                            reload_table();
                        }
                    },
                });
            }
        });
    });
</script>
</body>
</html>
