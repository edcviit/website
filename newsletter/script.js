const scrollDiv = document.getElementById("scrollDiv");
let scrolled = false;

window.addEventListener("scroll", () => {
  if (window.scrollY > 50 && !scrolled) {
    scrollDiv.style.opacity = 0;
    scrolled = true;
    console.log("ello");
  } else if (window.scrollY <= 50 && scrolled) {
    scrollDiv.style.opacity = 1;
    scrolled = false;
  }
});

const icon = document.getElementById("click-icon");
const text = document.getElementById("clicked-text");
const iconn = document.getElementById("liked-by-user");

icon.addEventListener("click", () => {
  text.style.fontSize = "16px";
  icon.style.display = "none";
  iconn.style.display = "block";
  localStorage.setItem("liked", "yes");
  // Set a timeout to hide the text after 2 seconds (2000 milliseconds)
  setTimeout(() => {
    text.style.fontSize = 0;
  }, 2000);
});

const icon2 = document.getElementById("click-icon2");
const text2 = document.getElementById("clicked-text2");

function copy() {
  // var copyText = document.querySelector("#copy-link");
  // copyText.select();
  // document.execCommand("copy");
  // icon2.click();
  navigator.share("Hello world");

  navigator.clipboard.writeText("edcviit.github.io/newsletter/").then(
    function () {
      text2.style.fontSize = "16px";
      // console.log("Copied to clipboard successfully!");
      setTimeout(() => {
        text2.style.fontSize = 0;
      }, 2000);
    },
    function () {
      console.error("Unable to write to clipboard. :-(");
    }
  );
}
document.querySelector("#copy").addEventListener("click", copy);

if (localStorage.getItem("liked")) {
  icon.style.display = "none";
  iconn.style.display = "block";
}
