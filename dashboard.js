function addListeners() {
    const imagePasswordContainers = document.querySelectorAll(".image-password");
    imagePasswordContainers.forEach(container => {
        container.addEventListener('click', onViewImagePassword);
    });

    const addImagePasswordButton = document.getElementById("add-image-password-button");
    if (addImagePasswordButton) {
        addImagePasswordButton.addEventListener('click', onAddImagePasswordClick);
    }
}

function onLogoutClick() {
    const logoutButton = document.getElementById("logout");
    logoutButton.click();
}

function onViewImagePassword(event) {
    const imagePasswordContainer = event.currentTarget;
    const password = imagePasswordContainer.dataset.password;
 
}

function onAddImagePasswordClick() {
    window.location.href = "add_password.php";
}

function toggleNavbar() {
    const navbar = document.getElementById("myNavbar");
    navbar.classList.toggle("responsive");
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll(".larg div h3").forEach(item => {
        item.addEventListener("click", function() {
            const span = this.querySelector('span');
            if (span.classList.contains('close')) {
                span.classList.remove('close');
            } else {
                span.classList.add('close');
            }
            const paragraphs = this.parentElement.querySelectorAll('p');
            paragraphs.forEach(p => {
                p.style.transition = 'slideToggle 250ms';
                p.style.display = p.style.display === 'none' ? 'block' : 'none';
            });
        });
    });

    document.querySelectorAll("nav ul li a").forEach(item => {
        item.addEventListener("click", function() {
            const title = this.dataset.title;
            document.querySelector('.title h2').innerHTML = title;
        });
    });
});
