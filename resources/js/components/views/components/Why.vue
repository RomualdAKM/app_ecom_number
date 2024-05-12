<script setup>
</script>

<template>
  <!-- Section Pourquoi choisir nos fichiers de contacts -->
  <section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6 text-center">
      <!-- Titre de la section -->
      <h2 class="text-4xl font-bold text-green-800 mb-10">Pourquoi choisir nos fichiers de contacts ?</h2>
      
      <!-- Liste des avantages -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Avantage 1 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 animate-fade-in">
          <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-12 h-12 mx-auto text-primary">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-green-800">Trouver des prospects de qualité</h3>
          <p class="text-gray-600 mt-2">
            Accédez à des listes de contacts triées sur le volet pour trouver des prospects qualifiés rapidement.
          </p>
        </div>
        
        <!-- Avantage 2 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 animate-fade-in delay-200">
          <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-12 h-12 mx-auto text-primary">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.8a7.2 7.2 0 110 14.4 7.2 7.2 0 010-14.4z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-green-800">Gagner du temps</h3>
          <p class="text-gray-600 mt-2">
            Économisez des heures de recherche grâce à des fichiers de contacts prêts à l'emploi.
          </p>
        </div>
        
        <!-- Avantage 3 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 animate-fade-in delay-400">
          <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-12 h-12 mx-auto text-primary">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12l-3-3-3 3 3 3 3-3z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-green-800">Améliorer votre portée</h3>
          <p class="text-gray-600 mt-2">
            Utilisez des contacts qualifiés pour augmenter votre portée marketing et toucher plus de clients potentiels.
          </p>
        </div>
        <!-- Avantage 1 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 animate-fade-in">
          <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-12 h-12 mx-auto text-primary">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M9 6l6 6" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-green-800">Économie de Coût</h3>
          <p class="text-gray-600 mt-2">
            L'utilisation de fichiers de contacts prêts à l'emploi réduit les coûts liés à la collecte de données et accélère vos campagnes marketing. 
          </p>
        </div>
        
        <!-- Avantage 2 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 animate-fade-in delay-200">
          <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-12 h-12 mx-auto text-primary">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.8a7.2 7.2 0 110 14.4 7.2 7.2 0 010-14.4z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-green-800">Personnalisation</h3>
          <p class="text-gray-600 mt-2">
            Les fichiers peuvent être adaptés à vos besoins spécifiques, avec des options de segmentation pour des campagnes plus ciblées.
          
          </p>
        </div>
        
        <!-- Avantage 3 -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 animate-fade-in delay-400">
          <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-12 h-12 mx-auto text-primary">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12l-3-3-3 3 3 3 3-3z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-green-800">Résultats Rapides</h3>
          <p class="text-gray-600 mt-2">
            Avec des contacts qualifiés, obtenez des résultats rapides et efficaces dans vos campagnes marketing. 
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Couleur pour les icônes */
.text-primary {
  color: #123e62; /* Ajustez selon votre thème */
}


/* Animation de fade-in pour les éléments */
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.animate-fade-in {
  animation: fade-in 2s ease-in;
}

.animate-fade-in.delay-200 {
  animation-delay: 1.2s;
}

.animate-fade-in.delay-400 {
  animation-delay: 1.4s;
}
</style>
