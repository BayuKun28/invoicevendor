
<!-- MODAL -->

<!-- Add Update Modal -->
<div class="modal fade text-left" id="modal_form_invoice" role="dialog"
            aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        
                        <h3 class="modal-title white" id="myModalLabel120"></h3>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
            <div class="modal-body form">
                        
                        <?php
                            $attributes = array('class' => 'form-horizontal', 'id' => 'forminvoice');
                            echo form_open($this->uri->uri_string(), $attributes);
                        ?>      
                        <div class="row">
                            <input type="hidden" class="id" name="id"/> 
                            <div class="col-12 col-md-12">
                            <label for="vendor">Vendor</b></label>
                                <select class="form-select id_vendor" name="vendor" id="vendor" style="width:100%" required>
                                    <option value="">[Pilih Vendor]</option>
                                    <?php foreach ($vendors->result() as $row) : ?>
                                        <option value="<?php echo $row->id;?>"><?php echo $row->nama;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="kwitansi">Kwitansi</b></label>
                                    <input type="text" name="kwitansi" class="form-control" id="kwitansi" placeholder="Masukkan Kwitansi" required>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nominal">Nominal</b></label>
                                    <input type="number" name="nominal" class="form-control" id="nominal" placeholder="Masukkan Nominal" required>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tgl_pembayaran">Tanggal Pembayaran</b></label>
                                    <input type="date" name="tgl_pembayaran" class="form-control" id="tgl_pembayaran" placeholder="Masukkan Tanggal Pembayaran" required>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status">Status</b></label>
                                    <input type="text" name="status" class="form-control" id="status" placeholder="Masukkan Status" required>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <?php
                            echo form_close();
                        ?>
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-sm-none"></i>Cancel</button>
                        <button type="submit" class="btn btn-success ml-1 btnSave" id="btnSave" onclick="addinvoice()">
                            <i class="bx bx-check d-sm-none"></i>Save</button>
                    </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- Add Update Modal -->
<!-- END MODAL -->

