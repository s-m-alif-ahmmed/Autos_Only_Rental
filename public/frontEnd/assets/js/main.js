(function ($) {
	"use strict";

	$(document).ready(function(){

		$(window).on('scroll', function(){
			$('header').toggleClass('active', $(this).scrollTop() > 10);
		})

		$('.hamburger-menu').on('click', function () {
			$('.line-top, .line-center, .line-bottom, .menu--wrapper').toggleClass('current');
		})

		// hero slider
		$('.hero--slider').owlCarousel({
			margin: 100,
			loop: true,
			nav: true,
			dots: true,
			center: true,
			items: 3,
			navText: [
			  '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15.0938 19.92L8.57375 13.4C7.80375 12.63 7.80375 11.37 8.57375 10.6L15.0938 4.07996" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			  '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M8.90625 19.92L15.4263 13.4C16.1963 12.63 16.1963 11.37 15.4263 10.6L8.90625 4.07996" stroke="#FF0000" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>'
			],
			stagePadding: 0,
			smartSpeed: 800,
			responsive: {

			  0: {
				items: 1,
				center:false,
			  },
			  768: {
				items: 1,
				center:false,
			  },
			  992: {
				items: 3
			  }
			}
		  });


		function handleFilter(){
			var filters = document.querySelectorAll('.sort--links--wrap li');

			filters.forEach((filter) => {
				filter.addEventListener('click', (e) => {
					var target = e.target;

					filters.forEach((filter) => {
						if(filter !== target){
							filter.classList.remove('active');
						}
					})

					target.classList.add('active');

				})
			})
		}
		handleFilter();


		function handleAccordion(){
			var accordions = document.querySelectorAll('.faq--area .accordion-item button');

			accordions.forEach((item) => {
				item.addEventListener('click', function(){
					var accordionItem = item.parentNode.parentNode;

					accordions.forEach((accItem) => {
						accItem.parentNode.parentNode.classList.remove('active');
					})

					if(!accordionItem.classList.contains('active')){
						accordionItem.classList.add('active');
					}

				})

			})
		}
		handleAccordion();

		function handleUserOption(){
			var toggle = document.querySelector('.user--options .toggle');
			var dropdown = document.querySelector('.user--options .dropdown');
			if(toggle){
				toggle.addEventListener('click', function(e){
					e.preventDefault();
					dropdown.classList.toggle('show');
				})

				// remove when click outside
				document.addEventListener('click', function(e){
					var target = e.target;
					if(!dropdown.contains(target) && !toggle.contains(target)){
						dropdown.classList.remove('show');
					}
				})
			}

		}
		 handleUserOption();

		// upload image
		function uploadImage() {
			var Input = document.getElementById('image-input');
			var PreviewBox = document.getElementById('image-preview');
			var uploadLabel = document.querySelector('.upload-label');

			if (Input) {
				Input.onchange = function(e) {
					var file = e.target.files[0];
					var reader = new FileReader();

					// Check if file size is greater than 1 MB
					if (file.size > 300 * 1024) {
						alert("Please select an image file smaller than 300 KB.");
						Input.value = ''; // Clear the file input
						PreviewBox.innerHTML = ''; // Clear the preview
						return; // Stop further execution
					}

					reader.onload = function(e) {
						PreviewBox.innerHTML = '<img src="' + e.target.result + '"/>';
						uploadLabel.classList.add('removed');
					};
					reader.readAsDataURL(file);
				}
			}
		}
		uploadImage();

		function handleRentCard(){
			var toggleBtn = document.querySelectorAll('.actions .add--review');
			var cardsWrap = document.querySelectorAll('.history--card--wrapper');

					cardsWrap.forEach((card) => {
						var toggleBtn = card.querySelector('.add--review');
						var review = card.querySelector('.review');


						toggleBtn.addEventListener('click', function(e){
							e.preventDefault();
							review.classList.toggle('show');

							if(review.classList.contains('show')){
								toggleBtn.innerText = 'Hide Review'
							}else{
								toggleBtn.innerText = 'Add Review'
							}
						})

					})

		}
		handleRentCard();

		$('.popup--box').each(function() {
			var $popupBox = $(this);
			var $popupContent = $popupBox.find('.gallery');

			// Initialize Magnific Popup
			$popupContent.magnificPopup({
				type: 'image',
				gallery: {
					enabled: true
				},
				delegate: 'a'
			});

			// Trigger popup when clicking on the 'View All' paragraph
			$popupBox.find('p').on('click', function() {
				$popupContent.magnificPopup('open');
			});
		});

		// dateDropper
		new dateDropper({
			selector: '.pick--date',
			format: "d/m/y",
			expandedDefault: true,
			showArrowsOnHover: true,
			range: true
		  });

		$('.timepick').mdtimepicker();

	});

})(jQuery);


// price range input number
document.querySelectorAll('.price-input').forEach(input => {
    input.addEventListener('input', function() {
        // Allow only numbers and empty strings
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Optional: Validate on blur (when the user leaves the input)
    input.addEventListener('blur', function() {
        if (this.value === '') {
            this.value = 0; // Default to 0 if empty
        }
    });
});
