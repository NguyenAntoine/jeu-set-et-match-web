var loc = window.location, new_uri;
if (loc.protocol === "https:") {
    new_uri = "ws://";
} else {
    new_uri = "ws://";
}

const host = "localhost";
//const host = "ns388377.ip-176-31-253.eu";

var webSocket = WS.connect(new_uri + host + ":8080");

var div = document.querySelector('.id-fixture');
const fixtureId = div.dataset.fixtureId;

webSocket.on("socket/connect", function (session) {
    //session is an Autobahn JS WAMP session.

    console.log("Successfully Connected!");
    //the callback function in "subscribe" is called everytime an event is published in that channel.
    session.subscribe("fixture/" + fixtureId, function (uri, payload) {
        var json;
        if (typeof(payload) === 'object') {
            json = payload;
        } else {
            json = JSON.parse(payload);
        }

        var firstPoint = json['firstPlayerPoint'];
        if (firstPoint !== undefined) {
            $('.first-player').text(firstPoint);
        }

        var secondPoint = json['secondPlayerPoint'];
        if (secondPoint !== undefined) {
            $('.second-player').text(secondPoint);
        }

        var isSetWin = json['isSetWin'];

        var firstSetPlayer = json['firstSetPlayer'];
        if (firstSetPlayer !== undefined) {
            const set = $('.set-last-first');

            set.text(firstSetPlayer);
            if (isSetWin !== undefined && isSetWin === true) {
                set.after('<td class="set set-last-first align-middle">0</td>');
                set.removeClass("set-last-first");
            }
        }

        var secondSetPlayer = json['secondSetPlayer'];
        if (secondSetPlayer !== undefined) {
            const set = $('.set-last-second');

            set.text(secondSetPlayer);
            if (isSetWin !== undefined && isSetWin === true) {
                set.after('<td class="set set-last-second align-middle">0</td>');
                set.removeClass("set-last-second");
            }
        }


        if (json['registration'] !== undefined || json['stat'] !== undefined || json['datetime'] !== undefined) {
            $('.card-footer').append("<p class=\"card-text\">" + json['stat'] + " pour " + json['registration'] + " à " + json['datetime'] + "</p>");
        }
    });
});

webSocket.on("socket/disconnect", function (error) {
    //error provides us with some insight into the disconnection: error.reason and error.code

    session.unsubscribe("fixture/" + fixtureId);
    console.log("Disconnected for " + error.reason + " with code " + error.code);
});
