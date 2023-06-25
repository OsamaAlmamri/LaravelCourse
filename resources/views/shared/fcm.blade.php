<script src="{{asset('/firebase/firebase-app.js')}}"></script>
<script src="{{asset('/firebase/firebase-messaging.js')}}"></script>
<script src="{{asset('/firebase/firebase-analytics.js')}}"></script>
<script>

    function playAudio() {
        var mp3Source = '<source src="{{url('firebase/mixkit-confirmation-tone-2867.mp3')}}" type="audio/mpeg">';
        var embedSource = '<embed hidden="true" autostart="true" loop="false" src="{{url('firebase/mixkit-confirmation-tone-2867.mp3')}}">';
        document.getElementById("sound").innerHTML = '<audio autoplay="autoplay">' + mp3Source +embedSource+ '</audio>';
    }
  {{--function  playAudio()--}}
  {{--  {--}}
  {{--      var audio = new Audio("{{url('firebase/mixkit-confirmation-tone-2867.mp3')}}");--}}
  {{--      audio.play();--}}
  {{--  }--}}
    $(document).ready(function () {

        var fcm_server_key = "BAQZ5b3ho0LgxOMX9YScXsFdD5jyk5tia5O4XpVUnttXexkizHx2yRM-03BCwpaAT1R4T_sXxHFJoD6eYFO5LvE";

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyACKbKHpJzRvwgS7b6vPYs3BSc7BzjQVFg",
            authDomain: "laravel10-86dfb.firebaseapp.com",
            projectId: "laravel10-86dfb",
            storageBucket: "laravel10-86dfb.appspot.com",
            messagingSenderId: "644526554058",
            appId: "1:644526554058:web:73255caaf04e262031ed33",
            measurementId: "G-454Y0FGPBK"
        };

        console.log('Notification permission granted.');
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        messaging.requestPermission()
            .then(function () {
                console.log('Notification permission granted.');
                // TODO(developer): Retrieve a Instance ID token for use with FCM.
                // ...
            })
            .catch(function (err) {
                console.log('Unable to get permission to notify.----------- ', err);
            });
        messaging.usePublicVapidKey(fcm_server_key);
        // Get Instance ID token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        messaging.requestPermission()
            .then(() => {
                console.log("Have Permission");
                return messaging.getToken();
            })
            .then(token => {
                console.log("FCM Token:", token);
                $("#device_token").val(token);
                setCookie('fcm_token', token, 7);

                $.ajax({
                    url: "{{route('fcm_token')}}",
                    data: {
                        token: token,
                    },
                    type:"get",

                });
                // subscribeTokenToTopic(token, "all")


                //Do something with TOken like subscribe to topics
            })
            .catch(error => {
                if (error.code === "messaging/permission-blocked") {
                    console.log("Please Unblock Notification Request Manually");
                } else {
                    console.log("Error Occurred", error);
                }
            });


        messaging.onMessage(function (payload) {
            //playAudio()

            console.log('Message received. ', payload);

            var nottifi=`<a class="dropdown-item d-flex align-items-center" href="`+payload.notification.click_action+`">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <img  width="40" src="`+payload.notification.image+`">
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{now()}}</div>
                    <span class="font-weight-bold">`+payload.notification.title+`</span>
                </div>
            </a>
`;
            $("#notifiction_count").html(parseInt($("#notifiction_count").html())+1)
            $("#notifiction_list").prepend(nottifi)
            const notificationTitle = 'Background Message Title';
            const notificationOptions = {
                body: 'Background Message body.',
                icon: '/firebase-logo.png'
            };
    //       self.registration.showNotification(notificationTitle, notificationOptions);
        });

      // messaging.onBackgroundMessage((payload) => {
      //     console.log(
      //         '[firebase-messaging-sw.js] Received background message ',
      //         payload
      //     );
      //     // Customize notification here
      //     const notificationTitle = 'Background Message Title';
      //     const notificationOptions = {
      //         body: 'Background Message body.',
      //         icon: '/firebase-logo.png'
      //     };
      //
      //     self.registration.showNotification(notificationTitle, notificationOptions);
      // });
    });
</script>
