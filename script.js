<<<<<<< HEAD

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
=======
let seizoen = "winter";

switch (seizoen) {
    case "lente":
        console.log("Het is lente! De bloemen beginnen te bloeien.");
        break;
    case "zomer":
        console.log("Het is zomer! Tijd voor het strand en de zon.");
        break;
    case "herfst":
        console.log("Het is herfst! De bladeren veranderen van kleur.");
        break;
    default:
        console.log("Het is winter! Tijd voor sneeuw en warme chocolademelk.");
        break;
>>>>>>> d857327 (ss)
}
