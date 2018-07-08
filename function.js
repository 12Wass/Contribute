function registerUser() {
 var firstName = document.getElementById('firstName').value;
 var lastName = document.getElementById('lastName').value;
 var username = document.getElementById('username').value;
 var address = document.getElementById('address').value;
 var city = document.getElementById('city').value;
 var postalCode = document.getElementById('postalCode').value;
 var mail = document.getElementById('mail').value;
 var password = document.getElementById('password').value;
 var verifPassword = document.getElementById('verifPassword').value;
 var functionSelect = "registerUser";

 if(firstName.length >= 2 && lastName.length >= 2 && address.length >= 10 && city.length > 7 && postalCode.length >= 5 && mail.length >= 10 && password.length >= 7 && password.value == verifPassword.value) { 
   var request = new XMLHttpRequest();
   request.onreadystatechange = function() {
     if (request.readyState == 4 && request.status == 200) {
       document.write(request.responseText);
     }
   };
   request.open('POST', 'function.php');
   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   request.send(`firstName=${firstName}&lastName=${lastName}&address=${address}&
                 city=${city}&postalCode=${postalCode}&password=${password}&functionSelect=${functionSelect}&mail=${mail}`);
 }
 else {
   console.log('erreur');
 }
}
