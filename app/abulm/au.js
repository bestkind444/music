document.addEventListener("DOMContentLoaded", () => {
  const audio = new Audio();
  const playPauseBtn = document.querySelector(".jp-play");
  const nextBtn = document.querySelector(".jp-next");
  const prevBtn = document.querySelector(".jp-previous");
  const muteBtn = document.querySelector(".jp-mute");
  const currentTrackDisplay = document.getElementById("current-track5");
  const progressBar = document.querySelector(".jp-seek-bar");
  const playBar = document.querySelector(".jp-play-bar");
  const volumeBar = document.querySelector(".jp-volume-bar");
  const volumeBarValue = document.querySelector(".jp-volume-bar-value");
  const playlistUL = document.querySelector(".jp-playlist ul");
  const albumWrap = document.querySelector(".wm-album-medium-wrap");

  let songs = [];
  let currentIndex = 0;

  // 🎵 Load Album Songs Smoothly
  document.addEventListener("click", async (e) => {
    const albumItem = e.target.closest(".album-item");
    if (!albumItem) return;
    e.preventDefault();

    const albumId = albumItem.dataset.albumId;
    if (!albumId) return;

    try {
      const res = await fetch(`get_album_songs.php?album_id=${albumId}`);
      const data = await res.json();

      // Animate fade out
      albumWrap.style.transition = "opacity 0.4s ease, transform 0.4s ease";
      albumWrap.style.opacity = "0";
      albumWrap.style.transform = "translateY(20px)";

      setTimeout(() => {
        // Update album info
        if (data.album) {
          albumWrap.querySelector("img").src = `../../${data.album.artworkPath}`;
          albumWrap.querySelector("h2 a").textContent = data.album.title;
          albumWrap.querySelector(".wm-album-options li:nth-child(2)").innerHTML =
            `<span>Release Date:</span> ${data.album.created_at}`;
          albumWrap.querySelector(".wm-album-options li:nth-child(3)").innerHTML =
            `<span>Genre:</span> ${data.album.genreName}`;
          albumWrap.querySelector("p").textContent =
            data.album.artistBio || "Description is not available.";
        }

        // Animate fade in
        setTimeout(() => {
          albumWrap.style.opacity = "1";
          albumWrap.style.transform = "translateY(0)";
        }, 300);

        //  Update album team members
        const teamContainer = document.querySelector(".wm-artist-grid");
        if (teamContainer) {
          if (data.team && data.team.length > 0) {
            teamContainer.innerHTML = ""; 
            
           
            data.team.forEach(member => {
              const div = document.createElement("div");
              div.classList.add("wm-artist-slider-layer");
              div.innerHTML = `
          <figure>
              <a href="../../${member.member_image}" data-lightbox="team-gallery" data-title="${member.member_name}">
            <img src="../../${member.member_image}" alt="${member.member_name}" style="border-radius:20px;">
          </a>
            <figcaption>
              <a href="#"><i class="flaticon-link"></i></a>
            </figcaption>
          </figure>
          <div class="wm-artist-title">
            <h2><a href="#">${member.member_name}</a></h2>
            <span>Collaborator</span>
          </div>
        `;
              teamContainer.appendChild(div);
            });
          } else {
            teamContainer.innerHTML = `
        <p style="padding: 10px; text-align:center;">No team members for this album.</p>
      `;
          }
        }





        // Setup playlist
        songs = data.songs || [];
        currentIndex = 0;
        playlistUL.innerHTML = "";

        if (songs.length === 0) {
          playlistUL.innerHTML = "<li>No songs found in this album.</li>";
          currentTrackDisplay.textContent = "No songs";
          return;
        }

        currentTrackDisplay.textContent = `${data.album.title} – ${songs[0].artistName}`;

        songs.forEach((song, i) => {
          const li = document.createElement("li");
          li.classList.add("song-item");
          li.innerHTML = `
            <div class="jp-playlist-item">
              <button class="play-btn" data-index="${i}">
                <i style="font-size:14px;padding:15px;  border-radius: 50%;" class="fa fa-play"></i>
              </button>
              <span style="font-size:18px;">${song.title} (${song.genreName})</span>
            </div>`;
          playlistUL.appendChild(li);
        });

        // Click song to play
        playlistUL.querySelectorAll(".play-btn").forEach((btn) => {
          btn.addEventListener("click", (e) => {
            e.preventDefault();
            currentIndex = parseInt(btn.dataset.index);
            playSong();
          });
        });
      }, 300);
    } catch (err) {
      console.error("Error loading album:", err);
    }
  });







  // ▶️ / ⏸️ Toggle
  playPauseBtn.style.cursor = "pointer";
  playPauseBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (!audio.src) return;
    if (audio.paused) audio.play().catch((err) => console.error("Play blocked:", err));
    else audio.pause();
  });

  audio.addEventListener("play", () => toggleIcon(true));
  audio.addEventListener("pause", () => toggleIcon(false));

  // ⏭️ Next / ⏮️ Prev
  nextBtn.addEventListener("click", () => {
    if (!songs.length) return;
    currentIndex = (currentIndex + 1) % songs.length;
    playSong();
  });

  prevBtn.addEventListener("click", () => {
    if (!songs.length) return;
    currentIndex = (currentIndex - 1 + songs.length) % songs.length;
    playSong();
  });

  // 🔇 Mute
  muteBtn.addEventListener("click", () => {
    audio.muted = !audio.muted;
    muteBtn.classList.toggle("muted", audio.muted);
  });

  //  Play Function
  function playSong() {
    if (!songs[currentIndex]) return;
    const song = songs[currentIndex];
    document.querySelectorAll(".song-item").forEach((li, i) => {
      li.classList.toggle("active", i === currentIndex);
    });

    const songPath = song.path.startsWith("assets/") ? `../../${song.path}` : song.path;
    audio.src = songPath;
    audio.load();
    toggleIcon(false);
    audio
      .play()
      .then(() => {
        currentTrackDisplay.textContent = `${song.title} — ${song.artistName}`;
        toggleIcon(true);
      })
      .catch((err) => console.error("Play error:", err));
  }

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

  // Progress
  audio.addEventListener("timeupdate", () => {
    if (!audio.duration) return;
    playBar.style.width = `${(audio.currentTime / audio.duration) * 100}%`;
  });

  progressBar.addEventListener("click", (e) => {
    if (!audio.duration) return;
    audio.currentTime = (e.offsetX / progressBar.clientWidth) * audio.duration;
  });

  // Volume
  audio.volume = 0.7;
  volumeBarValue.style.width = `${audio.volume * 100}%`;
  volumeBar.addEventListener("click", (e) => {
    const newVol = e.offsetX / volumeBar.clientWidth;
    audio.volume = newVol;
    volumeBarValue.style.width = `${newVol * 100}%`;
  });

  // Auto-next
  audio.addEventListener("ended", () => {
    currentIndex = (currentIndex + 1) % songs.length;
    playSong();
  });

  toggleIcon(false);
});
