function showSideBar(){
    const sidebar = document.querySelector('nav ul')
    sidebar.style.display = 'flex'
}
function closeSideBar(){
    const sidebar = document.querySelector('nav ul')
    sidebar.style.display = 'none'
}

function login(){
    let email = document.querySelector("#InputEmail").value;
    let password = document.querySelector("#InputPassword").value;
    let testemail = "Admin@hotmail.com";
    let testpassword = "Admin";
    if(email === testemail && password === testpassword)
        {
            document.querySelector("#login").href = "admin.php";
    }
    else{
        alert("Wrong Email or Password")
    }
}
function out() {
    window.location.href = 'index.php';
  }
  