$(function () {
	// property data
	var pageURL = $(location).attr("href");
	var title = $('#modalTitle').html();
	var baseUrl = $('.modal-content form').attr('action');
	var theInput = '<input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">';

	// make function for store appropriate data 
	// function getData(id) {


	// }

	// if user click edit button
	$('.editData').on('click', function () {
		$('#id').val($(this).data('id'));
		$('#modalTitle').html('Edit ' + title);
		$('#submitModal').html('Edit');
		$('.modal-content form').attr("action", baseUrl + "/edit" + title);

		// get data from php controller using ajax
		const id = $(this).data('id');
		$.ajax({
			url: pageURL + '/getDataMenu/',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('.form-group #menu').val(data.menu)
			}
		});
	});

	// if user click add new button
	$('.addData').on('click', function () {
		$('#modalTitle').html('Add New ' + title);
		$('#submitModal').html('Add');
		$('.modal-content form').attr("action", baseUrl);

		// $('.form-group').html(theInput);
	});

	// if user click delete button
	$('.deleteData').on('click', function () {
		$('#id').val($(this).data('id'));
		$('#modalTitle').html('Delete ' + title);
		$('#submitModal').html('Delete');
		$('.modal-content form').attr("action", baseUrl + "/delete" + title);

		// get data from php controller using ajax
		const id = $(this).data('id');
		$.ajax({
			url: pageURL + '/getDataMenu/',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('.modal-body').html(
					'Are you sure want to delete this Menu : <b>' + data.menu + '</b> ?'
				)
			}
		});
	});
});
