<div class="top">
  <div class="marquee-container">
    <div class="marquee-content">
      <span class="marquee-text">Obtenez une expérience complète qui allie sécurité, esthétique et innovation.</span>
      <span class="marquee-text">Obtenez une expérience complète qui allie sécurité, esthétique et innovation.</span>
      <span class="marquee-text">Obtenez une expérience complète qui allie sécurité, esthétique et innovation.</span>
      <span class="marquee-text">Obtenez une expérience complète qui allie sécurité, esthétique et innovation.</span>
    </div>
  </div>
</div>

<style>
.top {
  background-color: #000;
  width: 100vw;
  overflow: hidden;
  height: 40px;
  display: flex;
  align-items: center;
  position: relative;
}

.marquee-container {
  width: 100%;
  overflow: hidden;
  white-space: nowrap;
}

.marquee-content {
  display: inline-block;
  white-space: nowrap;
  animation: marquee-scroll 40s linear infinite;
}

.marquee-text {
  display: inline-block;
  color: white;
  font-size: 18px;
  font-weight: bold;
  font-style: italic;
  line-height: 40px;
  padding: 0 40px;
}

/* Continuous scrolling animation */
@keyframes marquee-scroll {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}
</style>
