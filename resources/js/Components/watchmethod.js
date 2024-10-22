// useMethodWatcher.js
import { watch,ref } from 'vue';
import { router } from '@inertiajs/vue3';

// go to different forms with methods
export function useMethodWatcher(form) {
  watch(() => form.method, (newMethod) => {
    if (newMethod === 'multiplechoice') {
      router.get('/create_image_poll', {}, { preserveScroll: true });
    } else if (newMethod === 'rankingpoll') {
      router.get('/create_ranking_poll', {}, { preserveScroll: true });
    } else if (newMethod === 'imagepoll') {
      router.get('/create_poll', {}, { preserveScroll: true });
    }
  });
}

// methods of all pages
export const methods = [
    { id: 1, name: 'multiplechoice', label: 'Multiple Poll' },
    { id: 2, name: 'imagepoll', label: 'Image Poll' },
    { id: 3, name: 'rankingpoll', label: 'Ranking Poll' },
  ];

  // checks of all pages
 export const checks = ref([
    { id: 1, name: 'vote_per_ip', label: 'One vote per IP address' },
    { id: 2, name: 'require_names', label: 'Require participants names' },
    { id: 3, name: 'other_option_vote', label: 'Show "Other" options in voting list' },
    { id: 4, name: 'other_option_results', label: 'Combine "Other" options in results' },
  ]);
