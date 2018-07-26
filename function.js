function connectUser() {
 var identifiant = document.getElementById('identifiant').value;
 var password = document.getElementById('password').value;
 var functionSelect = 'connectUser';

 if(identifiant.length > 2 && password.length > 4) { 
   var request = new XMLHttpRequest();
   request.onreadystatechange = function() {
     if (request.readyState == 4 && request.status == 200) {
       document.write(request.responseText);
     }
   };
   request.open('POST', 'function.php');
   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   request.send(`identifiant=${identifiant}&password=${password}&functionSelect=${functionSelect}`);
 }
 else {
   document.getElementById('idLab').style.color = 'red';
   document.getElementById('passLab').style.color = 'red';
 }
}
// Fonctions de modification depuis le profil
  // Modifications d'identité //
function modifyId(){
  var identity = document.getElementsByClassName('identity');
    var lastName = identity[0].innerText;
    var firstName = identity[1].innerText;
    var picture = identity[2].innerText;
    var username = identity[3].innerText;
    var functionSelect = 'generateIdForm'; // Fonction PHP crééant le formulaire de modification
    if (lastName.length > 1){
      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
          document.write(request.responseText);
        }
      };
      request.open('POST', 'function.php');
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.send(`lastName=${lastName}&firstName=${firstName}
                   &picture=${picture}&username=${username}
                   &functionSelect=${functionSelect}`);
    }
}



  // Envoi de la modification d'identité
function sendIdMod() {
 var newfirstName = document.getElementById('firstName').value;
 var newlastName = document.getElementById('lastName').value;
 var newUsername = document.getElementById('username').value;
 var newPicture = document.getElementById('picture').value;
 console.log('fn : ' + newfirstName);
 console.log('ln : '+ newlastName);
 console.log('us: ' + newUsername)
 var functionSelect = 'modifyIdentity';
 var val1 = 1;
 if(val1 == 1) { 
   var request = new XMLHttpRequest();
   request.onreadystatechange = function() {
     if (request.readyState == 4 && request.status == 200) {
       document.write(request.responseText);
     }
   };
   request.open('POST', 'function.php');
   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   request.send(`firstName=${newfirstName}&lastName=${newlastName}&username=${newUsername}
                &picture=${newPicture}&functionSelect=${functionSelect}`);

 }
 else {
console.log('erreur');
 }
}


function modifyAdd(){
  var address = document.getElementsByClassName('address');
    var addressinfo = address[0].innerText;
    var city = address[1].innerText;;
    var postalCode = address[2].innerText;;
    var functionSelect = 'generateAddForm';
    if (city.length > 1){
      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
          document.write(request.responseText);
        }
      };
      request.open('POST', 'function.php');
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.send(`addressinfo=${addressinfo}&city=${city}
                   &postalCode=${postalCode}
                   &functionSelect=${functionSelect}`);
    }
}


// Envoi de la modification d'adresse
function sendAddMod() {
var newAddressinfo = document.getElementById('addressinfo').value;
var newCity = document.getElementById('city').value;
var newPostalCode = document.getElementById('postalCode').value;
var functionSelect = 'modifyAddress';
var val1 = 1;
if(val1 == 1) { 
 var request = new XMLHttpRequest();
 request.onreadystatechange = function() {
   if (request.readyState == 4 && request.status == 200) {
     document.write(request.responseText);
   }
 };
 request.open('POST', 'function.php');
 request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 request.send(`addressinfo=${newAddressinfo}&city=${newCity}&postalCode=${newPostalCode}
          &functionSelect=${functionSelect}`);

}
  else {
    console.log('erreur');
  }
}

// Gestion des projets
// Envoi d'un projet

function addProject() {
  var categories = document.getElementById('category');
  // Valeurs à traiter en PHP
  var selectedCategory = categories.options[categories.selectedIndex].value;
  var projectName = document.getElementById('name').value;
  var description = document.getElementById('description').value;
  var target = document.getElementById('target').value;
  var deadLine = document.getElementById('deadline').value;
  var contribMin = document.getElementById('contribMin').value;
  console.log(selectedCategory);
  console.log(projectName);
  console.log(description);
  console.log(target);
  console.log(deadLine);
  console.log(contribMin);
  
  var functionSelect = 'addProject';
  var val1 = 1; // A remplacer par des vérifications
    if (val1 == 1) {
      var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
          document.write(request.responseText);
        }
      };
      request.open('POST', 'function.php');
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.send(`selectedCategory=${selectedCategory}&projectName=${projectName}
                    &description=${description}&target=${target}
                    &deadLine=${deadLine}&contribMin=${contribMin}&functionSelect=${functionSelect}`);

     }
       else {
         console.log('erreur');
       }
}









/* Fonction dépréciée car elle ne fonctionne pas.
function registerUser() {
  var lastName = document.getElementById('lastName').value;
  var firstName = document.getElementById('firstName').value;
  var username = document.getElementById('username').value;
  var city = document.getElementById('city').value;
  var email = document.getElementById('mail').value;
  var postalCode = document.getElementById('postalCode').value;
  var password = document.getElementById('password').value;
  var verifPassword = document.getElementById('verifPassword').value;
  var functionSelect = 'registerUser';

  if(password == verifPassword) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
       if(request.readyState == 4 && request.status == 200){
         document.write(request.responseText);
       }
    };
    request.open('POST', 'function.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(`lastName=${lastName}&firstName=${firstName}&city=${city}&username=${username}&email=${email}&postalCode=${postalCode}&
                  password=${password}&verifPassword=${verifPassword}&functionSelect=${functionSelect}`);

  }
  else {
    console.log('erreur');
  }
}
*/
