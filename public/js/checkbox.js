$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		});
	});

$(document).ready(function() {
		    // Kode yang akan dijalankan saat halaman telah dimuat sepenuhnya
		    $('#select-all').click(function() {
		        // Event listener untuk kotak centang "pilih semua"
		        $('.form-check-input').prop('checked', this.checked);
		        // Mengubah status properti "checked" untuk semua kotak centang individual
		    });
		    $('.form-check-input').change(function() {
		        // Event listener untuk setiap kotak centang individual
		        var allChecked = true;
		        $('.form-check-input').each(function() {
		            if (!this.checked) {
		                allChecked = false;
		            }
		        });
		        $('#select-all').prop('checked', allChecked);
		        // Mengubah status properti "checked" untuk kotak centang "pilih semua"
		    });
		});