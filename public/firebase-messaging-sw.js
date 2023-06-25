// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.15.5/firebase-messaging.js');
importScripts('https://www.gstatic.com/firebasejs/7.15.5/firebase-firestore.js');
importScripts('https://www.gstatic.com/firebasejs/7.15.5/firebase-functions.js');
// <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.

var firebaseConfig = {
    apiKey: "AIzaSyACKbKHpJzRvwgS7b6vPYs3BSc7BzjQVFg",
    authDomain: "laravel10-86dfb.firebaseapp.com",
    projectId: "laravel10-86dfb",
    storageBucket: "laravel10-86dfb.appspot.com",
    messagingSenderId: "644526554058",
    appId: "1:644526554058:web:73255caaf04e262031ed33",
    measurementId: "G-454Y0FGPBK"
};

firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
        body: 'Background Message body.',
        icon: '/firebase-logo.png'
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);

});
