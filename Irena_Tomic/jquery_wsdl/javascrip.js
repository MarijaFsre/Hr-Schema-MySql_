//javascrip funkcija za nav bar potreban za responzivnost kad se sadrzaj prikaziva na mobilnim uredajima.
function navBarResponzive() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
