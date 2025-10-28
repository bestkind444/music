document.addEventListener("DOMContentLoaded", function () {
  const audio = new Audio();
  const playButtons = document.querySelectorAll(".play-btn");
  const playPauseBtn = document.querySelector(".jp-play");
  const nextBtn = document.querySelector(".jp-next");
  const prevBtn = document.querySelector(".jp-previous");
  const muteBtn = document.querySelector(".jp-mute");
  const currentTrackDisplay = document.getElementById("current-track1");
  const progressBar = document.querySelector(".jp-seek-bar");
  const playBar = document.querySelector(".jp-play-bar");
  const volumeBar = document.querySelector(".jp-volume-bar");
  const volumeBarValue = document.querySelector(".jp-volume-bar-value");

  let songs = [];
  let currentIndex = 0;

  // collect all songs
  playButtons.forEach((btn, i) => {
    songs.push({
      path: btn.dataset.path,
      title: btn.dataset.title,
      artist: btn.dataset.artist,
    });
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      currentIndex = i;
      playSong();
    });
  });

  // PLAY / PAUSE button
  playPauseBtn.addEventListener("click", () => {
    if (audio.src === "") return; // no song loaded
    if (audio.paused) {
      audio.play();
      toggleIcon(true);
    } else {
      audio.pause();
      toggleIcon(false);
    }
  });

  // NEXT
  nextBtn.addEventListener("click", () => {
    if (songs.length === 0) return;
    currentIndex = (currentIndex + 1) % songs.length;
    playSong();
  });

  // PREV
  prevBtn.addEventListener("click", () => {
    if (songs.length === 0) return;
    currentIndex = (currentIndex - 1 + songs.length) % songs.length;
    playSong();
  });

  // MUTE
  muteBtn.addEventListener("click", () => {
    audio.muted = !audio.muted;
    muteBtn.classList.toggle("muted", audio.muted);
  });

  // PLAY SONG
  function playSong() {
    const song = songs[currentIndex];
    audio.src = song.path;
    audio.play();
    currentTrackDisplay.textContent = `${song.title} — ${song.artist}`;
    toggleIcon(true);
  }

  // ICON toggle
  function toggleIcon(isPlaying) {
    const playIcon = playPauseBtn.querySelector(".fa-play");
    const pauseIcon = playPauseBtn.querySelector(".fa-pause");

    if (isPlaying) {
      playIcon.style.display = "none";
      pauseIcon.style.display = "inline-block";
    } else {
      playIcon.style.display = "inline-block";
      pauseIcon.style.display = "none";
    }
  }

  // UPDATE progress bar
  audio.addEventListener("timeupdate", () => {
    const progress = (audio.currentTime / audio.duration) * 100;
    playBar.style.width = `${progress}%`;
  });

  // SEEK when user clicks progress bar
  progressBar.addEventListener("click", (e) => {
    const barWidth = progressBar.clientWidth;
    const clickX = e.offsetX;
    const newTime = (clickX / barWidth) * audio.duration;
    audio.currentTime = newTime;
  });

  // UPDATE volume bar
  audio.volume = 0.7; // default
  volumeBarValue.style.width = `${audio.volume * 100}%`;

  volumeBar.addEventListener("click", (e) => {
    const barWidth = volumeBar.clientWidth;
    const clickX = e.offsetX;
    const newVolume = clickX / barWidth;
    audio.volume = newVolume;
    volumeBarValue.style.width = `${newVolume * 100}%`;
  });

  // AUTO NEXT on song end
  audio.addEventListener("ended", () => {
    currentIndex = (currentIndex + 1) % songs.length;
    playSong();
  });

  toggleIcon(false);
});