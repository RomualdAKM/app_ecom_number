<script setup>
</script>

<template>
  <!-- Banner Section with Scrolling Background -->
  <div class="relative overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-no-repeat bg-center animate-zoom-in" style="background-image: url('images/banner-bg.jpg');"></div>

    <!-- Content Overlay with Fade-In Animation -->
    <div class="relative z-10 py-40 text-center text-white bg-black bg-opacity-50 flex flex-col items-center justify-center animate-fade-in">
      <!-- Banner Content with Slide-In Animation -->
      <div class="animate-slide-in-bottom">
        <h2 class="xl:text-6xl md:text-3xl text-2xl font-bold mb-6">
          Développez votre Réseau
          <br class="hidden sm:block">Instantanément !
        </h2>
      </div>
      <div class="animate-slide-in-bottom delay-500">
        <p class="text-lg leading-8 mb-10">
          Accédez à des milliers de contacts qualifiés en un clic.
          <br class="hidden sm:block">
          Démarrez vos campagnes marketing ou élargissez votre réseau professionnel dès aujourd'hui.
        </p>
      </div>
      <!-- Call to Action Button with Hover Effect -->
      <div class="animate-fade-in delay-1000">
        <a href="#acheterMaintenant" class="bg-primary border border-primary text-white px-10 py-4 font-medium rounded-full uppercase transition-transform hover:scale-105 duration-500 ease-in-out">
            ACHETER MAINTENANT
        </a>
      </div>
    </div>
    <!-- Banner Section End -->
  </div>
</template>

<style scoped>
/* Animation for Zoom-In Background */
@keyframes zoom-in {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.2);
  }
}

.animate-zoom-in {
  animation: zoom-in 20s linear infinite;
}

/* Background color for button */
.bg-primary {
  background-color: #1f2937;
}

.border-primary {
  border-color: #1f2937;
}


/* Animation for Fade-In */
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.animate-fade-in {
  animation: fade-in 1s ease-in;
}

/* Animation for Slide-In from Bottom */
@keyframes slide-in-bottom {
  0% {
    transform: translateY(50px);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}

.animate-slide-in-bottom {
  animation: slide-in-bottom 1s ease-in-out;
}

/* Delays for Different Elements */
.animate-slide-in-bottom.delay-500 {
  animation-delay: 0.5s;
}

.animate-fade-in.delay-1000 {
  animation-delay: 1s;
}

/* Background color for button */
.bg-primary {
  background-color: #1a3862;
}

.border-primary {
  border-color: #1f2937;
}
</style>
