const randomVersion = Math.random(); // สร้างเลขสุ่ม

fetch('view/navbar.html?v=' + randomVersion) // เปลี่ยน path ให้ตรงกับตำแหน่งที่ถูกต้อง
    .then(function(response) {
        if (!response.ok) {
            throw new Error('Failed to load navbar: ' + response.status + ' ' + response.statusText);
        }
        return response.text();
    })
    .then(function(html) {
        // แสดง Navbar ใน #navbar-container
        var navbarContainer = document.getElementById('navbar');
        if (navbarContainer) {
            navbarContainer.innerHTML = html;
        } else {
            console.error('Error: Element with id "navbar-container" not found.');
        }
    })
    .catch(function(error) {
        console.error('Error loading navbar:', error);
    });