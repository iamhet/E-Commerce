(function () {
	'use strict';
	$(document).ready(function () {

		var get_option;
		$(document).ready(function () {
			var layout_data = [];
			$.ajax({
				type: "post",
				url: "layout_setting_data",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (data) {
					var newClass1 = ['sidebar-menu'];
					$.each(data, function (key, value) {
						if (value.name == 'menuDropdownIcon') {
							if (value.value === "icon-style-1") {
								$('input:radio[value=icon-style-1]').trigger("click")
							}
							if (value.value === "icon-style-2") {
								$('input:radio[value=icon-style-2]').trigger("click")
							}
							if (value.value === "icon-style-3") {
								$('input:radio[value=icon-style-3]').trigger("click")
							}
							newClass1.push((value.value).toLowerCase().replace(/\s+/, "-"));
						}
						if (value.name == 'menuListIcon') {
							if (value.value === "icon-list-style-1") {
								$('input:radio[value=icon-list-style-1]').trigger("click")
							}
							if (value.value === "icon-list-style-2") {
								$('input:radio[value=icon-list-style-2]').trigger("click")
							}
							if (value.value === "icon-list-style-3") {
								$('input:radio[value=icon-list-style-3]').trigger("click")
							}
							if (value.value === "icon-list-style-4") {
								$('input:radio[value=icon-list-style-4]').trigger("click")
							}
							if (value.value === "icon-list-style-5") {
								$('input:radio[value=icon-list-style-5]').trigger("click")
							}
							if (value.value === "icon-list-style-6") {
								$('input:radio[value=icon-list-style-6]').trigger("click")
							}
							newClass1.push((value.value).toLowerCase().replace(/\s+/, "-"));
						}
						var name = value.name;
						var val = value.value;
						var obj = {};
						obj[name] = val;
						layout_data.push(obj);
					});
					$(".sidebar-menu").attr('class', newClass1.join(' '));
					set_data();
				}
			});

			get_option = JSON.stringify(layout_data);

		});
		function getOptions() {
			$.ajax({
				type: "post",
				url: "layout_setting_data",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (data) {
					var newClass1 = ['sidebar-menu'];
					$.each(data, function (key, value) {
						if (value.name == 'menuDropdownIcon') {
							if (value.value === "icon-style-1") {
								$('input:radio[value=icon-style-1]').trigger("click")
							}
							if (value.value === "icon-style-2") {
								$('input:radio[value=icon-style-2]').trigger("click")
							}
							if (value.value === "icon-style-3") {
								$('input:radio[value=icon-style-3]').trigger("click")
							}
							newClass1.push((value.value).toLowerCase().replace(/\s+/, "-"));
						}
						if (value.name == 'menuListIcon') {
							if (value.value === "icon-list-style-1") {
								$('input:radio[value=icon-list-style-1]').trigger("click")
							}
							if (value.value === "icon-list-style-2") {
								$('input:radio[value=icon-list-style-2]').trigger("click")
							}
							if (value.value === "icon-list-style-3") {
								$('input:radio[value=icon-list-style-3]').trigger("click")
							}
							if (value.value === "icon-list-style-4") {
								$('input:radio[value=icon-list-style-4]').trigger("click")
							}
							if (value.value === "icon-list-style-5") {
								$('input:radio[value=icon-list-style-5]').trigger("click")
							}
							if (value.value === "icon-list-style-6") {
								$('input:radio[value=icon-list-style-6]').trigger("click")
							}
							newClass1.push((value.value).toLowerCase().replace(/\s+/, "-"));
						}
						var name = value.name;
						var val = value.value;
						var obj = {};
						obj[name] = val;
						layout_data.push(obj);
					});
					$(".sidebar-menu").attr('class', newClass1.join(' '));

				}
			});
		}

		//Layout settings visible
		$('[data-toggle="right-sidebar"]').on('click', function () {
			jQuery('.right-sidebar').addClass('right-sidebar-visible');
		});

		//THEME OPTION CLOSE BUTTON
		$('[data-toggle="right-sidebar-close"]').on('click', function () {
			jQuery('.right-sidebar').removeClass('right-sidebar-visible');
		})

		//VARIABLE
		var body = jQuery('body');
		var left_sidebar = jQuery('.left-side-bar');

		function set_data() {
			// Menu Dropdown Icon
			$('input:radio[name=menu-dropdown-icon]').change(function () {
				// var className = $('input:radio[name=menu-dropdown-icon]:checked').val().toLowerCase().replace(/\s+/, "-");
				// $(".sidebar-menu").attr('class', 'sidebar-menu ' + className);
				var newClass1 = ['sidebar-menu'];
				newClass1.push($('input:radio[name=menu-dropdown-icon]:checked').val().toLowerCase().replace(/\s+/, "-"));
				newClass1.push($('input:radio[name=menu-list-icon]:checked').val().toLowerCase().replace(/\s+/, "-"));
				var data = { 'name': 'menuDropdownIcon', 'value': $('input:radio[name=menu-dropdown-icon]:checked').val().toLowerCase().replace(/\s+/, "-") };
				console.log(data);
				$.ajax({
					type: "post",
					url: "set_layout_setting",
					data: data,
					dataType: "json",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function (data) {
						getOptions();
					}
				});
				$(".sidebar-menu").attr('class', newClass1.join(' '));
			});
			// Menu List Icon
			$('input:radio[name=menu-list-icon]').click(function () {
				var newClass = ['sidebar-menu'];
				newClass.push($('input:radio[name=menu-dropdown-icon]:checked').val().toLowerCase().replace(/\s+/, "-"));
				newClass.push($('input:radio[name=menu-list-icon]:checked').val().toLowerCase().replace(/\s+/, "-"));
				$(".sidebar-menu").attr('class', newClass.join(' '));
				var data = { 'name': 'menuListIcon', 'value': $('input:radio[name=menu-list-icon]:checked').val().toLowerCase().replace(/\s+/, "-") };
				console.log(data);

				$.ajax({
					type: "post",
					url: "set_layout_setting",
					data: data,
					dataType: "json",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function (data) {
						getOptions();
					}
				});
			});
		}


		$('#reset-settings').click(function () {
			getOptions();
		});



	});

})()