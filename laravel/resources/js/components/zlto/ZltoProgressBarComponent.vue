<template>
    <div class="progress-container" data-percentage='90'>
  <div class="progress"></div>
  <div class="percentage">0%</div>
</div>
</template>
<script>
const progressContainer = document.querySelector('.progress-container');

// initial call
setPercentage();

function setPercentage() {
  const percentage = progressContainer.getAttribute('data-percentage') + '%';
  
  const progressEl = progressContainer.querySelector('.progress');
  const percentageEl = progressContainer.querySelector('.percentage');
  
  progressEl.style.width = percentage;
  percentageEl.innerText = percentage;
  percentageEl.style.left = percentage;
}
</script>
<style scoped>


.progress-container {
  box-shadow: 0 4px 5px rgb(0, 0, 0, 0.1)
}

.progress-container, .progress {
  background-color: #eee;
  border-radius: 5px;
  position: relative;
  height: 7px;
  width: 300px;
}

.progress {
  background-color: #6F39B0;
  width: 0;
  transition: width 0.4s linear;
}

.percentage {
  background-color: #6F39B0;
  border-radius: 5px;
  box-shadow: 0 4px 5px rgb(0, 0, 0, 0.2);
  color: #fff;
  font-size: 12px;
  padding: 4px;
  position: absolute;
  top: 20px;
  left: 0;
  transform: translateX(-50%);
  width: 40px;
  text-align: center;
  transition: left 0.4s linear;
}

.percentage::after {
  background-color: #6F39B0;
  content: '';
  position: absolute;
  top: -5px;
  left: 50%;
  transform: translateX(-50%) rotate(45deg);
  height: 10px;
  width: 10px;
  z-index: -1;
}
</style>