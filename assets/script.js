const randomversion = Math.random(); // สร้างเลขสุ่ม
fetch('view/navbar.html?v=$(randomversion)') // เปลี่ยน path ให้ตรงกับตำแหน่งที่ถูกต้อง
    .then(response => {
        if (!response.ok) {
            throw new Error(`Failed to load navbar: ${response.status} ${response.statusText}`);
        }
        return response.text();
    })
    .then(html => {
        // แสดง Navbar ใน #navbar-container
        const navbarContainer = document.getElementById('navbar');
        if (navbarContainer) {
            navbarContainer.innerHTML = html;
        } else {
            console.error('Error: Element with id "navbar-container" not found.');
        }
    })
    .catch(error => {
        console.error('Error loading navbar:', error);
    });