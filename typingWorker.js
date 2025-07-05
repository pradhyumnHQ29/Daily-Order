// typingWorker.js
self.onmessage = function (e) {
    const text = e.data;
    let index = 0;

    function typeChar() {
        if (index < text.length) {
            self.postMessage(text.charAt(index));
            index++;
            setTimeout(typeChar, 50);
        } else {
            self.postMessage("done");
        }
    }

    typeChar();
};
