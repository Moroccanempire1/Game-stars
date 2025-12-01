
// Modal open/close
function openModal(id) {
    document.getElementById(id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}
// Button alerts
function speelNu() { alert('Start het spel FC 26!'); }
function koopProduct(name) { alert(name + ' toegevoegd aan winkelmand!'); }
// Contact form validation
function validateForm(e) {
    e.preventDefault();
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let msg = document.getElementById('message').value;
    if(name === '' || email === '' || msg === '') { alert('Vul alle velden in'); return false; }
    alert('Bericht verzonden!');
    return true;
}
