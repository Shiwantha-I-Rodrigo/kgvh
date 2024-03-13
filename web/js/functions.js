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
	};
	function validateUserName() {
		const isValid = userName.value != "" && !userName.value.includes(" ");
		userName.classList.toggle("green_glow", isValid);
		userName.classList.toggle("red_glow", !isValid);
	};
	function validateEmail() {
		const isValid = email.value.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
		email.classList.toggle("green_glow", isValid);
		email.classList.toggle("red_glow", !isValid);
	};
	function validateFirstName() {
		const isValid = firstName.value != "" && !firstName.value.includes(" ") && !/\d/.test(firstName.value) && !/[!@#$%^&*()\[\]{}\\|;:'",<.>/?`~]/.test(firstName.value);
		firstName.classList.toggle("green_glow", isValid);
		firstName.classList.toggle("red_glow", !isValid);
	};
	function validateLastName() {
		const isValid = lastName.value != "" && !lastName.value.includes(" ") && !/\d/.test(lastName.value) && !/[!@#$%^&*()\[\]{}\\|;:'",<.>/?`~]/.test(lastName.value);
		lastName.classList.toggle("green_glow", isValid);
		lastName.classList.toggle("red_glow", !isValid);
	};
	function resetGlow() {
		password.classList.remove("green_glow");
		password.classList.remove("red_glow");
		password2.classList.remove("green_glow");
		password2.classList.remove("red_glow");
		userName.classList.remove("green_glow");
		userName.classList.remove("red_glow");
		email.classList.remove("green_glow");
		email.classList.remove("red_glow");
		firstName.classList.remove("green_glow");
		firstName.classList.remove("red_glow");
		lastName.classList.remove("green_glow");
		lastName.classList.remove("red_glow");
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



	password.addEventListener("blur", () => {
		passwordAlert.classList.add("d-none");
		resetGlow();
	});
	password2.addEventListener("blur", () => {
		passwordAlert.classList.add("d-none");
		resetGlow();
	});
	userName.addEventListener("blur", () => {
		resetGlow();
	});
	email.addEventListener("blur", () => {
		resetGlow();
	});
	firstName.addEventListener("blur", () => {
		resetGlow();
	});
	lastName.addEventListener("blur", () => {
		resetGlow();
	});

});





// requirements.forEach((element) => {
// 	element.classList.remove("wrong");
// 	element.classList.add("good");
// });