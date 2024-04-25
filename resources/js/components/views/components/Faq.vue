<script setup>
import { ref } from 'vue';

// Questions et réponses avec états pour l'ouverture/fermeture
const faqs = [
  { question: 'Qu\'est-ce que votre service offre ?', answer: 'Notre service offre des fichiers de contacts professionnels de haute qualité.', open: ref(false) },
  { question: 'Comment puis-je m\'inscrire ?', answer: 'Pour vous inscrire, cliquez sur le bouton "Inscription" en haut de la page.', open: ref(false) },
  { question: 'Y a-t-il des frais d\'abonnement ?', answer: 'Oui, nous avons plusieurs forfaits adaptés à vos besoins.', open: ref(false) },
  { question: 'Puis-je obtenir des fichiers de contacts personnalisés ?', answer: 'Bien sûr, nous proposons des options de personnalisation pour répondre à vos besoins spécifiques.', open: ref(false) },
  { question: 'Vos fichiers sont-ils à jour ?', answer: 'Nous mettons régulièrement à jour nos fichiers pour assurer la précision des contacts.', open: ref(false) },
  { question: 'Quelle est votre politique de confidentialité ?', answer: 'Nous nous engageons à protéger votre confidentialité et à ne pas partager vos données avec des tiers.', open: ref(false) },
  { question: 'Quelle est la politique de remboursement ?', answer: 'Nous offrons un remboursement complet dans les 30 jours suivant l\'achat, sous certaines conditions.', open: ref(false) },
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
  <section class="py-16 px-4 mx-3 bg-gray-100">
    <div class="container mx-auto px-2 text-center">
      <!-- Titre de la section -->
      <h2 class="text-2xl font-bold text-gray-800 mb-10">Questions Fréquemment Posées</h2>
      
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
              <span class="text-xl font-semibold text-gray-800">{{ faq.question }}</span>
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
