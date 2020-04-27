/**
 * Underscores.me specific javascript functionality
 */
document.onreadystatechange = function () {
	var advanced = document.getElementsByClassName('generator-form-options-toggle')[0];
	var simple = document.getElementsByClassName('generator-form-options-toggle')[1];
	var form = document.getElementById('generator-form');
	
	advanced.addEventListener('click', function( event ) {
		event.preventDefault();
		form.classList.remove('generator-form-skinny');
	});
	
	simple.addEventListener('click', function( event ) {
		event.preventDefault();
		form.classList.add('generator-form-skinny');
	});
}