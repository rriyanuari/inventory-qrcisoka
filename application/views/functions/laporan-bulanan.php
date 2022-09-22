<script>
  $(document).ready(function(){

    $('#tmb_cari').on('click',function(){
      event.preventDefault();

      let periode = $("input[name=periode]");

      if (!periode.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Periode tidak boleh kosong',
        position: 'topRight'
      });
        periode.focus();

        return false
      }
      
      window.location.href =`<?php echo base_url()?>/laporan-bulanan?periode=${periode.val()}`;
    });

  });
</script>