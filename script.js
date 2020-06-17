$( document ).ready(function() {
  $( ".vote-btns span" ).click(function() {
  	if ($(this).hasClass('plus')) {
  		var voteValue = Number($(this).siblings('.vote-value').val()) + 1;
  	}
  	else {
  		var voteValue = Number($(this).siblings('.vote-value').val()) - 1;
  	}
	  $(this).siblings('.vote-value').val(voteValue);
	  var elementId = $(this).siblings('.element-id').val();
		$.ajax({
			url: '../bitrix/templates/furniture_blue/components/bitrix/news.list/flat/test.php',
			method: 'post',
			dataType: 'html',
			data: {voteValue: voteValue, elementId: elementId},
		});
		$(this).parent().siblings('.bx-newslist-other').html('Голосов: ' + $(this).siblings('.vote-value').val());
	});
});