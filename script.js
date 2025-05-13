const formOpenBtn = document.querySelector("#form-open"),
home = document.querySelector(".home"),
formContainer = document.querySelector(".form_container"),
formCloseBtn = document.querySelector(".form_close"),
signupBtn = document.querySelector("#signup"),
loginBtn = document.querySelector("#login"),
pwShowHide = document.querySelectorAll(".pw_hide");

formOpenBtn.addEventListener("click", () => home.classList.add("show"));
formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

pwShowHide.forEach((icon) => {
 icon.addEventListener("click", () => {
 let getPwInput = icon.parentElement.querySelector("input");
 if(getPwInput.type === "password") {
	getPwInput.type = "text";
	icon.classList.replace("uil-eye-slash", "uil-eye");
 }else{
	getPwInput.type = "password";
	icon.classList.replace("uil-eye", "uil-eye-slash");
}
 console.log(getPwInput);
 });
});

signupBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.add("active-signup");
    formContainer.classList.remove("active-login");
});

loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.add("active-login");
    formContainer.classList.remove("active-signup");
});

// Assuming you have code to handle login and signup events

// Sample function for login
function handleLogin() {
    // ... your existing login logic ...

    // Assuming login is successful
    // Redirect to the home page
    window.location.href = "home.html";
}

// Sample function for signup
function handleSignup() {
    // ... your existing signup logic ...

    // Assuming signup is successful
    // Redirect to the home page
    window.location.href = "home.html";
}

// Event listeners for login and signup buttons
document.querySelector('.login_form button').addEventListener('click', handleLogin);
document.querySelector('.signup_form button').addEventListener('click', handleSignup);


function placeOrder(item, price) {
    alert("Order placed successfully!\nItem: " + item + "\nPrice: $" + price);
    // You can replace the alert with code to handle the order placement with a backend.
}

// Add the following JavaScript to your script.js file

function submitForm() {
    var form = document.getElementById('contactForm');
    var successMessage = document.getElementById('successMessage');

    // Simulate a successful form submission
    // In a real-world scenario, you would send the form data to a server using AJAX or another method

    // Display success message
    successMessage.classList.remove('hidden');

    // Reset the form after a delay
    setTimeout(function () {
        form.reset();
        successMessage.classList.add('hidden');
    }, 3000);
}

// Assuming you have a submit button with id 'submitButton'
document.getElementById('submitButton').addEventListener('click', submitForm);



let search = document.querySelector('.search-box');

document.querySelector('#search-icon').onclick = () => {
    search.classList.toggle('active');
}

// Header 
let header = document.querySelector('header');

window.addEventListener('scroll', () => {
    header.classList.toggle('shadow', window.scrollY > 0);
});
// Add the following JavaScript code to your script.js file

document.addEventListener('DOMContentLoaded', function () {
    const orderButtons = document.querySelectorAll('.order-btn');

    orderButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const productName = this.getAttribute('data-product');
            alert('Order placed successfully for ' + productName);
        });
    });
});
function submitForm() {
    // Get form elements
    const form = document.getElementById('contactForm');
    const successMessage = document.getElementById('successMessage');

    // Validate the form
    if (form.checkValidity()) {
        // Display success message
        successMessage.classList.remove('hidden');

        // Optional: You can add code here to send the form data to a server using AJAX or any other method.

        // Reset the form after submission (if needed)
        form.reset();
    } else {
        // If the form is invalid, trigger HTML5 validation messages
        form.reportValidity();
    }
}

// Optional: Hide the success message on page load
document.addEventListener('DOMContentLoaded', () => {
    const successMessage = document.getElementById('successMessage');
    successMessage.classList.add('hidden');
});



