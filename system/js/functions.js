// (function ($) {
//     "use strict";

//     // Spinner
//     var spinner = function () {
//         setTimeout(function () {
//             if ($('#spinner').length > 0) {
//                 $('#spinner').removeClass('show');
//             }
//         }, 1);
//     };
//     spinner();


//     // Back to top button
//     $(window).scroll(function () {
//         if ($(this).scrollTop() > 300) {
//             $('.back-to-top').fadeIn('slow');
//         } else {
//             $('.back-to-top').fadeOut('slow');
//         }
//     });
//     $('.back-to-top').click(function () {
//         $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
//         return false;
//     });


//     // Sidebar Toggler
//     $('.sidebar-toggler').click(function () {
//         $('.sidebar, .content').toggleClass("open");
//         return false;
//     });


//     // Progress Bar
//     $('.pg-bar').waypoint(function () {
//         $('.progress .progress-bar').each(function () {
//             $(this).css("width", $(this).attr("aria-valuenow") + '%');
//         });
//     }, {offset: '80%'});


//     // Calender
//     $('#calender').datetimepicker({
//         inline: true,
//         format: 'L'
//     });


//     // Testimonials carousel
//     $(".testimonial-carousel").owlCarousel({
//         autoplay: true,
//         smartSpeed: 1000,
//         items: 1,
//         dots: true,
//         loop: true,
//         nav : false
//     });


//     // Chart Global Color
//     Chart.defaults.color = "#6C7293";
//     Chart.defaults.borderColor = "#000000";


//     // Worldwide Sales Chart
//     var ctx1 = $("#worldwide-sales").get(0).getContext("2d");
//     var myChart1 = new Chart(ctx1, {
//         type: "bar",
//         data: {
//             labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
//             datasets: [{
//                     label: "USA",
//                     data: [15, 30, 55, 65, 60, 80, 95],
//                     backgroundColor: "rgba(235, 22, 22, .7)"
//                 },
//                 {
//                     label: "UK",
//                     data: [8, 35, 40, 60, 70, 55, 75],
//                     backgroundColor: "rgba(235, 22, 22, .5)"
//                 },
//                 {
//                     label: "AU",
//                     data: [12, 25, 45, 55, 65, 70, 60],
//                     backgroundColor: "rgba(235, 22, 22, .3)"
//                 }
//             ]
//             },
//         options: {
//             responsive: true
//         }
//     });


//     // Salse & Revenue Chart
//     var ctx2 = $("#salse-revenue").get(0).getContext("2d");
//     var myChart2 = new Chart(ctx2, {
//         type: "line",
//         data: {
//             labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
//             datasets: [{
//                     label: "Salse",
//                     data: [15, 30, 55, 45, 70, 65, 85],
//                     backgroundColor: "rgba(235, 22, 22, .7)",
//                     fill: true
//                 },
//                 {
//                     label: "Revenue",
//                     data: [99, 135, 170, 130, 190, 180, 270],
//                     backgroundColor: "rgba(235, 22, 22, .5)",
//                     fill: true
//                 }
//             ]
//             },
//         options: {
//             responsive: true
//         }
//     });



//     // Single Line Chart
//     var ctx3 = $("#line-chart").get(0).getContext("2d");
//     var myChart3 = new Chart(ctx3, {
//         type: "line",
//         data: {
//             labels: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150],
//             datasets: [{
//                 label: "Salse",
//                 fill: false,
//                 backgroundColor: "rgba(235, 22, 22, .7)",
//                 data: [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15]
//             }]
//         },
//         options: {
//             responsive: true
//         }
//     });


//     // Single Bar Chart
//     var ctx4 = $("#bar-chart").get(0).getContext("2d");
//     var myChart4 = new Chart(ctx4, {
//         type: "bar",
//         data: {
//             labels: ["Italy", "France", "Spain", "USA", "Argentina"],
//             datasets: [{
//                 backgroundColor: [
//                     "rgba(235, 22, 22, .7)",
//                     "rgba(235, 22, 22, .6)",
//                     "rgba(235, 22, 22, .5)",
//                     "rgba(235, 22, 22, .4)",
//                     "rgba(235, 22, 22, .3)"
//                 ],
//                 data: [55, 49, 44, 24, 15]
//             }]
//         },
//         options: {
//             responsive: true
//         }
//     });


//     // Pie Chart
//     var ctx5 = $("#pie-chart").get(0).getContext("2d");
//     var myChart5 = new Chart(ctx5, {
//         type: "pie",
//         data: {
//             labels: ["Italy", "France", "Spain", "USA", "Argentina"],
//             datasets: [{
//                 backgroundColor: [
//                     "rgba(235, 22, 22, .7)",
//                     "rgba(235, 22, 22, .6)",
//                     "rgba(235, 22, 22, .5)",
//                     "rgba(235, 22, 22, .4)",
//                     "rgba(235, 22, 22, .3)"
//                 ],
//                 data: [55, 49, 44, 24, 15]
//             }]
//         },
//         options: {
//             responsive: true
//         }
//     });


//     // Doughnut Chart
//     var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
//     var myChart6 = new Chart(ctx6, {
//         type: "doughnut",
//         data: {
//             labels: ["Italy", "France", "Spain", "USA", "Argentina"],
//             datasets: [{
//                 backgroundColor: [
//                     "rgba(235, 22, 22, .7)",
//                     "rgba(235, 22, 22, .6)",
//                     "rgba(235, 22, 22, .5)",
//                     "rgba(235, 22, 22, .4)",
//                     "rgba(235, 22, 22, .3)"
//                 ],
//                 data: [55, 49, 44, 24, 15]
//             }]
//         },
//         options: {
//             responsive: true
//         }
//     });


// })(jQuery);


function reDirect(path) {
	window.location = path;
};


function setActive() {
	var path = window.location.pathname;
	var page = path.split("/").pop();
	var element = document.getElementById(page);
	element.classList.add("active");
	// element.classList.remove("otherclass");
};


function userNameOn() {
	document.getElementById("user_overlay").style.display = "block";
}


function userNameOff() {
	document.getElementById("user_overlay").style.display = "none";
}


addEventListener("DOMContentLoaded", (event) => {
	const password = document.getElementById("password");
	const password2 = document.getElementById("password2");
	const passwordAlert = document.getElementById("password-alert");
	const requirements = document.querySelectorAll(".requirements");
	const leng = document.querySelector(".leng");
	const cap = document.querySelector(".cap");
	const num = document.querySelector(".num");
	const char = document.querySelector(".char");
	const userName = document.getElementById("user_name");
	const email = document.getElementById("email");
	const firstName = document.getElementById("first_name");
	const lastName = document.getElementById("last_name");
	const sub_btn = document.getElementById("sub_btn");
	var [p1, n1, e1, f1, l1] = [false, false, false, false, false,];

	const nic = document.getElementById("nic");
	const address1 = document.getElementById("address1");
	const address2 = document.getElementById("address2");
	const address3 = document.getElementById("address3");
	const mobile = document.getElementById("mobile");
	const telephone = document.getElementById("telephone");
	var [i1, a1, a2, a3, m1, t1] = [true, true, true, true, true, true];

	const sidebar = document.getElementById("sidebar");
	const content = document.getElementById("content");
	const sidebar_toggle = document.getElementById("sidebar_toggle");

	function validatePasswords() {
		const value = password.value;
		const hasLength = value.length >= 8;
		const hasUpperCase = /[A-Z]/.test(value);
		const hasNumber = /\d/.test(value);
		const hasSpecialChar = /[!@#$%^&*()\[\]{}\\|;:'",<.>/?`~]/.test(value);
		leng.classList.toggle("good", hasLength);
		leng.classList.toggle("wrong", !hasLength);
		cap.classList.toggle("good", hasUpperCase);
		cap.classList.toggle("wrong", !hasUpperCase);
		num.classList.toggle("good", hasNumber);
		num.classList.toggle("wrong", !hasNumber);
		char.classList.toggle("good", hasSpecialChar);
		char.classList.toggle("wrong", !hasSpecialChar);
		const isValid = hasLength && hasUpperCase && hasNumber && hasSpecialChar;
		const isEqual = password.value == password2.value;
		passwordAlert.classList.remove("d-none");
		password.classList.toggle("green_glow", isValid);
		password.classList.toggle("red_glow", !isValid);
		password2.classList.toggle("green_glow", isValid && isEqual);
		password2.classList.toggle("valid", isValid && isEqual);
		password2.classList.toggle("red_glow", !isValid || !isEqual);
		p1 = isValid && isEqual;
		sub_enable();
	};
	function validateUserName() {
		n1 = userName.value != "" && !userName.value.includes(" ");
		userName.classList.toggle("green_glow", n1);
		userName.classList.toggle("red_glow", !n1);
		sub_enable();
	};
	function validateEmail() {
		e1 = email.value.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
		email.classList.toggle("green_glow", e1);
		email.classList.toggle("red_glow", !e1);
		sub_enable();
	};
	function validateFirstName() {
		f1 = firstName.value != "" && !firstName.value.includes(" ") && !/\d/.test(firstName.value) && !/[!@#$%^&*()\[\]{}\\|;:'",<.>/?`~]/.test(firstName.value);
		firstName.classList.toggle("green_glow", f1);
		firstName.classList.toggle("red_glow", !f1);
		sub_enable();
	};
	function validateLastName() {
		l1 = lastName.value != "" && !lastName.value.includes(" ") && !/\d/.test(lastName.value) && !/[!@#$%^&*()\[\]{}\\|;:'",<.>/?`~]/.test(lastName.value);
		lastName.classList.toggle("green_glow", l1);
		lastName.classList.toggle("red_glow", !l1);
		sub_enable();
	};
	function validateNic() {
		i1 = /\d{9}V/.test(nic.value) || /\d{12}/.test(nic.value) || nic.value.trim() === "";
		nic.classList.toggle("yellow_glow", !i1);
		sub_enable();
	};
	function validateAddress1() {
		a1 = !/[!@#$%^&*\[\]{}|;:"<.>?`~]/.test(address1.value) || address1.value.trim() === "";
		address1.classList.toggle("yellow_glow", !a1);
		sub_enable();
	};
	function validateAddress2() {
		a2 = !/[!@#$%^&*\[\]{}|;:"<.>?`~]/.test(address2.value) || address2.value.trim() === "";
		address2.classList.toggle("yellow_glow", !a2);
		sub_enable();
	};
	function validateAddress3() {
		a3 = !/[!@#$%^&*\[\]{}|;:"<.>?`~]/.test(address3.value) || address3.value.trim() === "";
		address3.classList.toggle("yellow_glow", !a3);
		sub_enable();
	};
	function validateMobile() {
		m1 = /^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/.test(mobile.value) || mobile.value.trim() === "";
		// 123-456-7890
		// (123) 456-7890
		// 123 456 7890
		// 123.456.7890
		// +91 (123) 456-7890
		// +94775434326
		mobile.classList.toggle("yellow_glow", !m1);
		sub_enable();
	};
	function validateTelephone() {
		t1 = /^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/.test(telephone.value) || telephone.value.trim() === "";
		telephone.classList.toggle("yellow_glow", !t1);
		sub_enable();
	};
	function sub_enable() {
		(p1 && n1 && e1 && f1 && l1 && i1 && a1 && a2 && a3 && m1 && t1) ? sub_btn.disabled = false : sub_btn.disabled = true;
	};
	function resetGlow() {
		password.classList.remove("green_glow");
		//password.classList.remove("red_glow");
		password2.classList.remove("green_glow");
		//password2.classList.remove("red_glow");
		userName.classList.remove("green_glow");
		//userName.classList.remove("red_glow");
		email.classList.remove("green_glow");
		//email.classList.remove("red_glow");
		firstName.classList.remove("green_glow");
		//firstName.classList.remove("red_glow");
		lastName.classList.remove("green_glow");
		//lastName.classList.remove("red_glow");
	};

	function toggle_sidebar() {
		sidebar.classList.add("open");
		content.classList.add("open");
	};


	requirements.forEach((element) => element.classList.add("wrong"));

	password.addEventListener("focus", () => {
		validatePasswords();
	});
	password2.addEventListener("focus", () => {
		validatePasswords();
	});
	userName.addEventListener("focus", () => {
		validateUserName();
	});
	email.addEventListener("focus", () => {
		validateEmail();
	});
	firstName.addEventListener("focus", () => {
		validateFirstName();
	});
	lastName.addEventListener("focus", () => {
		validateLastName();
	});
	nic.addEventListener("focus", () => {
		validateNic();
	});
	address1.addEventListener("focus", () => {
		validateAddress1();
	});
	address2.addEventListener("focus", () => {
		validateAddress2();
	});
	address3.addEventListener("focus", () => {
		validateAddress3();
	});
	mobile.addEventListener("focus", () => {
		validateMobile();
	});
	telephone.addEventListener("focus", () => {
		validateTelephone();
	});

	password.addEventListener("input", () => {
		validatePasswords();
	});
	password2.addEventListener("input", () => {
		validatePasswords();
	});
	userName.addEventListener("input", () => {
		validateUserName();
	});
	email.addEventListener("input", () => {
		validateEmail();
	});
	firstName.addEventListener("input", () => {
		validateFirstName();
	});
	lastName.addEventListener("input", () => {
		validateLastName();
	});
	nic.addEventListener("input", () => {
		validateNic();
	});
	address1.addEventListener("input", () => {
		validateAddress1();
	});
	address2.addEventListener("input", () => {
		validateAddress2();
	});
	address3.addEventListener("input", () => {
		validateAddress3();
	});
	mobile.addEventListener("input", () => {
		validateMobile();
	});
	telephone.addEventListener("input", () => {
		validateTelephone();
	});

	password.addEventListener("blur", () => {
		passwordAlert.classList.add("d-none");
		resetGlow();
	});
	password2.addEventListener("blur", () => {
		passwordAlert.classList.add("d-none");
		resetGlow();
	});

	[userName, email, firstName, lastName].forEach(item => {
		item.addEventListener("blur", event => {
			resetGlow();
		})
	});


});


// requirements.forEach((element) => {
// 	element.classList.remove("wrong");
// 	element.classList.add("good");
// });