import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

// JWT token from localStorage
const token = localStorage.getItem('token');
// Conversation ID from localStorage (if needed)
const conversationId = localStorage.getItem('conversationId');

// Initialize Echo
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    authEndpoint: '/broadcasting/auth', //auth endpoint
    auth: {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    },
});

// Example: Listening to a private channel for a specific conversation
if (conversationId) {
    window.Echo.private(`chat.${conversationId}`)
        .listen('MessageSent', (e) => {
            console.log('New message received:', e.message);
        });
}





