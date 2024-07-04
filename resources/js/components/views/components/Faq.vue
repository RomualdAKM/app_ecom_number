<script setup>
import { ref } from 'vue';

// Questions et réponses avec états pour l'ouverture/fermeture
const faqs = [
  { question: 'Qu\'est-ce que votre service offre ?', answer: 'Notre service offre des fichiers de contacts whatsapp professionnels de haute qualité.', open: ref(false) },
  { question: 'Comment fonctionne notre service ?', answer: 'Pour utiliser notre service, vous devez d\'abord ajouter le pack de fichiers de contacts que vous souhaitez acheter au panier. Une fois que vous passez à la caisse, vous pouvez consulter Mes achats dans votre espace de compte. Dans l\'onglet "Mes achats", vous pouvez voir le téléchargement des fichiers de contacts après avoir terminé le processus de paiement. Une fois que vous avez téléchargé les fichiers, ils seront directement enregistrés sur votre appareil.', open: ref(false) },
 
  { question: 'Vos fichiers sont-ils à jour ?', answer: 'Nous mettons régulièrement à jour nos fichiers pour assurer la précision des contacts.', open: ref(false) },
 
  { question: 'Comment puis-je contacter le support ?', answer: 'Vous pouvez nous contacter via notre page de support ou par téléphone.', open: ref(false) },
  { question: 'Avez-vous des ressources pour aider à utiliser les fichiers de contacts ?', answer: 'Oui, nous proposons des guides et des tutoriels pour vous aider à utiliser nos fichiers efficacement.', open: ref(false) },
];

// Fonction pour basculer l'état d'une question
const toggleFaq = (faq) => {
  faq.open.value = !faq.open.value;
};
</script>

<template>
  <!-- Section FAQ avec animations -->
  <section class="py-16 px-4 mx-3 bg-gray-100" id="faqs">
    <div class="container mx-auto px-2 text-center">
      <!-- Titre de la section -->
      <h2 class="text-2xl font-bold text-green-800 mb-10">Questions Fréquemment Posées</h2>

      <!-- Liste des questions/réponses -->
      <ul class="space-y-6">
        <!-- Boucle pour créer les questions -->
        <li v-for="faq in faqs" :key="faq.question">
          <div
            @click="toggleFaq(faq)"
            class="cursor-pointer bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl"
          >
            <!-- Question et icône de basculement -->
            <div class="flex justify-between items-center">
              <span class="text-xl font-semibold text-green-800">{{ faq.question }}</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                class="w-6 h-6 text-gray-600 transition-transform"
                :class="{ 'rotate-180': faq.open.value }"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6l-6 6 6 6" />
              </svg>
            </div>
            <!-- Affichage conditionnel de la réponse -->
            <transition name="slide-fade" mode="out-in">
              <div v-if="faq.open.value" class="mt-4 text-gray-600">
                {{ faq.answer }}
              </div>
            </transition>
          </div>
        </li>
      </ul>
    </div>
  </section>
</template>

<style scoped>
/* Transition pour le glissement lors de l'ouverture/fermeture des réponses */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.3s ease-in-out;
}

.slide-fade-enter {
  opacity: 0;
  transform: translateY(-10px);
}

.slide-fade-leave {
  opacity: 0;
  transform: translateY(10px);
}

/* Effet de rotation pour l'icône lors de l'ouverture/fermeture */
.rotate-180 {
  transform: rotate(180deg);
}


</style>
