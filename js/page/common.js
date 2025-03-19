
    // document.addEventListener("DOMContentLoaded", function() {
    //     const backToTopButton = document.getElementById("back-to-top");

    //     window.addEventListener("scroll", function() {
    //         if (window.scrollY > 300) {
    //             backToTopButton.style.display = "flex";
    //         } else {
    //             backToTopButton.style.display = "none";
    //         }
    //     });

    //     backToTopButton.addEventListener("click", function() {
    //         window.scrollTo({
    //             top: 0,
    //             behavior: "smooth"
    //         });
    //     });
    // });

    
    class FormValidator {
        constructor(form) {
            this.form = form; // Assigning the form dynamically
            this.validationRules = {
                "validate-email": this.validateEmail,
                "validate-number": this.validateNumber,
                "validate-required": this.validateRequired
            };
    console.log("this is js");
            this.observeInputs();
            this.setupFormSubmission();
        }
    
        // Email Validation
        validateEmail(input) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(input.value) ? "" : "Invalid email format";
        }
    
        // Number Validation
        validateNumber(input) {
            return /^\d+$/.test(input.value) ? "" : "Only numbers allowed";
        }
    
        // Required Field Validation
        validateRequired(input) {
            return input.value.trim() ? "" : "This field is required";
        }
    
        // Validate a single input
        validateInput(input) {
            let errorMessage = "";
            Object.keys(this.validationRules).forEach((rule) => {
                if (input.classList.contains(rule)) {
                    let error = this.validationRules[rule](input);
                    if (error) errorMessage = error; // Last error will be shown
                }
            });
    
            this.showError(input, errorMessage);
            this.toggleSubmitButton();
        }
    
        // Show error message
        showError(input, message) {
            let errorDiv = input.nextElementSibling;
            if (!errorDiv || !errorDiv.classList.contains("error-message")) {
                errorDiv = document.createElement("div");
                errorDiv.classList.add("error-message", "text-danger", "mt-1");
                input.parentNode.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }
    
        // Toggle submit button based on validation
        toggleSubmitButton() {
            const allInputs = this.form.querySelectorAll("input");
            let isValid = true;
    
            allInputs.forEach((input) => {
                if (input.nextElementSibling && input.nextElementSibling.classList.contains("error-message") && input.nextElementSibling.textContent !== "") {
                    isValid = false;
                }
            });
    
            const submitButton = this.form.querySelector("button[type='submit']");
            if (submitButton) {
                submitButton.disabled = !isValid;
            }
        }
    
        // Observe inputs for validation
        observeInputs() {
            this.form.addEventListener("input", (event) => {
                if (event.target.tagName === "INPUT") {
                    this.validateInput(event.target);
                }
            });
    
            // MutationObserver for dynamically added inputs
            let observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    mutation.addedNodes.forEach((node) => {
                        if (node.tagName === "INPUT") this.validateInput(node);
                    });
                });
            });
    
            observer.observe(this.form, { childList: true, subtree: true });
        }
    
        // Prevent form submission if validation fails
        setupFormSubmission() {
            this.form.addEventListener("submit", (event) => {
                let isValid = true;
                const allInputs = this.form.querySelectorAll("input");
    
                allInputs.forEach((input) => {
                    this.validateInput(input);
                    if (input.nextElementSibling && input.nextElementSibling.textContent !== "") {
                        isValid = false;
                    }
                });
    
                if (!isValid) {
                    event.preventDefault(); // Block form submission
                    alert("Please fix validation errors before submitting.");
                }
            });
        }
    }
    
    //  Apply validation to **all** forms automatically
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll("form.triggerOnSubmit").forEach((form) => { // trigeronsubmit form. class name // je trigger thse e 
            new FormValidator(form);
        });
    });
    