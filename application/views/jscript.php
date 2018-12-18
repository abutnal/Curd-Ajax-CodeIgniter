// Retreive all records
$(document).ready(function(){
	show();
});

function show(){
	$.ajax({
		url: '<?= base_url().'admin/show'?>',
		method: 'get',
		dataType: 'json',
		data:{show_records:1},
		success:function(response){
			$('#dataTable').html(response);
		}
	});
}
// Selected edit records
$(document).ready(function(){
		$(document).on('click','#update', function(event){
				event.preventDefault();
				var $anchor = $(event.target);
				var id = $anchor.attr('data-id');
				$.ajax({
					url: '<?= base_url().'admin/select_where'?>',
					method: 'post',
					dataType: 'json',
					data: {update:1,user_id:id},
					success:function(response){
						$('#result').html(response);
						$('#insert_form').hide();
					}	
				});
		});
		$(document).on('click','#cancel',function(event){
			event.preventDefault();
			$('#insert_form').show();
			$('#update_form').hide();
			$('#error').hide();
		})
});

// Update records
$(document).ready(function(){
	$(document).on('submit','#updateForm', function(event){
		event.preventDefault();
		$form = $(this);
		$.ajax({
					url: $form.attr('action'),
					type: $form.attr('method'),
					data: new FormData(this),
					dataType: 'json',
					contentType:false,
					processData: false,
					cache:false,
					success: function(data){
					show();
					$.each(data, function(key, value) {
						if(key=='status'){
						$('#message').html(value);
						}
						$('#error-' + key).html(value);
	                });
					}
		});
	});
});



// Insert Records
$(document).ready(function(){
		$(document).on('submit','#insertForm', function(event){
		event.preventDefault();

		$form = $(this);
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method'),
				dataType: 'json',
				data: new FormData(this),
				contentType: false,
				processData: false,
				cache:false,
				success: function(response){
					show();
					$.each(response, function(key, value){
						if(key=='status'){
							$('#message').html(value);
							$('#insertForm')[0].reset();
							$('.error').hide();
						}
						$('#input-' + key).parents('.form-group').find('.error').html(value);
					});
					
				}
		});

		$('#insertForm input').on('keyup', function () { 
        $(this).parents('.form-group').find('.error').html(" ");
   		 });
		
		});
});



// Delete mehtod
$(document).ready(function(){
	$(document).on('click','#delete', function(event){
		event.preventDefault();
		$form = $(this);
		var $anchor = $(event.target);
		var id = $anchor.attr('data-id');
		$.ajax({
			url: '<?= base_url('admin/delete')?>',
			method: 'POST',
			dataType: 'json',
			data: {delete:1, user_id:id},
			success:function(response){
				show();
				$.each(response, function(key, value){
					$('#message').html(value);
					$('#insert_form').show();
					$('#update_form').hide();
				});
			}
		});
	});
});






















