function validateForm() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Example validation rules (customize as needed)
    if (username.length < 5) {
        document.getElementById("usernameError").textContent = "Username must be at least 5 characters long.";
        return false;
    } else {
        document.getElementById("usernameError").textContent = "";
    }

    if (password.length < 8) {
        document.getElementById("passwordError").textContent = "Password must be at least 8 characters long.";
        return false;
    } else {
        document.getElementById("passwordError").textContent = "";
    }
    
    let users = localStorage.getItem('users')? JSON.parse(localStorage.getItem('users')) :
    [
        {id: 1, name: "Mark", username: "mark01", password: "mark1234", admin: false}, 
        {id: 2, name: "Mary", username: "mary01", password: "mary1234", admin: false}, 
        {id: 3, name: "Alex", username: "alex01", password: "alex1234", admin: true}
    ];

    const user = users.find(user => user.username === username && user.password === password);

    // If user is found, validation is successful
    if (user) {
        console.log('User validated successfully.');
        localStorage.setItem('user', JSON.stringify(user));
        return true;
    } else {
        document.getElementById("error").style.display = 'block';
        return false;
    }
}