      // JavaScript code for the login form
      const loginForm = document.getElementById("login-form");

      // Simulated database of users
      const users = [
        { username: "1", password: "1" },
        { username: "user2", password: "password2" },
        { username: "user3", password: "password3" },
      ];

      // Function to handle form submission
      function handleSubmit(event) {
        event.preventDefault();
        const username = loginForm.elements.username.value;
        const password = loginForm.elements.password.value;

        // Validate username and password
        const user = users.find(
          (user) => user.username === username && user.password === password
        );

        if (user) {
          alert("Login successful!");
          // Redirect to the homepage
          window.location.href = "homepage.html"; // Change 'homepage.html' to your actual homepage URL
        } else {
          alert("Invalid username or password. Please try again.");
        }

        // Clear the form fields after submission
        loginForm.reset();
      }

      // Event listener for form submission
      loginForm.addEventListener("submit", handleSubmit);