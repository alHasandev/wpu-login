$(function () {
	var title = $('#modalTitle').html();

	// if user click edit button
	$('.editData').on('click', function () {
		$('#modalTitle').html('Edit ' + title);
		$('#submitModal').html('Edit');
	});

	// if user click add new button
	$('.addData').on('click', function () {
		$('#modalTitle').html('Add New ' + title);
		$('#submitModal').html('Add');
	});
});
