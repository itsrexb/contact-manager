// Contains codes exclusive for Contacts

(function($){
	
	var NewContactForm = $('#new-contact-form');

	var Contact = {

		init: function(){

			Contact.getContacts();

			$('.contact-menu a').on('click', function(e){
				Contact.preventDefault(e);
				$('.contact-content').removeClass('show');
				$($(this).attr('href')).addClass('show');
			});
			
			$('.new-info').on('click', function(e){
				Contact.preventDefault(e);
				$('.info-holder').append(Contact.newInfo($('.info-holder .form-group').length));
			});

			NewContactForm.on('change', '.info-type', function(){
				if ($(this).val() == 'other') {
					$(this).siblings('input').removeClass('hidden');
				} else {
					$(this).siblings('input').addClass('hidden');
				}
				
			})
			.on('submit', function(e){
				Contact.preventDefault(e);
				Contact.ajax(APP_URL + '/api/' + 'contacts/new', function(data){
					console.log('response', data);
				}, $(this).serialize(), 'POST');
			});
		},

		getContacts: function(){
			Contact.ajax(APP_URL + '/api/' + 'contacts/list', function(data){
				console.log('response', data);
			});
			
		},

		newInfo: function(index = 1){
			index++;
			return $('<div class="form-group">\
				<label for="info">\
					<select class="info-type" name="info[' + index + '][type]">\
						<option value="email">Email</option>\
						<option value="mobile">Mobile</option>\
						<option value="tel">Tel</option>\
						<option value="fax">Fax</option>\
						<option value="work">Work</option>\
						<option value="address">Address</option>\
						<option value="other">Other</option>\
					</select>\
					<input type="text" class="hidden" name="info[' + index + '][custom]" placeholder="custom"></span>\
				</label>\
				<input type="text" id="info" name="info[' + index + '][value]" class="form-control">\
			</div>');
		},

		preventDefault : function(e){
			e.preventDefault();
			e.stopPropagation();
		},

		/**
		 * Create a custom AJAX request to always include our token
		 */
		ajax: function(url, callback = 'functon(data){}', data = {}, type = 'GET'){
			var response;
			$.ajax({
		         url: url,
		         data: data,
		         type: type,
		         beforeSend: function(xhr){
		         	xhr.setRequestHeader('Authorization', 'Bearer ' + window.Laravel.apiToken);
		         },
		         success: callback
		      });

			return;
		}


	}
	
	// Execute on DomReady
	$(function(){

		Contact.init();

	});

})(jQuery);