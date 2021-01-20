$(document).ready(function () {
	$(".animated").scrollClass(); // Validate scroll calss

	$("#confirm-btn").click(function () {
		$("#checkout-form").slideDown("slow");
	});
});
// var $base_url = 'https://infs3202-0f70f4d3.uqcloud.net/';
var $base_url = 'http://localhost/';

function checkUsernameAvailability() {
	jQuery.ajax({
		url: $base_url + "users/jQuery_Ajax_username",
		data: 'username=' + $("#username").val(),
		type: "POST",
		success: function (data) {
			$("#user-availability-status").html(data);
		},
		error: function () {
			alert("AJAX ERROR!")
		}
	});
}

function checkEmailAvailability() {
	jQuery.ajax({
		url: $base_url + "users/jQuery_Ajax_email",
		data: 'email=' + $("#email").val(),
		type: "POST",
		success: function (data) {
			$("#email-availability-status").html(data);
		},
		error: function () {
			alert("AJAX ERROR!")
		}
	});
}


/**
 * Open the login form
 */
function openLoginForm() {
	document.getElementById("login-form").style.display = "block";
}

/**
 * Close the login form
 */
function closeLoginForm() {
	document.getElementById("login-form").style.display = "none";
}

/**
 * Open the signup form
 */
function openSignupForm() {
	document.getElementById("signup-form").style.display = "block";
}

/**
 * Close the signup form
 */
function closeSignupForm() {
	document.getElementById("signup-form").style.display = "none";
}

function openUpdateForm() {
	document.getElementById("update-form").style.display = "block";
}

function closeUpdateForm() {
	document.getElementById("update-form").style.display = "none";
}

/**
 * AJAX function to show the restaurants by selected category
 * iff no selected, show all restaurants
 * @param {String} str - selected picker value
 */
function showRestaurant(str) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("restaurant-list").innerHTML = this.responseText;
		}
	};
	if (str.length == 0) { // show all 
		xmlhttp.open("GET", $base_url + "restaurants/get_category?q=" + '?', true);
	} else { // show selected

		xmlhttp.open("GET", $base_url + "restaurants/get_category?q=" + str, true);

	}
	xmlhttp.send();
}

/**
 * AJAX function to show the search result
 * @param {string} str keyup result from the search bar
 */
function showResult(str) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("livesearch").innerHTML = this.responseText;
			document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
		}
	};
	if (str.length != 0) { // show all 
		xmlhttp.open("GET", $base_url + "restaurants/get_search?rname=" + str, true);
		xmlhttp.send();
	} else {
		document.getElementById("livesearch").innerHTML = "";
		document.getElementById("livesearch").style.border = "none";
	}
}