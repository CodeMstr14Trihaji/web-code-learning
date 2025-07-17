// Inisialisasi CodeMirror
const htmlEditor = CodeMirror.fromTextArea(document.getElementById("html-code"), {
    mode: "text/html",
    theme: "darcula",   
    lineNumbers: true,
});

const cssEditor = CodeMirror.fromTextArea(document.getElementById("css-code"), {
    mode: "css",
    theme: "darcula",
    lineNumbers: true,
});

const jsEditor = CodeMirror.fromTextArea(document.getElementById("js-code"), {
    mode: "javascript",
    theme: "darcula",
    lineNumbers: true,
});

function run() {
    const html = htmlEditor.getValue();
    const css = cssEditor.getValue();
    const js = jsEditor.getValue();

    const output = document.getElementById("output");
    output.srcdoc = `
        <html>
        <head><style>${css}</style></head>
        <body>${html}<script>${js}<\/script></body>
        </html>`;
}

// Event listener agar selalu update saat ngetik
htmlEditor.on("change", run);
cssEditor.on("change", run);
jsEditor.on("change", run);
