
 
<div class="page-content">
    <section class="row">
    <div class="row">
        <div class="card">
            <div class="card-body">
               <h2>Selamat Datang, <?php echo $this->session->userdata('name'); ?></h2>
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
   	
</body>

</html>
