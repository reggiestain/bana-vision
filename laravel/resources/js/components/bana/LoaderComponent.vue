<template>
  <div class="loader">
    <img src="../../../assets/img/bana1.png" alt="Logo" class="logo" />
    <span class="slider"></span>
  </div>
</template>
<script></script>

<style scoped>
body {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.logo {
  width: 60px;
  user-select: none;
}
.slider {
  width: 140px;
  height: 4px;
  background: #ccc;
  margin-top: 20px;
  position: relative;
  overflow: hidden;
}

.slider::before {
  content: "";
  width: 65px;
  height: 4px;
  background: #ff5211;
  position: absolute;
  left: 100px;
  animation: animate 1.5s ease infinite;
}

@keyframes animate {
  50% {
    left: -30px;
  }
}
</style>
