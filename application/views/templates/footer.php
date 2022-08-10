    <footer class="main-footer">
      <div class="footer-left">
        Copyright &copy; 2022
      </div>
      <div class="footer-right">

      </div>
    </footer>
  </div>
</div>

<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>

<script>
  $('.summernote').summernote({
    placeholder: 'Isi deskripsi di sini',
    tabsize: 2,
    height: 100,
    toolbar: [
      ['para', ['ul']],
    ]
  });
</script>

</body>

</html>