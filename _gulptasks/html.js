import { src, dest } from "gulp";
import pug from "gulp-pug";
import plumber from "gulp-plumber";
import rename from "gulp-rename";

export const pugTask = () => {
    return src(["src/pages/*.pug", "!src/pages/_*.pug"])
        .pipe(plumber())
        .pipe(
            pug({
                pretty: "\t",
            })
        )
        .pipe(
            rename({
                extname: ".php",
            })
        )
        .pipe(dest("."));
};

module.exports = pugTask;
