import { src, dest } from "gulp";
import { readFileSync } from "graceful-fs";
const path = require("path");
const cache = require("gulp-cache");
const squoosh = require("gulp-libsquoosh");

export const copyImage = () => {
    return src("./src/img/**/**.{svg,png,jpg,speg,gif}")
        .pipe(
            cache(
                squoosh((src) => {
                    const extname = path.extname(src.path);
                    let options = {
                        encodeOptions: squoosh.DefaultEncodeOptions[extname],
                    };

                    if (extname === ".jpg") {
                        options = {
                            encodeOptions: {
                                mozjpeg: {
                                    quality: 75,
                                },
                            },
                        };
                    }

                    if (extname === ".png") {
                        options = {
                            encodeOptions: {
                                oxipng: {
                                    level: 6,
                                },
                            },
                        };
                    }

                    return options;
                })
            )
        )
        .pipe(dest("img"));
};

export const copyFonts = () => {
    let glob = JSON.parse(readFileSync("config.json"));
    return src(glob.font, {
        allowEmpty: true,
    }).pipe(dest("fonts"));
};

export const copyFavicon = () => {
    return src("src/favicon.ico", {
        allowEmpty: true,
    }).pipe(dest("../"));
};

module.exports = {
    copyFonts,
    copyImage,
    copyFavicon,
};
