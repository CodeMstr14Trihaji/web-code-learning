# Music Player

HTML:
```html
<div class="player-container">
  <div class="player-header">
    <button class="control-btn-base minimize-btn">&#9662;</button>
    <div class="volume-control">
      <span class="speaker-icon">&#x1F508;</span>
      <input type="range" min="0" max="100" value="80" class="volume-slider" id="volume-slider">
      <span class="speaker-icon">&#x1F50A;</span>
    </div>
    <button class="control-btn-base more-options-btn">&#8942;</button>
  </div>

  <div class="controls-container">
    <div class="album-cover">
      <img src="" alt="Album cover" id="album-image" class="album-image">
      <button class="control-btn-base more-options-btn">&#8942;</button>
    </div>

    <div class="track-info">
      <div class="track-title" id="track-title">Track Title</div>
      <div class="track-artist" id="track-artist">Artist Name — Album</div>
    </div>

    <div class="playback-controls">
      <button class="control-btn control-btn-base" id="prev-btn">&#9198;</button>
      <button class="play-btn" id="play-btn">
        <div class="play-btn-inner-ring"></div>
        <span>&#9658;</span>
      </button>
      <button class="control-btn control-btn-base" id="next-btn">&#9197;</button>
    </div>

    <div class="progress-container">
      <div class="progress-bar" id="progress-bar">
        <div class="progress" id="progress">
          <div class="progress-handle"></div>
        </div>
      </div>
      <div class="time-info">
        <span id="current-time">0:00</span>
        <span id="duration">0:00</span>
      </div>
    </div>

    <div class="waveform" id="waveform">
    </div>
  </div>
</div>

<audio id="audio-player" crossorigin="anonymous"></audio>
```

CSS
```css
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  overflow: hidden;
  background-color: #f5626b;
}

.player-container {
  width: 100%;
  max-width: 400px;
  max-height: 98vh;
  border-radius: 20px;
  overflow: hidden;
  background: linear-gradient(180deg, #232731 0%, #1a1d24 100%);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
}

.player-header {
  padding: 8px 15px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #fff;
  flex-shrink: 0;
  gap: 10px;
  border-bottom: none;
}

.volume-control {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-grow: 1;
  justify-content: center;
}

.speaker-icon {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.7);
}

.control-btn-base {
  background: none;
  border: none;
  color: #fff;
  cursor: pointer;
  font-size: 20px;
  padding: 8px;
  border-radius: 50%;
  width: 36px;
  height: 36px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.2s ease, color 0.2s ease;
  flex-shrink: 0;
}

.control-btn-base:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.minimize-btn {}

.player-header .more-options-btn {}

.controls-container {
  padding: 15px 20px 20px;
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.album-cover {
  position: relative;
  width: 100%;
  padding-top: min(100%, 45vh);
  background-color: #0d0f16;
  margin-bottom: 15px;
  flex-shrink: 0;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.25);
}

.album-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: opacity 0.5s ease;
  opacity: 0;
}

.album-cover .more-options-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  background-color: rgba(0, 0, 0, 0.3);
  width: 36px;
  height: 36px;
  z-index: 10;
}

.album-cover .more-options-btn:hover {
  background-color: rgba(0, 0, 0, 0.5);
}

.track-info {
  color: #fff;
  margin-bottom: 15px;
  flex-shrink: 0;
  text-align: center;
}

.track-title {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 4px;
  color: #ffffff;
  text-shadow: none;
}

.track-artist {
  font-size: 12px;
  color: rgba(255, 255, 255, 0.7);
}

.playback-controls {
  display: flex;
  justify-content: space-around;
  align-items: center;
  margin-bottom: 15px;
  flex-shrink: 0;
}

.control-btn {
  font-size: 20px;
}

.play-btn {
  position: relative;
  width: 55px;
  height: 55px;
  border-radius: 50%;
  background: linear-gradient(145deg, #f77078, #e0505a);
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 6px 18px rgba(245, 98, 107, 0.45);
  font-size: 24px;
  color: #ffffff;
  border: none;
  cursor: pointer;
  transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
  overflow: hidden;
}

.play-btn:hover {
  background: linear-gradient(145deg, #f87d85, #e65c67);
  transform: scale(1.05);
  box-shadow: 0 8px 22px rgba(245, 98, 107, 0.5);
}

.play-btn:active {
  transform: scale(0.98);
  box-shadow: 0 4px 12px rgba(245, 98, 107, 0.4);
}

.play-btn span {
  position: relative;
  z-index: 2;
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.9);
  }
  70% {
    box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
  }
}

@keyframes spin-clockwise {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes spin-clockwise-offset {
  0% {
    transform: rotate(45deg);
  }
  100% {
    transform: rotate(405deg);
  }
}

.play-btn::before {
  content: '';
  position: absolute;
  width: 73px;
  height: 73px;
  top: -9px;
  left: -9px;
  border: 4px dashed rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  opacity: 0;
  transition: opacity 0.3s ease;
  box-sizing: border-box;
  filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.7));
}

.play-btn::after {
  content: '';
  position: absolute;
  width: 65px;
  height: 65px;
  top: -5px;
  left: -5px;
  border: 5px solid transparent;
  border-top: 5px solid white;
  border-right: 5px solid white;
  border-radius: 50%;
  opacity: 0;
  transition: opacity 0.3s ease;
  box-sizing: border-box;
  filter: drop-shadow(0 0 3px white);
}

.play-btn-inner-ring {
  position: absolute;
  width: 59px;
  height: 59px;
  top: -2px;
  left: -2px;
  border: 3px solid transparent;
  border-bottom: 3px solid rgba(255, 255, 255, 0.9);
  border-left: 3px solid rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  opacity: 0;
  transition: opacity 0.3s ease;
  box-sizing: border-box;
  pointer-events: none;
}

.play-btn.playing-border {
  animation: pulse 2s infinite;
}

.play-btn.playing-border::before {
  opacity: 1;
  animation: spin-clockwise 4s linear infinite;
}

.play-btn.playing-border::after {
  opacity: 1;
  animation: spin-clockwise 2s linear infinite;
}

.play-btn.playing-border .play-btn-inner-ring {
  opacity: 1;
  animation: spin-clockwise-offset 3s linear infinite;
}

.progress-container {
  margin-bottom: 10px;
  flex-shrink: 0;
}

.progress-bar {
  width: 100%;
  height: 5px;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 3px;
  cursor: pointer;
  position: relative;
  margin-bottom: 8px;
  overflow: visible;
}

.progress {
  width: 0%;
  height: 100%;
  background-color: #fff;
  border-radius: 3px;
  position: relative;
  transition: width 0.1s linear;
}

.progress-handle {
  width: 14px;
  height: 14px;
  background-color: #fff;
  border-radius: 50%;
  position: absolute;
  right: -7px;
  top: 50%;
  transform: translateY(-50%) scale(0);
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
  opacity: 0;
  transition: opacity 0.2s ease, transform 0.2s ease;
}

.progress-bar:hover .progress-handle {
  opacity: 1;
  transform: translateY(-50%) scale(1);
}

.time-info {
  display: flex;
  justify-content: space-between;
  color: rgba(255, 255, 255, 0.7);
  font-size: 12px;
  font-weight: normal;
}

.waveform {
  display: flex;
  align-items: flex-end;
  height: 40px;
  gap: 2px;
  margin-bottom: 15px;
  flex-shrink: 0;
  overflow: hidden;
  opacity: 1;
}

.waveform-bar {
  flex: 1;
  background-color: #f5626b;
  border-radius: 2px 2px 0 0;
  transition: height 0.1s ease;
  min-height: 2px;
}

.volume-slider {
  width: 100%;
  height: 5px;
  -webkit-appearance: none;
  appearance: none;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 3px;
  cursor: pointer;
  outline: none;
  transition: background-color 0.2s ease;
}

.volume-slider:hover {
  background: rgba(255, 255, 255, 0.3);
}

.volume-slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 14px;
  height: 14px;
  background: #fff;
  border-radius: 50%;
  cursor: pointer;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  transition: transform 0.15s ease;
}

.volume-slider::-webkit-slider-thumb:hover {
  transform: scale(1.1);
}

.volume-slider::-moz-range-thumb {
  width: 14px;
  height: 14px;
  background: #fff;
  border-radius: 50%;
  cursor: pointer;
  border: none;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  transition: transform 0.15s ease;
}

.volume-slider::-moz-range-thumb:hover {
  transform: scale(1.1);
}

@media (max-width: 480px) {
  .player-container {
    max-width: 100%;
    height: 100%;
    max-height: 100%;
    border-radius: 0;
    border: none;
    box-shadow: none;
    background: linear-gradient(180deg, #232731 0%, #1a1d24 100%);
  }
  .controls-container {
    padding: 15px;
  }
  .album-cover {
    padding-top: min(100%, 40vh);
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.25);
  }
  body {
    background: #f5626b;
  }
  .player-header {
    padding: 8px 12px;
    gap: 8px;
  }
  .volume-control {
    gap: 5px;
  }
  .play-btn {
    width: 55px;
    height: 55px;
    font-size: 24px;
  }
}
```

Javasript
```js
const tracks = [{
  id: 1,
  title: 'Inside Voice',
  artist: 'Artist',
  album: 'Album',
  cover: 'https://static.wixstatic.com/media/3d9313_297eadd7ade34c0fa48d27253d95dcc9~mv2.png',
  audioSrc: 'https://static.wixstatic.com/mp3/3d9313_64af6a309ea1494e9d4efe3ab004510b.mp3'
}, {
  id: 2,
  title: 'Dance Track',
  artist: 'Artist',
  album: 'Album',
  cover: 'https://static.wixstatic.com/media/3d9313_906e080e664c4c7191563e88fa808542~mv2.png',
  audioSrc: 'https://static.wixstatic.com/mp3/3d9313_9c3d1f38f2534166a0d5c2507a0aa2cd.mp3'
}];

let currentTrackIndex = 0;
let isPlaying = false;
let audioContext = null;
let analyser = null;
let audioSource = null;
let animationFrameId = null;

const audioPlayer = document.getElementById('audio-player');
const playBtn = document.getElementById('play-btn');
const playBtnIcon = playBtn.querySelector('span');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const progressBar = document.getElementById('progress-bar');
const progress = document.getElementById('progress');
const currentTimeEl = document.getElementById('current-time');
const durationEl = document.getElementById('duration');
const trackTitleEl = document.getElementById('track-title');
const trackArtistEl = document.getElementById('track-artist');
const albumImageEl = document.getElementById('album-image');
const waveformEl = document.getElementById('waveform');
const volumeSlider = document.getElementById('volume-slider');

audioPlayer.volume = volumeSlider.value / 100;

function createWaveformBars() {
  waveformEl.innerHTML = '';
  const barCount = 32;
  for (let i = 0; i < barCount; i++) {
    const bar = document.createElement('div');
    bar.className = 'waveform-bar';
    bar.style.height = '2px';
    waveformEl.appendChild(bar);
  }
  console.log('Waveform bars created.');
}

function setupAudioContext() {
  try {
    if (!audioContext) {
      console.log('Attempting to create AudioContext...');
      audioContext = new(window.AudioContext || window.webkitAudioContext)();
      console.log('AudioContext created successfully.');
      analyser = audioContext.createAnalyser();
      analyser.fftSize = 64;
      console.log('Analyser created.');
      if (!audioSource) {
        console.log('Creating MediaElementSource...');
        audioSource = audioContext.createMediaElementSource(audioPlayer);
        console.log('MediaElementSource created.');
      }
      audioSource.connect(analyser);
      analyser.connect(audioContext.destination);
      console.log('Audio nodes connected.');
    }
    if (audioContext.state === 'suspended') {
      audioContext.resume().then(() => {
        console.log('AudioContext resumed.');
        if (!animationFrameId && isPlaying) {
          startVisualization();
        }
      });
    }
  } catch (error) {
    console.error("Audio Context setup failed:", error);
    waveformEl.innerHTML = '<p style="color: #aaa; font-size: 10px; text-align: center; width: 100%;">Visualization unavailable</p>';
  }
}

function startVisualization() {
  if (!analyser || !audioContext || audioContext.state !== 'running') {
    console.log('Cannot start visualization: Analyser or AudioContext not ready or not running.');
    if (animationFrameId) {
      cancelAnimationFrame(animationFrameId);
      animationFrameId = null;
    }
    return;
  }
  const dataArray = new Uint8Array(analyser.frequencyBinCount);
  const bars = waveformEl.children;
  if (!bars || bars.length === 0 || !(bars[0] instanceof HTMLElement)) {
    console.warn('Waveform bars not found or invalid, stopping visualization.');
    if (animationFrameId) {
      cancelAnimationFrame(animationFrameId);
      animationFrameId = null;
    }
    return;
  }

  function updateBars() {
    if (!isPlaying || !audioContext || audioContext.state !== 'running') {
      for (let i = 0; i < bars.length; i++) {
        if (bars[i] instanceof HTMLElement) {
          bars[i].style.height = `2px`;
        }
      }
      animationFrameId = null;
      return;
    }
    analyser.getByteFrequencyData(dataArray);
    for (let i = 0; i < bars.length; i++) {
      if (bars[i] instanceof HTMLElement) {
        const dataIndex = Math.floor(i * dataArray.length / bars.length);
        const value = dataArray[dataIndex] / 255;
        const containerHeight = 40;
        const height = value * (containerHeight - 2) + 2;
        bars[i].style.height = `${Math.max(2, height)}px`;
      }
    }
    animationFrameId = requestAnimationFrame(updateBars);
  }
  if (animationFrameId) {
    cancelAnimationFrame(animationFrameId);
  }
  updateBars();
}

function formatTime(seconds) {
  if (isNaN(seconds)) return '0:00';
  const mins = Math.floor(seconds / 60);
  const secs = Math.floor(seconds % 60);
  return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
}

function loadTrack(trackIndex) {
  console.log(`Loading track index: ${trackIndex}`);
  const track = tracks[trackIndex];
  trackTitleEl.textContent = track.title;
  trackArtistEl.textContent = `${track.artist} — ${track.album}`;

  const currentSrc = albumImageEl.src;
  const newSrc = track.cover || '';

  if (currentSrc !== newSrc) {
    albumImageEl.style.opacity = 0;
    setTimeout(() => {
      albumImageEl.src = newSrc;
      albumImageEl.onerror = () => {
        console.warn(`Failed to load cover image: ${newSrc}`);
        albumImageEl.src = 'https://placehold.co/400x400/0d0f16/777?text=Cover+Art';
        albumImageEl.style.opacity = 1;
      };
      albumImageEl.onload = () => {
        albumImageEl.style.opacity = 1;
      };
      if (!albumImageEl.src) {
        albumImageEl.style.opacity = 1;
      }
    }, 300);
  } else if (albumImageEl.style.opacity === '0') {
    albumImageEl.style.opacity = 1;
  }

  audioPlayer.src = track.audioSrc;
  audioPlayer.load();
  console.log(`Audio source set to: ${track.audioSrc}`);
  progress.style.width = '0%';
  currentTimeEl.textContent = '0:00';
  durationEl.textContent = '0:00';
  audioPlayer.onloadedmetadata = () => {
    console.log(`Metadata loaded. Duration: ${audioPlayer.duration}`);
    durationEl.textContent = formatTime(audioPlayer.duration);
  };
  audioPlayer.onerror = (e) => {
    console.error("Audio loading error:", e);
    console.error(`Failed to load audio: ${track.audioSrc}`);
    durationEl.textContent = "Error";
  };

  if (isPlaying) {
    playAudio();
  } else {
    if (playBtnIcon) playBtnIcon.innerHTML = '&#9658;';
    playBtn.classList.remove('playing-border');
  }
}

function playAudio() {
  if (!audioContext) {
    setupAudioContext();
  } else if (audioContext.state === 'suspended') {
    audioContext.resume().then(() => console.log('AudioContext resumed on play.'));
  }
  if (audioContext && audioContext.state !== 'running') {
    console.warn('AudioContext not running. Attempting to resume...');
    audioContext.resume().then(() => {
      console.log('AudioContext resumed, now attempting play.');
      attemptPlay();
    }).catch(err => {
      console.error('Failed to resume AudioContext:', err);
    });
  } else {
    attemptPlay();
  }
}

function attemptPlay() {
  const playPromise = audioPlayer.play();
  if (playPromise !== undefined) {
    playPromise.then(() => {
      console.log('Audio playback started.');
      isPlaying = true;
      if (playBtnIcon) playBtnIcon.innerHTML = '&#10074;&#10074;';
      playBtn.classList.add('playing-border');
      if (audioContext && audioContext.state === 'running') {
        startVisualization();
      } else {
        console.log('Visualization not started: AudioContext not ready.');
      }
    }).catch(error => {
      console.error("Audio play failed:", error);
      isPlaying = false;
      if (playBtnIcon) playBtnIcon.innerHTML = '&#9658;';
      playBtn.classList.remove('playing-border');
      if (animationFrameId) {
        cancelAnimationFrame(animationFrameId);
        animationFrameId = null;
      }
    });
  } else {
    try {
      audioPlayer.play();
      console.log('Audio playback started (no promise).');
      isPlaying = true;
      if (playBtnIcon) playBtnIcon.innerHTML = '&#10074;&#10074;';
      playBtn.classList.add('playing-border');
      if (audioContext && audioContext.state === 'running') {
        startVisualization();
      }
    } catch (error) {
      console.error("Audio play failed (sync):", error);
      isPlaying = false;
      if (playBtnIcon) playBtnIcon.innerHTML = '&#9658;';
      playBtn.classList.remove('playing-border');
    }
  }
}

function pauseAudio() {
  audioPlayer.pause();
  isPlaying = false;
  if (playBtnIcon) playBtnIcon.innerHTML = '&#9658;';
  playBtn.classList.remove('playing-border');
  console.log('Audio playback paused.');
}

function createInnerRing() {
  if (!document.querySelector('.play-btn-inner-ring')) {
    const innerRing = document.createElement('div');
    innerRing.className = 'play-btn-inner-ring';
    playBtn.prepend(innerRing);
  }
}

function togglePlayPause() {
  createInnerRing();
  if (isPlaying) {
    pauseAudio();
  } else {
    playAudio();
  }
}

function prevTrack() {
  currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
  loadTrack(currentTrackIndex);
}

function nextTrack() {
  currentTrackIndex = (currentTrackIndex + 1) % tracks.length;
  loadTrack(currentTrackIndex);
}

function updateProgress(e) {
  if (!audioPlayer.duration || isNaN(audioPlayer.duration)) return;
  const progressBarRect = progressBar.getBoundingClientRect();
  const clickPositionX = e.clientX - progressBarRect.left;
  const width = progressBarRect.width;
  const percentage = Math.max(0, Math.min(1, clickPositionX / width));
  audioPlayer.currentTime = audioPlayer.duration * percentage;
  console.log(`Seeked to ${formatTime(audioPlayer.currentTime)}`);
  progress.style.width = `${percentage * 100}%`;
}

function updateVolume() {
  const volumeValue = volumeSlider.value / 100;
  audioPlayer.volume = volumeValue;
  console.log(`Volume set to: ${Math.round(volumeValue * 100)}%`);
}

audioPlayer.addEventListener('timeupdate', () => {
  if (!audioPlayer.duration || isNaN(audioPlayer.duration)) return;
  currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
  const percentage = (audioPlayer.currentTime / audioPlayer.duration) * 100;
  progress.style.width = `${percentage}%`;
});
audioPlayer.addEventListener('ended', () => {
  console.log('Track ended, playing next.');
  nextTrack();
});
playBtn.addEventListener('click', togglePlayPause);
prevBtn.addEventListener('click', prevTrack);
nextBtn.addEventListener('click', nextTrack);
progressBar.addEventListener('click', updateProgress);
volumeSlider.addEventListener('input', updateVolume);

createWaveformBars();
loadTrack(currentTrackIndex);

console.log('Music player initialized.');
```