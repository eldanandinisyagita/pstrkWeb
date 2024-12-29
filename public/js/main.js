function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodeCookie = decodeURIComponent(document.cookie);
  let dataCookie = decodeCookie.split(";");

  for (let i = 0; i < dataCookie.length; i++) {
      let c = dataCookie[i];
      while (c.charAt(0) == " ") {
          //if there is value ' ayam'  should be 'ayam'
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}

function deleteCookie(name) {
  document.cookie = name + "=;  Max-Age=0; path=/; domain=" + location.host;
}
