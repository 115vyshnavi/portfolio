// SHOW / HIDE PASSWORD
function togglePassword() {
    const password = document.getElementById("loginPassword") 
                  || document.getElementById("regPassword");

    if (!password) return;

    password.type = password.type === "password" ? "text" : "password";
}




// LOGIN VALIDATION
const loginForm = document.getElementById("loginForm");

if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const email = document.getElementById("loginEmail").value.trim();
        const password = document.getElementById("loginPassword").value.trim();
        const error = document.getElementById("loginError");

        if (!email || !password) {
            error.textContent = "Please fill in all fields.";
            error.classList.add("text-danger");
            return;
        }

        error.textContent = "Login validation successful (demo)";
        error.classList.remove("text-danger");
        error.classList.add("text-success");
    });
}

// REGISTER VALIDATION
const registerForm = document.getElementById("registerForm");

if (registerForm) {
   
        

        const password = document.getElementById("regPassword").value;
        const confirm = document.getElementById("confirmPassword").value;
        const error = document.getElementById("registerError");

        if (password !== confirm) {
            error.textContent = "Passwords do not match.";
            error.classList.add("text-danger");
            return;
        }

        error.textContent = "Registration validation successful (demo)";
        error.classList.remove("text-danger");
        error.classList.add("text-success");
    );
}
// DUMMY AJAX EMAIL CHECK (SIMULATION)
function checkEmailAvailability(email, callback) {
    setTimeout(() => {
        if (email === "test@gmail.com") {
            callback(false); // email exists
        } else {
            callback(true); // email available
        }
    }, 1000); // simulate server delay
}

// MODIFY REGISTER VALIDATION TO INCLUDE AJAX
const registerFormAjax = document.getElementById("registerForm");

if (registerFormAjax) {
    registerFormAjax.addEventListener("submit", function (e) {
        e.preventDefault();

        const email = document.getElementById("regEmail").value.trim();
        const password = document.getElementById("regPassword").value;
        const confirm = document.getElementById("confirmPassword").value;
        const error = document.getElementById("registerError");

        if (!email || !password || !confirm) {
            error.textContent = "All fields are required.";
            error.classList.add("text-danger");
            return;
        }

        if (password !== confirm) {
            error.textContent = "Passwords do not match.";
            error.classList.add("text-danger");
            return;
        }

        error.textContent = "Checking email availability...";
        error.classList.remove("text-danger");
        error.classList.add("text-warning");

        checkEmailAvailability(email, function (available) {
            if (!available) {
                error.textContent = "Email already exists.";
                error.classList.remove("text-warning");
                error.classList.add("text-danger");
            } else {
                error.textContent = "Registration successful (demo)";
                error.classList.remove("text-warning");
                error.classList.add("text-success");
            }
        });
    });
}
