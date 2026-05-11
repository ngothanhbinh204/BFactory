const templates = {
    pug: (name) => ``,
    sass: (name) => ``,
};

const fs = require("fs");
const chokidar = require("chokidar");

const fileExists = (path) => (file) => fs.existsSync(`${path}/${file}`);

const fileExistsInSrc = fileExists("/src/components"); // file => fs.existsSync(`${path}/${file}`)

fileExistsInSrc("index.js"); // true || false

const writeToPath = (path) => (file, content) => {
    const filePath = `${path}/${file}`;
    fs.writeFile(filePath, content, (err) => {
        if (err) throw err;
        console.log("Created file: ", filePath);
        return true;
    });
};

const watcher = chokidar
    .watch("src/components/**", { ignored: /node_modules/ })
    .on("addDir", (path, event) => {
        const name = path.replace(/^.*[\\\/]/, "");
        const goodToGo = /^[^\/_]*$/.test(name);
        if (goodToGo) createFiles(path, "index");
    });

function createFiles(path, name) {
    const files = {
        pug: `${name}.pug`,
        sass: `${name}.sass`,
    };

    if (name !== "components") {
        const writeFile = writeToPath(path);
        const toFileMissingBool = (file) => !fileExists(path)(file);
        const checkAllMissing = (acc, cur) => acc && cur;

        const noneExist = Object.values(files)
            .map(toFileMissingBool)
            .reduce(checkAllMissing);

        if (noneExist) {
            console.log(`Detected new component: ${name}, ${path}`);
            Object.entries(files).forEach(([type, fileName]) => {
                writeFile(fileName, templates[type](name));
            });
        }
    }
}
