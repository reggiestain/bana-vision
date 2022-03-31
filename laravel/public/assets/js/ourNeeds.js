(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});
//Add gratitude modal
$(document).on('click','#add-gratitude',function(event){
		$('#needs-gratitude-modal').modal();
});
//Add overview modal
$(document).on('click','#add-overview',function(event){
		$('#needs-overview-modal').modal();
});

$(document).on('click','.show-photos',function(event){
	var need_ = JSON.parse($(event.target).attr('data-need'));

 	var studentsImages = document.getElementById("student-pictures-"+need_.id);

	studentsImages.innerHTML = '';

	studentsImages.innerHTML += '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" id="first-slide" alt="First slide" ></div>';

	console.log($('#collapseNeed'+$(event.target).attr('data-keya')));
	$('#first-slide').prop('src',(value=$(event.target).attr('src')));
	document.getElementById("collapseNeedBody"+$(event.target).attr('data-keya')).innerHTML='<h6><strong>'+need_.title+'</strong></h6>'+
	'<dl class="row"><dt class="col-sm-4">Description :</dt><dd class="col-sm-8">'+need_.description+'</dd>'+
	'<dt class="col-sm-4">Quantity :</dt><dd class="col-sm-8">'+need_.quantity+'</dd>'+
	'<dt class="col-sm-4">Due date :</dt><dd class="col-sm-8">'+need_.dueDate+'</dd>'+
	'<dt class="col-sm-4">Urgency :</dt><dd class="col-sm-8">'+need_.urgency+'</dd></dl><hr>';

	//$('#PostPicCarousel-modal').modal();

});

