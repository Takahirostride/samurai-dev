$('#example-fontawesome,.datrating').barrating({
	//index page jubotron
    theme: 'fontawesome-stars',
    showSelectedRating: false,
    onSelect: function(value, text, event) {
	    if (typeof(event) !== 'undefined') {
	      // rating was selected by a user
	      console.log(value);
	    } else {
	      // rating was selected programmatically
	      // by calling `set` method
	    }
	  }
});
$('.rating-disable').barrating({
	//index page jubotron
    theme: 'fontawesome-stars',
    showSelectedRating: false,
    readonly: true,
    onSelect: function(value, text, event) {
	    if (typeof(event) !== 'undefined') {
	      // rating was selected by a user
	      console.log(value);
	    } else {
	      // rating was selected programmatically
	      // by calling `set` method
	    }
	  }
});
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})