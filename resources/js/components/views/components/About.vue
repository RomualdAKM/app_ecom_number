<script setup>
</script>

<template>
  <!-- Section À propos -->
  <section class="py-16 bg-white" id="about">
    <div class="container mx-auto px-6">
      <!-- Titre de la section -->
      <h2 class="text-4xl font-bold text-center text-green-800 mb-10">À propos des fichiers de contacts</h2>

      <!-- Contenu principal -->
      <div class="flex flex-col md:flex-row md:space-x-8 items-center">
        <!-- Image de présentation -->
        <div class="md:w-1/2">
          <img src="images/about.png" alt="Fichiers de contacts"
            class="rounded-lg shadow-lg transition-transform duration-300 hover:scale-105" />
        </div>

        <!-- Texte de présentation -->
        <div class="md:w-1/2 mt-8 md:mt-0">
          <p class="text-lg text-gray-600 leading-7 mb-6">
            Les fichiers de contacts offrent <span class="text-green-800">un accès rapide à des milliers </span> de
            connexions professionnelles, permettant aux entreprises de développer leur réseau de manière efficace. Ils
            constituent un outil précieux pour les campagnes marketing ciblées et la génération de prospects.
          </p>
          <p class="text-lg text-gray-600 leading-7 mb-6">
            Ces fichiers sont méticuleusement organisés et mis à jour pour garantir leur précision. Que vous soyez une
            start-up cherchant à élargir sa base de clients ou une grande entreprise souhaitant lancer une nouvelle
            campagne, les fichiers de contacts vous offrent <span class="text-green-800"> la flexibilité nécessaire
            </span> .
          </p>

          <h3 class="text-2xl font-semibold text-gray-800 mb-6">Comment ça marche ?</h3>
          <ul>
            <li class="flex items-start text-lg text-gray-600 leading-7 mb-6">
              <i class="fas fa-check-circle text-green-800 mr-3 mt-1"></i>
              <span>
                Parcourez notre collection et ajoutez les fichiers que vous souhaitez télécharger à votre panier.
              </span>
            </li>
            <li class="flex items-start text-lg text-gray-600 leading-7 mb-6">
              <i class="fas fa-check-circle text-green-800 mr-3 mt-1"></i>
              <span>
                Accédez à votre panier et suivez les étapes du processus de paiement sécurisé.
              </span>
            </li>
            <li class="flex items-start text-lg text-gray-600 leading-7 mb-6">
              <i class="fas fa-check-circle text-green-800 mr-3 mt-1"></i>
              <span>
                Connectez-vous à votre espace compte, accédez à la section "Mes achats" et téléchargez vos fichiers.
              </span>
            </li>
            <li class="flex items-start text-lg text-gray-600 leading-7 mb-6">
              <i class="fas fa-check-circle text-green-800 mr-3 mt-1"></i>
              <span>
                Une fois le téléchargement terminé, les fichiers sont immédiatement enregistrés sur votre appareil.
              </span>
            </li>
          </ul>



          <p class="text-lg text-gray-600 leading-7 mb-6">
            En investissant dans ces fichiers, vous gagnez du temps sur la recherche de prospects et réduisez le coût
            d'acquisition des clients. C'est la solution idéale pour les professionnels qui veulent établir <span
              class="text-green-800"> des connexions rapidement et efficacement </span> .
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Effet de survol pour l'image */
img {
  transition: transform 0.3s ease-in-out;
}

img:hover {
  transform: scale(1.05);
}
</style>
