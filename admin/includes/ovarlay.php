<?php
// overlay.php
?>

<!-- Reusable Overlay -->
<div class="overlay" id="overlay">
  <div class="alert-box" id="alertBox">
    <div class="spinner" id="spinner"></div>
    <span id="alertText">Processing...</span>
  </div>
</div>

<!-- Overlay CSS -->
<style>
.overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}
.alert-box {
  background: #333;
  color: white;
  padding: 20px 40px;
  border-radius: 10px;
  text-align: center;
  font-size: 18px;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #00ff99;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
  margin-bottom: 10px;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.checkmark {
  font-size: 40px;
  color: #00ff99;
  margin-bottom: 10px;
}
</style>

<!-- Overlay JS -->
<script>
const overlay = document.getElementById("overlay");
const spinner = document.getElementById("spinner");
const alertText = document.getElementById("alertText");
const alertBox = document.getElementById("alertBox");

function showOverlay(message = "Processing...") {
  if (!overlay) return console.error("❌ Overlay not found in DOM");
  overlay.style.display = "flex";
  spinner.style.display = "block";
  alertText.style.color = "white";
  alertText.textContent = message;
  return message;
}

function hideOverlay() {
  overlay.style.display = "none";
}

function showSuccess(message = "Success!", redirectUrl = null) {
  spinner.style.display = "none";

  let check = document.createElement("div");
  check.classList.add("checkmark");
  check.innerHTML = "&#10003;";
  alertBox.insertBefore(check, alertText);

  alertText.textContent = message;

  setTimeout(() => {
      hideOverlay();
      check.remove();
      spinner.style.display = "block";
  }, 2000);
  return message;
}

function showError(message = "Something went wrong") {
  spinner.style.display = "none";
  alertText.textContent = message;
  alertText.style.color = "red";

  setTimeout(() => {
    hideOverlay();
    spinner.style.display = "block";
    alertText.style.color = "white";
  }, 2000);
  return message;
}
</script>
