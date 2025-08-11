// loader section start here
window.addEventListener("load", () => {
  setTimeout(() => {
    document.querySelector(".loading-screen").style.display = "none";
    document.getElementById("main-content").style.display = "block";
  }, 1000);
});
// loader section end here