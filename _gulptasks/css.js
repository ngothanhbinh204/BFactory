import { src, dest } from "gulp";
const sass = require("gulp-sass")(require("node-sass"));
import concat from "gulp-concat";
import sourcemap from "gulp-sourcemaps";
import cssnano from "cssnano";
import postcss from "gulp-postcss";
import cssSort from "css-declaration-sorter";
import autoprefixer from "autoprefixer";
var csso = require("gulp-csso");

export const sassTask = () => {
    return src([
        "src/components/_core/**.sass",
        "src/components/_global/**.sass",
        "src/components/**/**.sass",
    ])
        .pipe(sourcemap.init())
        .pipe(concat("main.min.sass"))
        .pipe(sass().on("error", sass.logError))
        .pipe(
            postcss([
                autoprefixer({
                    browsers: ["last 4 version", "IE 9"],
                    cascade: false,
                }),
                cssnano(),
                cssSort({
                    order: "concentric-css",
                }),
            ])
        )
        .pipe(csso())
        .pipe(sourcemap.write("."))
        .pipe(dest("styles"));
};

module.exports = sassTask;
