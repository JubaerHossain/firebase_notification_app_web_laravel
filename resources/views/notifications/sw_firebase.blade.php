importScripts('//www.gstatic.com/firebasejs/8.7.1/firebase-app.js');
importScripts('//www.gstatic.com/firebasejs/8.7.1/firebase-messaging.js');

@include('notifications.init_firebase')

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
console.log('[firebase-messaging-sw.js] Received background message ', payload);
// Customize notification here
const notificationTitle = payload.data.title;
const notificationOptions = {
body: payload.data.body,
icon: payload.data.icon,
};

return self.registration.showNotification(notificationTitle,notificationOptions);
});
// {{ env('APP_NAME') }}
