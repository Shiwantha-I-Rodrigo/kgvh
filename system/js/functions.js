
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

	const loader = document.getElementById("loader");
	if (typeof (loader) != 'undefined' && loader != null) {
		setTimeout(() => loader.hidden = true, 1000);
	}

	const passwordAlert = document.getElementById("password-alert");
	if (typeof (passwordAlert) != 'undefined' && passwordAlert != null) {
		const password = document.getElementById("password");
		const password2 = document.getElementById("password2");
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

		const update_stat = document.getElementById("update_stat");
		const u1 = update_stat.value == "1";
		const pwd_btn = document.getElementById("pwd_btn");
		const pwd_row = document.getElementById("pwd_row");

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
			p1 = (isValid && isEqual) || u1;
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

		requirements.forEach((element) => element.classList.add("wrong"));

		password.addEventListener("focus", () => {
			u1 ? n1 = e1 = f1 = l1 = true : null;
			validatePasswords();
		});
		password2.addEventListener("focus", () => {
			u1 ? n1 = e1 = f1 = l1 = true : null;
			validatePasswords();
		});
		userName.addEventListener("focus", () => {
			u1 ? p1 = e1 = f1 = l1 = true : null;
			validateUserName();
		});
		email.addEventListener("focus", () => {
			u1 ? p1 = n1 = f1 = l1 = true : null;
			validateEmail();
		});
		firstName.addEventListener("focus", () => {
			u1 ? p1 = n1 = e1 = l1 = true : null;
			validateFirstName();
		});
		lastName.addEventListener("focus", () => {
			u1 ? p1 = n1 = e1 = f1 = true : null;
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
			u1 ? n1 = e1 = f1 = l1 = true : null;
			validatePasswords();
		});
		password2.addEventListener("input", () => {
			u1 ? n1 = e1 = f1 = l1 = true : null;
			validatePasswords();
		});
		userName.addEventListener("input", () => {
			u1 ? p1 = e1 = f1 = l1 = true : null;
			validateUserName();
		});
		email.addEventListener("input", () => {
			u1 ? p1 = n1 = f1 = l1 = true : null;
			validateEmail();
		});
		firstName.addEventListener("input", () => {
			u1 ? p1 = n1 = e1 = l1 = true : null;
			validateFirstName();
		});
		lastName.addEventListener("input", () => {
			u1 ? p1 = n1 = e1 = f1 = true : null;
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

		pwd_btn.addEventListener("click", () => {
			pwd_row.classList.toggle("d-none");
			let txt = pwd_btn.innerHTML;
			pwd_btn.innerHTML = txt == 'Change Password' ? 'Dont Change Password' : 'Change Password';
		});

	};

	const sidebar_toggle = document.getElementById("sidebar_toggle");
	if (typeof (sidebar_toggle) != 'undefined' && sidebar_toggle != null) {

		const sidebar = document.getElementById("sidebar");
		const content = document.getElementById("content");

		function toggle_sidebar() {
			sidebar.classList.toggle("open");
			content.classList.toggle("open");
		};

		sidebar_toggle.addEventListener("click", () => {
			toggle_sidebar();
		});

	};


});


// requirements.forEach((element) => {
// 	element.classList.remove("wrong");
// 	element.classList.add("good");
// });