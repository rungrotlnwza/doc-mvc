// เริ่มต้นการทำระบบส่งข้อมูลผ่าน From Register
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var name = document.getElementById('name').value;
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value;
    var confirmpassword = document.getElementById('confrimpassword').value;
    if (password !== confirmpassword) {
        message('password do not match', 'error');
        return;
    }
    var payload = { name: name, username: username, password: password }
    setAPIRegister(payload);

});

function setAPIRegister(payload) {
    fetch('localhost/api/example', {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload),
    }).then(function(response) {
        return response.json();
    }).then(function(data) {
        if (data.success) {
            message('สมัครสมาชิกสำเร็จ');
        } else {
            message('มีชื่อผู้ไช้ซ้ำ');
        }
    }).catch(function(error) {
        message(error.message);
    });
}

function message(message, Type) {
    var messageid = document.getElementById('message');
    messageid.textContent = message;

    if (Type === 'success') {
        messageid.style.color = 'green';
    } else if (Type === 'error') {
        messageid.style.color = 'red';
    }

}
// สิ้นสุดการส่งฟรอม register และขึ้นฟังชั่นไหม่