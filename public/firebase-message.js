importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

firebase.initializeApp({
  apiKey: 'your-api-key', // Dari Project settings -> General -> Web API Key
  authDomain: 'your-project-id.firebaseapp.com', // Dari Project settings -> General -> Auth Domain
  projectId: 'perpusda-d1bef', // Dari Project settings -> General -> Project ID
  storageBucket: 'your-project-id.appspot.com', // Dari Project settings -> General -> Storage bucket
  messagingSenderId: '10027851049', // Dari Project settings -> Cloud Messaging -> Sender ID
  appId: 'your-app-id', // Dari Project settings -> General -> App ID (Web)
});

// Dapatkan objek messaging
const messaging = firebase.messaging();

// Handler saat notifikasi diterima ketika browser di background
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: '/firebase-logo.png' // Ganti dengan path ikon Anda
  };

  return self.registration.showNotification(notificationTitle, notificationOptions);
});